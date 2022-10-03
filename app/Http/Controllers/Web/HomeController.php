<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $category = request('category');
        $author = request('author');

        $articles = Article::query()
            ->with(['category', 'user'])
            ->when($category, function ($q) use ($category) {
                return $q->whereHas('category', function ($q) use ($category) {
                    return $q->where('name', 'like', "%$category%");
                });
            })
            ->when($author, function ($q) use ($author) {
                return $q->whereHas('user', function ($q) use ($author) {
                    return $q->where('name', 'like', "%$author%");
                });
            })
            ->orderBy('created_at', 'DESC')
            ->get();

        return View::make('home', compact('articles'));
    }
}
