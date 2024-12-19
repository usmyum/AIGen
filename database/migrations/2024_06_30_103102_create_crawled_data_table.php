<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('crawled_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('search_id');
            $table->longText('content');
            $table->string('url');
            $table->timestamps();

            $table->foreign('search_id')->references('id')->on('searches')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('crawled_data');
    }
};
