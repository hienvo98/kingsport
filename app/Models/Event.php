<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'event';
    protected $fillable = ['name', 'banners', 'product_id','url','seo_title','seo_description','seo_keywords','status'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
