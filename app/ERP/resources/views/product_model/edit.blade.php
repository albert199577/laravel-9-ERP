@extends('layouts.app')

@section('title', '庫存總覽')

@section('content')
<div class="container mx-auto">
	<div class="shadow-sm my-8 flex justify-center">
		<form action="{{ route('product-model.update', ['product_model' => $model->id]) }}" method="POST">
			@csrf
			@method('PUT')
			<div>
				<label for="model-name">商品名稱</label>
				<input class="input" type="text" id="model-name" name="model-name" value="{{ $model->name }}">
			</div>
			<div>
				<label for="brand-name">商品品牌</label>
				<select class="input" name="brand-id" id="brand-name">
					@foreach ($brands as $brand)
						<option value="{{ $brand->id }}" @if ($model->product->brand->id == $brand->id) @selected(true) @endif>{{ $brand->name }}</option>
					@endforeach
				</select>
			</div>
			<div>
				<label for="type-name">商品類別</label>
				<select class="input" name="type-id" id="type-name">
					@foreach ($types as $type)
						<option value="{{ $type->id }}" @if ($model->product->type->id == $type->id) @selected(true) @endif>{{ $type->name }}</option>
					@endforeach
				</select>
			</div>
			<div>
				<label for="model-color">顏色</label>
				<input class="input" type="text" id="model-color" name="model-color" value="{{ $model->color }}">
			</div>
			<div>
				<label for="model-cost">成本</label>
				<input class="input" type="text" id="model-cost" name="model-cost" value="{{ $model->cost }}">
			</div>
			<div>
				<label for="model-price">售價</label>
				<input class="input" type="text" id="model-price" name="model-price" value="{{ $model->price }}">
			</div>
			<div>
				<label for="model-stock">商品庫存</label>
				<input class="input" type="text" id="model-stock" name="model-stock" value="{{ $model->stock }}">
			</div>
			<div>
				<label for="model-cargo_id">商品選項貨號</label>
				<input class="input" type="text" id="model-cargo_id" name="model-cargo_id" value="{{ $model->cargo_id }}">
			</div>
			<div class="flex justify-center">
				<button class="btn-primary m-10">更新</button>
			</div>
		</form>
	</div>
</div>
@endsection