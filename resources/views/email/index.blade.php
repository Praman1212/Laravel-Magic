@extends('layout.section')
@section('title', 'Email Index')
@section('section')

<div class="flex flex-col items-center p-6 bg-gray-100 min-h-screen ">
    <div class="w-full max-w-6xl mb-6 flex justify-start">
        <button class="bg-blue-900 px-4 py-2 rounded text-white hover:bg-blue-700" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal">
            + Add
        </button>
    </div>
    <div class="relative">
        <div id="statusMessage" class="w-full absolute top-0 right-0 bg-green-500 text-white p-2 rounded hidden"></div>
    </div>
    <div class="w-full max-w-6xl max-h-[75vh] overflow-y-auto">
        <table class="table-auto w-full  bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-blue-900 text-white">
                <tr class="text-left">
                    <th class="px-4 py-2">S.N.</th>
                    <th class="px-4 py-2">Your Email</th>
                    <th class="px-4 py-2">Client Email</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr class="bg-gray-100 border-b">
                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2">{{$item->your_email}}</td>
                    <td class="px-4 py-2">{{$item->client_email}}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('email.edit',$item->id                                            ) }}">
                            <i class="las la-edit bg-green-800 text-white rounded p-1 ajax-edit-button"></i>
                        </a>
                        <form action="{{ route('email.destroy', $item->id) }}" method="POST" class="m-1" onsubmit="return approveMessage()">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="las la-trash bg-red-800 text-white rounded p-1"></i>
                            </button>
                        </form>
                    </td>

                    <!-- Action button -->

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection