<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
	use HasFactory;
  protected $table = 'blogs';
  static public function getSingle($id) {
		return Blog::find($id);
	}
	static public function getRecord() {
		return self::select('blogs.*')
		->where('blogs.is_delete','=',0)
		->orderBy('blogs.id','desc')
		->get();
	}
	static public function getRecordActive() {
		return self::select('blogs.*')
		->where('blogs.is_delete','=',0)
		->where('blogs.status','=',0)
		->orderBy('blogs.id','asc')
		->get();
	}
	static public function getSingleSlug($slug) {
		return self::where('slug','=',$slug)
		->where('blogs.is_delete','=',0)
		->where('blogs.status','=',0)
		->first();
	}
	static public function getRecordActiveHome() {
		return self::select('blogs.*')
		->where('blogs.is_delete','=',0)
		->where('blogs.status','=',0)
		->orderBy('blogs.id','asc')
		->limit(3)
		->get();
	}
	public function getImage()
  {
    if (!empty($this->image_name) && file_exists('storage/blog/' . $this->image_name)) {
      return url('storage/blog/' . $this->image_name);
    } else {
      return '';
    }
  }
	static public function getBlog($blog_category_id='') {
		$return= self::select('blogs.*');
		if(!empty(request()->get('search'))) {
			$return= $return->where('blogs.title','like','%'.request()->get('search').'%');
		}
		if(!empty($blog_category_id)) {
			$return= $return->where('blogs.blog_category_id','=',$blog_category_id);
		}
		$return= $return->where('blogs.is_delete','=',0)
		->where('blogs.status','=',0)
		->orderBy('blogs.id','desc')
		->paginate(10);

		return $return;
	}
	public function getCategory() {
		return $this->belongsTo(BlogCategory::class,'blog_category_id');
	}
	static public function getPopular() {
		$return= self::select('blogs.*');
		$return= $return->where('blogs.is_delete','=',0)
		->where('blogs.status','=',0)
		->orderBy('blogs.total_view','desc')
		->limit(6)
		->get();

		return $return;
	}
	static public function getRelatedPost($blog_category_id, $blog_id) {
		$return= self::select('blogs.*');
		$return= $return->where('blogs.is_delete','=',0)
		->where('blogs.status','=',0)
		->where('blogs.id','!=',$blog_id)
		->where('blogs.blog_category_id','=',$blog_category_id)
		->orderBy('blogs.total_view','desc')
		->limit(6)
		->get();

		return $return;
	}
	public function getComment() {
		return $this->hasMany(BlogComment::class,'blog_id')
		->select('blog_comments.*')
		->join('users','users.id','=','blog_comments.user_id')
		->orderBy('blog_comments.id','desc');
	}
	public function getCommentCount() {
		return $this->hasMany(BlogComment::class,'blog_id')
		->select('blog_comments.*')
		->join('users','users.id','=','blog_comments.user_id')
		->count();
	}
}
