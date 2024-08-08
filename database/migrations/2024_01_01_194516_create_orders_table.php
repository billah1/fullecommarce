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
            $table->foreignId('billing_detail_id')->constrained('billing_details')->onDelete('cascade');
            $table->foreignId('ordered_by')->constrained('users')->onDelete('cascade');
            $table->string('order_code');
            $table->decimal('shipping_charge', 10, 2)->nullable();
            $table->string('discount')->nullable();
            $table->decimal('total_charge', 10, 2);
            $table->string('status')->default(\App\Models\Order::STATUS_PENDING);
            $table->enum('payment_type', ['cash', 'paypal', 'credit_card', 'online', 'other']);
            $table->boolean('is_payment')->default(false);
            $table->timestamps();
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
