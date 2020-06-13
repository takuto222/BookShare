<div class="media article-info">
  <svg class="bd-placeholder-img mr-3" width="64" height="64" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 64x64"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"/><text x="50%" y="50%" fill="#dee2e6" dy=".3em">64x64</text></svg>
  <div class="media-body">
    <h2 class="article-title mt-3 mb-2">{{ $article->title }}</h2>
    <p>投稿者：{{  Auth::user()->name }}</p>
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
        <div class="book-mark">
          <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">いいね</button>
          <button type="button" class="btn btn-primary ml-5" data-toggle="button" aria-pressed="false" autocomplete="off">後で読む</button>
          <button type="button" class="btn btn-primary ml-5" data-toggle="button" aria-pressed="false" autocomplete="off">お気に入り</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="main-content-wrapper mt-5">
  <h2 class="item-label">見出し</h2>
  <div class="border text-justify p-3">{!! nl2br($article->caption ?? '') !!}</div>
  <h2 class="item-label">本文</h2>
  <div class="border text-justify p-3">{!! nl2br($article->body ?? '') !!}</div>

  @isset($article->body)
    <h2 class="input-header hidden"></h2>
    @if (URL::isValidUrl($article->upfile))
    @php
      $keys = parse_url($article->upfile);
      $path = explode("/", $keys['path']);
      $url = "https://www.youtube.com/embed/".end($path);
    @endphp
    <div class="embed-responsive embed-responsive-16by9">
      <iframe
        title="existing_attachment"
        class="embed-responsive-item mt-3"
        src="{{ $url }}"
        frameborder="0"
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
        class="embed-responsive-item mt-3"
        src="{{ asset('storage/images/'.$article->upfile) }}"
        frameborder="0"
        allow="accelerometer; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen
        >
      </iframe>
    </div>
    @endif
  @endisset
</div>
