<?php

namespace App\Http\Controllers;

use App\Thread;


class ThreadSubscriptionController extends Controller
{
	/**
	 * ThreadSubscriptionController constructor.
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * A user is subscribed to a selected thread.
	 * @param $channelId
	 * @param Thread $thread
	 */
	public function store($channelId, Thread $thread)
	{
		$thread->subscribe();
	}

	/**
	 * A user is unsubscribed from a selected thread
	 * @param $channelId
	 * @param Thread $thread
	 */
	public function destroy($channelId, Thread $thread)
	{
		$thread->unsubscribe();
	}
}
