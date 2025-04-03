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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
						$table->integer('category_id')->nullable();
						$table->integer('created_by')->nullable();
						$table->string('name');
						$table->string('slug')->default(null);
						$table->string('meta_title')->default(null)->nullable();
						$table->text('meta_description')->default(null)->nullable();
						$table->string('meta_keywords')->default(null)->nullable();
						$table->tinyInteger('status')->default(0)->comment('1:InActive|0:Active');
						$table->tinyInteger('is_delete')->default(0)->comment('1:Deleted|0:Not');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};
