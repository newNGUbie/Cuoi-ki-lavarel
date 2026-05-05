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
            $table->string('name', 200);
            $table->unsignedBigInteger('id_type');
            $table->text('description')->nullable();
            $table->decimal('unit_price', 12, 2);
            $table->decimal('promotion_price', 12, 2)->default(0);
            $table->string('image')->nullable();
            $table->string('unit', 50)->nullable();
            $table->boolean('new')->default(false);
            $table->unsignedInteger('stock')->default(0);
            $table->timestamps();

            $table->index(['id_type', 'new']);
            $table->index(['unit_price', 'promotion_price']);
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
