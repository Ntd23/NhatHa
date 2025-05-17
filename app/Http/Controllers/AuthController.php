<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\ForgotPasswordMail;
use App\Mail\RegisterMail;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
class AuthController extends Controller
{
	public function register(RegisterRequest $request)
	{
		$user_exist = User::checkExist($request->email);
		if (empty($user_exist)) {
			$user = new User();
			$user->name = $request->name;
			$user->email = $request->email;
			$user->password = Hash::make($request->password);
			$user->save();

			//send mail
			try {
				Mail::to($user->email)->send(new RegisterMail($user));
			} catch (\Exception $e) {
			}
			//notify
			$user_id = 1;
			$url = route('admin.customer');
			$msg = 'Khách hàng @' . $request->name . ' đã đăng ký tài khoản';
			Notification::insertRecord($user_id, $url, $msg);

			$json['status'] = true;
			$json['message'] = 'Khách hàng đăng ký tài khoản thành công.<br/>Vui lòng đăng nhập lại!';
		} else {
			$json['status'] = false;
			$json['message'] = 'Email đã tồn tại. Vui lòng thử lại.';
		}
		echo json_encode($json);
	}
	public function active_email($id) {
		$id= base64_decode($id);
		$user= User::getSingle($id);
		$user->email_verified_at= date('Y-m-d H:i:s');
		$user->save();
		return redirect(route('front.home'))->with('success','Tài khoản đã kích hoạt');
	}
	public function login(LoginRequest $request)
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
				Mail::to($save->email)->send(new RegisterMail($save));
				Auth::logout();
				$json['status'] = true;
				$json['message'] = 'Tài khoản chưa được xác thực. Kiểm tra email';
			}
		} else {
			$json['status'] = false;
			$json['message'] = 'Email hoặc mật khẩu không chính xác';
		}
		echo json_encode($json);
	}
	  public function login_google_form()
  {
    return Socialite::driver('google')->redirect();
  }
	  public function login_google_callback()
  {
    try {
      $user = Socialite::driver('google')->user();
      $user_exist = User::where('google_id', $user->id)->first();
      if ($user_exist) {
        Auth::login($user_exist);
        return redirect('/')->with('success', 'Khách hàng đăng nhập thành công');
      } else {
        $newUser = User::updateOrCreate(['email' => $user->email], [
          'name' => $user->name,
          'google_id' => $user->id,
          'password' => encrypt('123456dummy')
        ]);
        Auth::login($newUser);
        return redirect('/')->with('success', 'Khách hàng đăng nhập thành công');
      }
    } catch (\Exception $e) {
      \Log::error('Google Login Error:', ['error' => $e->getMessage()]); // Log lỗi
      return redirect('/login-google')->with('error', 'Đăng nhập thất bại: ' . $e->getMessage());
    }
  }
	public function logout()
	{
		Auth::logout();
		return redirect(route('front.home'));
	}
	public function forgot_password(Request $request) {
		$data['meta_title']='Quên mật khẩu';
		return view('auth.forgot', $data);
	}
	public function auth_forgot_password(Request $request) {
		$user= User::where('email','=',$request->email)->first();
		if(!empty($user)) {
			$user->remember_token= \Str::random(30);
			$user->save();
			try {
				Mail::to($user->email)->send(new ForgotPasswordMail($user));
			}catch(\Exception $e) {}
			return redirect()->back()->with('success','Kiểm tra email để cập nhật lại mật khẩu');
		}else {
			return redirect()->back()->with('warning','Email không đúng');
		}
	}
	public function reset_password($token) {
		$user= User::where('remember_token','=',$token)->first();
		if(!empty($user)) {
			$data['user']= $user;
			$data['meta_title']='Reset password';
			return view('auth.reset_password', $data);
		}else {
			abort(404);
		}
	}
	public function auth_reset_password($token, Request $request) {
		if($request->password===$request->cpassword) {
			$user= User::where('remember_token','=',$token)->first();
			$user->password= Hash::make($request->password);
			$user->remember_token= \Str::random(30);
			$user->save();
			return redirect(route('front.home'))->with('success','Khôi phục mật khẩu thành công');
		}else {
			return redirect()->back()->with('warning','Mật khẩu không khớp');
		}
	}
}
