@extends('layouts.dashboard')

@section('content')
  <div class="inline-flex w-full items-center justify-between">
    <p class="text-2xl md:text-4xl font-bold">My Categories</p>
    <a class="rounded-md bg-indigo-600 text-sm px-2 py-1 text-center md:text-base md:px-4 md:py-2 hover:bg-indigo-500"
      href="{{ route('category.create') }}">Create new
      Category</a>
  </div>

  <div class="bg-gray-100 dark:bg-zinc-800 rounded-md shadow-lg p-4 mt-8">
    <table class="w-full table table-responsive table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($categories as $category)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $category->name }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
