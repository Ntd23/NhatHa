<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
	use HasFactory;
  protected $table = 'brands';
	static public function getSingle($id)
  {
    return self::find($id);
  }
	static public function getRecord() {
		return self::select('brands.*','users.name as created_by_name')
		->join('users','users.id','brands.created_by')
		->where('brands.is_delete','=',0)
		->orderBy('brands.id','desc')
		->get();
	}
	static public function getRecordActive() {
		return self::select('brands.*')
		->join('users','users.id','brands.created_by')
		->where('brands.is_delete','=',0)
		->where('brands.status','=',0)
		->orderBy('brands.name','asc')
		->get();
	}
	static public function getTrash() {
		return self::select('brands.*','users.name as created_by_name')
		->join('users','users.id','brands.created_by')
		->where('brands.is_delete','=',1)
		->orderBy('brands.id','desc')
		->get();
	}
	static public function restore($id) {
		$brand= self::getSingle($id);
		$brand->is_delete=0;
		$brand->save();
		return true;
	}
}
