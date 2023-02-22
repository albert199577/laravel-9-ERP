@extends('layouts.app')

@section('title', '品牌總覽')

@section('content')
<div class="container mx-auto">
	<h2 class="text-2xl font-semibold text-center text-zinc-500 p-3">品牌列表</h2>
	<div class="flex flex-row justify-between px-10">
		<div class="mx-10">
			<a href="{{ route('brand.create') }}">
				<button type="submit" class="btn-primary"> + Create</button>
			</a>
		</div>
		<div class="btn-primary mx-10">
			總成本 {{ $total }} 元
		</div>
	</div>
	<div class="shadow-sm overflow-y-auto my-8">
		<table class="table-fixed border-collapse w-3/4 text-sm mx-auto">
			<thead>
				<tr>
					<th class="th">No.</th>
					<th class="th">品牌名</th>
					<th class="th"></th>
				</tr>
			</thead>
			<tbody class="bg-white dark:bg-slate-800">
				@foreach ($brands as $brand)
					<tr>
						<td class="td cursor-pointer" onclick="location.href='{{route('brand.show', ['brand' => $brand->id])}}'">{{ $brand->id }}</td>
						<td class="td cursor-pointer" onclick="location.href='{{route('brand.show', ['brand' => $brand->id])}}'">
							{{ $brand->name }}
						</td>
						<td class="td flex flex-row">
							<a href="{{ route('brand.edit', ['brand' => $brand->id]) }}">
								<button type="submit" class="btn-primary mx-1.5">編輯</button>
							</a>
							<form action="{{ route('brand.destroy', ['brand' => $brand->id]) }}" method="POST">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn-primary mx-1.5">刪除</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

</div>

@endsection