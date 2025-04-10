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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
						$table->bigInteger('user_id')->default(null)->nullable();
						$table->string('first_name')->default(null)->nullable();
						$table->string('last_name')->default(null)->nullable();
						$table->string('company_name')->default(null)->nullable();
						$table->string('country')->default(null)->nullable();
						$table->string('address_one')->default(null)->nullable();
						$table->string('address_two')->default(null)->nullable();
						$table->string('city')->default(null)->nullable();
						$table->string('district')->default(null)->nullable();
						$table->string('postcode')->default(null)->nullable();
						$table->string('phone')->default(null)->nullable();
						$table->string('email')->default(null)->nullable();
						$table->text('note')->default(null)->nullable();
						$table->string('discount_code')->default(0)->nullable();
						$table->string('discount_amount')->default(null);
						$table->integer('shipping_id')->default(null)->nullable();
						$table->string('shipping_amount')->default(value: 0);
						$table->string('total_amount')->default(0);
						$table->string('payment_method')->default(null)->nullable();
						$table->tinyInteger('status')->default(0)->comment('0:Pending|1:Inprogess|2:Delivered|3:Completed|4:Cancelled');
						$table->tinyInteger('is_delete')->default(0)->nullable()->comment('0:not delete|1:delete');
						$table->tinyInteger('is_payment')->default(0);
						$table->text('payment_data')->default(null)->nullable();
						$table->string('transaction_id')->default(null)->nullable();
						$table->string('stripe_session_id')->default(null)->nullable();
						$table->string('order_number')->default(null)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
