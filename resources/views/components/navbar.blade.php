<nav
  class="fixed top-0 left-0 right-0 shadow-md bg-gray-200 dark:bg-zinc-800 border border-gray-400 dark:border-zinc-700 h-20">
  <div class="container mx-auto h-full font-semibold">
    <div class="inline-flex justify-between w-full h-full items-center">
      <ul class="inline-flex items-center gap-4">
        <li>
          <a class="hover:text-indigo-500 transition-colors @if (request()->route()->getName() == 'home') text-indigo-600 @endif"
            href="{{ route('home') }}">Home</a>
        </li>
        <li>
          <a class="hover:text-indigo-500 transition-colors @if (request()->route()->getName() == 'category.index') text-indigo-600 @endif"
            href="{{ route('category.index') }}">Categories</a>
        </li>
        <li>
          <a class="hover:text-indigo-500 transition-colors @if (request()->route()->getName() == 'article.index') text-indigo-600 @endif"
            href="{{ route('article.index') }}">Articles</a>
        </li>
      </ul>

      <a class="hover:text-indigo-500 transition-colors" href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    </div>
  </div>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
</nav>
