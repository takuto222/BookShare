@extends('app')

@section('title', '記事詳細')

@section('css')
  <link href="{{ asset('css/articles/show.css') }}" rel="stylesheet">
  <link href="{{ asset('css/articles/article.css') }}" rel="stylesheet">
@endsection
@section('js')
  <script src="{{ asset('js/articles/ArticleIcon.js') }}"></script>
@endsection

@section('content')
<div class="article-contents-wrapper container">
  <!-- slide show -->
  <div class="slide-show">
  </div>

  <!-- main content -->
  <div class="main-contents">
    <div class="main-content">
      @include('articles.article')
    </div>
  </div>

  <!-- icon-list(like, bookmark icon) -->
  <div class="article-like" hidden>
    <div class="initial-is-liked-by">{{ $article->isLikedBy(Auth::user()) }}</div>
    <div class="initial-count-likes">{{ $article->count_likes }}</div>
    <div class="initial-is-bookmarked-by">{{ $article->isBookmarkedBy(Auth::user()) }}</div>
    <div class="authorized">{{ Auth::check() }}</div>
  </div>

  <div id="iconList" class="icon-list mt-0">
    <meta name="token" content="{{ csrf_token() }}">
    <a href="{{ route('articles.like', ['article' => $article]) }}" id='like' class="mr-5">
      <i id="like-icon" class="fas fa-heart fa-2x icon-btn"></i>
      <p class="icon-label">いいね</p>
    </a>
    <a href="{{ route('articles.bookmark', ['article' => $article]) }}" id='bookmark' class="mr-5">
      <i id="bookmark-icon" class="fas fa-bookmark fa-2x icon-btn"></i>
      <p class="icon-label">ブックマーク</p>
    </a>
  </div>

  <!-- reviews -->
  <div class="reviews">
    <h2 class="heading mt-5">Reviews</h2>
    <ul class="scroll-list">
      <li class="scroll-item"></li>
    </ul>
  </div>

</div>
@endsection
