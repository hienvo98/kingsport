<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'category_type';
    public function products(){
        return $this->belongsToMany(product::class,'product_subcategory','subCategory_id','product_id');
    }
}
