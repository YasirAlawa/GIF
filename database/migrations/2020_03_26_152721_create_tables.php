<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->string('name')->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('password')->nullable(false);
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->string('path')->nullable(false);
            $table->string('origin_name')->nullable(false);
            $table->integer('user_id')->nullable(false);
            $table->timestamps();
            $table->index(['user_id']);
        });
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->string('tag_name')->nullable(false);          
            $table->timestamps();
        });

        Schema::create('image_tags', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->integer('tag_id')->nullable(false);
            $table->integer('image_id')->nullable(false);                  
            $table->timestamps();
            $table->index(['image_id']);   
            $table->index(['tag_id']); 
        });

        Schema::create('user_search', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->integer('user_id')->nullable(false);            
            $table->timestamps();
            $table->index(['user_id']);   
        });

        Schema::create('search_tags', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->integer('user_search_id')->nullable(false);
            $table->integer('tag_id')->nullable(false);           
            $table->timestamps();
            $table->index(['user_search_id']);   
            $table->index(['tag_id']); 
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables');
    }
}
