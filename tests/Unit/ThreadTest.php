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
	    	"/threads/{$thread->channel->slug}/{$thread->id}",$thread->path()
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

		$this->assertCount(1,$this->thread->replies);
	}

	/** @test */
	function a_thread_belongs_to_a_channel()
	{
		$thread = create('App\Thread');
		$this->assertInstanceOf('App\Channel',$thread->channel);
	}
}
