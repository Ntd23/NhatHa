<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\HomeSetting;
use App\Models\Notification;
use App\Models\Page;
use App\Models\PaymentSetting;
use App\Models\SystemSetting;
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
	public function create()
	{
		$data['header_title'] = 'Thêm trang';

		return view('admin.page.create', $data);
	}
	public function store(Request $request)
	{
		$page = new Page;
		$page->name = trim($request->name);
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
	public function home_setting()
	{
		$data['getRecord'] = HomeSetting::getSingle();
		$data['header_title'] = 'Cài đặt trang chủ';

		return view('admin.setting.home_setting', $data);
	}
	public function update_home_setting(Request $request)
	{
		$save = HomeSetting::getSingle();
		$save->trendy_product_title = trim($request->trendy_product_title);
		$save->shop_category_title = trim($request->shop_category_title);
		$save->recent_arrival_title = trim($request->recent_arrival_title);
		$save->blog_title = trim($request->blog_title);
		$save->payment_delivery_title = trim($request->payment_delivery_title);
		$save->payment_delivery_description = trim($request->payment_delivery_description);
		$save->refund_title = trim($request->refund_title);
		$save->refund_description = trim($request->refund_description);
		$save->suport_title = trim($request->suport_title);
		$save->suport_description = trim($request->suport_description);
		$save->signup_title = trim($request->signup_title);
		$save->signup_description = trim($request->signup_description);

		$save->save();

		//upload image payment delivery
		$payment_delivery_image_name = $request->file('payment_delivery_image');
		if (!empty($request->file('payment_delivery_image'))) {
			$payment_delivery_old_image = $save->payment_delivery_image;
			if (!empty($payment_delivery_old_image)) {
				Storage::disk('public')->delete('setting/' . $payment_delivery_old_image);
			}
			if ($payment_delivery_image_name->isValid()) {
				$ext = $payment_delivery_image_name->getClientOriginalExtension();
				$filename_payment_delivery = time() .'_'. uniqid() . '.' . $ext;
				$payment_delivery_image_name->storeAs('setting', $filename_payment_delivery, 'public');
				$save->payment_delivery_image = trim($filename_payment_delivery);
			}
		}
		//upload image refund
		$refund_image_name = $request->file('refund_image');
		if (!empty($request->file('refund_image'))) {
			$refund_old_image = $save->refund_image;
			if (!empty($refund_old_image)) {
				Storage::disk('public')->delete('setting/' . $refund_old_image);
			}
			if ($refund_image_name->isValid()) {
				$ext = $refund_image_name->getClientOriginalExtension();
				$filename_refund =  time() .'_'. uniqid() . '.' . $ext;
				$refund_image_name->storeAs('setting', $filename_refund, 'public');
				$save->refund_image = trim($filename_refund);
			}
		}
		//upload image support
		$support_image_name = $request->file('support_image');
		if (!empty($request->file('support_image'))) {
			$support_old_image = $save->support_image;
			if (!empty($support_old_image)) {
				Storage::disk('public')->delete('setting/' . $support_old_image);
			}
			if ($support_image_name->isValid()) {
				$ext = $support_image_name->getClientOriginalExtension();
				$filename_support =  time() .'_'. uniqid() . '.' . $ext;
				$support_image_name->storeAs('setting', $filename_support, 'public');
				$save->suport_image = trim($filename_support);
			}
		}
		//upload image signup
		$signup_image_name = $request->file('signup_image');
		if (!empty($request->file('signup_image'))) {
			$signup_old_image = $save->signup_image;
			if (!empty($signup_old_image)) {
				Storage::disk('public')->delete('setting/' . $signup_old_image);
			}
			if ($signup_image_name->isValid()) {
				$ext = $signup_image_name->getClientOriginalExtension();
				$filename_signup =  time() .'_'. uniqid() . '.' . $ext;
				$signup_image_name->storeAs('setting', $filename_signup, 'public');
				$save->signup_image = trim($filename_signup);
			}
		}
		$save->save();
		return redirect()->back()->with('success', 'Cài đặt trang chủ đã được cập nhật!');
	}
	public function system_setting() {
		$data['getRecord'] = SystemSetting::getSingle();
    $data['header_title'] = 'Cài đặt chung';

    return view('admin.setting.system_setting', $data);
	}
	public function update_system_setting(Request $request)
  {
    $save = SystemSetting::getSingle();
    $save->website_name = trim($request->website_name);
    $save->footer_description = trim($request->footer_description);
    $save->address = trim($request->address);
    $save->phone = trim($request->phone);
    $save->phone_two = trim($request->phone_two);
    $save->email = trim($request->email);
    $save->email_two = trim($request->email_two);
    $save->submit_email = trim($request->submit_email);
    $save->working_hours = trim($request->working_hours);
    $save->fb_link = trim($request->fb_link);
    $save->ig_link = trim($request->ig_link);
    $save->ytb_link = trim($request->ytb_link);

    $save->save();

    //upload image logo
		$logo_name = $request->file('logo');
		if (!empty($request->file('logo'))) {
			$logo_old_image = $save->logo;
			if (!empty($logo_old_image)) {
				Storage::disk('public')->delete('setting/' . $logo_old_image);
			}
			if ($logo_name->isValid()) {
				$ext = $logo_name->getClientOriginalExtension();
				$filename_logo =  time() .'_'. uniqid() . '.' . $ext;
				$logo_name->storeAs('setting', $filename_logo, 'public');
				$save->logo = trim($filename_logo);
			}
		}
    //upload image favicon
		$favicon_name = $request->file('favicon');
		if (!empty($request->file('favicon'))) {
			$favicon_old_image = $save->favicon;
			if (!empty($favicon_old_image)) {
				Storage::disk('public')->delete('setting/' . $favicon_old_image);
			}
			if ($favicon_name->isValid()) {
				$ext = $favicon_name->getClientOriginalExtension();
				$filename_favicon =  time() .'_'. uniqid() . '.' . $ext;
				$favicon_name->storeAs('setting', $filename_favicon, 'public');
				$save->favicon = trim($filename_favicon);
			}
		}
    //upload image footer_payment_icon
		$footer_payment_icon_name = $request->file('footer_payment_icon');
		if (!empty($request->file('footer_payment_icon'))) {
			$footer_payment_icon_old_image = $save->footer_payment_icon;
			if (!empty($footer_payment_icon_old_image)) {
				Storage::disk('public')->delete('setting/' . $footer_payment_icon_old_image);
			}
			if ($footer_payment_icon_name->isValid()) {
				$ext = $footer_payment_icon_name->getClientOriginalExtension();
				$filename_footer_payment_icon =  time() .'_'. uniqid() . '.' . $ext;
				$footer_payment_icon_name->storeAs('setting', $filename_footer_payment_icon, 'public');
				$save->footer_payment_icon = trim($filename_footer_payment_icon);
			}
		}
		$save->save();

    return redirect()->back()->with('info', 'Cập nhật thành công cài đặt chung!');
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
	public function contact() {
		$data['getRecord'] = Contact::getRecord();
    $data['header_title'] = 'Liên hệ';

    return view('admin.contact.index', $data);
	}
	public function delete_contact($id)
  {
    Contact::where('id', '=', $id)->delete();

    return redirect()->back()->with('success', 'Đã xóa thư này');
  }

	public function notification()
	{
		$data['getRecord'] = Notification::getRecord();
		$data['header_title'] = 'Thông báo';

		return view('admin.notification.index', $data);
	}
}
