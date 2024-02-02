@extends('admin.layouts.dashboard-app')

@section('content')

@section('script-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection

    <div class="p-4">
        <div class="font-bold text-2xl font-sans py-5 flex justify-between">
            <div>
                <h1>PETUGAS</h1>
            </div>
            <div>
                <button type="button" data-modal-target="petugas-modal" data-modal-toggle="petugas-modal"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah</button>
            </div>
        </div>
        <div>
            <div class="relative overflow-x-auto">
                <table id="myTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="text-center">
                            <th scope="col" class="px-6 py-3">
                                Code
                            </th>
                            <th scope="col" class="px-6 py-3">
                                username
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Create Date
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($petugas as $index => $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 text-center">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ $item->username }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ $item->created_at == null ? 'none' : \Carbon\Carbon::parse($item->created_at)->formatLocalized('%d %B %Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center">
                                        <button type="button" data-id="{{ $item->code }}"
                                            data-username="{{ $item->username }}" data-level="{{ $item->level }}"
                                            data-nama_petugas="{{ $item->nama_petugas }}"
                                            class="btn-edit focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Edit</button>
                                        <form id="removeForm-{{ $item->code }}" action="{{ route('delete.petugas.admin', $item->code) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="ask('removeForm-{{ $item->code }}')" type="button"
                                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <div class="my-5 flex justify-center w-full" style="min-height:16rem">
                                        <div class="my-auto">
                                            <img width="250" src="{{ asset('assets/content/empty-data.png') }}"
                                                alt="" srcset="">
                                            <span class="font-bold text-lg">Data Kosong!</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="petugas-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        TAMBAH PETUGAS
                    </h3>
                </div>
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="{{ route('create.petugas.admin') }}" method="POST">
                        @csrf
                        <div>
                            <label for="username"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="text" name="username" id="username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="your name" required>
                        </div>
                        <div>
                            <label for="nama_petugas"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Petugas</label>
                            <input type="text" name="nama_petugas" id="nama_petugas"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="your name" required>
                        </div>
                        <div>
                            <label for="level"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <select id="level" name="level"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                <option value="admin">ADMIN</option>
                                <option value="petugas">PETUGAS</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="petugas-update" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        TAMBAH PETUGAS
                    </h3>
                    <button type="button"
                        class="close-button text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5">
                    <form class="form-edit-petugas space-y-4" action="{{ route('update.petugas.admin') }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" name="id">
                        <div>
                            <label for="username"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="text" name="username" id="username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="your name" required>
                        </div>
                        <div>
                            <label for="nama_petugas"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Petugas</label>
                            <input type="text" name="nama_petugas" id="nama_petugas"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="your name" required>
                        </div>
                        <div>
                            <label for="level"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <select id="level" name="level"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="admin">ADMIN</option>
                                <option value="petugas">PETUGAS</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.close-button').click(function() {
            $('#petugas-update').removeClass('flex').addClass('hidden');
        });
    </script>

    <script>
        $('.btn-edit').click(function() {
            var id = $(this).data('id');
            var username = $(this).data('username');
            var nama_petugas = $(this).data('nama_petugas');
            var level = $(this).data('level');

            var formUpdate = $('#petugas-update .form-edit-petugas');

            formUpdate.find('input[name="id"]').val(id);
            formUpdate.find('input[name="username"]').val(username);
            formUpdate.find('input[name="nama_petugas"]').val(nama_petugas);

            formUpdate.find('#level option[value="' + level + '"]').prop('selected', true);

            $('#petugas-update').removeClass('hidden').addClass('flex');
        });
    </script>

@section('script-js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@endsection

<script>
$(document).ready(function() {
    $('#myTable').DataTable({
        lengthChange: false
    });
});
</script>
@endsection
