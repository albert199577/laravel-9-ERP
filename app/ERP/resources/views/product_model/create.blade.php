@extends('layouts.app')

@section('title', '庫存總覽')

@section('content')
<div class="container mx-auto">
	<div class="text-2xl font-semibold text-center text-zinc-500 p-3">新增商品</div>
	<div class="flex bg-stone-50 m-4">
		<form class="w-full p-4" action="{{ route('product-model.store') }}" method="POST">
			@csrf
			<div class="text-xl font-semibold text-zinc-500 pb-5">商品資訊</div>
			<div class="intro mb-8 grid grid-cols-1 md:grid-cols-2 gap-4">
				<div class="md:col-span-2">
					<label class="label" for="product-name">商品名稱</label>
					<input class="input" type="text" id="product-name" name="product-name">
				</div>
				<div>
					<label class="label" for="brand-name">商品品牌</label>
					<select class="input" name="brand-id" id="brand-name">
						@foreach ($brands as $brand)
							<option value="{{ $brand->id }}">{{ $brand->name }}</option>
						@endforeach
					</select>
				</div>
				<div>
					<label class="label" for="type-name">商品類別</label>
					<select class="input" name="type-id" id="type-name">
						@foreach ($types as $type)
							<option value="{{ $type->id }}">{{ $type->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="text-xl font-semibold text-zinc-500 pb-5">銷售資訊</div>
			<div class="detail grid grid-cols-1 md:grid-cols-2 gap-4">
				<div>
					<label class="label" for="model-name">規格</label>
					<input class="input" type="text" id="model-name" name="model-name[]">
				</div>
				<div>
					<label class="label" for="model-color">顏色</label>
					<input class="input" type="text" id="model-color" name="model-color[]">
				</div>
				<div>
					<label class="label" for="model-cost">成本</label>
					<input class="input" type="text" id="model-cost" name="model-cost">
				</div>
				<div>
					<label class="label" for="model-price">售價</label>
					<input class="input" type="text" id="model-price" name="model-price">
				</div>
				<div>
					<label class="label" for="model-stock">商品庫存</label>
					<input class="input" type="text" id="model-stock" name="model-stock">
				</div>
				<div>
					<label class="label" for="model-cargo_id">商品選項貨號</label>
					<input class="input" type="text" id="model-cargo_id" name="model-cargo_id">
				</div>
			</div>
			<div class="flex justify-center">
				<button class="btn-primary m-10">新增</button>
			</div>
		</form>
	</div>
</div>
<script defer>
	let add_option = document.querySelector("button.add-option");
    let option_form = document.getElementsByClassName("input-group my-2")[1];
    let all_option = document.getElementsByClassName("input-group my-2");
    console.log(all_option);
    add_option.addEventListener("click", e => {
        let form = add_option.parentNode;
        let new_form = option_form.cloneNode(true);
        let input = new_form.childNodes[3];
        input.value = "";
        if (all_option.length < 7) {
            form.insertBefore(new_form, add_option);
        }
    })
</script>
@endsection