<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('layout.header')
</head>

<body>
    <div class="flex w-[100vw] h-[100vh] here">
        <div class="w-1/6 bg-gray-900 h-full">

            @include('layout.sidebar')
        </div>
        <div class="w-5/6  h-full">

            @yield('section')
        </div>
    </div>
</body>

</html>