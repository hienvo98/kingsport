<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowRoom extends Model
{
    use HasFactory;
    protected $table = 'showroom';
    protected $fillable = [
        'name',
        'address',
        'url',
        'region_id',
        'phone',
        'status',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'content',
        'images',
        'thumbnail',
        'latitude',
        'longitude',
    ];
}
