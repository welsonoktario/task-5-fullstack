<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Throwable;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $userId = Auth::id();
        $articles = Article::query()
            ->where('user_id', $userId)
            ->get();

        return View::make('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $user = User::find(Auth::id());
        $categories = $user->categories;

        return View::make('article.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = User::find(Auth::id());

            $user->articles()->create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $request->image,
                'category_id' => $request->category
            ]);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            return Redirect::back()
                ->withErrors([
                    'msg' => 'Terjadi kesalahan menambah artikel',
                    'error' => $e->getMessage()
                ])
                ->withInput($request->all());
        }

        return Redirect::route('article.index')->with(
            'status',
            'Artikel berhasil ditambahkan'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Article $article)
    {
        $article->load('category');

        return View::make('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Article $article)
    {
        $article->load('category');
        $user = User::find(Auth::id());
        $categories = $user->categories;

        return View::make('article.create', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        DB::beginTransaction();

        try {
            $article->update([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $request->image,
                'category_id' => $request->category
            ]);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            return Redirect::back()
                ->withErrors([
                    'msg' => 'Terjadi kesalahan mengubah artikel',
                    'error' => $e->getMessage()
                ])
                ->withInput($request->all());
        }

        return Redirect::route('article.index')->with(
            'status',
            'Artikel berhasil diubah'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        DB::beginTransaction();

        try {
            $article->delete();

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            return Redirect::back()
                ->withErrors([
                    'msg' => 'Terjadi kesalahan menghapus artikel',
                    'error' => $e->getMessage()
                ]);
        }

        return Redirect::route('article.index')->with(
            'status',
            'Artikel berhasil dihapus'
        );
    }
}
