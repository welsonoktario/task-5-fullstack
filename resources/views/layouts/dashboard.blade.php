@extends('layouts.app')

@section('body')
  <div class="bg-gray-50 dark:bg-zinc-900">
    <x-navbar></x-navbar>

    <main class="pt-24 flex min-h-screen">
      <div class="container mx-6 md:mx-auto dark:bg-zinc-900">
        @yield('content')
      </div>
    </main>
  </div>
@endsection
