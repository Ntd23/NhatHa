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
      Schema::create('brands', function (Blueprint $table) {
				$table->id();
				$table->string('name')->default(null)->nullable();
				$table->string('slug')->default(null)->nullable();
				$table->string('meta_title')->default(null)->nullable();
				$table->text('meta_description')->default(null)->nullable();
				$table->string('meta_keywords')->default(null)->nullable();
				$table->tinyInteger('status')->default(0)->comment('0:active|1:inactive');
				$table->integer('created_by')->nullable();
				$table->tinyInteger('is_delete')->default(0)->comment('0:not delete|1:delete');
				$table->timestamps();
			});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
			Schema::dropIfExists('brands');
    }
};
