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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity');
            $table->integer('category_id');
            $table->integer('category_type_id');
            $table->integer('regular_price'); // Giá thực 
            $table->integer('sale_price'); // Giá sale
            $table->integer('event_id'); // sự kiện hằng tháng
            $table->boolean('on_hot')->default(false); // hot
            $table->boolean('on_coming')->default(false); // sắp về 
            $table->boolean('on_new')->default(false); // mới về 
            $table->boolean('on_outstanding')->default(false); // nổi bật
            $table->boolean('on_gift')->default(false); // có quà tặng
            $table->boolean('on_installment')->default(false); // được trả góp hay không
            $table->integer('post_id'); // bài viết về sản phẩm
            $table->integer('outstanding_id'); // tính năng nổi bật
            $table->integer('rating');
            $table->integer('sorting'); // thứ tự hiển thị
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
