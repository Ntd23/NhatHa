<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
			$data['getRecord'] = Brand::getRecord();
			$data['header_title'] = 'Thương hiệu';
			return view('admin.brand.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
			$data['header_title'] = 'Thêm mới thương hiệu';
			return view('admin.brand.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
			$brand = new Brand;
			$brand->name = trim($request->name);
			$brand->slug = trim($request->slug);
			$brand->status = trim($request->status);
			$brand->meta_title = trim($request->meta_title);
			$brand->meta_description = trim($request->meta_description);
			$brand->meta_keywords = trim($request->meta_keywords);
			$brand->created_by = Auth::user()->id;
			$brand->save();

			return redirect(route('admin.brand.index'))->with('success', 'Thêm thương hiệu thành công');
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
			$data['getRecord'] = Brand::getSingle($id);
			$data['header_title'] = 'Chỉnh sửa thương hiệu';

			return view('admin.brand.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
			$brand = Brand::getSingle($id);
			$brand->name = trim($request->name);
			$brand->slug = trim($request->slug);
			$brand->status = trim($request->status);
			$brand->meta_title = trim($request->meta_title);
			$brand->meta_description = trim($request->meta_description);
			$brand->meta_keywords = trim($request->meta_keywords);
			$brand->save();

			return redirect(route('admin.brand.index'))->with('success', 'Thương hiệu cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function soft_delete(string $id)
    {
			$brand = Brand::getSingle($id);
			$brand->is_delete = 1;
			$brand->save();
			$json['status']=true;
			$json['success']='Xóa thành công!';
			echo json_encode($json);
    }
		public function trash() {
			$data['getRecord'] = Brand::getTrash();
			$data['header_title'] = 'Thùng rác';

			return view('admin.brand.trash', $data);
		}
		public function restore($id) {
			 Brand::restore($id);
			return redirect(route('admin.brand.index'))->with('success', 'Khôi phục thành công');
		}
}
