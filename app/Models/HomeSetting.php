<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
	use HasFactory;
  protected $table = 'home_settings';
  static public function getSingle()
  {
    return self::find(1);
  }
	public function getPaymentDeliveryImage()
  {
    if (!empty($this->payment_delivery_image) && file_exists('storage/setting/' . $this->payment_delivery_image)) {
      return url('storage/setting/' . $this->payment_delivery_image);
    } else {
      return '';
    }
  }
	public function getRefundImage()
  {
    if (!empty($this->refund_image) && file_exists('storage/setting/' . $this->refund_image)) {
      return url('storage/setting/' . $this->refund_image);
    } else {
      return '';
    }
  }
	public function getSupportImage()
  {
    if (!empty($this->suport_image) && file_exists('storage/setting/' . $this->suport_image)) {
      return url('storage/setting/' . $this->suport_image);
    } else {
      return '';
    }
  }
	public function getSignupImage()
  {
    if (!empty($this->signup_image) && file_exists('storage/setting/' . $this->signup_image)) {
      return url('storage/setting/' . $this->signup_image);
    } else {
      return '';
    }
  }
}
