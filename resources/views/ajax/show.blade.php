@extends('layout.section')
@section('title', 'Show Page')
@section('section')
<div class="flex flex-col items-center p-6 bg-gray-100 min-h-screen">
    <div class="w-full max-w-6xl">
        <div class="flex bg-gray-800 text-white justify-center items-center h-12 rounded-t">
            Ajax Form
        </div>
        <div id="statusMessage" class="hidden bg-green-700 text-white p-2 rounded"></div>
        
            <div class="flex flex-row mt-4 bg-gray-200 p-4 rounded-b justify-between">
                <div class="flex items-center w-1/3 p-2">
                    <label for="name">Name: </label>
                    <div class="p-2 rounded w-2/3 ">{{$item->name}}</div>
                </div>
                <div class="flex items-center w-1/3 p-2">
                    <label for="phone">Phone: </label>
                    <div class="p-2 rounded w-2/3 ">{{$item->phone}}</div>
                </div>
                <div class="flex items-center w-1/3 p-2">
                    <label for="name1">Email: </label>
                    <div class="p-2 rounded w-2/3">{{$item->email}}</div>                    
                </div>
            </div>
            <div class="mt-2">
                <a href="{{ route('ajax.index') }}" class="bg-gray-600 text-white rounded py-1 px-3">
                    Back
                </a>
            </div>
        
    </div>
</div>
@endsection