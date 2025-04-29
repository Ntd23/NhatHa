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
		Schema::create('pages', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->text('slug');
			$table->string('title');
			$table->longText('description')->default(null)->nullable();
			$table->text('image_name')->default(null)->nullable();
			$table->text('meta_title')->default(null)->nullable();
			$table->text('meta_desciption')->default(null)->nullable();
			$table->text('meta_keywords')->default(null)->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('pages');
	}
};
