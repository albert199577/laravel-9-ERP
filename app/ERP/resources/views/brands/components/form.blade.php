<div class="grid gird-cols-6 gap-4">
    <div class="col-span-2">
        <label for="name" class="label">品牌名</label>
        <input type="text" class="input" name="name" id="name" value="{{ old('name', optional($brand ?? null)->name) }}"/>
        </div>
    </div>
</div>
@if ($errors->any())
    <div class="mt-2 mb-2">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <div class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        </ul>
    </div>
@endif