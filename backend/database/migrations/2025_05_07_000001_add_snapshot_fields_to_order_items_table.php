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
        Schema::table('order_items', function (Blueprint $table) {
            $table->string('product_name')->nullable();
            $table->string('product_category')->nullable();
            $table->string('product_brand')->nullable();
            $table->string('product_image')->nullable();
            $table->decimal('product_sum', 12, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['product_name', 'product_category', 'product_brand', 'product_image', 'product_sum']);
        });
    }
};
