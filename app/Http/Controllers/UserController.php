<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function dashboard() {
		$data['meta_title'] = 'Bảng điều khiển';
    $data['meta_keywords'] = '';
    $data['meta_description'] = '';

    //totals
		$data['TotalOrder']=Order::getTotalOrderForUser(Auth::user()->id);
		$data['TotalTodayOrder']=Order::getTotalTodayOrderForUser(Auth::user()->id);
		$data['TotalAmount']= Order::getTotalAmountForUser(Auth::user()->id);
		$data['TotalTodayAmount']= Order::getTotalTodayAmountForUser(Auth::user()->id);

		$data['TotalPending']= Order::getTotalStatusForUser(Auth::user()->id,0);
		$data['TotalInprogess']= Order::getTotalStatusForUser(Auth::user()->id,1);
		$data['TotalDelivered']= Order::getTotalStatusForUser(Auth::user()->id,2);
		$data['TotalCompleted']= Order::getTotalStatusForUser(Auth::user()->id,3);
		$data['TotalCancelled']= Order::getTotalStatusForUser(Auth::user()->id,4);
		return view('user.dashboard', $data);
	}
	public function order() {
		$data['meta_title'] = 'Đơn hàng của tôi';
    $data['meta_keywords'] = '';
    $data['meta_description'] = '';
		$data['getOrder'] = Order::getRecordForUser(Auth::user()->id);
    return view('user.order', $data);
	}
	public function order_detail($id) {
		$data['getRecord']= Order::getSingleForUser(Auth::user()->id, $id);
		if (!empty($data['getRecord'])) {
      $data['meta_title'] = 'Chi tiết đơn hàng';
      $data['meta_keywords'] = '';
      $data['meta_description'] = '';
      return view('user.order_detail', $data);
    } else {
      abort(404);
    }
	}
	public function submit_review(Request $request) {
		$save= new ProductReview;
		$save->product_id= trim($request->product_id);
		$save->order_id= trim($request->order_id);
		$save->user_id= Auth::user()->id;
		$save->rating= trim($request->rating);
		$save->review= trim($request->review);
		$save->save();

		return redirect()->back()->with('success','Cảm ơn đánh giá chân thành của bạn');
	}
}
