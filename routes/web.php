<?php

use App\Http\Controllers\Admin\AuthController as AuthControllerForAdmin;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\admin\ShippingChargeController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController as ProductControllerFront;
use Illuminate\Support\Facades\Route;


Route::get('admin/login', [AuthControllerForAdmin::class, 'login_form']);
Route::post('admin/login', [AuthControllerForAdmin::class, 'login']);
Route::get('admin/logout', [AuthControllerForAdmin::class, 'logout']);

Route::group(['middleware' => 'is_admin'], function () {
	Route::prefix('admin')->name('admin.')->group(function() {
		Route::get('dashboard', function () {
			return view('admin.dashboard');
		})->name('dashboard');
		Route::prefix('category')->controller(CategoryController::class)->group(function() {
			Route::get('index','index')->name('category.index');
			Route::get('create','create')->name('category.create');
			Route::post('store','store')->name('category.store');
			Route::get('edit/{id}','edit')->name('category.edit');
			Route::post('update/{id}','update')->name('category.update');
			Route::get('delete/{id}','destroy')->name('category.delete');
		});
		Route::prefix('subcategory')->controller(SubCategoryController::class)->group(function() {
			Route::get('index','index')->name('subcategory.index');
			Route::get('create','create')->name('subcategory.create');
			Route::post('store','store')->name('subcategory.store');
			Route::get('edit/{id}','edit')->name('subcategory.edit');
			Route::post('update/{id}','update')->name('subcategory.update');
			Route::get('delete/{id}','destroy')->name('subcategory.delete');
			Route::post('get_sub_category','get_sub_category')->name('subcategory.get_sub_category');
		});
		Route::prefix('brand')->controller(BrandController::class)->group(function() {
			Route::get('index','index')->name('brand.index');
			Route::get('create','create')->name('brand.create');
			Route::post('store','store')->name('brand.store');
			Route::get('edit/{id}','edit')->name('brand.edit');
			Route::post('update/{id}','update')->name('brand.update');
			Route::get('delete/{id}','soft_delete')->name('brand.soft_delete');
			Route::get('trash','trash')->name('brand.trash');
			Route::get('restore/{id}','restore')->name('brand.restore');
		});
		Route::prefix('product')->controller(ProductController::class)->group(function() {
			Route::get('index','index')->name('product.index');
			Route::get('create','create')->name('product.create');
			Route::post('store','store')->name('product.store');
			Route::get('edit/{id}','edit')->name('product.edit');
			Route::post('update/{id}','update')->name('product.update');
			Route::get('delete/{id}','destroy')->name('product.delete');
			Route::get('image/delete/{id}', [ProductController::class, 'image_delete'])->name('product.image_delete');
			Route::post('image/sortable', [ProductController::class, 'product_image_sortable'])->name('product.image_sortable');
		});
		Route::prefix('discountcode')->controller(DiscountCodeController::class)->group(function() {
			Route::get('index','index')->name('discountcode.index');
			Route::get('create','create')->name('discountcode.create');
			Route::post('store','store')->name('discountcode.store');
			Route::get('edit/{id}','edit')->name('discountcode.edit');
			Route::post('update/{id}','update')->name('discountcode.update');
			Route::get('delete/{id}','destroy')->name('discountcode.delete');
		});
		Route::prefix('shipping-charge')->controller(ShippingChargeController::class)->group(function() {
			Route::get('index','index')->name('shippingcharge.index');
			Route::get('create','create')->name('shippingcharge.create');
			Route::post('store','store')->name('shippingcharge.store');
			Route::get('edit/{id}','edit')->name('shippingcharge.edit');
			Route::post('update/{id}','update')->name('shippingcharge.update');
			Route::get('delete/{id}','destroy')->name('shippingcharge.delete');
		});
		Route::prefix('order')->controller(OrderController::class)->group(function() {
			Route::get('index','index')->name('order.index');
			Route::get('create','create')->name('order.create');
			Route::post('store','store')->name('order.store');
			Route::get('edit/{id}','edit')->name('order.edit');
			Route::post('update/{id}','update')->name('order.update');
			Route::get('delete/{id}','destroy')->name('order.delete');
		});
		Route::prefix('payment-setting')->controller(PageController::class)->group(function() {
			Route::get('','payment_setting')->name('payment_setting');
			Route::post('','update_payment_setting')->name('update_payment_setting');
		});
	});
});

//user
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::name('front.')->group(function() {
	Route::get('',[HomeController::class,'home'])->name('home');
	Route::post('recent_arrival_category_product',[HomeController::class,'recent_arrival_category_product'])->name('recent_arrival_category_product');
	Route::get('search',[ProductControllerFront::class,'getProductSearch'])->name('search');
	Route::post('get_filter_product_ajax', [ProductControllerFront::class,'getFilterProductAjax'])->name('filter_product');
	Route::post('product/add-to-cart',[PaymentController::class,'add_to_cart'])->name('add_to_cart');
	Route::get('cart',[PaymentController::class,'cart'])->name('cart');
	Route::post('update_cart',[PaymentController::class,'update_cart'])->name('update_cart');
	Route::get('cart/delete/{id}',[PaymentController::class,'cart_delete'])->name('cart_delete');
	Route::get('checkout',[PaymentController::class,'checkout'])->name('checkout');
	Route::get('{category?}/{sub_category?}',[ProductControllerFront::class,'getCategory'])->name('category');
});
