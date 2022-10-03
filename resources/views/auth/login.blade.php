@extends('layouts.auth')

@section('content')
  <div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 dark:text-gray-50 leading-9">
        Sign in to your account
      </h2>
      @if (Route::has('register'))
        <p class="mt-2 text-sm text-center text-gray-600 dark:text-gray-200 leading-5 max-w">
          Or
          <a href="{{ route('register') }}"
            class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
            create a new account
          </a>
        </p>
      @endif
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="px-4 py-8 bg-white dark:bg-zinc-800 shadow sm:rounded-lg sm:px-10">
        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200 leading-5">
              Email address
            </label>

            <div class="mt-1 rounded-md shadow-sm">
              <input id="email" name="email" type="email" required autofocus
                class="appearance-none block w-full px-3 py-2 dark:bg-zinc-700 dark:text-zinc-200 border border-gray-300 dark:border-gray-600 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror"
                value="{{ old('email', '') }}" />
            </div>

            @error('email')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <div class="mt-6">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200 leading-5">
              Password
            </label>

            <div class="mt-1 rounded-md shadow-sm">
              <input id="password" type="password" name="password" required
                class="appearance-none block w-full px-3 py-2 dark:bg-zinc-700 dark:text-zinc-200 border border-gray-300 dark:border-gray-600 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
            </div>

            @error('password')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <div class="flex items-center justify-between mt-6">
            <div class="flex items-center">
              <input id="remember" type="checkbox"
                class="form-checkbox w-4 h-4 text-indigo-600 dark:text-indigo-400 transition duration-150 ease-in-out" />
              <label for="remember" class="block ml-2 text-sm text-gray-900 dark:text-gray-200 leading-5">
                Remember
              </label>
            </div>
          </div>

          <div class="mt-6">
            <span class="block w-full rounded-md shadow-sm">
              <button type="submit"
                class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                Sign in
              </button>
            </span>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
