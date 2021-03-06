<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Article;
use App\Review;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    public function index()
    {
        $articles = Article::where('status', 1)->orderBy('created_at', 'DESC')->paginate(9);

        return view('articles.index', [
          'articles' => $articles,
        ]);
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

    public function show(Article $article, Review $review)
    {
        $reviews = $review->where('article_id', $article->id)->orderBy('created_at', 'DESC')->paginate(9);

        return view('articles.show', [
          'article' => $article,
          'reviews' => $reviews,
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');

        $articles = Article::where('status', 1)
        ->where('title','like','%'.$keyword.'%')
        ->orWhere('author','like','%'.$keyword.'%')
        ->orderBy('created_at', 'DESC')->paginate(9);

        return view('articles.search', [
          'articles' => $articles,
        ]);
    }

    // ============ いいね機能関連のアクション =============

    public function like(Request $request, Article $article)
    {
        // 1人のユーザーが同一記事に複数回重ねていいねを付けられないように
        // するため、detachを追加
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        // 非同期通信に対するレスポンス
        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    public function unlike(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    // ============ ブックマーク機能関連のアクション =============
    public function bookmark(Request $request, Article $article)
    {
        $article->bookmarks()->detach($request->user()->id);
        $article->bookmarks()->attach($request->user()->id);

        return [
            'id' => $article->id,
        ];
    }

    public function unbookmark(Request $request, Article $article)
    {
        $article->bookmarks()->detach($request->user()->id);

        return [
            'id' => $article->id,
        ];
    }

    // ============ レビュー機能関連のアクション =============
    public function review(Request $request, Article $article, Review $review)
    {
        $review->fill($request->all());
        $review->user_id = $request->user()->id;
        $review->article_id = $article->id;
        $review->public = $request->public ? true: false;
        $review->save();
        return redirect()->back();
    }

}
