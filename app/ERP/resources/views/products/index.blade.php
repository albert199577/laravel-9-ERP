@extends('layouts.app')

@section('title', '商品總覽')

@section('content')
<div class="container mx-auto">
	<form class="search text-xl text-center text-zinc-500 my-3" action="{{ route('product.index') }}" method="GET">
		<select class="inline-block w-1/5 p-3 rounded-md border" name="type" id="type">
			<option value="default">--</option>
			<option value="brand">品牌</option>
			<option value="type">分類</option>
			<option value="product_name">商品名稱</option>
			<option value="model">型號</option>
			<option value="cargo_id">貨號</option>
		</select>
		<input class="inline-block w-2/5 p-3 font-semibold rounded-md border" type="search" placeholder="尋找商品" aria-label="Search" name="key">
		<button class="rounded-md border p-3" type="submit"><i class="fas fa-search"></i></button>
	</form>
	<h2 class="text-2xl font-semibold text-center text-zinc-500 p-3">商品列表</h2>
	<div class="flex flex-row justify-between px-10">
		<div class="mx-10">
			<a href="{{ route('product-model.create') }}">
				<button type="submit" class="btn-primary">新增商品</button>
			</a>
		</div>
		<div class="btn-primary mx-10">
			總成本 {{ $total }} 元
		</div>
	</div>
	<div class="shadow-sm overflow-y-auto my-8">
		<table class="table-fixed border-collapse w-full text-sm">
			<thead>
				<tr>
					<th class="th">No.</th>
					<th class="th">預設商品</th>
					<th class="th">商品</th>
					<th class="th">分類</th>
					<th class="th">品牌</th>
					<th class="th">型號</th>
					<th class="th">顏色</th>
					<th class="th">庫存</th>
					<th class="th">成本</th>
					<th class="th">售價</th>
					<th class="th">商品選項貨號</th>
					<th class="th"></th>
				</tr>
			</thead>
			<tbody class="bg-white dark:bg-slate-800">
				@foreach ($products as $product)
					@if ($product->is_default)
						<tr>
							<td class="td">{{ $product->id }}</td>
							<td class="td">√</td>
							<td class="td">{{ $product->name }}</td>
							<td class="td">{{ $product->type->name ?? '--' }}</td>
							<td class="td">{{ $product->brand->name ?? '--' }}</td>
							<td class="td">{{ $product->name }}</td>
							<td class="td">{{ $product->product_model[0]->color }}</td>
							<td class="td">{{ $product->product_model[0]->stock }}</td>
							<td class="td">{{ $product->product_model[0]->cost }}</td>
							<td class="td">{{ $product->product_model[0]->price }}</td>
							<td class="td">{{ $product->product_model[0]->cargo_id }}</td>
							<td class="td flex flex-col">
								{{-- <a href="{{ route('prodcut_model.edit', ['id' => $product->product_model[0]->id]) }}"> --}}
								<a href="{{ route('product-model.edit', ['product_model' => $product->product_model[0]->id]) }}">
									<button class="btn-primary mx-1.5" type="button">編輯</button>
								</a>
								<form action="{{ route('product.destroy', ['product' => $product->id]) }}" method="POST">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn-danger mx-1.5">刪除</button>
								</form>
							</td>
						</tr>
					@else
						<tr>
							<td class="td">{{ $product->id }}</td>
							<td class="td cursor-pointer"></td>
							<td class="td cursor-pointer" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);">{{ $product->name }}</td>
							<td class="td cursor-pointer" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);">{{ $product->type->name ?? '--' }}</td>
							<td class="td cursor-pointer" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);">{{ $product->brand->name ?? '--' }}</td>
							<td class="td cursor-pointer" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);">--</td>
							<td class="td cursor-pointer" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);">--</td>
							<td class="td cursor-pointer" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);">{{ $product->product_model_sum_stock }}</td>
							<td class="td cursor-pointer" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);">--</td>
							<td class="td cursor-pointer" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);">--</td>
							<td class="td cursor-pointer" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);">--</td>
							<td class="td" id="{{ 'model_' . $product->id }}">
								<form action="{{ route('product.destroy', ['product' => $product->id]) }}" method="POST">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn-danger mx-1.5">刪除</button>
								</form>
							</td>
						</tr>
						@foreach ($product->product_model as $model)
						<tr>
							<td class="model hidden {{ 'model_' . $product->id }}"></td>
							<td class="model hidden {{ 'model_' . $product->id }}">--</td>
							<td class="model hidden {{ 'model_' . $product->id }}">{{ $model->name }}</td>
							<td class="model hidden {{ 'model_' . $product->id }}">{{ $product->type->name ?? '--' }}</td>
							<td class="model hidden {{ 'model_' . $product->id }}">{{ $product->brand->name ?? '--' }}</td>
							<td class="model hidden {{ 'model_' . $product->id }}">{{ $model->name }}</td>
							<td class="model hidden {{ 'model_' . $product->id }}">{{ $model->color }}</td>
							<td class="model hidden {{ 'model_' . $product->id }}">{{ $model->stock }}</td>
							<td class="model hidden {{ 'model_' . $product->id }}">{{ $model->cost }}</td>
							<td class="model hidden {{ 'model_' . $product->id }}">{{ $model->price }}</td>
							<td class="model hidden {{ 'model_' . $product->id }}">{{ $model->cargo_id }}</td>
							<td class="model hidden {{ 'model_' . $product->id }} flex flex-row">
								<a href="{{ route('product-model.edit', ['product_model' => $model->id]) }}">
									<button class="btn-primary" type="button">編輯</button>
								</a>
								<form action="{{ route('product-model.destroy', ['product_model' => $model->id]) }}" method="POST">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn-danger mx-1.5">刪除</button>
								</form>
							</td>
						</tr>
						@endforeach
					@endif
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<script defer>
	let defaultInput = document.querySelector("input[type=search]");
	function openSubmenu(ele) {
		const models = document.querySelectorAll('.' + ele.id);
		models.forEach(ele => {
			ele.classList.toggle('hidden');
		});
	}

	let selectElement = document.getElementById("type");

	selectElement.addEventListener('change', function() {
		let type = selectElement.value;

		if (type === 'brand' || type === 'type') {
			getAllData(type);
		} else {
			let select = document.querySelector("[type=search]");
			if (select === defaultInput) return;
			let form = document.querySelector(".search");
			form.replaceChild(defaultInput, select);
		}
	});

	function getAllData(type) {
		let url;
		let requestOptions = {
			method: 'GET',
		};
		let selectElement = document.getElementById("type");
		let select = document.querySelector("[type=search]");
		let form = document.querySelector(".search");

		switch (type) {
			case 'brand':
				url = "/api/v1/brand";
				break;
			case 'type':
				url = "/api/v1/type";
				break;
		}

		fetch(url, requestOptions)
			.then(response => response.json())
			.then(function (data) {
				console.log(data)
				let new_select = document.createElement("select");
				new_select.classList.add(
					"inline-block",
					"w-2/5",
					"p-3",
					"font-semibold",
					"rounded-md",
					"border"
				)
				new_select.setAttribute("type", "search");
				new_select.setAttribute("name", "key");

				data.forEach(e => {
					let option = document.createElement("option");
					option.value = e.name;
					option.text = e.name;
					new_select.append(option);
				});

				form.insertBefore(new_select, select);
				select.remove();
			})
			.catch(error => console.log('error', error));
	}
</script>

@endsection