@extends('layouts.dashboard')

@section('content')
  <div class="inline-flex w-full items-center justify-start">
    <button onclick="history.back();">
      <svg class="h-5 w-5" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
      </svg>
    </button>
    <p class="ml-4 flex-1 text-2xl md:text-4xl font-bold">Edit Article</p>
  </div>

  <div class="bg-white mt-8 px-4 py-8 shadow dark:bg-zinc-800 sm:rounded-lg sm:px-10">
    @if (session('error'))
      <p class="text-red-500 font-italic">{{ session('error') }}</p>
    @endif

    <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div>
        <label class="block text-sm font-medium leading-5 text-gray-700 dark:text-gray-200" for="title">
          Title
        </label>

        <div class="mt-1 rounded-md shadow-sm">
          <input
            class="focus:ring-blue block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 transition duration-150 ease-in-out focus:border-blue-300 focus:outline-none dark:border-gray-600 dark:bg-zinc-700 dark:text-zinc-200 sm:text-sm sm:leading-5"
            id="title" name="title" type="text" value="{{ $article->title }}" required autofocus />
        </div>
      </div>

      <div class="mt-6">
        <label class="block text-sm font-medium leading-5 text-gray-700 dark:text-gray-200" for="title">
          Image
        </label>

        <div class="mt-1 rounded-md shadow-sm">
          <input
            class="focus:ring-blue block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 transition duration-150 ease-in-out focus:border-blue-300 focus:outline-none dark:border-gray-600 dark:bg-zinc-700 dark:text-zinc-200 sm:text-sm sm:leading-5"
            id="image" name="image" type="file" accept="image/*" required />
        </div>
      </div>

      <div class="mt-6">
        <label class="block text-sm font-medium leading-5 text-gray-700 dark:text-gray-200" for="content">
          Content
        </label>

        <div class="mt-1 rounded-md shadow-sm">
          <textarea
            class="focus:ring-blue block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 transition duration-150 ease-in-out focus:border-blue-300 focus:outline-none dark:border-gray-600 dark:bg-zinc-700 dark:text-zinc-200 sm:text-sm sm:leading-5"
            id="content" name="content" rows="6">{{ $article->content }}</textarea>
        </div>
      </div>

      <div class="mt-6">
        <label class="block text-sm font-medium leading-5 text-gray-700 dark:text-gray-200" for="category">
          Category
        </label>

        <div class="mt-1 rounded-md shadow-sm">
          <select
            class="focus:ring-blue block w-full rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 transition duration-150 ease-in-out focus:border-blue-300 focus:outline-none dark:border-gray-600 dark:bg-zinc-700 dark:text-zinc-200 sm:text-sm sm:leading-5"
            id="category" name="category" value="{{ $article->category_id }}" required>
            <option disabled selected>Select a category</option>
            @foreach ($categories as $category)
              @if ($category->id == $article->category_id)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
              @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endif
            @endforeach
          </select>
        </div>
      </div>

      <div class="mt-6">
        <span class="block w-full rounded-md shadow-sm">
          <button
            class="focus:ring-indigo flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out hover:bg-indigo-500 focus:border-indigo-700 focus:outline-none active:bg-indigo-700"
            type="submit">
            Edit
          </button>
        </span>
      </div>
    </form>
  </div>
@endsection
