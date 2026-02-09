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
            $table->string('product_name');
            $table->text('product_description');
            $table->string('product_status');
            $table->integer('product_stock')->default(0);
            $table->decimal('product_price', 15, 2);
            $table->decimal('product_old_price', 15, 2)->nullable();
            $table->string('product_code');
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
