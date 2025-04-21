<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class PaymentSetting extends Model
{
	use HasFactory;
	protected $table = 'payment_settings';
	static public function getSingle()
	{
		return self::find(1);
	}
}
