@extends('admin.layouts.dashboard-app')

@section('content')
@section('script-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection

<div class="p-4">
    <div class="font-bold text-2xl font-sans py-5 flex justify-between">
        <div>
            <h1>SISWA</h1>
        </div>
        <div>
            <button type="button" data-modal-target="siswa-modal" data-modal-toggle="siswa-modal"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah</button>
        </div>
    </div>
    <div>
        <div class="relative overflow-x-auto">
            <table id="myTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-3">
                            Id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Profile
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nisn
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kelas
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Spp
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
                    @forelse ($siswa as $index => $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 text-center">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 text-center">

                                <div
                                    class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="" srcset="">
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $item->nisn }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $item->name }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $item->kelas->kelas }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $item->spp->tahun }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $item->created_at == null ? 'none' : \Carbon\Carbon::parse($item->created_at)->formatLocalized('%d %B %Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center">
                                    <button type="button" data-image="{{ $item->image }}"
                                        data-nisn="{{ $item->nisn }}" data-nis="{{ $item->nis }}"
                                        data-id="{{ $item->code }}" data-name="{{ $item->name }}"
                                        data-alamat="{{ $item->alamat }}" data-telp="{{ $item->telp }}"
                                        data-kelas="{{ $item->id_kelas }}" data-spp="{{ $item->id_spp }}"
                                        class="btn-edit focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                        onclick="updatePhotoPreview(this.getAttribute('data-image'));">Edit</button>
                                    <form id="removeForm-{{ $item->code }}"
                                        action="{{ route('delete.siswa.admin', $item->code) }}" method="post">
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
                            <td colspan="8" class="text-center">
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

<div id="siswa-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    TAMBAH SISWA
                </h3>
            </div>
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="{{ route('create.siswa.admin') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="w-full">
                        <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
                            <input type="file" name="image" class="hidden" x-ref="photo"
                                x-on:change="
                        photoName = $refs.photo.files[0].name;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            photoPreview = e.target.result;
                        };
                        reader.readAsDataURL($refs.photo.files[0]);
    ">
                            <div class="text-center">
                                <div class="mt-2" x-show="! photoPreview">
                                    <img src="https://images.unsplash.com/photo-1531316282956-d38457be0993?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80"
                                        class="w-40 h-40 m-auto rounded-full shadow">
                                </div>
                                <!-- New Profile Photo Preview -->
                                <div class="mt-2" x-show="photoPreview" style="display: none;">
                                    <span class="block w-40 h-40 rounded-full m-auto shadow"
                                        x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                                        photoPreview + '\');'"
                                        style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                                    </span>
                                </div>
                                <button type="button"
                                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 ml-3"
                                    x-on:click.prevent="$refs.photo.click()">
                                    Select New Photo
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div>
                            <label for="nisn"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nisn</label>
                            <input type="text" name="nisn" id="nisn"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="your class name" required>
                        </div>
                        <div>
                            <label for="nis"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nis</label>
                            <input type="text" name="nis" id="nis"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="RPL, etc" required>
                        </div>
                    </div>
                    <div>
                        <label for="nama"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                        <input type="text" name="name" id="nama"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="RPL, etc" required>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div>
                            <label for="id_kelas"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                            <select id="id_kelas" name="id_kelas"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                @forelse ($kelas as $item)
                                    <option value="{{ $item->code }}">{{ $item->kelas }}</option>
                                @empty
                                    <option>Empty</option>
                                @endforelse
                            </select>
                        </div>
                        <div>
                            <label for="id_spp"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
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
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div>
                            <label for="alamat"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                            <input type="text" name="alamat" id="alamat"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="RPL, etc" required>
                        </div>
                        <div>
                            <label for="telp"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefon</label>
                            <input type="number" name="telp" id="telp"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="RPL, etc" required>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="siswa-update" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    UPDATE SISWA
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
                <form class="form-edit-siswa space-y-4" action="{{ route('update.siswa.admin') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" name="id">
                    <div>
                        <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
                            <input type="file" name="image" class="hidden" x-ref="photo"
                                x-on:change="handleImageUpload(event)">
                            <div class="text-center">
                                <div class="mt-2" id="photoPreviewContainer">
                                    <img class="w-40 h-40 m-auto rounded-full shadow" id="photoPreview">
                                </div>
                                <!-- New Profile Photo Preview -->
                                <div class="mt-2" x-show="photoPreview" style="display: none;">
                                    <span class="block w-40 h-40 rounded-full m-auto shadow"
                                        x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                                        photoPreview + '\');'"
                                        style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                                    </span>
                                </div>
                                <button type="button"
                                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 ml-3"
                                    x-on:click.prevent="$refs.photo.click()">
                                    Select New Photo
                                </button>
                            </div>
                        </div>

                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div>
                            <label for="nisn"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nisn</label>
                            <input type="text" name="nisn" id="nisn"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="your class name" required>
                        </div>
                        <div>
                            <label for="nis"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nis</label>
                            <input type="text" name="nis" id="nis"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="RPL, etc" required>
                        </div>
                    </div>
                    <div>
                        <label for="nama"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                        <input type="text" name="name" id="nama"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="RPL, etc" required>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div>
                            <label for="id_kelas"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                            <select id="id_kelas" name="id_kelas"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                @forelse ($kelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                                @empty
                                    <option>Empty</option>
                                @endforelse
                            </select>
                        </div>
                        <div>
                            <label for="id_spp"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                            <select id="id_spp" name="id_spp"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                @forelse ($spp as $item)
                                    <option value="{{ $item->id }}">{{ $item->tahun }}</option>
                                @empty
                                    <option>Empty</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div>
                            <label for="alamat"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                            <input type="text" name="alamat" id="alamat"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="RPL, etc" required>
                        </div>
                        <div>
                            <label for="telp"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefon</label>
                            <input type="number" name="telp" id="telp"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="RPL, etc" required>
                        </div>
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
        $('#siswa-update').removeClass('flex').addClass('hidden');
    });

    $('.btn-edit').click(function() {
        var id = $(this).data('id');
        var nisn = $(this).data('nisn');
        var nis = $(this).data('nis');
        var name = $(this).data('name');
        var alamat = $(this).data('alamat');
        var telp = $(this).data('telp');
        var id_kelas = $(this).data('kelas');
        var id_spp = $(this).data('spp');

        var formUpdate = $('#siswa-update .form-edit-siswa');

        formUpdate.find('input[name="id"]').val(id);
        formUpdate.find('input[name="nisn"]').val(nisn);
        formUpdate.find('input[name="nis"]').val(nis);
        formUpdate.find('input[name="name"]').val(name);
        formUpdate.find('input[name="alamat"]').val(alamat);
        formUpdate.find('input[name="telp"]').val(telp);

        formUpdate.find('#id_kelas option[value="' + id_kelas + '"]').prop('selected', true);
        formUpdate.find('#id_spp option[value="' + id_spp + '"]').prop('selected', true);

        $('#siswa-update').removeClass('hidden').addClass('flex');
    });
</script>


<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

<script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.3.x/dist/index.js"></script>


<script>
    var loadFileUpdate = function(event) {
        var input = event.target;
        var file = input.files[0];
        var type = file.type;

        var output = document.getElementById('preview_img');

        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src);
        }
    };

    function updatePhotoPreview(imageUrl) {
        var photoPreviewContainer = document.getElementById('photoPreviewContainer');
        var img = document.getElementById('photoPreview');

        if (imageUrl && imageUrl !== "null") {
            var modifiedUrl = imageUrl.replace('/admin', '/storage');
            img.src = `http://127.0.0.1:8000/storage/${modifiedUrl}`;
        }
    }

    function handleImageUpload(event) {
        var fileInput = event.target;
        var photoPreview = document.getElementById('photoPreview');
        var reader = new FileReader();

        reader.onload = function(e) {
            photoPreview.src = e.target.result;
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
</script>


<script>
    var loadFile = function(event) {

        var input = event.target;
        var file = input.files[0];
        var type = file.type;

        var output = document.getElementById('preview_img');


        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
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
