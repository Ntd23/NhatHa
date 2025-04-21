<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductReview extends Model
{
	use HasFactory;
	protected $table = 'product_reviews';
	static public function getSingle($id)
	{
		return self::find($id);
	}
	static public function getReview($product_id, $order_id, $user_id)
	{
		return self::select('*')
			->where('product_id', '=', $product_id)
			->where('order_id', '=', $order_id)
			->where('user_id', '=', $user_id)
			->first();
	}
	static public function getReviewProduct($product_id)
	{
		return self::select('product_reviews.*', 'users.name')
			->join('users', 'users.id', 'product_reviews.user_id')
			->where('product_id', '=', $product_id)
			->orderBy('product_reviews.id', 'desc')
			->paginate(5);
	}
	static public function getRatingReview($product_id)
	{
		return self::select('product_reviews.rating')
			->join('users', 'users.id', 'product_reviews.user_id')
			->where('product_reviews.product_id', '=', $product_id)
			->avg('product_reviews.rating');
	}
	public function getPercent()
	{
		$rating = $this->rating;
		return [1 => 20, 2 => 40, 3 => 60, 4 => 80, 5 => 100][$rating] ?? 0;
	}
}
