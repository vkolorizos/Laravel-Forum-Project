<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
	use RefreshDatabase;

	public function setUp()
	{
		parent::setUp();
		$this->thread = create('App\Thread');
	}

	/** @test */
	function a_thread_can_make_a_string_path()
	{
		$thread = create('App\Thread');

		$this->assertEquals(
			"/threads/{$thread->channel->slug}/{$thread->id}", $thread->path()
		);
	}

	/** @test */
	public function a_thread_has_a_creator()
	{
		$thread = create('App\Thread');

		$this->assertInstanceOf('App\User', $this->thread->creator);

	}

	/** @test */
	public function a_thread_has_replies()
	{
		$thread = create('App\Thread');

		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $thread->replies);
	}

	/** @test */
	public function a_thread_can_add_a_reply()
	{
		$this->thread->addReply([
			'body' => 'FooBar',
			'user_id' => 1
		]);

		$this->assertCount(1, $this->thread->replies);
	}

	/** @test */
	function a_thread_belongs_to_a_channel()
	{
		$thread = create('App\Thread');
		$this->assertInstanceOf('App\Channel', $thread->channel);
	}

	/** @test */
	function a_thread_can_be_subscribed_to()
	{
		//give we have a thread
		$thread = create('App\Thread');

		// when the user subscribes to the thread
		$thread->subscribe($userId = 1);

		// then we should be able to fetch all threads the user has subscribed to
		$this->assertEquals(
			1,
			$thread->subscriptions()->where('user_id', $userId)->count()
		);
	}
	
	/** @test */
	function a_thread_can_be_unsubscribed_from()
	{
		//give we have a thread
		$thread = create('App\Thread');

		// and a user who is subscribed to the thread
		$thread->subscribe($userId = 1);

		// when the thread is unsubscribed
		$thread->unsubscribe($userId);

		$this->assertCount(0, $thread->subscriptions);
	}
	

}
