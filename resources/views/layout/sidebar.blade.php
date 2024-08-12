@php
$menus = [

[
'name' => 'AJAX FORM',
'icon' => '<i class="las la-folder-open"></i></i>',
'route' => 'ajax.index'
],
[
'name' => 'EMAIL',
'icon' => '<i class="las la-envelope"></i>',
'route' => 'email.index'
]



]
@endphp

@foreach($menus as $menu)
<div class="flex items-center space-x-4 p-3">
    <a href="{{ route($menu['route']) }}" class="flex items-center space-x-2 group">
        <span class="text-2xl text-white group-hover:text-black group-hover:bg-gray-200 p-1 transition duration-300 rounded">{!! $menu['icon'] !!}</span>
        <span class="text-xl text-white group-hover:text-black group-hover:bg-gray-200 p-1 transition duration-300 rounded">{{ $menu['name'] }}</span>
    </a>
</div>
@endforeach 
