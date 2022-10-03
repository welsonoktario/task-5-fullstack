@extends('layouts.app')

@section('body')
    <div class="flex flex-col justify-center items-center min-h-screen py-12 bg-gray-50 dark:bg-zinc-900 sm:px-6 lg:px-8">
        @yield('content')
    </div>
@endsection
