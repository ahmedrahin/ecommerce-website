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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_type')->nullable()->comment('Author and Customer');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->longText('shipping_address');
            $table->integer('district_id')->nullable();
            $table->integer('division_id')->nullable();
            $table->string('zip_code')->nullable();
            $table->double('grand_total', 20, 2)->nullable();
            $table->integer('paid_amount')->nullable();
            $table->integer('discount_amount')->nullable();
            $table->integer('shipping_method')->nullable();
            $table->double('shipping_cost', 8, 2)->default(0); 
            $table->string('shipping_type', 50)->nullable();
            $table->text('cupon_code')->nullable(); 
            $table->double('coupon_discount', 20, 2)->nullable();
            $table->string('delivery_status', 20)->default('pending');
            $table->string('payment_type')->nullable();
            $table->string('payment_from', 191)->nullable();
            $table->longText('note')->nullable();
            $table->string('order_source', 15)->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamp('order_date')->nullable();
            $table->boolean('viewed')->default(0);
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
