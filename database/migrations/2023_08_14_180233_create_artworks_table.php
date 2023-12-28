<?php

use App\Models\Category;
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
            $table->id();
            $table->unsignedBigInteger('artist_id')->nullable();
            $table->string('artwork_image')->nullable();
            $table->string('title');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('theme');
            $table->string('size')->nullable();
            $table->float('price');
            $table->boolean('is_sold')->default(false);
            $table->string('medium')->nullable();
            $table->string('description');
            $table->date('created_date')->nullable();
            $table->string('contact');
            $table->string('address');
            $table->timestamps();

            $table->foreign('artist_id')
                ->references('id')
                ->on('users')
                ->where('usertype', '=', 'artist');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
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
