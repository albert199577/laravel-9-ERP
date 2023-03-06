@extends('layouts.app')

@section('title', '新增品牌')

@section('content')
<div class="container mx-auto">
	<div class="shadow-sm overflow-y-auto my-8">
		<form action="{{ route('brand.update', ['brand' => $brand->id]) }}" method="POST">
			@csrf
			@method('PUT')
			<x-form :type="'品牌'" :data="$brand">
			</x-form>
			<div class="flex flex-row justify-center">
				<div>
					<button type="submit" class="btn-primary">編輯</button>
				</div>
				<div>
					<a href="{{ route('brand.index') }}">
						<button type="button" class="btn-primary">取消</button>
					</a>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection