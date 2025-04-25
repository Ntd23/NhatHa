<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
			$data['getSlider']=Slider::getRecordAcitve();
			$data['getProduct']= Product::getRecentArrival();
			$data['getCategory']= Category::getRecordActiveHome();
			$data['getProductTrendy']= Product::getProductTrendy();
			return view('layout.main', $data);
		}
		public function recent_arrival_category_product(Request $request) {
			$getProduct= Product::getRecentArrival();
			$getCategory= Category::getSingle($request->category_id);

			return response()->json([
				'status'=>true,
				'success'=>view('product._list_recent_arrival',['getProduct'=>$getProduct,'getCategory'=>$getCategory])->render(),
			],200);
		}
}
