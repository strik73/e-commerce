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
            $table->string('no_transaction')->primary();
            $table->string('item_no_item');
            $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('item_no_item')->references('no_item')->on('items')->onUpdate('cascade');
            $table->integer('quantity');
            $table->double('total_price');
            $table->string('status');
            $table->timestamps();
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
