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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('subtotal', 5, 2);
            $table->decimal('tax', 5, 2);
            $table->decimal('total', 5, 2);
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('dis_id');
            $table->foreign('dis_id')->references('id')->on('discounts');

            $table->unsignedBigInteger('cus_id');
            $table->foreign('cus_id')->references('id')->on('customer_information');

            $table->unsignedBigInteger('shi_id');
            $table->foreign('shi_id')->references('id')->on('shipping_methods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
