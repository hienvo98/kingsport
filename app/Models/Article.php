<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table = 'articles';
    protected $fillable=[
        'title',
        'category_id',
        'url',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'thumbnail',
        'content',
        'on_form',
        'status',
        'publish_date',
        'user_id',
        'product_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //function lấy tất cả các sản phẩm liên quan đến bài viết
    public function products(){
        if(isset($this->product_id)&&is_array(unserialize($this->product_id))){
            return Product::whereIn('id',unserialize($this->product_id))->get();
        }else{
            return collect();
        }
    }
    
}
