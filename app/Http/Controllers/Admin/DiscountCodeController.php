<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use Illuminate\Http\Request;

class DiscountCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
			$data['getRecord'] = DiscountCode::getRecord();
			$data['header_title'] = 'Mã giảm giá';
			return view('admin.discountcode.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
			$data['header_title'] = 'Thêm mã giảm giá';
			return view('admin.discountcode.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
			$DiscountCode = new DiscountCode;
			$DiscountCode->name = trim($request->name);
			$DiscountCode->type = trim($request->type);
			$DiscountCode->percent_amount = trim($request->percent_amount);
			$DiscountCode->expire_date = trim($request->expire_date);
			$DiscountCode->status = trim($request->status);
			$DiscountCode->save();

			return redirect(route('admin.discountcode.index'))->with('success', 'Đã tạo mã giảm giá!');
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
			$data['getRecord'] = DiscountCode::getSingle($id);
			$data['header_title'] = 'Chỉnh sửa mã giảm giá';

			return view('admin.discountcode.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
			$DiscountCode = DiscountCode::getSingle($id);
			$DiscountCode->name = trim($request->name);
			$DiscountCode->type = trim($request->type);
			$DiscountCode->percent_amount = trim($request->percent_amount);
			$DiscountCode->expire_date = trim($request->expire_date);
			$DiscountCode->status = trim($request->status);
			$DiscountCode->save();

			return redirect(route('admin.discountcode.index'))->with('success', 'Đã cập nhật mã giảm giá!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
			$discountcode = DiscountCode::getSingle($id);
			$discountcode->isDelete = 1;
			$discountcode->save();

			$json['status']=true;
			$json['success']='Đã xóa mã giảm giá';
			echo json_encode($json);
    }
}