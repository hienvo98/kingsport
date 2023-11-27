<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image_service extends Model
{
    use HasFactory;
    protected $table = 'image_services';
    protected $fillable = ['url','color_ver_id'];
    public function color(){
        return $this->belongsTo(color_version::class);
    }
}
