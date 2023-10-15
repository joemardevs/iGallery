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
        Schema::create('transactions', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('artwork_id');
            $table->unsignedBigInteger('user_id');
            $table->string('checkout_id');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->foreign('artwork_id')
                ->references('id')
                ->on('artworks');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
