<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use HasFactory;
	protected $table = 'categories';
	static public function getRecord()
	{
		return self::select('categories.*', 'users.name as created_by_name')
			->join('users', 'users.id', 'categories.created_by')
			->where('categories.is_delete', '=', 0)
			->orderBy('categories.id', 'desc')
			->get();
	}
	static public function getSingle($id)
	{
		return self::find($id);
	}
	public function getProduct() {
		return $this->hasMany(Product::class,'category_id');
	}
	public function getImage() {
		if (!empty($this->image_name) && file_exists('storage/category/' . $this->image_name)) {
			return url('storage/category/' . $this->image_name);
		} else {
			return '';
		}
	}
	static public function getRecordActive() {
		return self::select('categories.*','users.name as created_by_name')
		->join('users','users.id','categories.created_by')
		->where('categories.is_delete','=',0)
		->where('categories.status','=',0)
		->orderBy('categories.id','asc')
		->get();
	}
	static public function getRecordMenu() {
		return self::select('categories.*')
		->join('users','users.id','=','categories.created_by')
		->where('categories.is_delete','=',0)
		->where('categories.status','=',0)
		->orderBy('categories.name','asc')
		->get();
	}
	public function getSubCategory() {
		return $this->hasMany(SubCategory::class,'category_id')
		->where('sub_categories.status','=',0)
		->where('sub_categories.is_delete','=',0)
		->get();
	}
	static public function getSingleSlug($slug) {
		return self::where('slug','=',$slug)
			->where('is_delete','=',0)
			->where('status','=',0)
			->first();
	}
	static public function getRecordActiveHome() {
		return self::select(
			'categories.*',
		)
		->join('users','users.id','=','categories.created_by')
		->where('categories.is_delete','=',0)
		->where('categories.status','=',0)
		->where('categories.is_home','=',1)
		->orderBy('categories.name','asc')
		->get();
	}
}
