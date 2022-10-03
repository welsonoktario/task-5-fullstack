@extends('layouts.dashboard')

@section('content')
<p class="text-4xl font-bold">My latest articles</p>

<div class="grid grid-cols-4 gap-8 w-auto mt-8">
    @foreach ($articles as $article)
        <figure class="w-auto bg-gray-300 dark:bg-zinc-800 shadow-lg rounded-lg overflow-hidden">
            <img src="{{ $article->image }}" alt="{{ $article->title }}">
            <figcaption class="p-4 text-xl font-semibold">
                <a href="{{ route('article.show', $article->id) }}">{{ $article->title }}</a>
            </figcaption>
        </figure>
    @endforeach
</div>
@endsection
