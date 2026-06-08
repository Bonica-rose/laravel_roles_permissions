<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ArticleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view articles', only: ['index']),
            new Middleware('permission:edit articles', only: ['edit']),
            new Middleware('permission:create articles', only: ['create']),
            new Middleware('permission:delete articles', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(5);
        return view('articles.list', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:255',
            'author' => 'required|string|min:3|max:255',
            'content' => 'nullable|string|max:10000',
        ]);

        // Save the article
        Article::create($request->only('title', 'author', 'content'));

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:255',
            'author' => 'required|string|min:3|max:255',
            'content' => 'nullable|string|max:10000',
        ]);

        $article->update($request->only('title', 'author', 'content'));

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}
