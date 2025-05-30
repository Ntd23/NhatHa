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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
						$table->integer('order_id')->default(null)->nullable();
      $table->integer('product_id')->default(null)->nullable();
      $table->string('price')->default(0)->nullable();
      $table->string('size_name')->default(null);
      $table->string('size_amount')->default(null);
      $table->string('total_price')->default(null);
      $table->integer('quantity')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
