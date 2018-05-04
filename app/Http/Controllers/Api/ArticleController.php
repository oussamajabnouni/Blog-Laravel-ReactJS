<?php
namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->is_admin) {
            return Article::loadAll();
        }
        return Article::loadAllMine($request->user()->id);
    }

    public function publishedArticles()
    {
        return Article::loadAllPublished();
    }

    public function publishedArticle($slug)
    {
        return Article::loadPublished($slug);
    }

    public function create()
    {
        //
    }

    public function store(ArticleRequest $request)
    {
        $user = $request->user();

        $article = new Article($request->validated());
        $article->slug = str_slug($request->get('title'));

        $user->articles()->save($article);

        return response()->json($article, 201);
    }

    public function show(Request $request, $id)
    {
        if (!$request->user()->is_admin) {
            return Article::mine($request->user()->id)->findOrFail($id);
        }

        return Article::findOrFail($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(ArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);

        $data = $request->validated();
        $data['slug'] = str_slug($data['title']);
        $article->update($data);

        return response()->json($article, 200);
    }

    public function delete($id)
    {
        $article = Article::findOrFail($id);

        $article->delete();

        return response([], 200);
    }
}
