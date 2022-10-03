@extends('layouts.dashboard')

@section('content')
  <div class="inline-flex w-full items-center justify-between">
    <div class="inline-flex flex-1">
      <button onclick="history.back();">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
      </button>
      <p class="ml-4 flex-1 text-2xl md:text-4xl font-bold">{{ $article->title }}</p>
    </div>
  </div>

  <div class="py-8 md:mx-8">
    <div class="flex flex-col">
      <div class="inline-flex justify-between items-center">
        <div class="flex flex-col">
          <a class="font-semibold hover:text-indigo-600"
            href="{{ route('home', ['author' => $article->user->name]) }}">{{ $article->user->name }}</a>
          <div class="inline-flex
            gap-2 text-gray-400 dark:text-zinc-400">
            <p>@datetime($article->created_at)</p>
            <span>&middot;</span>
            <a class="hover:text-indigo-600"
              href="{{ route('home', ['category' => $article->category->name]) }}">{{ $article->category->name }}</p>
          </div>
        </div>

        @if ($article->user_id === auth()->id())
          <a class="text-indigo-600 hover:text-indigo-500" href="{{ route('article.edit', $article->id) }}">Edit
            Article</a>
        @endif
      </div>
    </div>
    <img class="mt-4" src="{{ asset($article->image) }}" width="100%" />

    <p class="mt-4 whitespace-pre-line">{{ $article->content }}</p>
  </div>
@endsection
