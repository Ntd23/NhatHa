<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $data['getRecord'] = BlogCategory::getRecord();
    $data['header_title'] = 'Danh mục bài viết';
    return view('admin.blog_category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
			$data['header_title'] = 'Thêm mới danh mục bài viết';
			return view('admin.blog_category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      request()->validate([
				'slug' => 'required|unique:blog_categories',
			]);
			$category = new BlogCategory;
			$category->name = trim($request->name);
			$category->slug = trim($request->slug);
			$category->status = trim($request->status);
			$category->meta_title = trim($request->meta_title);
			$category->meta_description = trim($request->meta_description);
			$category->meta_keywords = trim($request->meta_keywords);

			$category->save();

			return redirect(route('admin.blog_category.index'))->with('success', 'Đã thêm danh mục bài viết');
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
			$data['getRecord'] = BlogCategory::getSingle($id);
			$data['header_title'] = 'Sửa danh mục bài viết';

			return view('admin.blog_category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      request()->validate([
				'slug' => 'required|unique:blog_categories,slug,' . $id,
			]);
			$category = BlogCategory::getSingle($id);
			$category->name = trim($request->name);
			$category->slug = trim($request->slug);
			$category->status = trim($request->status);
			$category->meta_title = trim($request->meta_title);
			$category->meta_description = trim($request->meta_description);
			$category->meta_keywords = trim($request->meta_keywords);

			$category->save();

			return redirect(route('admin.blog_category.index'))->with('success', 'Đã cập nhật danh mục bài viết!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
			BlogCategory::where('id', $id)->delete();

			$json['status'] = true;
			$json['success'] = 'Đã xóa danh mục bài viết';
			echo json_encode($json);
    }
}
