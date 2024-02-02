<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- font google --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <style>
        * {
            font-family: "Poppins", sans-serif;
        }

        .left-side-menu::-webkit-scrollbar {
            width: 8px;
        }

        .left-side-menu::-webkit-scrollbar-thumb {
            background-color: #d2d2d2;
            border-radius: 4px;
        }

        .left-side-menu::-webkit-scrollbar-track {
            background-color: #f1f1f1;
        }

        html::-webkit-scrollbar {
            width: 8px;
        }

        html::-webkit-scrollbar-thumb {
            background-color: #d2d2d2;
            border-radius: 4px;
        }

        html::-webkit-scrollbar-track {
            background-color: #f1f1f1;
        }

        html {
            scroll-behavior: smooth;
        }

        .smooth-scroll-container {
            scroll-behavior: smooth;
        }
    </style>

</head>

<body class="bg-gray-50">


    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <img width="100"
                        src="https://jasalogocepat.com/wp-content/uploads/2023/09/logo-bumn-tanpa-background-1-jasalogocepat-768x253.png"
                        alt="" srcset="">
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <div
                                    class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                    <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                                        </path>
                                    </svg>
                                </div>
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 py-3 px-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                {{ Auth::user()->username }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Log
                                    out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    @include('action.sweetalert')
    @include('action.error-messages')
    @include('action.sweetalert-validation')

    <div class="sm:mx-4 mt-8 py-5">
        @yield('content')
    </div>


</body>

</html>
