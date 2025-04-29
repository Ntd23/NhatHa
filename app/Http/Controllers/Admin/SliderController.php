<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;

class SliderController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data['getRecord'] = Slider::getRecord();
		$data['header_title'] = 'Thanh trượt';
		return view('admin.slider.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data['header_title'] = 'Thêm mới thanh trượt';
		return view('admin.slider.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$slider = new Slider;
		$slider->title = trim($request->title);
		$slider->button_name = trim($request->button_name);
		$slider->button_link = trim($request->button_link);
		$slider->status = trim($request->status);

		//upload image
		$image_name = $request->file('image_name');
		if (!empty($request->file('image_name'))) {
			if ($image_name->isValid()) {
				$ext = $image_name->getClientOriginalExtension();
				$filename = time() . '.' . $ext;
				$image_name->storeAs('slider', $filename, 'public');
				$slider->image_name = trim($filename);
			}
		}
		$slider->save();
		return redirect(route('admin.slider.index'))->with('success', 'Thêm thanh trượt thành công!');
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
		$data['getRecord'] = Slider::getSingle($id);
		$data['header_title'] = 'Sửa thanh trượt';

		return view('admin.slider.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$slider = Slider::getSingle($id);
		$slider->title = trim($request->title);
		$slider->button_name = trim($request->button_name);
		$slider->button_link = trim($request->button_link);
		$slider->status = trim($request->status);

		//upload image
		$image_name = $request->file('image_name');
		if (!empty($request->file('image_name'))) {
			$oldImage = $slider->image_name;
			if (!empty($oldImage)) {
				Storage::disk('public')->delete('slider/' . $oldImage);
			}
			if ($image_name->isValid()) {
				$ext = $image_name->getClientOriginalExtension();
				$filename = time() . '.' . $ext;
				$image_name->storeAs('slider', $filename, 'public');
				$slider->image_name = trim($filename);
			}
		}
		$slider->save();

		return redirect(route('admin.slider.index'))->with('success', 'Cập nhật thành công thanh trượt');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$slider = Slider::where('id', $id)->first();
		$image_name = $slider->image_name;
		if (!empty($image_name)) {
			Storage::disk('public')->delete('slider/' . $image_name);
		}
		$slider->delete();
		$json['status'] = true;
		$json['success'] = 'Đã xóa thanh trượt';
		echo json_encode($json);
	}
}
