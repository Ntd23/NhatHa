<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function dashboard(Request $request)
	{
		//total
		$data['TotalOrder'] = Order::getTotalOrder();
		$data['TotalTodayOrder'] = Order::getTotalTodayOrder();
		$data['TotalMonthOrder'] = Order::getTotalMonthOrder();
		$data['TotalAmount'] = Order::getTotalAmount();
		$data['TotalTodayAmount'] = Order::getTotalTodayAmount();
		$data['TotalMonthAmount'] = Order::getTotalMonthAmount();
		$data['TotalCustomer'] = User::getTotalCustomer();
		$data['TotalTodayCustomer'] = User::getTotalTodayCustomer();
		$data['TotalMonthCustomer'] = User::getTotalMonthCustomer();
		$data['getLatestOrders'] = Order::getLatestOrders();
		//chart
		if (!empty($request->year)) $year = $request->year;
		else $year = date('Y');
		$getTotalCustomerMonth = '';
		$getTotalOrderMonth = '';
		$getTotalOrderAmountMonth = '';
		$totalAmount = 0;
		for ($month = 1; $month <= 12; $month++) {
			$startDate = new \DateTime("$year-$month-01");
			$endDate = new \DateTime("$year-$month-01");
			$endDate->modify('Last day of this month');

			$startDate = $startDate->format('Y-m-d');
			$endDate = $endDate->format('Y-m-d');

			$customer = User::getTotalCustomerMonth($startDate, $endDate);
			$getTotalCustomerMonth .= $customer . ',';

			$order = Order::getTotalOrderMonth($startDate, $endDate);
			$getTotalOrderMonth .= $order . ',';

			$orderpayment= Order::getTotalOrderAmountMonth($startDate,$endDate);
			$getTotalOrderAmountMonth .= $orderpayment . ',';

			$totalAmount= $totalAmount + $orderpayment;
		}
		$data['getTotalCustomerMonth']= rtrim($getTotalCustomerMonth,',');
		$data['getTotalOrderMonth']= rtrim($getTotalOrderMonth,',');
		$data['getTotalOrderAmountMonth']= rtrim($getTotalOrderAmountMonth,',');
		$data['totalAmount']= rtrim($totalAmount,',');
		$data['year']=$year;
		$data['header_title']='Bảng điều khiển';
		return view('admin.dashboard', $data);
	}
}
