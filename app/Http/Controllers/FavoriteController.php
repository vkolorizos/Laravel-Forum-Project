<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * @param Reply $reply
	 */
	public function store(Reply $reply)
	{
		$reply->favorite();
	}
}
