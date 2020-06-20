<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit(User $user)
    {
        $profile = Profile::where('user_id', $user->id)->first();
        return view('users.edit', ['profile' => $profile]);
    }

    public function update(Request $request, User $user)
    {

        $profile = Profile::where('user_id', $user->id)->first() ?: new Profile;

        $profile->self_intro =  $request->self_intro;
        $profile->recommend =  $request->recommend;
        $profile->user_id = $request->user()->id;

        // アップされた本の画像、添付ファイルをハッシュ化してから保存
        if ($request->hasFile('file')) {
            $request->file('file')->store('/public/images');
            $profile->file = $request->file('file')->hashName();
        }

        $profile->save();
        return redirect('/');
    }

    public function show(string $name)
    {
        $user = User::where('name', $name)->first();
        $profile = Profile::where('user_id', $user->id)->first();
        $like_articles = $user->likes->sortByDesc('created_at');
        $bookmark_articles = $user->bookmarks->sortByDesc('created_at');
        $post_articles = $user->articles->sortByDesc('created_at');
        $public_reviews = $user->reviews->where('public',  1)->sortByDesc('created_at');
        $private_reviews = $user->reviews->where('public', 0)->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            'profile' => $profile,
            'like_articles' => $like_articles,
            'bookmark_articles' => $bookmark_articles,
            'post_articles' => $post_articles,
            'public_reviews' => $public_reviews,
            'private_reviews' => $private_reviews,
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
