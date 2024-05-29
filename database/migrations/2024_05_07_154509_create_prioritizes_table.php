<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prioritizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('store_id')->nullable();
            $table->tinyInteger('day');
            $table->double('total');
            $table->date('priority_expiration_date')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('prioritizes');
    }
};
