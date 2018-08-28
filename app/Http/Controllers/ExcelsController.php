<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelsController extends Controller
{
	public function index(Request $request)
	{
		return view('excels.index');		
	}

	public function import(Request $request)
	{

		die('test');	

	}

	public function export(Request $request)
	{
		Excel::create('Filename', function($excel) {
			$excel->sheet('abc', function ($sheet) {
				$sheet->appendRow(['id', '标题', '链接', '用户id', '分类名称','分类id', '阅读次数', '创建时间']);
				$rows = [
					[1, 'bbbbb', 'www.baidu.com', 3, 1, 2, 101, '2018-08-01']
				];
				$sheet->rows($rows);
			});
		})->export('xls');	
	}
}

