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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('discount_type', ['percentage', 'fixed']);
            $table->decimal('discount_amount', 8, 2);
            $table->decimal('min_purchase_amount', 8, 2)->nullable();
            $table->string('usage_limit')->nullable();
            $table->string('used')->nullable();
            $table->date('start_at')->nullable();
            $table->date('expire_date')->nullable();
            $table->integer('status')->default(1)->comment('1-active, 0=inactive, 2=expire');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
