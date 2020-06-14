@extends('app')

@section('title', '記事詳細')

@section('css')
    <link href="{{ asset('css/articles/article.css') }}" rel="stylesheet">
@endsection
@section('js')
  <script src="{{ asset('js/articles/ArticleLike.js') }}"></script>
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

  <!-- reviews -->
  <div class="reviews">
    <h2 class="heading mt-5">Reviews</h2>
    <ul class="scroll-list">
      <li class="scroll-item"></li>
    </ul>
  </div>

</div>

<style media="screen">
.slide-show {
  margin-top: -20px;
}
.article-contents-wrapper {
  width: 100%;
  margin: 0 auto;
  padding: 0
}
</style>
@endsection
