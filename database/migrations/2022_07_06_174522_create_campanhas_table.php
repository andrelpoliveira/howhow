<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('campanhas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marca_id');
            $table->string('campaign_name');
            $table->string('start_date');
            $table->string('finish_date');
            $table->string('type');
            $table->string('funds');
            $table->string('content');
            $table->string('filter_category');
            $table->string('filter_engagement');
            $table->timestamps();

            $table->foreign('marca_id')->references('id')->on('marcas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('campanhas');
    }
};
