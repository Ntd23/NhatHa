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
        Schema::table('users', function (Blueprint $table) {
					$table->string('company_name')->default(null)->nullable();
					$table->string('country')->default(null)->nullable();
					$table->string('address_one')->default(null)->nullable();
					$table->string('address_two')->default(null)->nullable();
					$table->string('city')->default(null)->nullable();
					$table->string('district')->default(null)->nullable();
					$table->string('postcode')->default(null)->nullable();
					$table->string('google_id')->default(null)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
