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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');

            $table->unsignedBigInteger('pro_id');
            $table->foreign('pro_id')->references('id')->on('products');

            $table->unsignedBigInteger('sce_id');
            $table->foreign('sce_id')->references('id')->on('product_scents');

            $table->unsignedBigInteger('siz_id');
            $table->foreign('siz_id')->references('id')->on('product_sizes');

            $table->bigInteger("quantity");
            $table->decimal("subtotal", 5, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
