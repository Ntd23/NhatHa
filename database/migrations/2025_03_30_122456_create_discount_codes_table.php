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
		Schema::create('discount_codes', function (Blueprint $table) {
			$table->id();
			$table->string('name')->default(null)->nullable();
			$table->string('type')->default(null)->nullable();
			$table->string('percent_amount')->default(null)->nullable();
			$table->string('expire_date')->default(null)->nullable();
			$table->tinyInteger('status')->default(0)->comment('0:active|1:inactive');
			$table->tinyInteger('isDelete')->default(0)->comment('0:not delete|1:delete');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('discount_codes');
	}
};
