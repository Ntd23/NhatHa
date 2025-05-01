<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	use HasFactory;
	protected $table = 'contacts';
	static public function getRecord()
	{
		$return = self::select('contacts.*');
		if (!empty(request()->get('id'))) {
			$return = $return->where('id', '=', request()->get('id'));
		}
		if (!empty(request()->get('name'))) {
			$return = $return->where('name', 'like', '%' . request()->get('name') . '%');
		}
		if (!empty(request()->get('email'))) {
			$return = $return->where('email', 'like', '%' . request()->get('email') . '%');
		}
		if (!empty(request()->get('phone'))) {
			$return = $return->where('phone', 'like', '%' . request()->get('phone') . '%');
		}
		if (!empty(request()->get('subject'))) {
			$return = $return->where('subject', 'like', '%' . request()->get('subject') . '%');
		}
		$return = $return->orderBy('contacts.id', 'desc')
			->paginate(10);
		return $return;
	}
	public function getUser()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
