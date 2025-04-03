<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data['header_title'] = 'Danh mục';
		$data['getRecord'] = Category::getRecord();
		return view('admin.category.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data['header_title'] = 'Thêm danh mục';
		return view('admin.category.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreCategoryRequest $request)
	{
		$category = new Category;
		$category->name = trim($request->name);
		$category->slug = trim($request->slug);
		$category->status = trim($request->status);
		$category->meta_title = trim($request->meta_title);
		$category->meta_description = trim($request->meta_description);
		$category->meta_keywords = trim($request->meta_keywords);
		$category->created_by = Auth::user()->id;

		$category->button_name = trim($request->button_name);
		$category->is_home = !empty($request->is_home) ? 1 : 0;
		$category->is_menu = !empty($request->is_menu) ? 1 : 0;
		$file = $request->file('image');
		if (!empty($file)) {
			$ext = $file->getClientOriginalExtension();
			$fileName = time() . '.' . $ext;
			$file->storeAs('category', $fileName, 'public');
			$category->image_name = trim($fileName);
		}

		$category->save();

		return redirect(route('admin.category.index'))->with('success', 'Thêm mới danh mục thành công!');
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
		$data['getRecord'] = Category::getSingle($id);
		$data['header_title'] = 'Chỉnh sửa danh mục';

		return view('admin.category.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateCategoryRequest $request, string $id)
	{
		$category = Category::getSingle($id);
		$category->name = trim($request->name);
		$category->slug = trim($request->slug);
		$category->status = trim($request->status);
		$category->meta_title = trim($request->meta_title);
		$category->meta_description = trim($request->meta_description);
		$category->meta_keywords = trim($request->meta_keywords);

		$category->button_name = trim($request->button_name);
		$category->is_home = !empty($request->is_home) ? 1 : 0;
		$category->is_menu = !empty($request->is_menu) ? 1 : 0;
		$file = $request->file('image');
		if (!empty($file)) {
			$ext = $file->getClientOriginalExtension();
			$fileName = time() . '.' . $ext;
			$file->storeAs('category', $fileName, 'public');
			$category->image_name = trim($fileName);
		}

		$category->save();

		return redirect(route('admin.category.index'))->with('success', 'Cập nhật danh mục thành công!');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$category= Category::getSingle($id);
		if(!empty($category->image_name)) {
			Storage::disk('public')->delete('category/'.$category->image_name);
		}
		$category->delete();
		$json['status']= true;
		$json['success']='Đã xóa danh mục';
		echo json_encode($json);
	}
}