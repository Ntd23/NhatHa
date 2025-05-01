<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
		];
	}
	static public function checkExist($email)
	{
		return User::select('users.*')
			->where('email', '=', $email)
			->first();
	}
	static public function getSingle($user_id)
	{
		return User::find($user_id);
	}
	static public function getAdmin() {
		return self::select('users.*')
		->where('users.is_admin','=',1)
		->where('users.is_delete',0)
		->orderBy('id','desc')
		->get();
	}
	static public function getCustomer() {
		$return = self::select('users.*');
    if (!empty(request()->get('id'))) {
      $return = $return->where('id', '=', request()->get('id'));
    }
    if (!empty(request()->get('name'))) {
      $return = $return->where('name', 'like', '%' . request()->get('name') . '%');
    }
    if (!empty(request()->get('email'))) {
      $return = $return->where('email', 'like', '%' . request()->get('email') . '%');
    }
    if (!empty(request()->get('from_date'))) {
      $return = $return->whereDate('created_at', '>=', request()->get('from_date'));
    }
    if (!empty(request()->get('to_date'))) {
      $return = $return->whereDate('created_at', '<=', request()->get('to_date'));
    }
    $return = $return->where('is_admin', 0)
      ->where('is_delete', 0)
      ->orderBy('id', 'desc')->paginate(15);

    return $return;
	}
	static public function getTotalCustomer() {
		return self::select('id')
		->where('is_admin','=',0)
		->where('is_delete','=',0)
		->count();
	}
	static public function getTotalTodayCustomer() {
		return self::select('id')
		->where('is_admin','=',0)
		->where('is_delete','=',0)
		->whereDate('created_at','=',date('Y-m-d'))
		->count();
	}
	static public function getTotalCustomerMonth($startDate, $endDate) {
		return self::select('id')
		->where('is_admin','=',0)
		->where('is_delete','=',0)
		->whereDate('created_at','>=',$startDate)
		->whereDate('created_at','<=',$endDate)
		->count();
	}
}
