<div class="media article-info">
  <svg class="bd-placeholder-img mr-3" width="64" height="64" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 64x64"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"/><text x="50%" y="50%" fill="#dee2e6" dy=".3em">64x64</text></svg>
  <div class="media-body heading">
    <h2 class="article-title mt-2 mb-3">{{ $article->title }}</h2>
    <div class="heding-info">
      <p>投稿者：{{ $article->user->name }},</p>
      <p id="count-likes">いいね数：{{ $article->count_likes }}</p>
    </div>
  </div>
</div>

<div class="article-like" hidden>
  <div class="initial-is-liked-by">{{ $article->isLikedBy(Auth::user()) }}</div>
  <div class="initial-count-likes">{{ $article->count_likes }}</div>
  <div class="authorized"> {{ Auth::check() }} </div>
  <div class="url">{{ route('articles.like', ['article' => $article]) }}</div>
</div>

<div class="row book_info form-group">

  <div class="col-4 drag-drop-area" id="dragDropArea">
    @isset($article->book_img)
      @if (URL::isValidUrl($article->book_img))
      <img id="previewImage" class='book-image card-img-top' src="{{ $article->book_img }}" alt="本の画像">
      @else
      <img id="previewImage" class='book-image card-img-top' src="{{ asset('storage/images/'.$article->book_img) }}" alt="本の画像">
      @endif
    @endisset
  </div>

  <div class="col-8">
    <div class="basic-info-wrapper">
      <table class="table" >
        <tbody>
          <tr class="d-flex">
            <th class="col-2" scope="row">タイトル</th>
            <td class="col-10">{{ $article->title }}</td>
          </tr>
          <tr class="d-flex">
            <th class="col-2" scope="row">著者</th>
            <td class="col-10">{{ $article->author }}</td>
          </tr>
          <tr class="d-flex">
            <th class="col-2" scope="row">出版日</th>
            <td class="col-10">{{ $article->publication_date }}</td>
          </tr>
          <tr class="d-flex">
            <th class="col-2" scope="row">価格</th>
            <td class="col-10">{{ $article->price }}</td>
          </tr>
          <tr class="d-flex">
            <th class="col-2" scope="row">評点</th>
            <td class="col-10">{{ $article->score }}</td>
          </tr>
        </tbody>
      </table>
      <div class="side-wrapper">
        <div class="order-list">
          <h2>本の購入先</h2>
          <ul>
            <li><a href="#"><img src="{{ asset('images/amazon.png') }}" alt="amazon-logo"></a></li>
            <li><a href="#"><img src="{{ asset('images/rakuten.png') }}" alt="rakuten-logo"></a></li>
            <li><a href="#"><img src="{{ asset('images/honto.png') }}" alt="honto-logo"></a></li>
            <li><a href="#"><img src="{{ asset('images/kinokuniya.png') }}" alt="kinokuniya-logo"></a></li>
          </ul>
        </div>

        <div class="icon-list mt-5">
          <meta name="token" content="{{ csrf_token() }}">
          <a href="{{ route('articles.like', ['article' => $article]) }}" id='like' class="mr-5">
            <i id="like-icon" class="fas fa-heart fa-3x icon-btn"></i>
            <p class="icon-label">いいね</p>
          </a>
          <a href="{{ route('articles.index') }}" id='bookmark' class="mr-5">
            <i id="bookmark-icon" class="fas fa-bookmark fa-3x icon-btn"></i>
            <p class="icon-label">ブックマーク</p>
          </a>
          <a href="{{ route('articles.index') }}" id='follow' class="mr-5">
            <i id="follow-icon" class="fas fa-user-plus fa-3x icon-btn"></i>
            <p class="icon-label">フォロー</p>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="main-content-wrapper mt-5">
  <h2 class="item-label">見出し</h2>
  <div class="border text-justify p-3 caption">{!! nl2br($article->caption ?? '') !!}</div>
  <h2 class="item-label">本文</h2>
  <div class="border text-justify p-3 body">{!! nl2br($article->body ?? '') !!}</div>

  @isset($article->body)
    <h2 class="input-header hidden mb-5"></h2>
    @if (URL::isValidUrl($article->upfile))
    @php
      $keys = parse_url($article->upfile);
      $path = explode("/", $keys['path']);
      $url = "https://www.youtube.com/embed/".end($path);
    @endphp
    <div class="embed-responsive embed-responsive-16by9">
      <iframe
        title="existing_attachment"
        class="embed-responsive-item"
        src="{{ $url }}"
        frameborder="2"
        allow="accelerometer; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen
        >
      </iframe>
    </div>
    <a class="file-url" href="{{ $article->upfile }}">{{ $article->upfile }}</a>
    @else
    <div class="embed-responsive embed-responsive-16by9">
      <iframe
        title="existing_attachment"
        class="embed-responsive-item"
        src="{{ asset('storage/images/'.$article->upfile) }}"
        frameborder="2"
        allow="accelerometer; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen
        >
      </iframe>
    </div>
    @endif
  @endisset
</div>
