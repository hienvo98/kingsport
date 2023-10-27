<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQS extends Model
{
    use HasFactory;
    protected $table = 'faqs';
    protected $fillable = ['title', 'answer', 'question', 'url', 'category_id', 'meta_title', 'meta_description', 'meta_keywords', 'status'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
