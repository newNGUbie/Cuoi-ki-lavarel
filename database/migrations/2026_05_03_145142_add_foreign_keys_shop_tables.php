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
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('id_type')
                ->references('id')->on('type_products')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });

        Schema::table('bills', function (Blueprint $table) {
            $table->foreign('id_customer')
                ->references('id')->on('customer')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });

        Schema::table('bill_detail', function (Blueprint $table) {
            $table->foreign('id_bill')
                ->references('id')->on('bills')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('id_product')
                ->references('id')->on('products')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });

        Schema::table('wishlists', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('product_id')
                ->references('id')->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wishlists', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::table('bill_detail', function (Blueprint $table) {
            $table->dropForeign(['id_bill']);
            $table->dropForeign(['id_product']);
        });

        Schema::table('bills', function (Blueprint $table) {
            $table->dropForeign(['id_customer']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['id_type']);
        });
    }
};
