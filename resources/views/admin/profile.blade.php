@extends('admin.layouts.dashboard-app')

@section('content')
    <div class="p-4">
        <div class="font-bold text-2xl font-sans py-5">
            <h1>PROFILE</h1>
        </div>
        <div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Code
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
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
                        @forelse ($users as $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 text-center">
                                    {{ $item->code }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ $item->email }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ $item->created_at == null ? 'none' : \Carbon\Carbon::parse($item->created_at)->formatLocalized('%d %B %Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center">
                                        <form id="approvalForm" action="{{ route('admin.user.approve', $item->code) }}"
                                            method="post">
                                            @csrf
                                            <button onclick="ask('approvalForm')" type="button"
                                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Approve</button>
                                        </form>
                                        <form id="removeForm" action="{{ route('admin.user.remove', $item->code) }}"
                                            method="post">
                                            @csrf
                                            <button onclick="ask('removeForm')" type="button"
                                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Decline</button>
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
@endsection
