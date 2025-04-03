<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_form() {
      if(!empty(Auth::check()) && Auth::user()->is_admin==1) {
        return redirect('admin/dashboard');
      }
      return view('admin.auth.login');
    }
    public function login(Request $request) {
      $remember= !!empty($request->remember);
      if(Auth::attempt([
        'email'=>$request->email,
        'password'=>$request->password,
        'is_admin'=>1,
        'status'=>0,
        'is_delete'=>0
      ], $remember)) {
        return redirect('admin/dashboard');
      }else {
        return redirect()->back()->with('error','Email hoặc mật khẩu không chính xác');
      }
    }
    public function logout() {
      Auth::logout();
      return redirect('admin/login');
    }
}
