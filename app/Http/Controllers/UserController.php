<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	public function dashboard()
	{
		$data['meta_title'] = 'Bảng điều khiển';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';

		//totals
		$data['TotalOrder'] = Order::getTotalOrderForUser(Auth::user()->id);
		$data['TotalTodayOrder'] = Order::getTotalTodayOrderForUser(Auth::user()->id);
		$data['TotalAmount'] = Order::getTotalAmountForUser(Auth::user()->id);
		$data['TotalTodayAmount'] = Order::getTotalTodayAmountForUser(Auth::user()->id);

		$data['TotalPending'] = Order::getTotalStatusForUser(Auth::user()->id, 0);
		$data['TotalInprogess'] = Order::getTotalStatusForUser(Auth::user()->id, 1);
		$data['TotalDelivered'] = Order::getTotalStatusForUser(Auth::user()->id, 2);
		$data['TotalCompleted'] = Order::getTotalStatusForUser(Auth::user()->id, 3);
		$data['TotalCancelled'] = Order::getTotalStatusForUser(Auth::user()->id, 4);
		return view('user.dashboard', $data);
	}
	public function order(Request $request)
	{
		$data['meta_title'] = 'Đơn hàng của tôi';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if(!empty($request->noti_id)) {
			Notification::updateReadNoti($request->noti_id);
		}
		$data['getOrder'] = Order::getRecordForUser(Auth::user()->id);
		return view('user.order', $data);
	}
	public function order_detail($id)
	{
		$data['getRecord'] = Order::getSingleForUser(Auth::user()->id, $id);
		if (!empty($data['getRecord'])) {
			$data['meta_title'] = 'Chi tiết đơn hàng';
			$data['meta_keywords'] = '';
			$data['meta_description'] = '';
			return view('user.order_detail', $data);
		} else {
			abort(404);
		}
	}
	public function submit_review(Request $request)
	{
		$save = new ProductReview;
		$save->product_id = trim($request->product_id);
		$save->order_id = trim($request->order_id);
		$save->user_id = Auth::user()->id;
		$save->rating = trim($request->rating);
		$save->review = trim($request->review);
		$save->save();

		return redirect()->back()->with('success', 'Cảm ơn đánh giá chân thành của bạn');
	}
	public function edit_profile()
	{
		$data['meta_title'] = 'Chỉnh sửa thông tin';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';

		$data['getRecord'] = User::getSingle(Auth::user()->id);
		return view('user.edit_profile', $data);
	}
	public function update_profile(Request $request)
	{
		$user = User::getSingle(Auth::user()->id);
		$user->name = $request->last_name . ' ' . $request->first_name;
		$user->company_name = trim($request->company_name);
		$user->country = trim($request->country);
		$user->address_one = trim($request->address_one);
		$user->address_two = trim($request->address_two);
		$user->city = trim($request->city);
		$user->district = trim($request->district);
		$user->postcode = trim($request->postcode);
		$user->phone = trim($request->phone);

		$user->save();

		return redirect()->back()->with('success', 'Thông tin của bạn đã được cập nhật');
	}
	public function change_password()
	{
		$data['meta_title'] = 'Cập nhật mật khẩu';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';

		$data['getRecord'] = User::getSingle(Auth::user()->id);
		return view('user.change_password', $data);
	}
	public function update_password(Request $request)
	{
		$user = User::getSingle(Auth::user()->id);
		if (Hash::check($request->old_password, $user->password)) {
			if ($request->password == $request->cpassword) {
				$user->password = Hash::make($request->password);
				$user->save();
				return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi');
			} else {
				return redirect()->back()->with('error', 'Mật khẩu không khớp');
			}
		} else {
			return redirect()->back()->with('error', 'Mật khẩu không chính xác');
		}
	}
	public function notifications(Request $request) {
		$data['meta_title'] = 'Thông báo';
    $data['meta_keywords'] = '';
    $data['meta_description'] = '';

    $data['getRecord'] = Notification::getRecordUser(Auth::user()->id);
    return view('user.notification', $data);
	}
}
