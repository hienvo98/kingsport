<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'category_type';
    protected $fillable = ['name','url','category_id','ordinal_number','avatar','status'];
    public function products(){
        return $this->belongsToMany(product::class,'product_subcategory','subCategory_id','product_id');
    }
}
