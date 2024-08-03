@extends('layout.section')
@section('title', 'Index Page')
@section('section')

<div class="flex flex-col items-center p-6 bg-gray-100 min-h-screen">
    <div class="w-full max-w-6xl mb-6 flex justify-start">
        <a href="{{ route('ajax.create') }}" class="bg-blue-900 px-4 py-2 rounded text-white hover:bg-blue-700">
            + Add
        </a>
    </div>
    <div class="relative">
        <div id="statusMessage" class="w-full absolute top-0 right-0 bg-green-500 text-white p-2 rounded hidden"></div>
    </div>
    <div class="w-full max-w-6xl max-h-[75vh] overflow-y-auto">
        <table class="table-auto w-full  bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-blue-900 text-white">
                <tr class="text-left">
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Phone</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr class="bg-gray-100 border-b">
                    <td class="px-4 py-2">{{$item->name}}</td>
                    <td class="px-4 py-2">{{$item->phone}}</td>
                    <td class="px-4 py-2">{{$item->email}}</td>
                    <!-- Action button -->
                    <td class="px-4 py-2 flex">
                        <a href="{{route('ajax.show',$item->id)}}" class="m-1">
                            <i class="las la-eye bg-blue-800 text-white rounded p-1"></i>
                        </a>
                        <a href="" class="m-1">
                            <i class="las la-edit bg-green-800 text-white rounded p-1"></i>
                        </a>
                        <a href="" class="m-1">
                            <form action="" class="">
                                <i class="las la-trash bg-red-800 text-white rounded p-1"></i>
                            </form>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('ajax.script')
@endsection