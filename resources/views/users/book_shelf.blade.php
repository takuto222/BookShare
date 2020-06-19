<select class="item-selection form-control mb-5">
  <option class="like">いいね</option>
  <option class="book-mark">ブックマーク</option>
</select>

<div id="like-articles-wrapper">
  <ul id="shelf-like-container" class="row align-content-start">
    @foreach($like_articles as $article)
    <li class="col-md-4 article-wrapper shelf-like-item">
      @include('users.article')
    </li>
    @endforeach
  </ul>
  <ul id="shelf-like-pagination"></ul>
</div>

<div id="bookmark-articles-wrapper" class="hidden">
  <ul id="shelf-bm-container" class="row align-content-start">
    @foreach($bookmark_articles as $article)
    <li class="col-md-4 article-wrapper shelf-bm-item">
      @include('users.article')
    </li>
    @endforeach
  </ul>
  <ul id="shelf-bm-pagination"></ul>
</div>
