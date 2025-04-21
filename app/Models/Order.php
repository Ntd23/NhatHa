<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	use HasFactory;
  protected $table = 'orders';
	static public function getSingle($id) {
		return self::find($id);
	}
	static public function getRecord() {
		$return = Order::select('orders.*');

		if (!empty(request()->get('order_number'))) {
      $return = $return->where('order_number', '=', request()->get('order_number'));
    }
    if (!empty(request()->get('company_name'))) {
      $return = $return->where('company_name', 'like', '%' . request()->get('company_name') . '%');
    }
    if (!empty(request()->get('first_name'))) {
      $return = $return->where('first_name', 'like', '%' . request()->get('first_name') . '%');
    }
    if (!empty(request()->get('last_name'))) {
      $return = $return->where('last_name', 'like', '%' . request()->get('last_name') . '%');
    }
    if (!empty(request()->get('email'))) {
      $return = $return->where('email', 'like', '%' . request()->get('email') . '%');
    }
    if (!empty(request()->get('country'))) {
      $return = $return->where('country', 'like', '%' . request()->get('country') . '%');
    }
    if (!empty(request()->get('district'))) {
      $return = $return->where('district', 'like', '%' . request()->get('district') . '%');
    }
    if (!empty(request()->get('city'))) {
      $return = $return->where('city', 'like', '%' . request()->get('city') . '%');
    }
    if (!empty(request()->get('phone'))) {
      $return = $return->where('phone', 'like', '%' . request()->get('phone') . '%');
    }
    if (!empty(request()->get('postcode'))) {
      $return = $return->where('postcode', 'like', '%' . request()->get('postcode') . '%');
    }
    if (!empty(request()->get('from_date'))) {
      $return = $return->whereDate('created_at', '>=', request()->get('from_date'));
    }
    if (!empty(request()->get('to_date'))) {
      $return = $return->whereDate('created_at', '<=', request()->get('to_date'));
    }

		$return= $return->where('is_payment','=',1)
		->where('is_delete','=',0)
		->orderBy('id','desc')
		->paginate(5);

		return $return;
	}
	public function getItem() {
		return $this->hasMany(OrderItem::class,'order_id');
	}
	public function getShipping() {
		return $this->belongsTo(ShippingCharge::class,'shipping_id');
	}

	//for customer
	static public function getTotalOrderForUser($user_id) {
		return self::select('id')
		->where('user_id','=',$user_id)
		->where('is_payment','=',1)
		->where('is_delete','=',0)
		->count();
	}
	static public function getTotalTodayOrderForUser($user_id) {
		return self::select('id')
		->where('user_id','=',$user_id)
		->where('is_payment','=',1)
		->where('is_delete','=',0)
		->whereDate('created_at','=',date('Y-m-d'))
		->count();
	}
	static public function getTotalAmountForUser($user_id) {
		return self::select('id')
		->where('user_id','=',$user_id)
		->where('is_payment','=',1)
		->where('is_delete','=',0)
		->sum('total_amount');
	}
	static public function getTotalTodayAmountForUser($user_id) {
		return self::select('id')
		->where('user_id','=',$user_id)
		->where('is_payment','=',1)
		->where('is_delete','=',0)
		->whereDate('created_At','=',date('Y-m-d'))
		->sum('total_amount');
	}
	static public function getTotalStatusForUser($user_id, $status) {
		return self::select('id')
		->where('status','=',$status)
		->where('user_id','=',$user_id)
		->where('is_payment','=',1)
		->where('is_delete','=',0)
		->count();
	}
	static public function getRecordForUser($user_id) {
		return self::select('orders.*')
		->where('user_id','=',$user_id)
		->where('is_payment','=',1)
		->where('is_delete','=',0)
		->orderBy('id','desc')
		->paginate(5);
	}
	static public function getSingleForUser($user_id, $order_id) {
		return self::select('orders.*')
		->where('user_id','=',$user_id)
		->where('id','=',$order_id)
		->where('is_payment','=',1)
		->where('is_delete','=',0)
		->first();
	}
}
