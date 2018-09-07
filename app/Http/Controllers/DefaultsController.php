<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultsController extends Controller
{
	public function index()
	{
		return view('defaults.index');
	}

	public function goodsAttributeCombination()
	{
		return view('defaults.goods_attribute_combination');
	}		
}
