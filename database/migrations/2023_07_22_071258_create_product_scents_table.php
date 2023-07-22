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
        Schema::create('product_scents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();

            
            $table->unsignedBigInteger('pro_id');
            $table->foreign('pro_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_scents');
    }
};
