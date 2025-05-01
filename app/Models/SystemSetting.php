<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
  use HasFactory;
  protected $table = 'system_settings';
  static public function getSingle()
  {
    return self::find(1);
  }
	public function getLogo()
  {
    if (!empty($this->logo) && file_exists('storage/setting/' . $this->logo)) {
      return url('storage/setting/' . $this->logo);
    } else {
      return '';
    }
  }
	public function getFavicon()
  {
    if (!empty($this->favicon) && file_exists('storage/setting/' . $this->favicon)) {
      return url('storage/setting/' . $this->favicon);
    } else {
      return '';
    }
  }
	public function getFooterPaymentIcon()
  {
    if (!empty($this->footer_payment_icon) && file_exists('storage/setting/' . $this->footer_payment_icon)) {
      return url('storage/setting/' . $this->footer_payment_icon);
    } else {
      return '';
    }
  }
}
