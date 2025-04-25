<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data['getRecord'] = User::getAdmin();
		$data['header_title'] = 'Quản trị viên';
		return view('admin.admin.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data['header_title'] = 'Thêm người quản trị';
		return view('admin.admin.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		request()->validate([
			'email' => 'required|email|unique:users',
			'name' => 'required|string'
		]);
		$user = new User;
		$user->name = trim($request->name);
		$user->email = trim($request->email);
		$user->password = Hash::make(trim($request->password));
		$user->status = $request->status;
		$user->is_admin = 1;
		$user->save();

		return redirect(route('admin.index'))->with('success', 'Đã thêm người quản trị');
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
		$data['getRecord'] = User::getSingle($id);
		$data['header_title'] = 'Chỉnh sửa người quản trị';
		return view('admin.admin.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		request()->validate([
			'email' => 'email|unique:users,email,' . $id,
		]);
		$user = User::getSingle($id);
		$user->name = $request->name;
		$user->email = $request->email;
		if (!empty($request->password)) {
			$user->password = Hash::make($request->password);
		}
		$user->status = $request->status;
		$user->is_admin = 1;
		$user->save();

		return redirect(route('admin.index'))->with('success', 'Cập nhật thành công!');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		User::where('id', $id)->delete();
		$json['status'] = true;
		$json['success'] = 'Xóa thành công';
		echo json_encode($json);
	}
	public function customer(Request $request)
	{
		if (!empty($request->noti_id)) {
			Notification::updateReadNoti($request->noti_id);
		}
		$data['getRecord'] = User::getCustomer();
		$data['header_title'] = 'Khách hàng';
		return view('admin.admin.customer', $data);
	}
}
