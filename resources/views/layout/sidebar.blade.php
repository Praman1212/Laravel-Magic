@php
$menus = [

[
'name' => 'Home',
'icon' => '<i class="fa fa-home fa-2x" aria-hidden="true"></i>',
'route' => 'ajax.index'
],
[
'name' => 'Index',
'icon' => '<i class="fa fa-home fa-2x" aria-hidden="true"></i>',
'route' => 'ajax.index'
]


]
@endphp

@foreach($menus as $menu)
<div class="flex flex-cols m-5">
    <a href="{{ route($menu['route']) }}">
        <span class="text-white">{!! $menu['icon'] !!}</span>
        <span class="text-white text-2xl"> {{ $menu['name'] }}</span>
    </a>
</div>
@endforeach