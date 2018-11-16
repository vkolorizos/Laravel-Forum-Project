<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The route key name used for model binding.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
		return 'name';
	}

	/**
	 * Returns all the latest threads of a user.
	 *
	 * @return $this
	 */
	public function threads()
	{
		return $this->hasMany(Thread::class)->latest();
	}

	public function activity()
	{
		return $this->hasMany(Activity::class);
	}
}
