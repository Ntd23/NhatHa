<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data['getRecord'] = SubCategory::getRecord();
		$data['header_title'] = 'Danh  mục con';
		return view('admin.sub_category.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data['getCategory'] = Category::getRecord();
		$data['header_title'] = 'Thêm mới danh mục con';
		return view('admin.sub_category.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreSubCategoryRequest $request)
	{
		$sub_category = new SubCategory;
		$sub_category->category_id = $request->category_id;
		$sub_category->name = trim($request->name);
		$sub_category->slug = trim($request->slug);
		$sub_category->status = trim($request->status);
		$sub_category->meta_title = trim($request->meta_title);
		$sub_category->meta_description = trim($request->meta_description);
		$sub_category->meta_keywords = trim($request->meta_keywords);
		$sub_category->created_by = Auth::user()->id;
		$sub_category->save();

		return redirect(route('admin.subcategory.index'))->with('success', 'Thêm mới danh mục con thành công');
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
		$data['getCategory'] = Category::getRecord();
		$data['getRecord'] = SubCategory::getSingle($id);
		$data['header_title'] = 'Chỉnh sửa danh mục con';
		return view('admin.sub_category.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$sub_category = SubCategory::getSingle($id);
		$sub_category->name = trim($request->name);
		$sub_category->slug = trim($request->slug);
		$sub_category->status = trim($request->status);
		$sub_category->meta_title = trim($request->meta_title);
		$sub_category->meta_description = trim($request->meta_description);
		$sub_category->meta_keywords = trim($request->meta_keywords);
		$sub_category->save();

		return redirect(route('admin.subcategory.index'))->with('success', 'Cập nhật danh mục con thành công!');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$subcategory = SubCategory::getSingle($id);
		$subcategory->delete();
		$json['status'] = true;
		$json['success'] = 'Đã xóa danh mục con';
		echo json_encode($json);
	}
	public function get_sub_category(Request $request)
	{
		$category_id = $request->id;
		$get_sub_category = SubCategory::getRecordSubCategory($category_id);
		$html = '';
		$html .= '';
		foreach ($get_sub_category as $value) {
			$html .= '<option value="' . $value->id . '">' . $value->name . '</option>';
		}
		$json['html']= $html;
		echo json_encode($json);
	}

}
