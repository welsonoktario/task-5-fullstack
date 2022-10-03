<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $userId = Auth::id();

        $articles = Article::query()
            ->paginate()
            ->withQueryString();

        return (new ArticleCollection($articles))->additional([
            'status' => 'OK'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = User::find(Auth::id());

            $article = $user->articles()->create([
                'name' => $request->name
            ]);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            return $this->fail(
                "Terjadi kesalahan menambah artikel.\n\nError: {$e->getMessage()}"
            );
        }

        return $this->success(new ArticleResource($article));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Article $article)
    {
        if (!$article->exists) {
            return $this->fail("Data artikel tidak ditemukan");
        }

        // Load article with it's category
        $article->load('category');

        return $this->success(new ArticleResource($article));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Article $article)
    {
        if ($article->user_id !== Auth::id()) {
            return $this->fail('Unauthenticated', 403);
        }

        DB::beginTransaction();

        try {
            tap(
                $article->update([
                    'title' => $request->title,
                    'content' => $request->content,
                    'image' => $request->image,
                ])
            );

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            return $this->fail(
                "Terjadi kesalahan mengubah artikel.\n\nError: {$e->getMessage()}"
            );
        }

        return $this->success(new ArticleResource($article));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Article $article)
    {
        if ($article->user_id !== Auth::id()) {
            return $this->fail('Unauthenticated', 403);
        }

        DB::beginTransaction();

        try {
            $article->delete();

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            return $this->fail(
                "Terjadi kesalahan menghapus artikel.\n\nError: {$e->getMessage()}"
            );
        }

        return $this->success();
    }
}
