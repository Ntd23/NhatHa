<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;

class BlogController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data['getRecord'] = Blog::getRecord();
		$data['header_title'] = 'Bài viết';
		return view('admin.blog.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data['header_title'] = 'Thêm mới bài viết';
		$data['getCategory'] = BlogCategory::getRecordActive();
		return view('admin.blog.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$blog = new Blog;
		$blog->title = trim($request->title);
		$blog->blog_category_id = trim($request->blog_category_id);
		$blog->short_description = trim($request->short_description);
		$blog->description = trim($request->description);
		$blog->status = trim($request->status);
		$blog->meta_title = trim($request->meta_title);
		$blog->meta_description = trim($request->meta_description);
		$blog->meta_keywords = trim($request->meta_keywords);
		$slug = Str::slug($request->title);
		$count = Blog::where('slug', '=', $slug)->count();
		if (!empty($count)) {
			$blog->slug = $slug . '-' . $blog->id;
		} else {
			$blog->slug = trim($slug);
		}
		//upload image
		$image_name = $request->file('image_name');
		if (!empty($request->file('image_name'))) {
			if ($image_name->isValid()) {
				$ext = $image_name->getClientOriginalExtension();
				$filename = time() . '.' . $ext;
				$image_name->storeAs('blog', $filename, 'public');
				$blog->image_name = trim($filename);
			}
		}
		$blog->save();

		return redirect(route('admin.blog.index'))->with('success', 'Đã thêm bài viết');
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
		$data['getRecord'] = Blog::getSingle($id);
		$data['getCategory'] = BlogCategory::getRecordActive();

		$data['header_title'] = 'Sửa bài viết';

		return view('admin.blog.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$blog = Blog::getSingle($id);
		$blog->title = trim($request->title);
		$blog->blog_category_id = trim($request->blog_category_id);
		$blog->description = trim($request->description);
		$blog->short_description = trim($request->short_description);
		$blog->status = trim($request->status);
		$blog->meta_title = trim($request->meta_title);
		$blog->meta_description = trim($request->meta_description);
		$blog->meta_keywords = trim($request->meta_keywords);

		//upload image
		$image_name = $request->file('image_name');
		if (!empty($request->file('image_name'))) {
			$oldImage = $blog->image_name;
			if (!empty($oldImage)) {
				Storage::disk('public')->delete('blog/' . $oldImage);
				if ($image_name->isValid()) {
					$ext = $image_name->getClientOriginalExtension();
					$filename = time() . '.' . $ext;
					$image_name->storeAs('blog', $filename, 'public');
					$blog->image_name = trim($filename);
				}
			}
		}
		$blog->save();

		return redirect(route('admin.blog.index'))->with('success', 'Đã cập nhật bài viết!');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$blog = Blog::where('id', $id)->first();
		$image_name = $blog->image_name;
		if (!empty($image_name)) {
			Storage::disk('public')->delete('blog/' . $image_name);
		}
		$blog->delete();
		$json['status'] = true;
		$json['success'] = 'Đã xóa bài viết';
		echo json_encode($json);
	}
}
