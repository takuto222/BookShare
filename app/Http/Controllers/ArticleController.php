<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::where('status', 1)->orderBy('created_at', 'DESC')->paginate(9);

        return view('articles.index', ['articles' => $articles]);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = $request->user()->id;
        // アップされた本の画像、添付ファイルをハッシュ化してから保存
        if ($request->hasFile('book_img')) {
            $request->file('book_img')->store('/public/images');
            $article->book_img = $request->file('book_img')->hashName();
        } else {
            // 本の画像がアップされてないときはデフォルトを使用
            $article->book_img = $request->default_book_image;
        }
        // 100M以内のファイル
        if ($request->hasFile('upfile')) {
            $request->file('upfile')->store('/public/images');
            $article->upfile = $request->file('upfile')->hashName();
        }
        // 100M以上の動画ファイル
        if ($request->upmovie_url) {
            $article->upfile = $request->upmovie_url;
        }

        $article->save();
        return redirect()->route('articles.index');
    }

    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article]);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());

        // アップされた本の画像、添付ファイルをハッシュ化してから保存
        if ($request->hasFile('book_img')) {
            $request->file('book_img')->store('/public/images');
            $article->book_img = $request->file('book_img')->hashName();
        } else {
            // 本の画像がアップされてないときはデフォルトを使用
            $article->book_img = $request->default_book_image;
        }
        // 100M以上の動画ファイル
        if ($request->upmovie_url) {
            $article->upfile = $request->upmovie_url;
        }
        // 100M以内のファイル
        if ($request->hasFile('upfile')) {
            $request->file('upfile')->store('/public/images');
            $article->upfile = $request->file('upfile')->hashName();
        }

        $article->save();
        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        # ファイル類も削除するか検討
        $article->delete();
        return redirect()->route('articles.index');
    }

    public function show(Article $article)
    {
        return view('articles.show', ['article' => $article]);
    }

}
