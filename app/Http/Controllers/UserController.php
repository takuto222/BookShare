<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first();

        $like_articles = $user->likes->sortByDesc('created_at');
        $bookmark_articles = $user->bookmarks->sortByDesc('created_at');
        $post_articles = $user->articles->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            'like_articles' => $like_articles,
            'bookmark_articles' => $bookmark_articles,
            'post_articles' => $post_articles,
        ]);
    }

    public function followings(string $name)
    {
        $user = User::where('name', $name)->first();

        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }

    public function followers(string $name)
    {
        $user = User::where('name', $name)->first();

        $followers = $user->followers->sortByDesc('created_at');

        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }

    public function follow(Request $request, string $name)
    {
        // フォローされる側のユーザーのユーザーモデルを取得
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);
        // フォローされる側のユーザ名を返す
        return [
          'name' => $name,
          'countFollowings' => $user->count_followings,
          'countFollowers' => $user->count_followers,
        ];
    }

    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return [
          'name' => $name,
          'countFollowings' => $user->count_followings,
          'countFollowers' => $user->count_followers,
        ];
    }
}
