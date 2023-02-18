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
    <nav class="flex flex-row justify-between p-4 mb-5 shadow">
        <div class="text-blue-700 text-lg font-mono">
            <a href="{{ route('brand.index') }}">
                chaomimimi
            </a>
        </div>
        <ul class="grid grid-cols-3 gap-4 text-green-700">
            <li>
                <a href="{{ route('brand.index') }}">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('brand.index') }}">
                    Brands List
                </a>
            </li>
            <li>
                <a href="{{ route('product.index') }}">
                    Product List
                </a>
            </li>
        </ul>
    </nav>
    <div class="container mx-auto">
        @if (session('status'))
            <div class="bg-green-100 rounded-lg py-5 px-6 mb-4 text-base text-green-700 mb-3" role="alert"">
                {{ session('status') }}
            </div>
        @endif
    </div>
    @yield('content')
</body>
</html>