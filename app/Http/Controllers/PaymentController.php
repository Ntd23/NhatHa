<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentSetting;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ShippingCharge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Checkout\Session as SessionStripe;

class PaymentController extends Controller
{
	public function add_to_cart(Request $request)
	{
		$getProduct = Product::getSingle($request->product_id);
		// $total= $getProduct->price;
		$total = 0;
		if (!empty($request->size_id)) {
			$size_id = $request->size_id;
			$getSize = ProductSize::getSingle($size_id);
			$size_price = !empty($getSize->price) ? $getSize->price : 0;
			$total = $total + $size_price;
		} else {
			$size_id = 0;
			$total = $getProduct->price;
		}
		\Cart::add([
			'id' => $getProduct->id,
			'name' => $getProduct->name . '-' . time(),
			'price' => $total,
			'quantity' => $request->qty,
			'attributes' => array('size_id' => $size_id)
		]);
		return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
	}
	public function cart(Request $request)
	{
		$data['meta_title'] = 'Giỏ hàng';
		$data['meta_description'] = '';
		$data['meta_keywords'] = '';
		return view('payment.cart', $data);
	}
	public function update_cart(Request $request)
	{
		foreach ($request->cart as $cart) {
			\Cart::update($cart['id'], array(
				'quantity' => array(
					'relative' => false,
					'value' => $cart['qty']
				)
			));
		}
		return redirect()->back();
	}
	public function cart_delete($id)
	{
		\Cart::remove($id);
		return redirect()->back();
	}
	public function checkout(Request $request)
	{
		if (empty(\Cart::getContent()->count())) {
			return redirect('cart');
		}
		$data['meta_title'] = 'Thanh toán';
		$data['meta_description'] = '';
		$data['meta_keywords'] = '';

		$data['getShipping'] = ShippingCharge::getRecordActive();
		$data['getPaymentSetting'] = PaymentSetting::getSingle();

		return view('payment.checkout', $data);
	}
	public function appy_discount_code(Request $request)
	{
		$getDiscount = DiscountCode::CheckDiscount($request->discount_code);
		if (!empty($getDiscount)) {
			$total = \Cart::getSubTotal();
			if ($getDiscount->type == 0) {
				$discount_amount = $getDiscount->percent_amount;
				$payable_total = $total - $getDiscount->percent_amount;
			} else {
				$discount_amount = ($total * $getDiscount->percent_amount) / 100;
				$payable_total = $total - $discount_amount;
			}
			$json['discount_amount'] = number_format($discount_amount);
			$json['payable_total'] = $payable_total;
			$json['status'] = true;
			$json['message'] = 'success';
		} else {
			$json['status'] = false;
			$json['discount_amount'] = 0;
			$json['payable_total'] = \Cart::getSubTotal();
			$json['message'] = 'Mã giảm giá không chính xác!';
		}
		echo json_encode($json);
	}
	public function place_order(Request $request)
	{
		$validate = 0;
		$message = '';
		if (!empty(Auth::check())) {
			$user_id = Auth::user()->id;
		} else {
			if (!empty($request->is_create)) {
				$checkEmail = User::checkExist($request->email);
				if (!empty($checkEmail)) {
					$message = 'Email này đã đăng ký! Sử dụng email khác';
					$validate = 1;
				} else {
					$save = new User;
					$save->name = trim($request->name);
					$save->email = trim($request->email);
					$save->password = Hash::make($request->password);
					$save->save();
					$user_id = $save->id;
				}
			} else {
				$user_id = '';
			}
		}
		if (empty($validate)) {
			$getShipping = ShippingCharge::getSingle($request->shipping);
			$payable_total = \Cart::getSubTotal();
			$discount_amount = 0;
			$discount_code = '';
			if (!empty($request->discount_code)) {
				$getDiscount = DiscountCode::CheckDiscount($request->discount_code);
				if (!empty($getDiscount)) {
					$discount_code = $request->discount_code;
					if ($getDiscount->type == 0) {
						$discount_amount = $getDiscount->percent_amount;
						$payable_total = $payable_total - $getDiscount->percent_amount;
					} else {
						$discount_amount = ($payable_total * $getDiscount->percent_amount) / 100;
						$payable_total = $payable_total - $discount_amount;
					}
				}
			}
			$shipping_amount = !empty($getShipping->price) ? $getShipping->price : 0;
			$payable_total = $payable_total + $shipping_amount;

			$order = new Order;
			if (!empty($user_id)) {
				$order->user_id = trim($user_id);
			}
			$order->order_number = mt_rand(111111, 999999) . time();
			$order->first_name = trim($request->first_name);
			$order->last_name = trim($request->last_name);
			$order->company_name = trim($request->company_name);
			$order->country = trim($request->country);
			$order->address_one = trim($request->address_one);
			$order->address_two = trim($request->address_two);
			$order->city = trim($request->city);
			$order->district = trim($request->district);
			$order->postcode = trim($request->postcode);
			$order->phone = trim($request->phone);
			$order->email = trim($request->email);
			$order->note = trim($request->note);
			$order->discount_code = trim($discount_code);
			$order->discount_amount = trim($discount_amount);
			$order->shipping_id = trim($request->shipping);
			$order->shipping_amount = trim($shipping_amount);
			$order->total_amount = trim($payable_total);
			$order->payment_method = trim($request->payment_method);
			$order->save();

			foreach (\Cart::getContent() as $key => $cart) {
				$order_item = new OrderItem;
				$order_item->order_id = $order->id;
				$order_item->product_id = $cart->id;
				$order_item->quantity = $cart->quantity;
				$order_item->price = $cart->price;
				$size_id = $cart->attributes->size_id;
				if (!empty($size_id)) {
					$getSize = ProductSize::getSingle($size_id);
					$order_item->size_name = $getSize->name;
					$order_item->size_amount = $getSize->price;
				}
				$order_item->total_price = $cart->price * $cart->quantity;
				$order_item->save();
			}
			$json['status'] = true;
			$json['message'] = 'success';
			$json['redirect'] = route('front.payment') . '?order_id=' . base64_encode($order->id);
		} else {
			$json['status'] = false;
			$json['message'] = $message;
		}
		echo json_encode($json);
	}
	public function checkout_payment(Request $request)
	{
		if (!empty(\Cart::getSubTotal()) && !empty($request->order_id)) {
			$order_id = base64_decode($request->order_id);
			$getOrder = Order::getSingle($order_id);
			$getPaymentSetting = PaymentSetting::getSingle();
			if (!empty($getOrder)) {
				if ($getOrder->payment_method == 'cash') {
					$getOrder->is_payment = 1;
					$getOrder->save();

					//notify
					$user_id = 1;
					$url= route('admin.order.detail',$getOrder->id);
					$msg= 'Đơn hàng #'. $getOrder->order_number .' đã được đặt';
					Notification::insertRecord($user_id, $url, $msg);

					\Cart::clear();
					return redirect(route('front.cart'))->with('success', 'Đơn hàng đặt thành công!');
				} elseif ($getOrder->payment_method == 'stripe') {
					Stripe::setApiKey($getPaymentSetting->stripe_secret_key);
					$exchangeRate = 25000; //1usd~25000vnd
					$finalPrice = round($getOrder->total_amount * 100 / $exchangeRate, 2);
					$session = SessionStripe::create([
						'customer_email' => $getOrder->email,
						'payment_method_types' => ['card'],
						'line_items' => [
							[
								'price_data' => [
									'currency' => 'usd',
									'product_data' => [
										'name' => 'Nhật Hạ',
									],
									'unit_amount' => intval($finalPrice)
								],
								'quantity' => 1
							]
						],
						'mode' => 'payment',
						'success_url' => route('front.stripe_success_payment'),
						'cancel_url' => route('front.checkout')
					]);
					$getOrder->stripe_session_id = $session['id'];
					$getOrder->save();
					$data['session_id'] = $session['id'];
					Session::put('stripe_session_id', $session['id']);
					$data['setPublicKey'] = $getPaymentSetting->stripe_public_key;

					return view('payment.stripe_charge', $data);
				}
			} else {
				abort(404);
			}
		} else {
			abort(404);
		}
	}
	public function stripe_success_payment(Request $request)
	{
		$getPaymentSetting = PaymentSetting::getSingle();
		$trans_id = Session::get('stripe_session_id');
		Stripe::setApiKey($getPaymentSetting->stripe_secret_key);
		$getData = SessionStripe::retrieve($trans_id);
		$getOrder = Order::where('stripe_session_id', '=', $getData->id)->first();

		if (!empty($getOrder) && !empty($getData->id) && $getData->id == $getOrder->stripe_session_id) {
			$getOrder->is_payment = 1;
			$getOrder->transaction_id = $getData->id;
			$getOrder->payment_data = json_encode($getData);
			$getOrder->save();

			//notify
			$user_id = 1;
			$url= route('admin.order.detail',$getOrder->id);
			$msg= 'Đơn hàng #'. $getOrder->order_number .' đã được đặt';
			Notification::insertRecord($user_id, $url, $msg);

			\Cart::clear();
			return redirect(route('front.cart'))->with('success', 'Đơn hàng đặt thành công!');
		}
	}
}
