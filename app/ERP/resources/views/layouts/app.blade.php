<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=`, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel App - @yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="flex flex-col h-screen">
        <nav class="flex flex-row justify-between p-4 border-b border-slate-900/10"  style="box-shadow: rgba(0, 0, 0, 0.024) -1px 0px 0px 0px inset;">
            <div class="text-blue-700 text-lg font-mono">
                <a href="{{ route('brand.index') }}">
                    Simon
                </a>
            </div>
        </nav>
        <div class="flex flex-row grow">
            <ul class="sm:w-3/12 md:w-2/12 lg:w-2/12 bg-stone-50 text-center" style="box-shadow: rgba(0, 0, 0, 0.024) -1px 0px 0px 0px inset; color: rgba(25, 23, 17, 0.6);">
                <li class="m-2">
                    <a href="{{ route('brand.index') }}">
                        Home
                    </a>
                </li>
                <li class="m-2">
                    <a href="{{ route('brand.index') }}">
                        品牌列表
                    </a>
                </li>
                <li class="m-2">
                    <a href="{{ route('product.index') }}">
                        商品列表
                    </a>
                </li>
            </ul>
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
    </div>
</body>
</html>