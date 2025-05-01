<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Category;
use App\Models\Contact;
use App\Models\HomeSetting;
use App\Models\Page;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	public function home()
	{
		$getPage = Page::getSlug('home');
		$data['meta_title'] = $getPage->meta_title;
		$data['meta_desciption'] = $getPage->meta_desciption;
		$data['meta_keywords'] = $getPage->meta_keywords;
		$data['getHomeSetting'] = HomeSetting::getSingle();
		$data['getSlider'] = Slider::getRecordAcitve();
		$data['getBlog'] = Blog::getRecordActiveHome();
		$data['getProduct'] = Product::getRecentArrival();
		$data['getCategory'] = Category::getRecordActiveHome();
		$data['getProductTrendy'] = Product::getProductTrendy();
		return view('layout.main', $data);
	}
	public function recent_arrival_category_product(Request $request)
	{
		$getProduct = Product::getRecentArrival();
		$getCategory = Category::getSingle($request->category_id);

		return response()->json([
			'status' => true,
			'success' => view('product._list_recent_arrival', ['getProduct' => $getProduct, 'getCategory' => $getCategory])->render(),
		], 200);
	}
	public function blog()
	{
		$data['getBlog'] = Blog::getBlog();
		$data['getBlogCategory'] = BlogCategory::getRecordActive();
		$data['getPopular'] = Blog::getPopular();
		return view('blog.list', $data);
	}
	public function blog_detail($slug)
	{
		$getBlog = Blog::getSingleSlug($slug);
		if (!empty($getBlog)) {
			$data['meta_title'] = $getBlog->meta_title;
			$data['meta_description'] = $getBlog->meta_description;
			$data['meta_keywords'] = $getBlog->meta_keywords;
			$total_view = $getBlog->total_view;
			$getBlog->total_view = $total_view + 1;
			$getBlog->save();
			$data['getBlog'] = $getBlog;
			$data['getBlogCategory'] = BlogCategory::getRecordActive();
			$data['getPopular'] = Blog::getPopular();
			$data['getRelatedPost'] = Blog::getRelatedPost($getBlog->blog_category_id, $getBlog->id);
			return view('blog.detail', $data);
		} else {
			abort(404);
		}
	}
	public function blog_category($slug)
	{
		$getCategory = BlogCategory::getSingleSlug($slug);
		if (!empty($getCategory)) {
			$data['meta_title'] = $getCategory->meta_title;
			$data['meta_desciption'] = $getCategory->meta_desciption;
			$data['meta_keywords'] = $getCategory->meta_keywords;

			$data['getCategory'] = $getCategory;
			$data['getBlog'] = Blog::getBlog($getCategory->id);
			$data['getBlogCategory'] = BlogCategory::getRecordActive();
			$data['getPopular'] = Blog::getPopular();
			return view('blog.category', $data);
		} else {
			abort(404);
		}
	}
	public function submit_comment(Request $request)
	{
		$comment = new BlogComment;
		$comment->user_id = Auth::user()->id;
		$comment->blog_id = $request->blog_id;
		$comment->comment = trim($request->comment);
		$comment->save();

		return redirect()->back();
	}
	public function contact()
	{
		$getPage = Page::getSlug('contact');
		$data['getPage'] = $getPage;
		$data['meta_title'] = $getPage->meta_title;
		$data['meta_desciption'] = $getPage->meta_desciption;
		$data['meta_keywords'] = $getPage->meta_keywords;
		$data['getSystemSetting'] = SystemSetting::getSingle();
		return view('page.contact', $data);
	}
	public function submit_contact(Request $request)
	{
		$save = new Contact;
		if (!empty(Auth::check())) {
			$save->user_id = Auth::user()->id;
		}
		$save->name = trim($request->name);
		$save->email = trim($request->email);
		$save->phone = trim($request->phone);
		$save->subject = trim($request->subject);
		$save->message = trim($request->message);
		$save->save();

		$getSystemSetting = SystemSetting::getSingle();
		// Mail::to($getSystemSetting->submit_email)->send(new ContactMail($save));

		return redirect()->back()->with('success', 'Chúng tôi sẽ phản hồi đến bạn trong thời gian sớm nhất');
	}
}
