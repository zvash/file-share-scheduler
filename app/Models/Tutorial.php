<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Uid\Ulid;

class Tutorial extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'title',
        'thumbnail_url',
        'download_url',
        'size',
    ];

    protected $appends = [
        'url',
    ];

    public static function store(array $data)
    {
        return Tutorial::query()->create([
            'title' => $data['title'],
            'thumbnail_url' => array_key_exists('thumbnail_url', $data) ? $data['thumbnail_url'] : null,
            'download_url' => $data['download_url'],
            'size' => $data['size'] ? $data['size'] : null,
            'token' => Ulid::generate(),
        ]);
    }

    public function getUrlAttribute()
    {
        return '/tutorials/' . $this->token . '/download';
    }
}
