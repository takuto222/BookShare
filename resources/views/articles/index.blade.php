@extends('app')

@section('title', '記事一覧')

@section('css')
    <link href="{{ asset('css/articles/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="article-contents container">
  <!-- slide show -->
  <div class="slide-show">
    <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel" data-interval="10000">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="{{ asset('images/slide-1.jpg') }}" alt="第1スライド">
        </div>
        <div class="carousel-item" data-interval="10000">
          <img class="d-block w-100" src="{{ asset('images/slide-2.jpg') }}" alt="第2スライド">
        </div>
        <div class="carousel-item" data-interval="10000">
          <img class="d-block w-100" src="{{ asset('images/slide-3.jpg') }}" alt="第3スライト">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">前へ</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">次へ</span>
      </a>
    </div>
  </div>

  <!-- main content -->
  <div class="main-contents">
      <div class="main-content">
        @include('articles.book-list')
      </div>
      <div class="side-content">
        @include('sidemenu')
      </div>
  </div>

  <!-- news -->
  <div class="news">
    <h2 class="heading">NEWS</h2>
    <ul class="scroll-list">
        <li class="scroll-item">
        <a href="#">
          <time class="date" datetime="2015-08-23">2015.08.23 SUN</time>
          <span class="category news">NEWS</span>
          <span class="title">WORKSを更新しました。</span>
        </a>
        </li>
        <li class="scroll-item">
        <a href="#">
          <time class="date" datetime="2015-08-12">2015.08.12 WED</time>
          <span class="category">TOPIC</span>
          <span class="title">CSSでここまでできる！？ホントに使えるCSSセレクタ10選！</span>
        </a>
        </li>
        <li class="scroll-item">
        <a href="#">
          <time class="date" datetime="2015-08-04">2015.08.04 TUE</time>
          <span class="category news">NEWS</span>
          <span class="title">TOPICSを更新しました。</span>
        </a>
        </li>
        <li class="scroll-item">
        <a href="#">
          <time class="date" datetime="2015-07-25">2015.07.25 SAT</time>
          <span class="category">TOPIC</span>
          <span class="title">HTML/CSSコーディングと切っても切れないWebブラウザのシェア動向をチェックしよう</span>
        </a>
        </li>
        <li class="scroll-item">
        <a href="#">
          <time class="date" datetime="2015-07-09">2015.07.09 THU</time>
          <span class="category">TOPIC</span>
          <span class="title">HTML5の新しい属性で手軽にフォームバリデーション</span>
        </a>
        </li>
        <li class="scroll-item">
        <a href="#">
          <time class="date" datetime="2015-06-30">2015.06.30 TUE</time>
          <span class="category news">NEWS</span>
          <span class="title">WORKSを更新しました。</span>
        </a>
        </li>
    </ul>
  </div>

</div>
@endsection