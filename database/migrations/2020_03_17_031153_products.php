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
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('images')->nullable();
            $table->double('price')->nullable()->default(0);
            $table->float('sale_up')->nullable()->default(0);
            $table->integer('quantity')->nullable()->default(1);
            $table->tinyInteger('status')->nullable()->default(1);
            $table->tinyInteger('is_hot')->nullable()->default(0);
            $table->tinyInteger('is_bestseller')->nullable()->default(0);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
