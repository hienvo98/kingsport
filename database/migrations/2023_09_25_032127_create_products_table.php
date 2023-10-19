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
            $table->text('description')->nullable();
            $table->integer('regular_price');
            $table->integer('sale_price');
            $table->integer('discount')->nullable();
            $table->enum('status_stock',['off' , 'on'])->default('off');
            $table->enum('on_outstanding',['off' , 'on'])->default('off');
            $table->enum('on_hot',['off' , 'on'])->default('off');
            $table->enum('on_sale',['off' , 'on'])->default('off');
            $table->enum('on_installment',['off' , 'on'])->default('off');
            $table->enum('on_new',['off' , 'on'])->default('off');
            $table->enum('on_comming',['off' , 'on'])->default('off');
            $table->enum('on_gift',['off' , 'on'])->default('off');
            $table->integer('event_id')->nullable();
            $table->integer('outstanding_id')->nullable();
            $table->integer('rate')->nullable();
            $table->integer('sorting')->unsigned()->default(1)->nullable();
            $table->enum('status', ['off', 'on',])->default('off');
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
