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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
						$table->string('title');
						$table->string('slug')->default(null)->nullable();
						$table->integer('blog_category_id')->default(null)->nullable();
						$table->text('image_name')->default(null)->nullable();
						$table->longText('description')->default(null)->nullable();
						$table->integer('total_view')->default(0);
						$table->text('short_description')->default(null)->nullable();
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
        Schema::dropIfExists('blogs');
    }
};
