@extends('layouts.dashboard')

@section('content')
  @php
    $category = request('category');
    $author = request('author');
  @endphp

  <div class="inline-flex w-full items-center justify-between">
    @if ($category)
      <p class="text-2xl md:text-4xl font-bold">Articles from {{ $category }} category</p>
    @elseif ($author)
      <p class="text-2xl md:text-4xl font-bold">Articles from {{ $author }}</p>
    @else
      <p class="text-2xl md:text-4xl font-bold">Latest articles</p>
    @endif
  </div>

  <div class="mt-8 grid w-auto grid-cols-1 md:grid-cols-4 gap-8">
    @foreach ($articles as $article)
      <figure class="w-auto overflow-hidden rounded-lg bg-gray-300 shadow-lg dark:bg-zinc-800">
        <img src="{{ asset($article->image) }}" width="100%" class="h-40 object-cover" alt="{{ $article->title }}">
        <figcaption class="p-4">
          <a class="article-title" href="{{ route('article.show', $article->id) }}">{{ $article->title }}</a>
          <br>
          <div class="flex flex-col mt-4 text-sm font-semibold text-gray-400 dark:text-zinc-300">
            <p>{{ $article->category->name }}</p>
            <p class="mt-2">{{ $article->user->name }}</p>
            <p class="font-normal">@datetime($article->created_at)</p>
          </div>
          <p class="article-content">
            {{ $article->content }}
          </p>
        </figcaption>
      </figure>
    @endforeach
  </div>
@endsection
