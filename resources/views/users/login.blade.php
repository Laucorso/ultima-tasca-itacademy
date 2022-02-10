@extends('welcome')
@section('content')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        <form method="POST" action="{{ route('login.store') }}">
            @csrf
                <div>
                    <label for="password" class="block font-medium text-sm text-gray-700">
                        {{ __('Password') }}
                    </label>

				    <input id="password" name="password" type="password" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('password') }}" required autofocus>
                    @error('password')
                    <br>
                        <strong>*{{ $message }}</strong>
                    <br>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block font-medium text-sm text-gray-700">
                        {{ __('Email') }}
                    </label>

                    <input id="email" name="email" type="email" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('email') }}" required autofocus>
                    @error('email')
                    <br>
                        <strong>*{{ $message }}</strong>
                    <br>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Log in') }}
                    </button>
                </div>
        </form>
    </div>
</div>