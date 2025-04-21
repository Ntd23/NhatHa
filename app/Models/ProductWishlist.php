<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ProductWishlist extends Model
{
  use HasFactory;
	protected $table = 'product_wishlists';
	static public function getSingle($id) {
		return self::find($id);
	}
	static public function checkAlready($product_id,$user_id) {
		return self::where('product_id','=',$product_id)
		->where('user_id','=',$user_id)
		->count();
	}
	static public function DeleteRecord($product_id,$user_id) {
		return self::where('product_id','=',$product_id)
		->where('user_id','=',$user_id)
		->delete();
	}
}
