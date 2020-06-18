@extends('app')

@section('title', $user->name)



@section('content')

@include('header')

@include('users.user')

<div class="container">
  <div class="">
    <div class=""></div>
  </div>
  <ul class="nav nav-tabs nav-justified md-tabs" id="user-page-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link user-page-nav-link active" id="profile-link" data-toggle="tab" href="#profile" role="tab"><i class="fas fa-user fa-2x pr-2"></i>プロフィール</a>
    </li>
    <li class="nav-item">
      <a class="nav-link user-page-nav-link" id="book-shelf-link" data-toggle="tab" href="#book-shelf" role="tab" aria-controls="profile-just" aria-selected="false"><i class="fas fa-book fa-2x pr-3"></i>本棚</a>
    </li>
    <li class="nav-item">
      <a class="nav-link user-page-nav-link" id="post-article-link" data-toggle="tab" href="#post-articles" role="tab" aria-controls="contact-just"
        aria-selected="false"><i class="fas fa-file-alt fa-2x pr-3"></i>投稿記事</a>
    </li>
    <li class="nav-item">
      <a class="nav-link user-page-nav-link" id="review-link" data-toggle="tab" href="#reviews" role="tab" aria-controls="contact-just"
        aria-selected="false"><i class="fas fa-graduation-cap fa-2x pr-2"></i>レビュー</a>
    </li>
  </ul>
  <div class="tab-content pt-5" id="myTabContentJust">
    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="home-tab-just">
      @include('users.profile')
    </div>
    <div class="tab-pane fade" id="book-shelf" role="tabpanel" aria-labelledby="profile-tab-just">
      @include('users.book_shelf')
    </div>
    <div class="tab-pane fade" id="post-articles" role="tabpanel" aria-labelledby="contact-tab-just">
      @include('users.post_articles')
    </div>
    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="contact-tab-just">
      @include('users.reviews')
    </div>
  </div>
</div>
@endsection
