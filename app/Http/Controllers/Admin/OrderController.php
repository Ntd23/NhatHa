<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $data['getRecord'] = Order::getRecord();
    $data['header_title'] = 'Order';
    return view('admin.order.index', $data);
    }

    public function show(Request $request,string $id)
    {
			$data['getRecord']=Order::getSingle($id);
			$data['header_title']='Chi tiết đơn hàng';

			return view('admin.order.detail', $data);
    }

		public function status(Request $request)
    {
        $getOrder= Order::getSingle($request->order_id);
				$getOrder->status= $request->status;
				$getOrder->save();

				$json['message']= 'Đã cập nhật đơn hàng này!';
				echo json_encode($json);
    }
}
