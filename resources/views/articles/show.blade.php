@extends('app')

@section('title', '記事詳細')

@section('css')
  <link href="{{ asset('css/articles/show.css') }}" rel="stylesheet">
  <link href="{{ asset('css/articles/article.css') }}" rel="stylesheet">
@endsection
@section('js')
  <script src="{{ asset('js/articles/ArticleIcon.js') }}"></script>
  <script src="{{ asset('js/articles/show.js') }}"></script>
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
    <!-- post review form -->
    <form class="post-review-form" method="POST" action="{{ route('articles.review', ['article' => $article]) }}">
      @csrf
      <div class="form-group">
        <label for="reviewTextarea">レビュー</label>
        <textarea name="body" class="form-control" id="reviewTextarea" rows="15" placeholder="学びを記録しよう"></textarea>
      </div>
      <div class="form-group">
        <div class="form-check m-2">
          <input name="public" class="form-check-input" type="checkbox" id="gridCheck1">
          <label class="form-check-label" for="gridCheck1">
            公開する
          </label>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary btn-lg">投稿</button>
        </div>
      </div>
    </form>
    <!-- display reviews -->
    <h2 class="heading mt-5 mb-3">レビュー</h2>
    <ul class="p-3">
      @foreach($reviews as $review)
      <li class="review-list scroll-item mb-5">
        <div class="media">
          <a class="reviewer-icon" href="{{ route('users.show', ['name' => $review->user->name]) }}">
            <i class="fas fa-user-circle fa-5x mr-3"></i>
            <p class="reviewer">{{ $review->user->name }}</p>
          </a>

          <div class="media-body text_wrapper">
            <p class="post-date">{{ $review->created_at }}</p>
            <p class="review-body text hidden">{{ $review->body }}</p>
            <div class="show_more">
              + 続きを読む
            </div>
          </div>
        </div>
      </li>
      @endforeach
    </ul>
    <div class="d-flex justify-content-center reviews-link">{{ $reviews->links() }}</div>
  </div>

</div>
@endsection

<style media="screen">
.review-list-wrapper {
  background-color: #grey;
}
.text_wrapper {
  position: relative;
  margin-bottom: 45px;
}
.text {
  height: 40px;
  overflow: hidden;
}
.show_more {
  position: absolute;
  bottom: 0px;
  left: 0px;
  width: 100%;
  height: 20px;
  padding-top: 10px;
  text-align: center;
  line-height: 20px;
  background: linear-gradient(
    180deg,
    rgb(255, 255, 255, 0) 0%,
    rgb(255, 255, 255, 1) 70%
  );
  cursor: pointer;
  transition: bottom 0.2s;
}
.active {
  background: none;
  bottom: -10px;
}
.reviews-link {
  margin-left: 15%;
}
.reviewer-icon {
  margin: 0;
  color: #828282;
}
.reviewer {
  text-align: center;
  margin-right: 15%;
  color: #158aea;
}
.post-date {
  display: inline-block;
  color: #828282;
}

</style>
