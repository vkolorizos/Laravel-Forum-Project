<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
	use RecordsActivity;

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
	protected $with = ['creator', 'channel'];


	protected $appends = ['isSubscribedTo'];

	/**
	 * Boot the model
	 */
	protected static function boot()
	{
		parent::boot();

		static::deleting(function ($thread) {
			$thread->replies->each->delete();
		});
	}

	/**
	 * Get a string path for the thread
	 *
	 * @return string
	 */
	public function path()
	{
		return "/threads/{$this->channel->slug}/{$this->id}";
	}

	/**
	 * A thread belongs to a creator.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function creator()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	/**
	 * A thread is assigned a channel.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function channel()
	{
		return $this->belongsTo(Channel::class, 'channel_id');
	}

	/**
	 * A thread may have many replies.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function replies()
	{
		return $this->hasMany(Reply::class);
	}

	/**
	 *  Add a reply to the thread.
	 *
	 * @param $reply
	 * @return Model
	 */
	public function addReply($reply)
	{
		$reply = $this->replies()->create($reply);

		//Prepare notifications for all subscribers

		$this->subscriptions
			->filter(function($sub) use ($reply){
				return $sub->user_id != $reply->user_id;
			})
			->each->notify($reply);

		return $reply;
	}

	/**
	 * Scope to apply filters to a thread.
	 *
	 * @param $query
	 * @param $filters
	 * @return mixed
	 */
	public function scopeFilter($query, $filters)
	{
		return $filters->apply($query);
	}

	/**
	 * @param null $userId
	 * @return $this
	 */
	public function subscribe($userId = null)
	{
		$this->subscriptions()->create([
			'user_id' => $userId ?: auth()->id()
		]);

		return $this;
	}

	/**
	 * @param null $userId
	 */
	public function unsubscribe($userId = null)
	{
		$this->subscriptions()
			->where('user_id', $userId ?: auth()->id())
			->delete();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function subscriptions()
	{
		return $this->hasMany(ThreadSubscription::class);
	}

	/**
	 * @return bool
	 */
	public function getIsSubscribedToAttribute()
	{
		return $this->subscriptions()
			->where('user_id', auth()->id())
			->exists();
	}
}
