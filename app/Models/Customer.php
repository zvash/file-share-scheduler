<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public static function store($data)
    {
        Log::info('store', $data);
        return Customer::query()->create([
            'name' => $data['name'],
            'hours' => $data['hours'],
            'token' => Ulid::generate(),
        ]);
    }
}
