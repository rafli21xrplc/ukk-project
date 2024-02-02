@extends('layouts.app')

@section('content')
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
                    <h1 class="text-3xl font-semibold mb-6 text-black text-center">Sign Up</h1>
                    <h1 class="text-sm font-semibold mb-6 text-gray-500 text-center">Join to Our Community with all time access
                        and free </h1>
                </div>
                @if (session('messages'))
                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400"
                        role="alert">{{ session('messages') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('register') }}"class="space-y-4" autocomplete="off">
                    @csrf
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="username" name="name"
                            class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300"
                            value="{{ old('name') }}">
                        @error('name')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="text" id="email" name="email"
                            class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300"
                            value="{{ old('email') }}">
                        @error('email')
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
                    <div>
                        <label for="password-confirm" class="block text-sm font-medium text-gray-700">Konfirmasi
                            Password</label>
                        <input type="password" id="password-confirm" name="password_confirmation"
                            class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                        @error('password_confirmation')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-black text-white p-2 rounded-md hover:bg-gray-800 focus:outline-none focus:bg-black focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">
                            {{ __('Register') }}</button>
                    </div>
                </form>
                <div class="mt-4 text-sm text-gray-600 text-center">
                    <p>Already have an account? <a href="{{ route('login') }}" class="text-black hover:underline">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
