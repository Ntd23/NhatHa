<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	public function register(Request $request)
	{
		$user_exist = User::checkExist($request->email);
		if (empty($user_exist)) {
			$user = new User();
			$user->name = $request->name;
			$user->email = $request->email;
			$user->password = Hash::make($request->password);
			$user->save();
			$json['status'] = true;
			$json['message'] = 'Khách hàng đăng ký tài khoản thành công.<br/>Vui lòng đăng nhập lại!';
		} else {
			$json['status'] = false;
			$json['message'] = 'Email đã tồn tại. Vui lòng thử lại.';
		}
		echo json_encode($json);
	}
	public function login(Request $request)
	{
		$remember = !empty($request->is_remember) ? true : false;
		if (
			Auth::attempt([
				'email' => $request->email,
				'password' => $request->password,
				'status' => 0,
				'is_delete' => 0
			], $remember)
		) {
			if (!empty(Auth::user()->email_verified_at)) {
				$json['status'] = true;
				$json['message'] = 'success';
			} else {
				$save = User::getSingle(Auth::user()->id);
			//	Auth::logout();
			$json['status'] = true;
				$json['message'] = 'Kiểm tra hộp thư để xác thực email';
			}
		} else {
			$json['status'] = false;
			$json['message'] = 'Email hoặc mật khẩu không chính xác';
		}
		echo json_encode($json);
	}
	public function logout() {
		Auth::logout();
		return redirect(route('front.home'));
	}
}
