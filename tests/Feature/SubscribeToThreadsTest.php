<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscribeToThreadsTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function a_user_can_subscribe_to_threads()
	{
		$this->signIn();

		// Given we have a thread
		$thread = create('App\Thread');

		// and the user subscribes to the thread...
		$this->post($thread->path() . '/subscriptions');

		// Then, each time a new reply is left...
		$thread->addReply([
			'user_id' => auth()->id(),
			'body' => 'Some reply here'
		]);
		$this->assertCount(1, $thread->subscriptions);
		// A notification should be prepared for the user.
//		$this->assertCount(1, auth()->user()->notifications);

	}

	/** @test */
	function a_user_can_unsubscribe_from_threads()
	{
		$this->signIn();

		$thread = create('App\Thread');

		$thread->subscribe();

		$this->delete($thread->path() . '/subscriptions');

		$this->assertCount(0, $thread->subscriptions);
	}

}
