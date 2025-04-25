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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
						$table->string('title');
						$table->text('image_name')->default(null)->nullable();
						$table->text('button_name')->default(null)->nullable();
						$table->text('button_link')->default(null)->nullable();
						$table->tinyInteger('is_delete')->default(0)->nullable()->comment('0:not delete|1:delete');
						$table->tinyInteger('status')->default(0)->comment('1:InActive|0:Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
