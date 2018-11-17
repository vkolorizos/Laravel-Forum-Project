<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{

	/**
	 * The route key name used for model binding.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
		return 'slug';
	}

	/**
	 * A Channel has many Threads.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function threads()
	{
		return $this->hasMany(Thread::class);
	}

}
