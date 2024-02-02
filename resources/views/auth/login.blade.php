@extends('layouts.app')

@section('content')
    {{-- <script src="https://www.google.com/recaptcha/api.js"></script> --}}

    <div class="flex h-screen">
        <!-- Left Pane -->
        <div class="hidden lg:flex items-center justify-center flex-1 bg-white text-black">
            <div class="max-w-md text-center">
                <img src="{{ asset('assets/content/register.svg') }}" alt="" srcset="">
            </div>
        </div>
        <!-- Right Pane -->
        <div class="w-full bg-gray-100 lg:w-1/2 flex items-center justify-center">
            <div class="max-w-md w-full p-6">
                <div>
                    <h1 class="text-3xl font-semibold mb-6 text-black text-center">Sign In</h1>
                    <h1 class="text-sm font-semibold mb-6 text-gray-500 text-center">Join to Our Community with all time
                        access
                        and free </h1>
                </div>
                @if (session('messages'))
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400"
                        role="alert">{{ session('messages') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}"class="space-y-4" autocomplete="off">
                    @csrf
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="username" name="username"
                            class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300"
                            value="{{ old('username') }}">
                        @error('username')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password"
                            class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                        @error('password')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <input type="hidden" id="g-recaptcha-response" name="recaptcha">
                    <div>
                        <button type="submit"
                            class="w-full bg-black text-white p-2 rounded-md hover:bg-gray-800 focus:outline-none focus:bg-black focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">
                            {{ __('login') }}</button>
                    </div>
                </form>
                <div class="mt-4 text-sm text-gray-600 text-center">
                    <p>Dont have an account? <a href="{{ route('register') }}" class="text-black hover:underline">Register
                            here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    @include('rechapca')
@endsection
