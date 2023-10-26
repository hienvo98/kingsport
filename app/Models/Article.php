<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table = 'articles';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products(){
        if(isset($this->product_id)&&is_array(unserialize($this->product_id))){
            return Product::whereIn('id',unserialize($this->product_id))->get();
        }else{
            return collect();
        }
    }
    
}
