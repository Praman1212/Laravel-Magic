@extends('layout.section')
@section('title', 'Email Index')
@section('section')

<div class="flex flex-col items-center p-6 bg-gray-100 min-h-screen ">

    <div class="w-full max-w-6xl mb-6 flex justify-start ">

        <!-- Right-aligned (button) -->
        <div class="w-fit flex justify-start">
            <button class="bg-blue-900 px-4 py-2 rounded text-white hover:bg-blue-700" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal">
                + Add
            </button>
        </div>
        <!-- Left-aligned (status message) -->
        <div class="w-fit status-message flex justify-end p-1 rounded" style="display: none;">
        </div>
    </div>


    @include('email.create')
    <div class="flex items-center">
        <div class="w-screen max-w-6xl max-h-[75vh] overflow-y-auto">
            <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-blue-900 text-white">
                    <tr class="text-left">
                        <th class="px-4 py-2">S.N.</th>
                        <th class="px-4 py-2">Your Email</th>
                        <th class="px-4 py-2">Client Email</th>
                        <th class="px-4 py-2">Message</th>
                        <th class="px-4 py-2">Attachment</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr class="bg-gray-100 border-b">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{$item->your_email}}</td>
                        <td class="px-4 py-2">{{$item->client_email}}</td>
                        <td class="px-4 py-2">{{$item->message}}</td>
                        <td class="px-4 py-2">{{ isset($item->attachment) ? $item->attachment : 'No attachment' }}</td>
                        <td class="px-4 py-2 flex">

                            <button class="m-1 email-edit-btn" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" data-id="{{ $item->id }}" data-your-email="{{ $item->your_email }}" data-client-email="{{ $item->client_email }}" data-message="{{ $item->message }}">
                                <i class="las la-edit bg-green-800 text-white rounded p-1 ajax-edit-button"></i>
                            </button>

                            <form action="{{ route('email.destroy', $item->id) }}" class="m-1" method="POST" onsubmit="return showConfirmationModal(event)" id="email-delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <i class="las la-trash bg-red-800 text-white rounded p-1"></i>
                                </button>
                            </form>

                            <div id="confirmationModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                <div class="bg-white p-6 rounded shadow-md w-96">
                                    <h2 class="text-lg font-bold mb-4">Confirm Deletion</h2>
                                    <p class="mb-6">Are you sure you want to delete this item?</p>
                                    <div class="flex justify-end">
                                        <button type="button" id="cancelButton" class="mr-4 bg-gray-300 px-4 py-2 rounded">Cancel</button>
                                        <button type="button" id="confirmButton" class="bg-red-600 text-white px-4 py-2 rounded">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@include('email.script')
@endsection