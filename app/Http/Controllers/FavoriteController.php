<?php

namespace App\Http\Controllers;

use App\Reply;

class FavoriteController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * @param Reply $reply
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Reply $reply)
	{
		$reply->favorite();
		return back();
	}

	/**
	 * @param Reply $reply
	 */
	public function destroy(Reply $reply)
	{
		$reply->unfavorite();
	}
}
