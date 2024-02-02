@extends('siswa.layouts.app')

@section('content')
    <div class="p-4 mt-8">
        <div class="font-bold text-2xl font-sans flex flex-row justify-between">
            <div>
                <h1>PEMBAYARAN</h1>
            </div>
            <div class="flex flex-row gap-2 justify-between">
                <form action="{{ route('generate.pembayaran.siswa', Auth::user()->siswa_id) }}" method="GET">
                    @csrf
                    <button type="submit"
                        class="focus:outline-none text-white bg-yellow-300 hover:bg-yellow-400 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Print</button>
                </form>
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

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.tailwindcss.min.js"></script>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com/"> --}}

    {{-- <script>
        $(document).ready(function() {
            $('#table').DataTable({
                lengthChange: false,
                language: {
                    url: 'cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
                },
            });
        });
    </script> --}}
@endsection
