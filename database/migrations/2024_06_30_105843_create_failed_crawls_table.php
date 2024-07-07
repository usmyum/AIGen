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
        Schema::create('failed_crawls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('search_id')->constrained()->onDelete('cascade');
            $table->string('url');
            $table->text('error_message');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('failed_crawls');
    }
};
