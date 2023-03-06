@extends('layouts.app')

@section('title', '新增類別')

@section('content')
<div class="container mx-auto">
	<div class="shadow-sm overflow-y-auto my-8">
		<form action="{{ route('type.store') }}" method="POST">
			@csrf
			<x-form type='類別'>
			</x-form>
			<div class="flex flex-row justify-center">
				<div>
					<button type="submit" class="btn-primary mx-1.5">新增</button>
				</div>
				<div>
					<a href="{{ route('type.index') }}">
						<button type="button" class="btn-primary mx-1.5">取消</button>
					</a>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection