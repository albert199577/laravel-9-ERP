@extends('layouts.app')

@section('title', '類別總覽')

@section('content')
<div class="container mx-auto">
	<h2 class="text-2xl font-semibold text-center text-zinc-500 p-3">類別列表</h2>
    <div class="flex flex-row justify-between px-10">
		<div class="mx-10">
			<a href="{{ route('type.create') }}">
				<button type="submit" class="btn-primary">新增類別</button>
			</a>
		</div>
	</div>
	<div class="shadow-sm overflow-y-auto my-8">
		<table class="table-fixed border-collapse w-3/4 text-sm mx-auto">
			<thead>
				<tr>
					<th class="th">No.</th>
					<th class="th">類別名</th>
					<th class="th"></th>
				</tr>
			</thead>
			<tbody class="bg-white dark:bg-slate-800">
				@foreach ($types as $type)
					<tr>
						<td class="td">{{ $type->id }}</td>
						<td class="td">
							{{ $type->name }}
						</td>
						<td class="td flex flex-row">
							<a href="{{ route('type.edit', ['type' => $type->id]) }}">
								<button type="submit" class="btn-primary mx-1.5">編輯</button>
							</a>
							<form action="{{ route('type.destroy', ['type' => $type->id]) }}" method="POST">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn-danger mx-1.5">刪除</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection