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
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
						$table->tinyInteger('is_cash_delivery')->default(1)->nullable();
						$table->string('stripe_public_key')->default(null)->nullable();
						$table->string('stripe_secret_key')->default(null)->nullable();
						$table->tinyInteger('is_stripe')->default(1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_settings');
    }
};
