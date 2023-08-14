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
        Schema::create('artworks', function (Blueprint $table) {
            Schema::create('artworks', function (Blueprint $table) {
                $table->increments('id');
                $table->string('artwork_image')->nullable();
                $table->string('title');
                $table->string('category_id')->nullable();
                $table->string('size')->nullable();
                $table->float('price');
                $table->string('artist_name')->nullable();
                $table->string('medium')->nullable();
                $table->string('description');
                $table->string('address');
                $table->date('created_date')->nullable();
                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artworks');
    }
};
