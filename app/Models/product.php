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
        'subcategory_id',
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
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function colors(){
        return $this->hasMany(color_version::class);
    }

}
