<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarkdownsController extends Controller
{
	public function index()
	{
		return view('markdowns.index');	
	}
}
