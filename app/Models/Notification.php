<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	use HasFactory;
	protected $table = 'notifications';
	static public function getSingle($id)
  {
    return self::find($id);
  }
   static public function getRecord() {
		return Notification::where('user_id','=',1)
		->orderBy('id','desc')
		->paginate(15);
	 }
	 static public function insertRecord($user_id, $url, $msg) {
		$save= new Notification;
		$save->user_id= $user_id;
		$save->url= $url;
		$save->message= $msg;
		$save->save();
	 }
	 static public function getRecordUser($user_id) {
		return Notification::where('user_id','=',$user_id)
			->orderBy('id','desc')
			->paginate(10);
	 }
	 static public function updateReadNoti($id) {
		$getRecord= Notification::getSingle($id);

		if(!empty($getRecord)) {
			$getRecord->is_read=1;
			$getRecord->save();
		}
	 }
	 static public function getUnreadNotification() {
		return Notification::where('is_read','=',0)
		->where('user_id','=',1)
		->orderBy('id','desc')
		->get();
	 }
	 static public function getUnreadNotificationCount($user_id) {
		return Notification::where('is_read','=',0)
		->where('user_id','=',$user_id)
		->orderBy('id','desc')
		->count();
	 }
}
