<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultsController extends Controller
{
	public function index()
	{
		return view('defaults.index');
	}
}
