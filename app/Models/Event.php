<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'event';
    protected $fillable = ['name', 'banners', 'product_id'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
