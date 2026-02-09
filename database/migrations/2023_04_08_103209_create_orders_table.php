<?php

use App\Models\ProductColor;
use App\Models\ProductSize;
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
            $table->foreignIdFor(ProductSize::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ProductColor::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->integer('order_quantity');
            $table->decimal('order_price', 15, 2);
            $table->decimal('order_total_amount', 15, 2);
            $table->string('order_payment_method');
            $table->string('transaction_code');
            $table->string('order_status')->default('Pending');
            $table->text('shipping_address');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
