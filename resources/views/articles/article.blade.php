<div class="media article-info">
  <a href="{{ route('users.show', ['name' => $article->user->name]) }}">
    <img src="{{ asset('images/dummy.png') }}" alt="user-icon" class="width="64" height="64"">
  </a>
  <div class="media-body heading">
    <h2 class="article-title mt-2 mb-3">{{ $article->title }}</h2>
    <div class="heding-info">
      <u><a href="{{ route('users.show', ['name' => $article->user->name]) }}">
        <p>投稿者：{{ $article->user->name }}</p>
      </a></u>
      <p id="count-likes" class="ml-3">いいね数：{{ $article->count_likes }}</p>
    </div>
  </div>
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
