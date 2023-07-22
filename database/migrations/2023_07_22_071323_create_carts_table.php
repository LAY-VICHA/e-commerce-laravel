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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('quantity');
            $table->boolean("status");
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('pro_id');
            $table->foreign('pro_id')->references('id')->on('products');

            $table->unsignedBigInteger('sce_id');
            $table->foreign('sce_id')->references('id')->on('product_scents');

            $table->unsignedBigInteger('siz_id');
            $table->foreign('siz_id')->references('id')->on('product_sizes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
