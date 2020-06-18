<div id="post-articles-wrapper">
  <ul id="post_container" class="row justify-content-center container item-container">
    @foreach($post_articles as $article)
    <li class="col-md-4 article-wrapper post-item">
      <div class="card mb50">
        <a href="{{ route('articles.show', ['article' => $article]) }}">
          <div class="card-body article">
            <div class='image-wrapper'>
              @if (URL::isValidUrl($article->book_img))
              <img class='book-image card-img-top' src="{{ $article->book_img }}" alt="本の画像">
              @else
              <img class='book-image card-img-top' src="{{ asset('storage/images/'.$article->book_img) }}" alt="本の画像">
              @endif
            </div>
            <p class='book-title'>{{ $article->title }}</p>
            <p class='author'>
              {{ $article->author }}
            </p>
            <!-- いいね数 -->
            <div class="card-body pt-0 pb-2 pl-1">
              <div class="card-text">
                <div id="article-like">
                  @if ($article->isLikedBy(Auth::user()))
                    <i class="fas fa-heart heart-active"></i> {{ $article->count_likes }}
                  @else
                    <i class="fas fa-heart heart"></i> {{ $article->count_likes }}
                  @endif
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    </li>
    @endforeach
  </ul>
  <ul id="post-pagination"></ul>
</div>
