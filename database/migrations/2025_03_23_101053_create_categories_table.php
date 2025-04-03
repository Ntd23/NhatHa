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
		Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('slug')->default(null);
			$table->string('meta_title')->default(null)->nullable();
			$table->text('meta_description')->default(null)->nullable();
			$table->string('meta_keywords')->default(null)->nullable();
			$table->tinyInteger('status')->default(0)->comment('1:InActive|0:Active');
			$table->tinyInteger('is_delete')->default(0)->comment('1:Deleted|0:Not');
			$table->string('button_name')->default(null)->nullable();
      $table->tinyInteger('is_home')->default(0);
			$table->tinyInteger('is_menu')->default(0)->nullable();
      $table->longText('image_name')->default(null)->nullable();
			$table->integer('created_by')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('categories');
	}
};