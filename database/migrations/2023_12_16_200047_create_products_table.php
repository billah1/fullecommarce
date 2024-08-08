<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('currency_id')->constrained('currencies');
            $table->string('code');
            $table->string('name');
            $table->text('description');
            $table->string('tags');
            $table->string('product_code');
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2);
            $table->integer('stock');
            $table->boolean('has_coupon')->default(false);
            $table->boolean('is_active')->default(false);
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
