<?php


namespace App;


trait Favoritable
{
	/**
	 * Return the corresponding items that have been favored.
	 *
	 * @return mixed
	 */
	public function favorites()
	{
		return $this->morphMany(Favorite::class, 'favorited');
	}

	/**
	 * A user can favorite many items.
	 *
	 * @return mixed
	 */
	public function favorite()
	{
		$attributes = ['user_id' => auth()->id()];

		if (!$this->favorites()->where($attributes)->exists()) {
			return $this->favorites()->create($attributes);
		}
	}

	/**
	 * Check whether an item is favorited.
	 *
	 * @return bool
	 */
	public function isFavorited()
	{
		return !!$this->favorites->where('user_id', auth()->id())->count();
	}

	/**
	 * Get the count of the favorited items.
	 *
	 * @return mixed
	 */
	public function getFavoritesCountAttribute()
	{
		return $this->favorites->count();
	}
}