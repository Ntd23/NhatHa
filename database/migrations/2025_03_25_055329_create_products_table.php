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
						$table->string('title')->default(null)->nullable();
						$table->string('slug')->default(null)->nullable();
						$table->string('sku')->default(null)->nullable();
						$table->integer('category_id')->default(null)->nullable();
						$table->integer('sub_category_id')->default(null)->nullable();
						$table->integer('brand_id')->default(null)->nullable();
						$table->double('old_price')->default(0)->nullable();
						$table->double('price')->default(0);
						$table->tinyInteger('is_trendy')->default(0)->nullable();
						$table->text('short_description')->default(null)->nullable();
						$table->longText('description')->default(null)->nullable();
						$table->text('additional_information')->default(null)->nullable();
						$table->string('shipping_returns')->default(null)->nullable();
						$table->tinyInteger('status')->default(0)->comment('0:active|1:inactive');
						$table->tinyInteger('is_delete')->default(0)->comment('0:not delete|1:delete');
						$table->integer('created_by')->nullable();
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
