<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('images')->nullable();
            $table->float('price')->default(0);
            $table->integer('quantity')->default(1);
            $table->float('sale_up')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_hot')->nullable()->default(0);
            $table->tinyInteger('is_bestseller')->nullable()->default(0);
            $table->string('slug')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
