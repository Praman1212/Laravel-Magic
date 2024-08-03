@php
$menus = [

[
'name' => 'AJAX FORM',
'icon' => '<i class="fa fa-folder " aria-hidden="true"></i>',
'route' => 'ajax.index'
],
[
'name' => 'Index',
'icon' => '<i class="fa fa-home " aria-hidden="true"></i>',
'route' => 'ajax.index'
]


]
@endphp

@foreach($menus as $menu)
<div class="flex flex-cols m-5">
    <a href="{{ route($menu['route']) }}" >
        <span class="text-white hover:text-black" >{!! $menu['icon'] !!}</span>
        <span class="text-white hover:text-black"> {{ $menu['name'] }}</span>
    </a>
</div>
@endforeach