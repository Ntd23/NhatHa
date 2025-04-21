<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
	use HasFactory;
	protected $table = 'products';
	public function getCategory()
	{
		return $this->belongsTo(Category::class, 'category_id');
	}
	public function getSubCategory()
	{
		return $this->belongsTo(SubCategory::class, 'sub_category_id');
	}
	public function getSize()
	{
		return $this->hasMany(ProductSize::class, 'product_id');
	}
	static public function getSingle($id)
	{
		return self::find($id);
	}
	static public function getRecord()
	{
		return self::select('products.*', 'users.name as created_by_name')
			->join('users', 'users.id', '=', 'products.created_by')
			->orderBy('products.id', 'desc')
			->paginate(10);
	}
	static public function getSingleSlug($slug)
	{
		return self::where('slug', '=', $slug)
			->where('products.is_delete', '=', 0)
			->where('products.status', '=', 0)
			->first();
	}
	static public function checkSlug($slug)
	{
		return self::where('slug', '=', $slug)->count();
	}
	public function getImage()
	{
		return $this->hasMany(ProductImages::class, 'product_id')->orderBy('order_by', 'asc');
	}
	public function getImageSingle($product_id)
	{
		return ProductImages::where('product_id', '=', $product_id)
			->orderBy('order_by', 'asc')
			->first();
	}
	static public function getProduct($category_id = '', $subcategory_id = '')
	{
		$return = Product::select(
			'products.*',
			'users.name as created_by_name',
			'categories.name as category_name',
			'categories.slug as category_slug',
			'sub_categories.name as sub_category_name',
			'sub_categories.slug as sub_category_slug',
		)
			->join('categories', 'categories.id', '=', 'products.category_id')
			->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
			->join('users', 'users.id', '=', 'products.created_by');

		if (!empty($category_id)) { // for slug
			$return = $return->where('products.category_id', '=', $category_id);
		}
		if (!empty($subcategory_id)) { // for subslug
			$return = $return->where('products.sub_category_id', '=', $subcategory_id);
		}
		//search
		if (!empty(request()->get('q'))) {
			$return = $return->where('products.title', 'like', '%' . request()->get('q') . '%');
		}
		//load more products & filter
		//filter by category & sub category
		if (!empty(request()->get('sub_category_id'))) {
			$sub_category_id = rtrim(request()->get('sub_category_id'), ',');
			$sub_category_id_array = explode(',', $sub_category_id);
			$return = $return->whereIn('products.sub_category_id', $sub_category_id_array);
		} else {
			if (!empty(request()->get('old_category_id'))) {
				$return = $return->where('products.category_id', '=', request()->get('old_category_id'));
			}
			if (!empty(request()->get('old_sub_category_id'))) {
				$return = $return->where('products.sub_category_id', '=', request()->get('old_sub_category_id'));
			}
		}
		//filter by brand
		if (!empty(request()->get('brand_id'))) {
			$brand_id = rtrim(request()->get('brand_id'), ',');
			$brand_id_array = explode(',', $brand_id);
			$return = $return->whereIn('products.brand_id', $brand_id_array);
		}
		//filter by size size_id
		if (!empty(request()->get('size_id'))) {
			$size_id = rtrim(request()->get('size_id'), ',');
			$size_id_array = explode(',', $size_id);
			$return = $return->join('product_sizes', 'product_sizes.product_id', '=', 'products.id')
				->whereIn('product_sizes.id', $size_id_array);
		}
		//filter by price
		if (!empty(request()->get('start_price')) && !empty(request()->get('end_price'))) {
			$start_price = str_replace('VND', '', request()->get('start_price'));
			$end_price = str_replace('VND', '', request()->get('end_price'));
			$return = $return->where('products.price', '>=', $start_price);
			$return = $return->where('products.price', '>=', $end_price);
		}
		if (!empty(request()->get('sort_by_id'))) {
			if (request()->get('sort_by_id') == 'date') {
				$return = $return->orderBy('products.created_at');
			}
		}
		//result last
		$return = $return->where('products.is_delete', '=', 0)
			->where('products.status', '=', 0)
			->groupBy('products.id')
			->orderBy('products.id', 'desc')
			->paginate(6);
		return $return;
	}
	static public function getRelatedProduct($product_id, $sub_category_id)
	{
		$return = Product::select(
			'products.*',
			'users.name as created_by_name',
			'categories.name as category_name',
			'categories.slug as category_slug',
			'sub_categories.name as sub_category_name',
			'sub_categories.slug as sub_category_slug',
		)
			->join('categories', 'categories.id', '=', 'products.category_id')
			->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
			->join('users', 'users.id', '=', 'products.created_by')
			->where('products.status', '=', 0)
			->where('products.is_delete', '=', 0)
			->where('products.id', '!=', $product_id)
			->where('products.sub_category_id', '=', $sub_category_id)
			->groupBy('products.id')
			->orderBy('products.id', 'desc')
			->limit(10)
			->get();
		return $return;
	}
	static public function getProductTrendy()
	{
		$return = Product::select(
			'products.*',
			'users.name as created_by_name',
			'categories.name as category_name',
			'categories.slug as category_slug',
			'sub_categories.name as sub_category_name',
			'sub_categories.slug as sub_category_slug',
		)
			->join('users', 'users.id', '=', 'products.created_by')
			->join('categories', 'categories.id', '=', 'products.category_id')
			->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
			->where('products.is_delete', '=', 0)
			->where('products.status', '=', 0)
			->where('products.is_trendy', '=', 1);
		$return = $return->groupBy('products.id')
			->orderBy('products.id', 'desc')
			->limit(8)
			->get();
		return $return;
	}
	static public function getRecentArrival()
	{
		$return = Product::select(
			'products.*',
			'users.name as created_by_name',
			'categories.name as category_name',
			'categories.slug as category_slug',
			'sub_categories.name as sub_category_name',
			'sub_categories.slug as sub_category_slug',
		)
			->join('users', 'users.id', '=', 'products.created_by')
			->join('categories', 'categories.id', '=', 'products.category_id')
			->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
			->where('products.is_delete', '=', 0)
			->where('products.status', '=', 0);
		if (!empty(request()->get('category_id'))) {
			$return = $return->where('products.category_id', '=', request()->get('category_id'));
		}
		$return = $return->groupBy('products.id')
			->orderBy('products.id', 'desc')
			->limit(8)
			->get();
		return $return;
	}
	public function getTotalReview() {
		return $this->hasMany(ProductReview::class,'product_id')
		->join('users','users.id','product_reviews.user_id')
		->count();
	}
	static public function getMyWishList($user_id) {
		$return = Product::select(
			'products.*',
			'users.name as created_by_name',
			'categories.name as category_name',
			'categories.slug as category_slug',
			'sub_categories.name as sub_category_name',
			'sub_categories.slug as sub_category_slug',
		)
		->join('users', 'users.id', '=', 'products.created_by')
			->join('categories', 'categories.id', '=', 'products.category_id')
			->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
			->join('product_wishlists', 'product_wishlists.product_id', '=', 'products.id')
			->where('product_wishlists.user_id','=',$user_id)
			->where('products.is_delete','=',0)
			->where('products.status','=',0)
			->groupBy('products.id')
			->orderBy('products.id','desc')
			->paginate(3);

			return $return;
	}
	static public function checkWishList($product_id) {
		return ProductWishlist::checkAlready($product_id,Auth::user()->id);
	}
	static public function getReviewRating($product_id) {
		$avg= ProductReview::getRatingReview($product_id);
		if($avg>=1&&$avg<2) return 20;
		elseif($avg>=2&&$avg<3) return 40;
		elseif($avg>=3&&$avg<4) return 60;
		elseif($avg>=4&&$avg<5) return 80;
		elseif($avg==5) return 100;
		else return 0;
	}
}
