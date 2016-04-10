<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests;

class PagesController extends Controller
{
	public function index()
	{
		return view('pages.index');
    }
}
