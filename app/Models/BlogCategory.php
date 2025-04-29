<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
	use HasFactory;
  protected $table = 'blog_categories';
	static public function getSingle($id) {
		return self::find($id);
	}
   static public function getRecord() {
		return self::select('blog_categories.*')
		->where('blog_categories.is_delete','=',0)
		->orderBy('blog_categories.id','desc')
		->get();
	 }
	 static public function getRecordActive() {
		return self::select('blog_categories.*')
		->where('blog_categories.is_delete','=',0)
		->where('blog_categories.status','=',0)
		->orderBy('blog_categories.id','asc')
		->get();
	 }
	 static public function getSingleSlug($slug) {
		return self::where('slug','=',$slug)
		->where('blog_categories.is_delete','=',0)
		->where('blog_categories.status','=',0)
		->first();
	 }
	 static public function getRecordActiveHome() {
		return self::select('blog_categories.*')
		->where('blog_categories.is_home','=',1)
		->where('blog_categories.is_delete','=',0)
		->where('blog_categories.status','=',0)
		->first();
	 }
	 public function getCountBlog() {
		return $this->hasMany(Blog::class,'blog_category_id')
		->where('blogs.is_delete','=',0)
		->where('blogs.status','=',0)
		->count();
	 }
}
