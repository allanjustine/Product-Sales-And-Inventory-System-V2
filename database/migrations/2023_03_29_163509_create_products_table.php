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
            $table->foreignId('product_category_id')->nullable();
            $table->longText('product_image')->nullable();
            $table->string('product_name');
            $table->text('product_description');
            $table->string('product_status');
            $table->string('product_stock');
            $table->decimal('product_price', 10, 2);
            $table->decimal('product_rating', 3, 1)->default(0);
            $table->string('product_code');
            $table->unsignedInteger('product_sold')->default(0);
            $table->unsignedInteger('product_votes')->default(0);
            $table->timestamps();

            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
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
