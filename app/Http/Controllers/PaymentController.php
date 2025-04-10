<?php

namespace App\Http\Controllers;

use App\Models\PaymentSetting;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
  public function add_to_cart(Request $request) {
		$getProduct= Product::getSingle($request->product_id);
		// $total= $getProduct->price;
		$total=0;
		if(!empty($request->size_id)) {
			$size_id= $request->size_id;
			$getSize= ProductSize::getSingle($size_id);
			$size_price=!empty($getSize->price) ? $getSize->price : 0;
			$total= $total+ $size_price;
		}else {
			$size_id=0;
			$total= $getProduct->price;
		}
		\Cart::add([
			'id'=>$getProduct->id,
			'name'=>$getProduct->name .'-'. time(),
			'price'=>$total,
			'quantity'=>$request->qty,
			'attributes'=> array('size_id'=>$size_id)
		]);
		return redirect()->back()->with('success','Sản phẩm đã được thêm vào giỏ hàng!');
	}
	public function cart(Request $request) {
		$data['meta_title'] = 'Giỏ hàng';
    $data['meta_description'] = '';
    $data['meta_keywords'] = '';
    return view('payment.cart', $data);
	}
	public function update_cart(Request $request){
		foreach($request->cart as $cart) {
			\Cart::update($cart['id'], array(
				'quantity'=>array(
					'relative'=>false,'value'=>$cart['qty']
				)
			));
		}
		return redirect()->back();
	}
	public function cart_delete($id) {
		\Cart::remove($id);
		return redirect()->back();
	}
	public function checkout(Request $request) {
		if(empty(\Cart::getContent()->count())) {
			return redirect('cart');
		}
		$data['meta_title'] = 'Thanh toán';
    $data['meta_description'] = '';
    $data['meta_keywords'] = '';

		$data['getShipping']= ShippingCharge::getRecordActive();
		$data['getPaymentSetting']= PaymentSetting::getSingle();

		return view('payment.checkout',$data);
	}
}
