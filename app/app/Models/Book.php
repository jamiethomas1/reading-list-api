<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'authors_array',
        'published',
        'genres_array',
        'length_pages',
        'complete',
        'current_page',
        'current_chapter',
        'started_reading',
        'finished_reading',
        'cover_image_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'authors_array' => 'array',
            'genres' => 'array',
        ];
    }
}
