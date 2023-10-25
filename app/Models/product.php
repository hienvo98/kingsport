<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'quantity',
        'category_id',
        'description',
        'regular_price',
        'sale_price',
        'discount',
        'status_stock',
        'on_outstanding',
        'on_hot',
        'on_sale',
        'on_installment',
        'on_new',
        'on_comming',
        'on_gift',
        'event_id',
        'outstanding_id',
        'rate',
        'sorting',
        'status',
        'avatar',
        'sold',
        'url',
        'subCategory_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function subCategory()
    {
        return $this->belongsToMany(SubCategory::class, 'product_subcategory','product_id','subCategory_id');
    }

    public function colors(){
        return $this->hasMany(color_version::class);
    }

    public function images(){
        return $this->hasManyThrough(image_service::class,color_version::class,'product_id','color_ver_id');
    }
    public function articles(){
        return $this->belongsToMany(Article::class,'product_article','product_id','article_id');
    }
}
