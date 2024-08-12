@extends('layout.section')
@section('title', 'Index Page')
@section('section')
@if (Route::has('login'))
<livewire:welcome.navigation />
@endif
@include('ajax.table')
<div class="flex flex-col items-center p-6 bg-gray-100 min-h-screen ">

</div>
@include('ajax.script')
@endsection