<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;

class ShippingChargeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data['getRecord'] = ShippingCharge::getRecord();
		$data['header_title'] = 'Phí giao hàng';
		return view('admin.shippingcharge.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data['header_title'] = 'Thêm mới phí giao hàng';
		return view('admin.shippingcharge.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$shippingcharge = new ShippingCharge;
		$shippingcharge->name = trim($request->name);
		$shippingcharge->price = trim($request->price);
		$shippingcharge->status = trim($request->status);
		$shippingcharge->save();
		return redirect(route('admin.shippingcharge.index'))->with('success', 'Phí giao hàng đã được tạo mới!');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$data['getRecord'] = ShippingCharge::getSingle($id);
		$data['header_title'] = 'Chỉnh sửa phí giao hàng';
		return view('admin.shippingcharge.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$shippingcharge = ShippingCharge::getSingle($id);
		$shippingcharge->name = trim($request->name);
		$shippingcharge->price = trim($request->price);
		$shippingcharge->status = trim($request->status);
		$shippingcharge->save();
		return redirect(route('admin.shippingcharge.index'))->with('success', 'Phí giao hàng đã được cập nhật!');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$shippingcharge = ShippingCharge::getSingle($id);
		$shippingcharge->is_delete = 1;
		$shippingcharge->save();
		$json['status'] = true;
		$json['success'] = 'Đã xóa giao hàng này';
		echo json_encode($json);
	}
}
