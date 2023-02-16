@extends('layouts.app')

@section('title', '庫存總覽')

@section('content')
<div class="container mx-auto">
	<h2 class="text-center">{{ $brands->name }}</h2>
	<div class="shadow-sm overflow-y-auto my-8">
		<table class="table-auto border-collapse w-full text-sm">
			<thead>
				<tr>
					{{-- <th class="th">No.</th> --}}
					<th class="th">預設商品</th>
					<th class="th">商品</th>
					<th class="th">分類</th>
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
							{{-- <td class="td">{{ $product->id }}</td> --}}
							<td class="td">√</td>
							<td class="td">{{ $product->product_model[0]->name }}</td>
							<td class="td">{{ $product->type->name }}</td>
							<td class="td">{{ $product->name }}</td>
							<td class="td">{{ $product->product_model[0]->color }}</td>
							<td class="td">{{ $product->product_model[0]->stock }}</td>
							<td class="td">{{ $product->product_model[0]->cost }}</td>
							<td class="td">{{ $product->product_model[0]->price }}</td>
							<td class="td">{{ $product->product_model[0]->cargo_id }}</td>
							<td class="td">
								{{-- <a href="{{ route('prodcut_model.edit', ['id' => $product->product_model[0]->id]) }}"> --}}
								<a href="">
									<button class="btn-primary" type="button">編輯</button>
								</a>
							</td>
						</tr>
					@else
						<tr>
							{{-- <td class="td">{{ $product->id }}</td> --}}
							<td class="td"></td>
							<td class="td" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);">{{ $product->name }}</td>
							<td class="td" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);">{{ $product->type->name }}</td>
							<td class="td" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);">{{ $product->name }}</td>
							<td class="td" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);">--</td>
							<td class="td" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);">{{ $product->product_model[0]->stock }}</td>
							<td class="td" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);">--</td>
							<td class="td" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);">--</td>
							<td class="td" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);">{{ $product->product_model[0]->cargo_id }}</td>
							<td class="td" id="{{ 'model_' . $product->id }}" onclick="javascript:openSubmenu(this);"></td>
						</tr>
						@foreach ($product->product_model as $model)
						<tr>
							<td class="model hidden {{ 'model_' . $product->id }}"></td>
							<td class="model hidden {{ 'model_' . $product->id }}">{{ $model->name }}</td>
							<td class="model hidden {{ 'model_' . $product->id }}">{{ $product->type->name }}</td>
							<td class="model hidden {{ 'model_' . $product->id }}">{{ $model->name }}</td>
							<td class="model hidden {{ 'model_' . $product->id }}">{{ $model->color }}</td>
							<td class="model hidden {{ 'model_' . $product->id }}">{{ $model->stock }}</td>
							<td class="model hidden {{ 'model_' . $product->id }}">{{ $model->cost }}</td>
							<td class="model hidden {{ 'model_' . $product->id }}">{{ $model->price }}</td>
							<td class="model hidden {{ 'model_' . $product->id }}">{{ $model->cargo_id }}</td>
							<td class="model hidden {{ 'model_' . $product->id }}">
								<a href="">
									<button class="btn-primary" type="button">編輯</button>
								</a>
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
	function openSubmenu(ele) {
		const models = document.querySelectorAll('.' + ele.id);
		models.forEach(ele => {
			ele.classList.toggle('hidden');
		});
	}
</script>
@endsection