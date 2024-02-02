@extends('admin.layouts.dashboard-app')

@section('content')

@section('script-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection


    <div class="p-4">
        <div class="font-bold text-2xl font-sans py-5 flex justify-between">
            <div>
                <h1>KELAS</h1>
            </div>
            <div>
                <button type="button" data-modal-target="kelas-modal" data-modal-toggle="kelas-modal"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah</button>
            </div>
        </div>
        <div>
            <div class="relative overflow-x-auto">
                <table id="myTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="text-center">
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kelas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kompetensi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Create Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kelas as $index => $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 text-center">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ $item->kelas }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ $item->kompetensi_keahlian }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ $item->created_at == null ? 'none' : \Carbon\Carbon::parse($item->created_at)->formatLocalized('%d %B %Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center">
                                        <button type="button" data-kelas="{{ $item->kelas }}"
                                            data-kompetensi="{{ $item->kompetensi_keahlian }}" data-id="{{ $item->code }}"
                                            class="btn-edit focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Edit</button>
                                        <form id="removeForm-{{ $item->code }}" action="{{ route('delete.kelas.admin', $item->code) }}"
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

    <div id="kelas-update" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        UPDATE KELAS
                    </h3>
                    <button type="button" class="close-button text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5">
                    <form class="form-edit-kelas space-y-4" action="{{ route('update.kelas.admin') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" name="id">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Kelas</label>
                            <input type="text" name="kelas" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="your class name" required>
                        </div>
                        <div>
                            <label for="kompetensi"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kompetensi
                                Kelas</label>
                            <input type="text" name="kompetensi" id="kompetensi"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="RPL, etc" required>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="kelas-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        TAMBAH KELAS
                    </h3>
                </div>
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="{{ route('create.kelas.admin') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Kelas</label>
                            <input type="text" name="kelas" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="your class name" required>
                        </div>
                        <div>
                            <label for="kompetensi"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kompetensi
                                Kelas</label>
                            <input type="text" name="kompetensi" id="kompetensi"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="RPL, etc" required>
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
            $('#kelas-update').removeClass('flex').addClass('hidden');
        });

        $('.btn-edit').click(function() {
            var id = $(this).data('id');
            var kelas = $(this).data('kelas');
            var kompetensi = $(this).data('kompetensi');

            var formUpdate = $('#kelas-update .form-edit-kelas');

            formUpdate.find('input[name="id"]').val(id);
            formUpdate.find('input[name="kelas"]').val(kelas);
            formUpdate.find('input[name="kompetensi"]').val(kompetensi);

            $('#kelas-update').removeClass('hidden').addClass('flex');
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
