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

    <!-- <div class="relative">
        <div id="statusMessage" class=" absolute top-0 right-0 mt-4 mr-4 bg-green-500 text-white p-2 rounded hidden">
        </div>
    </div> -->

    <div class="w-full max-w-6xl">
        <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-blue-900 text-white">
                <tr class="text-left">
                    <th class="px-4 py-2">Song</th>
                    <th class="px-4 py-2">Artist</th>
                    <th class="px-4 py-2">Year</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-gray-100 border-b">
                    <td class="px-4 py-2">The Sliding Mr. Bones (Next Stop, Pottersville)</td>
                    <td class="px-4 py-2">Malcolm Lockyer</td>
                    <td class="px-4 py-2">1961</td>
                </tr>
                <tr class="bg-white border-b">
                    <td class="px-4 py-2">Witchy Woman</td>
                    <td class="px-4 py-2">The Eagles</td>
                    <td class="px-4 py-2">1972</td>
                </tr>
                <tr class="bg-gray-100 border-b">
                    <td class="px-4 py-2">Shining Star</td>
                    <td class="px-4 py-2">Earth, Wind, and Fire</td>
                    <td class="px-4 py-2">1975</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@include('ajax.script')
@endsection