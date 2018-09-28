<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function unauthenticated_users_may_not_add_replies()
	{
		$this->withExceptionHandling()
			->post('/threads/some-channel/1/replies', [])
			->assertRedirect('/login');
	}


	/** @test */
	public function an_authenticated_user_may_participate_in_forum_threads()
	{
			$this->actingAs($user = create('App\User')) ;

			$thread = create('App\Thread');

			$reply = make('App\Reply');
			$this->post($thread->path() .'/replies', $reply->toArray());

			$this->get($thread->path())
				->assertSee($reply->body);
	}

}
