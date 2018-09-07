<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	
	<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>

	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<!-- 开发环境版本，包含了有帮助的命令行警告 -->
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</head>
<body>

	<div id="app" class="container-fluid">


		<div class="row">

			<div class="col-md-4">
				<ul class="list-group" v-for="(option, index) in options">	
					<li class="list-group-item active">
						@{{ option.name }}
						<button class="btn btn-xs btn-default" v-on:click="delete_gg_key(index)">删除</button>
					</li>

					<li class="list-group-item" v-for="v in option.value">
						@{{ v.name }}
						<button class="btn btn-xs btn-default" v-on:click="delete_gg_value(index, v.id)">删除</button>
					</li>

					<li class="list-group-item">
						<input type="text" class="form-control" name="new-gg-value" />	
						<button class="btn btn-default btn-xs" v-on:click="add_gg_value(index)">添加</button>
					</li>
				</ul>

				<input type="text" class="form-control" name="new-gg-key"/>
				<button class="btn btn-xs btn-default" v-on:click="add_gg_key">添加</button>	
			</div>

			<div class="col-md-6">
				<table class="table">
					
					<tr v-for="item in items">
						<td> @{{ item.name }}</td>
						<td> 库存：<input type="text" v-model="item.attr.stock"> </td>
						<td> 价格：<input type="text" v-model="item.attr.price"> </td>
						<td> 编号：<input type="text" v-model="item.attr.goods_sn"> </td>
					</tr>
										
				</table>		
			</div>
		</div>			
	</div>

	<script type="text/javascript">
		var v = new Vue({
			el: '#app',
			data: {
				title: 'test',
				increase_id: 1,
				options: [],
				items: [],	
				intermediary: []
			},
			methods: {
				add_gg_value: function (index) {
					v.options[index].value.push({
						id: v.increase_id,
						name: $('input[name=new-gg-value]').eq(index).val()
					});

					v.increase_id += 1;
					$('input[name=new-gg-value]').val('');
					v.create_items();
				},
				add_gg_key: function () {
					v.options.push({
						name: $('input[name=new-gg-key]').val(),
						value: []
					});
					$('input[name=new-gg-key]').val('');
				},
				delete_gg_value: function (index, id) {
					v.options[index].value.forEach(function (item, i) {
						if (item.id === id) {
							v.options[index].value.splice(i, 1);
						}
					});
					v.create_items();
				},
				delete_gg_key: function (index) {
					v.options.splice(index, 1);	
					v.create_items();
				},
				create_items: function () {
					var data = [];
					v.intermediary = [];	
					v.options.forEach(function (item) {
						if (item.value.length) {
							data = v.combination(item.value);
						}
					});
					v.intermediary = [];						
					v.items = data;
				},
				combination: function (arr) {
					if (v.intermediary.length) {	
						var data = [];	

						v.intermediary.forEach(function (old_item) {
							arr.forEach(function (new_item) {

								var attr = v.get_default_attr(old_item.name + '|' + new_item.id);

								data.push({
									name: old_item.name + '|' + new_item.id,
									nameArr: old_item.nameArr.concat([new_item.id]),
									attr: {
										stock : attr.stock,
										price : attr.price,
										goods_sn: attr.goods_sn
									}
								});

							});
						});

						v.intermediary = data;
					} else {
						arr.forEach(function (item) {
							var attr = v.get_default_attr(item.id);
							v.intermediary.push({
								name: item.id,
								nameArr: [item.id],
								attr: {
									stock : attr.stock,
									price : attr.price,
									goods_sn: attr.goods_sn	
								}
							});
						});
					}
					return v.intermediary;
				},
				get_default_attr: function (name) {
					for (let index in v.items) {
						if (v.items[index].name === name) {
							return v.items[index].attr;
						}
					}	
					return {stock: 0, price: 0, goods_sn: ''};
				}	
			},
			watch: {
				options: function () {
					v.create_items();	
				}
			}
		});		
	</script>	
</body>
</html>