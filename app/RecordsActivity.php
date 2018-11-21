<?php

namespace App;


trait RecordsActivity
{
	/**
	 *  Boots the associated model that uses the Trait.
	 */
	protected static function bootRecordsActivity()
	{
		if (auth()->guest()) return;

		foreach (static::getActivitiesToRecord() as $event)
			static::$event(function ($model) use ($event) {
				$model->recordActivity('created');
			});

		static::deleting(function ($model) {
			$model->activity()->delete();
		});
	}

	/**
	 *  Activities that should be recorded
	 * @return array
	 */
	protected static function getActivitiesToRecord()
	{
		return ['created'];
	}

	/**
	 * Records the activity of a model.
	 * @param $event
	 * @throws \ReflectionException
	 */
	protected function recordActivity($event)
	{
		$this->activity()->create([
			'user_id' => auth()->id(),
			'type' => $this->getActivityType($event)
		]);
	}

	/**
	 * A polymorphic hasMany relationship
	 * @return mixed
	 */
	public function activity()
	{
		return $this->morphMany('App\Activity', 'subject');
	}

	/**
	 * Get the activity type out of the class name
	 * @param $event
	 * @return string
	 * @throws \ReflectionException
	 */
	protected function getActivityType($event)
	{
		$type = strtolower((new \ReflectionClass($this))->getShortName());

		return "{$event}_{$type}";
	}
}