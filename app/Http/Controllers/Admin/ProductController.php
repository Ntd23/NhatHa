<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductSize;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Str;

class ProductController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data['getRecord'] = Product::getRecord();
		$data['header_title'] = 'Sản phẩm';
		return view('admin.product.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data['getCategory'] = Product::getRecord();
		$data['header_title'] = 'Thêm mới sản phẩm';
		return view('admin.product.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$title = trim($request->title);
		$product = new Product;
		$product->title = $title;
		$product->created_by = Auth::user()->id;
		$product->save();
		$slug = Str::slug($title, '-');
		$checkSlug = Product::checkSlug($slug);
		if (empty($checkSlug)) {
			$product->slug = $slug;
			$product->save();
		} else {
			$new_slug = $slug . '-' . $product->id;
			$product->slug = $new_slug;
			$product->save();
		}
		return redirect(route('admin.product.edit',$product->id));
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
		$product = Product::getSingle($id);
		if (!empty($product)) {
			$data['getCategory'] = Category::getRecordActive();
			$data['getSubCategory'] = SubCategory::getRecordSubCategory($product->category_id);
			$data['getBrand'] = Brand::getRecordActive();
			$data['product'] = $product;
			$data['header_title'] = 'Chỉnh sửa sản phẩm';
			return view('admin.product.edit', $data);
		}
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		// dd($request);
		$product = Product::getSingle($id);
    if (!empty($product)) {
      //store product
      $product->title = trim($request->title);
      $product->sku = trim($request->sku);
      $product->category_id = trim($request->category_id);
      $product->sub_category_id = trim($request->sub_category_id);
      $product->brand_id = trim($request->brand_id);
      $product->is_trendy = !empty($request->is_trendy) ? 1 : 0;
      $product->price = trim($request->price);
      $product->old_price = trim($request->old_price);
      $product->short_description = trim($request->short_description);
      $product->description = trim($request->description);
      $product->additional_information = trim($request->additional_information);
      $product->shipping_returns = trim($request->shipping_returns);
      $product->status = trim($request->status);
      $product->save();

      //update size
      ProductSize::DeleteRecord($product->id);
      if (!empty($request->size)) {
				// dd($request->size);
        foreach ($request->size as $size) {
          if (!empty($size['name'])) {
            $saveSize = new ProductSize;
            $saveSize->name = $size['name'];
            $saveSize->price = !empty($size['price']) ? $size['price'] : 0;
            $saveSize->product_id = $product->id;
            $saveSize->save();
          }
        }
      }

      //upload image
      if (!empty($request->file('image'))) {
        foreach ($request->file('image') as $value) {
          if ($value->isValid()) {
            $ext = $value->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $value->storeAs('product',$filename,'public');
            $imageUpload = new ProductImages;
            $imageUpload->image_name = $filename;
            $imageUpload->image_extension = $ext;
            $imageUpload->product_id = $product->id;
            $imageUpload->save();
          }
        }
      }
      return redirect()->back()->with('success', 'Cập nhật sản phẩm thành công');
    } else {
      abort(404);

    }
	}
	public function product_image_sortable(Request $request) {
		if(!empty($request->photo_id)) {
			$i=1;
			foreach($request->photo_id as $photo_id) {
				$image= ProductImages::getSingle($photo_id);
				$image->order_by= $i;
				$image->save();
				$i++;
			}
		}
		$json['success']= true;
		echo json_encode($json);
	}
	public function image_delete($id)
  {
    $image = ProductImages::getSingle($id);
    if (!empty($image->getLogo())) {
			Storage::disk('public')->delete('product/'.$image->image_name);
    }
    $image->delete();
    return redirect()->back()->with('success', 'Đã xóa ảnh sản phẩm! ');
  }
	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$image = ProductImages::getSingle($id);
    if (!empty($image) && !empty($image->getLogo())) {
			Storage::disk('public')->delete('product/'.$image->image_name);
			$image->delete();
    }
		Product::where('id',$id)->delete();
		$json['status']= true;
		$json['success']='Đã xóa sản phẩm';
		echo json_encode($json);
	}
}
