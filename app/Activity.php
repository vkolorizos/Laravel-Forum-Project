<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
	protected $guarded = [];

	/**
	 * Returns the corresponding model of the subject.
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function subject()
	{
		return $this->morphTo();
	}


	/**
	 *
	 * Returns the feed of a  user.
	 * Default: 50 results
	 * @param $user
	 * @param int $take
	 * @return mixed
	 */
	public static function feed($user, $take = 50)
	{
		return static::where('user_id', $user->id)
			->latest()
			->with('subject')
			->take($take)
			->get()
			->groupBy(function ($activity) {
				return $activity->created_at->format('Y-m-d');
		});
	}
}
