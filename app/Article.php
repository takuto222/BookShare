<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    protected $fillable = [
        'title',
        'author',
        'publication_date',
        'price',
        'score',
        'caption',
        'body',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    // ================ いいね機能関係 =================

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }
    // あるユーザがある記事をいいね済みであるかどうかを判定
    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }
    // 現在のいいね数を算出(アクセス時は$article->count_likesとする)
    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }
    //

}
