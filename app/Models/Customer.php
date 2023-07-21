<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Uid\Ulid;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hours',
        'token',
    ];

    protected $attributes = [
        'hours' => 24,
        'is_visited' => false,
        'is_active' => true,
    ];

    protected $appends = [
        'full_url',
        'valid_until_string',
    ];

    protected $casts = [
        'valid_until' => 'datetime',
    ];

    public static function store($data)
    {
        return Customer::query()->create([
            'name' => $data['name'],
            'hours' => $data['hours'],
            'token' => Ulid::generate(),
        ]);
    }

    public static function getActives()
    {
        return Customer::query()->where('is_active', true)
            ->where(function ($query) {
                return $query->whereNull('valid_until')
                    ->orWhere('valid_until', '>=', Carbon::now());
            })->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getFullUrlAttribute()
    {
        return '/tutorials/' . $this->token;
    }

    public function getValidUntilStringAttribute()
    {
        if (!$this->valid_until) {
            return "{$this->hours} hours after first access.";
        }
        if ($this->valid_until->timestamp >= Carbon::now()->timestamp) {
            return $this->valid_until->diffForHumans(Carbon::now()) . ' now ';
        }
        return 'Expired';
    }
}
