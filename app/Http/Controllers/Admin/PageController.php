<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Page;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;

class PageController extends Controller
{
	public function index()
  {
    $data['getRecord'] = Page::getRecord();
    $data['header_title'] = 'Trang';

    return view('admin.page.index', $data);
  }
	public function create() {
    $data['header_title'] = 'Thêm trang';

    return view('admin.page.create', $data);
	}
	public function store(Request $request) {
		$page= new Page;
		$page->name= trim($request->name);
		$page->save();

		return redirect(route('admin.page.edit', $page->id));
	}
  public function edit($id)
  {
    $data['getRecord'] = Page::getSingle($id);
    $data['header_title'] = 'Sửa trang';

    return view('admin.page.edit', $data);
  }
  public function update(Request $request, $id)
  {
    $page = Page::getSingle($id);
    $page->name = trim($request->name);
    $page->slug = str_replace(' ', '-', trim($request->name));
    $page->title = trim($request->title);
    $page->description = trim($request->description);
    $page->meta_title = trim($request->meta_title);
    $page->meta_desciption = trim($request->meta_description);
    $page->meta_keywords = trim($request->meta_keywords);
    //upload image
		$image_name = $request->file('image_name');
		if (!empty($request->file('image_name'))) {
			$oldImage = $page->image_name;
			if (!empty($oldImage)) {
				Storage::disk('public')->delete('page/' . $oldImage);
			}
			if ($image_name->isValid()) {
				$ext = $image_name->getClientOriginalExtension();
				$filename = time() . '.' . $ext;
				$image_name->storeAs('page', $filename, 'public');
				$page->image_name = trim($filename);
			}
		}
    $page->save();

    return redirect(route('admin.page.index'))->with('success', 'Trang cập nhật thành công!');
  }
	public function payment_setting()
	{
		$data['header_title'] = 'Cài đặt thanh toán';
		$data['getRecord'] = PaymentSetting::getSingle();
		return view('admin.setting.payment_setting', $data);
	}
	public function update_payment_setting(Request $request)
	{
		$save = PaymentSetting::getSingle();
		$save->stripe_public_key = trim($request->stripe_public_key);
		$save->stripe_secret_key = trim($request->stripe_secret_key);
		$save->is_stripe = !empty($request->is_stripe) ? 1 : 0;
		$save->is_cash_delivery = !empty($request->is_cash_delivery) ? 1 : 0;
		$save->save();
		return redirect()->back()->with('success', 'Cài đặt thanh toán đã được cập nhật!');
	}
	public function notification() {
		$data['getRecord'] = Notification::getRecord();
    $data['header_title'] = 'Thông báo';

    return view('admin.notification.index', $data);
	}
}
