@extends('layouts.app')

@section('content')
	
	<div class="container">

		<div class="panel panel-info">
			<div class="panel-heading">
				<h2>导出</h2>
			</div>
			<div class="panel-body">
				<form method="POST" action="{{ route('excels.export') }}">
					{{ csrf_field() }}
					<button type="submit" class="btn btn-primary btn-xs">确定</button>	
				</form>	
			</div>
		</div>

		<div class="panel panel-info">
			<div class="panel-heading">
				<h2>导入</h2>
			</div>

			<div class="panel-body">
				<form method="POST" action="{{ route('excels.import') }}">
				
					<div class="form-group">
					    <label>文件</label>
					    <input type="file" class="form-control" />
					</div>

					{{ csrf_field() }}	
					<button type="submit" class="btn btn-primary btn-xs">确定</button>
				</form>	
			</div>
		</div>
	
	</div>			

@endsection