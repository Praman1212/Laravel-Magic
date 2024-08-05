@extends('layout.section')
@section('title', isset($item) ? 'Edit Ajax' : 'Create Ajax')
@section('section')
<div class="flex flex-col items-center p-6 bg-gray-100 min-h-screen">
    <div class="w-full max-w-6xl">
        <div class="flex bg-gray-800 text-white justify-center items-center h-12 rounded-t">
            Ajax Form
        </div>
        <div id="statusMessage" class="hidden bg-green-700 text-white p-2 rounded"></div>
        <form id="ajaxForm" action="{{ isset($item) ? route('ajax.update',$item->id) : route('ajax.store') }}" method="POST">
            @csrf
            @if(isset($item))
            @method('PUT')

            @endif
            <div class="flex flex-row mt-4 bg-gray-200 p-4 rounded-b justify-between">
                <div class="flex items-center w-1/3 p-2">
                    <label for="name">Name: </label>
                    <input type="text" name="name" id="name" class="p-2 rounded w-2/3" placeholder="Enter your name." value="{{ isset($item) ? $item->name : '' }}">
                </div>
                <div class="flex items-center w-1/3 p-2">
                    <label for="phone">Phone: </label>
                    <input type="number" name="phone" id="phone" class="p-2 rounded w-2/3" placeholder="Enter your phone number." value="{{ isset($item) ? $item->phone : '' }}">
                </div>
                <div class="flex items-center w-1/3 p-2">
                    <label for="name1">Email: </label>
                    <input type="text" name="email" id="email" class="p-2 rounded w-2/3" placeholder="Enter your email." value="{{ isset($item) ? $item->email : '' }}">
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" id="ajaxButton" class="bg-blue-900 px-4 py-1 text-white rounded ">{{ isset($item) ? 'Update' : 'Save' }}</button>
            </div>
        </form>
    </div>
</div>

@include('ajax.script')
@endsection