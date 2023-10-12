<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToArticles extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->enum('status',['on' , 'off'])->default('off'); 
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}

