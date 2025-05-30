<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductSize;
use App\Models\ProductWishlist;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
	public function getCategory($slug, $subSlug = '')
	{
		$getProductSingle = Product::getSingleSlug($slug);
		$getCategory = Category::getSingleSlug($slug);
		$getSubCategory = SubCategory::getSingleSlug($subSlug);
		$data['getBrand'] = Brand::getRecordActive();
		$data['getSize'] = ProductSize::getRecord();
		// dd($getProductSingle);
		if (!empty($getProductSingle)) {
			$data['meta_title'] = $getProductSingle->title;
			$data['meta_keywords'] = $getProductSingle->short_description;
			$data['getProduct'] = $getProductSingle;
			$data['getRelatedProduct'] = Product::getRelatedProduct($getProductSingle->id, $getProductSingle->sub_category_id);
			$data['getReviewProduct']= ProductReview::getReviewProduct($getProductSingle->id);
			return view('product.detail', $data);
		} elseif (!empty($getCategory) && !empty($getSubCategory)) {
			$data['meta_title'] = $getSubCategory->meta_title;
			$data['meta_keywords'] = $getSubCategory->meta_keywords;
			$data['meta_description'] = $getSubCategory->meta_description;

			$getProduct = Product::getProduct($getCategory->id, $getSubCategory->id);
			$page = 0;
			if (!empty($getProduct->nextPageUrl())) { // example: http://127.0.0.1:8000/giay-the-thao/giay-the-thao-nike-air%20-max?page=2
				$parse_url = parse_url($getProduct->nextPageUrl());
				if (!empty($parse_url['query'])) {
					parse_str($parse_url['query'], $get_array);
					$page = !empty($get_array['page']) ? $get_array['page'] : 0;
				}
			}
			$data['page'] = $page;
			$data['getProduct'] = $getProduct;
			$data['getCategory'] = $getCategory;
			$data['getSubCategory'] = $getSubCategory;

			$data['getSubCategoryFilter'] = SubCategory::getSubCategoryFilter($getCategory->id);
			return view('product.list', $data);
		} elseif (!empty($getCategory)) {
			$data['meta_title'] = $getCategory->meta_title;
			$data['meta_keywords'] = $getCategory->meta_keywords;
			$data['meta_description'] = $getCategory->meta_description;

			$getProduct = Product::getProduct($getCategory->id);
			$page = 0;
			if (!empty($getProduct->nextPageUrl())) { // example: http://127.0.0.1:8000/giay-the-thao?page=2
				$parse_url = parse_url($getProduct->nextPageUrl());
				if (!empty($parse_url['query'])) {
					parse_str($parse_url['query'], $get_array);
					$page = !empty($get_array['page']) ? $get_array['page'] : 0;
				}
			}
			$data['page'] = $page;
			$data['getProduct'] = $getProduct;
			$data['getCategory'] = $getCategory;
			$data['getSubCategoryFilter'] = SubCategory::getSubCategoryFilter($getCategory->id);
			return view('product.list', $data);
		} else {
			abort(404);
		}
	}
	public function getFilterProductAjax(Request $request)
	{
		$getProduct = Product::getProduct();
		$page = 0;
		// dd($request);
		if (!empty($getProduct->nextPageUrl())) { // example: http://127.0.0.1:8000/giay-the-thao?page=2
			$parse_url = parse_url($getProduct->nextPageUrl());
			if (!empty($parse_url['query'])) {
				parse_str($parse_url['query'], $get_array);
				$page = !empty($get_array['page']) ? $get_array['page'] : 0;
			}
		}
		return response()->json([
			'page' => $page,
			'status' => true,
			'success' => view('product._list', ['getProduct' => $getProduct])->render()
		], 200);
	}
	public function getProductSearch(Request $request)
	{
		$data['meta_title'] = 'Tìm kiếm';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$getProduct= Product::getProduct();
		$page=0;
		if (!empty($getProduct->nextPageUrl())) { // example: http://127.0.0.1:8000/giay-the-thao?page=2
			$parse_url = parse_url($getProduct->nextPageUrl());
			if (!empty($parse_url['query'])) {
				parse_str($parse_url['query'], $get_array);
				$page = !empty($get_array['page']) ? $get_array['page'] : 0;
			}
		}
		$data['page']= $page;
		$data['getProduct']=$getProduct;
		$data['getSize'] = ProductSize::getRecord();
		$data['getBrand']= Brand::getRecordActive();

		return view('product.list',$data);
	}
	public function my_wishlist() {
		$data['meta_title'] = 'Danh sách yêu thích';
    $data['meta_keywords'] = '';
    $data['meta_description'] = '';

    $data['getProduct'] = Product::getMyWishList(Auth::user()->id);
    return view('product.my_wishlist', $data);
	}
	public function add_to_wishlist(Request $request) {
		$check= ProductWishlist::checkAlready($request->product_id,Auth::user()->id);
		if(empty($check)) {
			$save= new ProductWishlist;
			$save->product_id= $request->product_id;
			$save->user_id= Auth::user()->id;
			$save->save();
			$json['is_wishlist']=1;
		}else {
			$count= ProductWishlist::DeleteRecord($request->product_id,Auth::user()->id);
			$json['is_wishlist']=0;
		}
		$json['status']=true;
		echo json_encode($json);
	}
}
