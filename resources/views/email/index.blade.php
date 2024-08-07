@extends('layout.section')
@section('title', 'Email Index')
@section('section')

<div class="flex flex-col items-center p-6 bg-gray-100 min-h-screen ">
    <div class="w-full max-w-6xl max-h-[75vh] overflow-y-auto">
        <table class="table-auto w-full  bg-white shadow-md rounded-lg ">
            <thead class="bg-blue-900 text-white">
                <tr class="text-left">
                    <th class="px-4 py-2">S.N.</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Phone</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>

            <tr class="bg-gray-100 border-b">
                <td class="px-4 py-2">1</td>
                <td class="px-4 py-2">Praman Ghimire</td>
            </tr>

        </tbody>
        </table>
    </div>
</div>
@include('email.create')
@endsection