<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
	use Favoritable, RecordsActivity;

	/**
	 * Don't auto-apply mass assignment protection.
	 *
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * The relationships to always eager-load.
	 *
	 * @var array
	 */
	protected $with = ['owner', 'favorites'];


	protected $appends = ['favoritesCount','isFavorited'];

	/**
	 * A reply has an owner.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function owner()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	/**
	 * A reply belongs to a thread.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function thread()
	{
		return $this->belongsTo(Thread::class);
	}

	public function path()
	{
		return $this->thread->path() . "#reply-{$this->id}";
	}

}
