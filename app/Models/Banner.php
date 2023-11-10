<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banners';
    protected $fillable = ['user_id','name','image','sorting','seo_title','seo_description','seo_keywords','status'];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
