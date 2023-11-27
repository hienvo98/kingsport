<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color_version extends Model
{
    use HasFactory;
    protected $table = 'color_versions';
    protected $fillable = ['name','code_color','status','product_id'];
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function images(){
        return $this->hasOne(image_service::class,'color_ver_id');
    }
}