<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrderItem extends Model
{
	use HasFactory;
  protected $table = 'order_items';
	public function getProduct() {
		return $this->belongsTo(Product::class,'product_id');
	}
	static public function getReview($product_id, $order_id) {
		return ProductReview::getReview($product_id,$order_id,Auth::user()->id);
	}
}
