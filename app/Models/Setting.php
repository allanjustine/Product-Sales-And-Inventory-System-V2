<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'links' => 'array'
    ];

    protected function getLocationLinkUrlAttribute()
    {
        return preg_match('/src=["\']([^"\']+)["\']/', $this->location_link, $matches)
            ? $matches[1]
            : 'https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d413.07098686836446!2d123.970567480301!3d9.949291019306209!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zOcKwNTYnNTcuMCJOIDEyM8KwNTgnMTMuOCJF!5e0!3m2!1sen!2sph!4v1681485598511!5m2!1sen!2sph';
    }
}
