<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = ['name','url','avatar','ordinal_number','status'];
    public function subCategory(){
        return $this->hasMany(SubCategory::class,'category_id');
    }
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }

    public function faq(){
        return $this->hasMany(FAQS::class);
    }
}
