<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopSearch extends Model
{
    use HasFactory;
    protected $table = 'topsearcheds';
    protected $fillable = ['name','url','seo_title','seo_keywords','seo_description','status'];
}
