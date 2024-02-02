@extends('petugas.layouts.app')

@section('content')
    <div class="p-4 mt-8">
        <div class="font-bold text-2xl font-sans flex flex-row justify-between">
            <div>
                <h1>PEMBAYARAN</h1>
            </div>
            <div class="flex flex-row gap-2 justify-between">
                <span>
                    <form action="{{ route('admin.generate.pdf') }}" method="GET">
                        @csrf
                        <button type="submit"
                            class="focus:outline-none text-white bg-yellow-300 hover:bg-yellow-400 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Print</button>
                    </form>
                </span>
                <span>
                    <button type="button" type="button" data-modal-target="pembayaran-modal"
                        data-modal-toggle="pembayaran-modal"
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Entri
                        Transaksi</button>
                </span>
            </div>
        </div>
        <div>
            <div class="relative overflow-x-auto mb-4">
                <div class="relative overflow-x-auto mb-4 p-4">
                    <table id="table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 mt-3 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    TANGGAL BAYAR
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    NOMINAL
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    SISWA
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    PETUGAS
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    SPP
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pembayaran as $index => $item)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-table-search-{{ $item->code }}" type="checkbox"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-table-search-{{ $item->code }}"
                                                class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $index + 1 }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $item->tgl_bayar == null ? 'none' : \Carbon\Carbon::parse($item->tgl_bayar)->formatLocalized('%d %B %Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ number_format($item->jumlah_bayar, 2, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->siswa->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->petugas->nama_petugas }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->spp->tahun }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">
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
    </div>

    <div id="pembayaran-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        PEMBAYARAN
                    </h3>
                </div>
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="{{ route('create.pembayaran.petugas') }}" method="POST">
                        @csrf
                        <div>
                            <div>
                                <label for="tgl_bayar"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                    Bayar</label>
                                <input type="date" name="tgl_bayar" id="tgl_bayar"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="your class name" required>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div>
                                <label for="nisn"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Siswa</label>
                                <select id="nisn" name="nisn"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                    @forelse ($siswa as $item)
                                        <option value="{{ $item->code }}">{{ $item->nisn }}</option>
                                    @empty
                                        <option>Empty</option>
                                    @endforelse
                                </select>
                            </div>
                            <div>
                                <label for="id_spp"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Spp</label>
                                <select id="id_spp" name="id_spp"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                    @forelse ($spp as $item)
                                        <option value="{{ $item->code }}">{{ $item->tahun }}</option>
                                    @empty
                                        <option>Empty</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="id_petugas"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Petugas</label>
                            <select id="id_petugas" name="id_petugas"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @forelse ($petugas as $item)
                                    <option value="{{ $item->code }}">{{ $item->nama_petugas }}</option>
                                @empty
                                    <option>Empty</option>
                                @endforelse
                            </select>
                        </div>
                        <div>
                            <label for="bayar"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Bayar</label>
                            <input type="number" name="bayar" id="bayar"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="20000" required>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.tailwindcss.min.js"></script>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com/">

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                lengthChange: false,
                // language: {
                //     url: 'cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
                // },
                "lengthMenu": [
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                ],
                "pageLength": 5,

                "order": [],

                "bStateSave": true,

                "ordering": false,

                "language": {
                    "sProcessing": "Sedang memproses...",
                    "sLengthMenu": "Tampilkan _MENU_ data",
                    "sZeroRecords": "Tidak ditemukan Data",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "sInfoFiltered": "(disaring dari _MAX_ data keseluruhan)",
                    "sInfoPostFix": "",
                    "sSearch": "Cari:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sPrevious": "&#8592;",
                        "sNext": "&#8594;",
                        "sLast": "Terakhir"
                    }
                }
            });
        });
    </script> --}}
@endsection
