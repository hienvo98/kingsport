<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('image_services', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->integer('product_id');
            $table->integer('color_ver_id');
            $table->integer('type');// có thể tạo thêm 1 bảng để lưu nếu muốn, quy định: 0: category, 1: product, 2:post,..phát sinh thì defined thêm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_services');
    }
};
