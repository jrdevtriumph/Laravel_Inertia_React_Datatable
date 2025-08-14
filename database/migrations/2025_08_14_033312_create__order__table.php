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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->integer('order_number')->unique();
            $table->json('customer_details')->nullable();
            $table->date('order_date')->nullable();
            $table->string('attachment')->nullable();
            $table->string('ordering_office')->nullable();
            $table->string('ordering_officer')->nullable();
            $table->json('order_items')->nullable();
            $table->string('allow_shipping')->default('N');
            $table->string('shipping_address')->nullable();
            $table->string('shipping_method')->nullable();
            $table->string('shipping_cost')->default('0');
            $table->string('status')->default('pending');
            $table->integer('subtotal')->default(0);
            $table->integer('tax')->default(0);
            $table->integer('total')->default(0);
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
