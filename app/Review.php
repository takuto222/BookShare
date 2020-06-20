<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Review extends Model
{
  protected $fillable = [
      'body',
  ];

  public function user(): BelongsTo
  {
      return $this->belongsTo('App\User');
  }

  public function article(): BelongsTo
  {
      return $this->belongsTo('App\Article');
  }

}
