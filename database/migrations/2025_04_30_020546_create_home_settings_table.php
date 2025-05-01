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
		Schema::create('home_settings', function (Blueprint $table) {
			$table->id();
			$table->string('trendy_product_title')->default(null)->nullable();
			$table->string('shop_category_title')->default(null)->nullable();
			$table->string('recent_arrival_title')->default(null)->nullable();
			$table->string('blog_title')->default(null)->nullable();
			$table->string('payment_delivery_title')->default(null)->nullable();
			$table->string('payment_delivery_description')->default(null)->nullable();
			$table->text('payment_delivery_image')->default(null)->nullable();
			$table->string('refund_title')->default(null)->nullable();
			$table->string('refund_description')->default(null)->nullable();
			$table->text('refund_image')->default(null)->nullable();
			$table->string('suport_title')->default(null)->nullable();
			$table->string('suport_description')->default(null)->nullable();
			$table->text('suport_image')->default(null)->nullable();
			$table->string('signup_title')->default(null)->nullable();
			$table->string('signup_description')->default(null)->nullable();
			$table->string('signup_image')->default(null)->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('home_settings');
	}
};
