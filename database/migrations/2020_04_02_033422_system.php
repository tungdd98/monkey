<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class System extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('hotline')->nullable();
            $table->string('time')->nullable();
            $table->string('copyright')->nullable();
            $table->string('fanpage')->nullable();
            $table->string('brief')->nullable();
            $table->string('facebook')->nullable();
            $table->string('gmail')->nullable();
            $table->string('twitter')->nullable();
            $table->string('google')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system');
    }
}
