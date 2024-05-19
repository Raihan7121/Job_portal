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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category'); 
            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')->references('id')->on('users');
            $table->string('product_description')->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_video')->nullable();
            $table->float('weight')->unsigned();
            $table->float('regular_price')->unsigned();
            $table->float('offer_price')->nullable()->unsigned();
            $table->integer('quantity')->unsigned();
            $table->integer('no_of_sales')->default(0)->unsigned();
            $table->float('total_revenue')->default(0)->unsigned();
            $table->integer('status')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
