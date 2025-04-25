<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;

class PageController extends Controller
{
	public function payment_setting()
	{
		$data['header_title'] = 'Cài đặt thanh toán';
		$data['getRecord'] = PaymentSetting::getSingle();
		return view('admin.setting.payment_setting', $data);
	}
	public function update_payment_setting(Request $request)
	{
		$save = PaymentSetting::getSingle();
		$save->stripe_public_key = trim($request->stripe_public_key);
		$save->stripe_secret_key = trim($request->stripe_secret_key);
		$save->is_stripe = !empty($request->is_stripe) ? 1 : 0;
		$save->is_cash_delivery = !empty($request->is_cash_delivery) ? 1 : 0;
		$save->save();
		return redirect()->back()->with('success', 'Cài đặt thanh toán đã được cập nhật!');
	}
	public function notification() {
		$data['getRecord'] = Notification::getRecord();
    $data['header_title'] = 'Thông báo';

    return view('admin.notification.index', $data);
	}
}
