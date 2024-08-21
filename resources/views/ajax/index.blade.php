@extends('layout.section')
@section('title', 'Index Page')
@section('section')

<div class="flex flex-col items-center p-6 bg-gray-100 min-h-screen ">
    @include('ajax.table')

</div>
@include('ajax.script')
@endsection