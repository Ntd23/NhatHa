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
        Schema::create('s_m_t_p_s', function (Blueprint $table) {
            $table->id();
						$table->string('name')->default(null)->nullable();
						$table->string('mail_mailer')->default(null)->nullable();
						$table->string('mail_host')->default(null)->nullable();
						$table->string('mail_port')->default(null)->nullable();
						$table->string('mail_username')->default(null)->nullable();
						$table->string('mail_password')->default(null)->nullable();
						$table->string('mail_encryption')->default(null)->nullable();
						$table->string('mail_from_address')->default(null)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_m_t_p_s');
    }
};
