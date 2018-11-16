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
}
