<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first();

        return view('users.show', [
            'user' => $user,
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
