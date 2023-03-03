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
					<small id="add_brand_btn" class="absolute w-full text-gray-500 dark:text-gray-300">
						找不到你要的品牌嗎？<button type="button" class="underline underline-offset-2 hover:text-sky-400">按此新增品牌</button>
					</small>
				</div>
				<div>
					<label class="label" for="type-name">商品類別</label>
					<select class="input" name="type-id" id="type-name">
						@foreach ($types as $type)
							<option value="{{ $type->id }}">{{ $type->name }}</option>
						@endforeach
					</select>
					<small id="add_type_btn" class="absolute w-full text-gray-500 dark:text-gray-300">
						找不到你要的類別嗎？<button type="button" class="underline underline-offset-2 hover:text-sky-400">按此新增類別</button>
					</small>
				</div>
			</div>
			<div class="flex flex-row justify-between">
				<div class="text-xl font-semibold text-zinc-500 pb-5">銷售資訊</div>
				<div class="mx-10">
					<button type="button" class="btn-primary create_model">開啟商品規格</button>
				</div>
			</div>
			<div class="detail grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 m-4">
				<div class="hidden md:col-span-2">
					<label class="label" for="model-name">規格</label>
					<input class="input" type="text" id="model-name" name="model-name[]">
				</div>
				<div class="hidden md:col-span-2">
					<label class="label" for="model-color">顏色</label>
					<input class="input" type="text" id="model-color" name="model-color[]">
				</div>
				<div>
					<label class="label" for="model-cost">成本</label>
					<input class="input" type="text" id="model-cost" name="model-cost[]">
				</div>
				<div>
					<label class="label" for="model-price">售價</label>
					<input class="input" type="text" id="model-price" name="model-price[]">
				</div>
				<div>
					<label class="label" for="model-stock">商品庫存</label>
					<input class="input" type="text" id="model-stock" name="model-stock[]">
				</div>
				<div>
					<label class="label" for="model-cargo_id">商品選項貨號</label>
					<input class="input" type="text" id="model-cargo_id" name="model-cargo_id[]">
				</div>
			</div>
			<div class="flex justify-center add_btn">
				<button class="btn-primary m-10">新增</button>
			</div>
		</form>
	</div>
	<div id="myModal" class="modal hidden">
		<div class="modal-content">
			<span class="close">&times;</span>
				@include('brands.components.form')
				<div class="flex flex-row justify-center">
					<div>
						<button type="submit" class="add_brand_btn btn-primary mx-1.5">新增</button>
						<button type="button" class="cancle btn-primary mx-1.5">取消</button>
					</div>
				</div>
		</div>
	</div>
</div>
<script defer>
	function add_model (count) {
		let add_btn = document.querySelector("button.create_model");
		let t = 0;

		add_btn.addEventListener("click", e => {
			if (t < 1) {
				let model = document.querySelectorAll(".hidden");
				model.forEach(e => {
					e.classList.remove("hidden");
				});
				t++;
			} else if (t < count) {
				let form = document.querySelector("form"); 
				let detail_form = document.querySelectorAll(".detail")[0];
				let new_form = detail_form.cloneNode(true);
				let add_option = document.querySelector(".add_btn");
				
				let inputs = new_form.querySelectorAll("input");
				inputs.forEach(input => input.value = "");

				// let delete_btn = document.createElement("span");
				// delete_btn.innerText = "X";
				// delete_btn.style.position = "relative";
				// delete_btn.style.float = "right";
				// delete_btn.classList.add("delete_btn");

				// new_form.insertBefore(delete_btn, new_form.firstElementChild);

				// delete_btn.addEventListener("click", e => {
				// 	let target = e.target.closest(".detail");
				// 	target.parentNode.removeChild(target);
				// 	t--;
				// });

				let hr = document.createElement("hr");

				form.insertBefore(hr, add_option);

				form.insertBefore(new_form, add_option);
				t++;
			}
		})
	}
	add_model(10)


	
	//clear brand default value
	let brand_input = document.querySelector("input[name=name]");
	brand_input.value = "";


	function addBrand() {
		let data = {
			name: brand_input.value,
		}

		var requestOptions = {
			method: 'POST',
			body: JSON.stringify(data),
			headers: {
				'Content-Type': 'application/json'
			}
		};

		let url = "/api/v1/brand";

		console.log(requestOptions)

		fetch(url, requestOptions)
			.then(response => response.text())
			.then(result => console.log(result))
			.catch(error => console.log('error', error));
		
	}
	
	let add_brand_btn = document.querySelector(".add_brand_btn");

	add_brand_btn.addEventListener('click', addBrand);

	// Get the modal
	let modal = document.querySelector("#myModal");

	// Get the button that opens the modal
	let btn = document.querySelector("#add_brand_btn");

	// Get the <span> element that closes the modal
	let span = document.querySelector(".close");
	
	let cancle = document.querySelector(".cancle");
	// When the user clicks on the button, open the modal

	let key = [btn, span, cancle];

	key.forEach(ele => {
		ele.onclick = () => {
			modal.classList.toggle('hidden');
		}
	});

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.classList.toggle('hidden');
		}
	}
</script>
@endsection