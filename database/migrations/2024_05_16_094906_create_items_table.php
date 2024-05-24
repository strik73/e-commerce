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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->references('id')->on('categories')->onUpdate('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->integer('stock');
            $table->string('condition');
            $table->double('price');
            $table->text('description');
            $table->boolean('status');
            $table->string('image');
            $table->string('imageSec')->nullable();
            $table->string('imageThird')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
