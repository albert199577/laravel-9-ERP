<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Laravel App - @yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body>
    <nav class="flex flex-row justify-between p-4 border-b border-slate-900/10"  style="box-shadow: rgba(0, 0, 0, 0.024) -1px 0px 0px 0px inset;">
        <div class="text-blue-700 text-lg font-mono">
            <a href="{{ route('brand.index') }}">
                Simon
            </a>
        </div>
        <button class="rounded bg-primary px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-black" onclick="javascript:toggleDropDown();">商品管理</button>
        <ul class="hidden list absolute right-2 top-16 sm:w-3/12 md:w-2/12 lg:w-2/12 bg-stone-50 text-center" style="box-shadow: rgba(0, 0, 0, 0.024) -1px 0px 0px 0px inset; color: rgba(25, 23, 17, 0.6);">
            <li class="m-2">
                <a href="{{ route('brand.index') }}" class="block">
                    Home
                </a>
            </li>
            <li class="m-2">
                <a href="{{ route('brand.index') }}" class="block">
                    品牌列表
                </a>
            </li>
            <li class="m-2">
                <a href="{{ route('product.index') }}" class="block">
                    商品列表
                </a>
            </li>
            <li class="m-2">
                <a href="{{ route('type.index') }}" class="block">
                    類別列表
                </a>
            </li>
        </ul>
    </nav>
    <div class="flex flex-row grow">
        <div class="sm:w-9/12 md:w-10/12 lg:w-10/12 grow">
            <div class="">
                @if (session('status'))
                    <div class="bg-green-100 rounded-lg py-5 px-6 text-base text-green-700 mb-3" role="alert"">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            @yield('content')
        </div>
    </div>
</body>
<script>
    function toggleDropDown() {
        const list = document.querySelector('.list');
        list.classList.toggle('hidden');

        window.addEventListener('click', function(event) {
            if (event.target == list) {
                list.classList.toggle('hidden');
            }
        });
    }
</script>
</html>