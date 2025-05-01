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
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
						$table->string('website_name');
						$table->text('logo');
						$table->text('favicon');
						$table->text('footer_payment_icon');
						$table->longText('footer_description')->default(null)->nullable();
						$table->longText('address')->default(null)->nullable();
						$table->string('phone')->default(null)->nullable();
						$table->string('phone_two')->default(null)->nullable();
						$table->string('submit_email')->default(null)->nullable();
						$table->string('email')->default(null)->nullable();
						$table->string('email_two')->default(null)->nullable();
						$table->text('working_hours')->default(null)->nullable();
						$table->longText('fb_link')->default(null)->nullable();
						$table->longText('ig_link')->default(null)->nullable();
						$table->longText('ytb_link')->default(null)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
