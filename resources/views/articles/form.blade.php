@csrf
<h2 class="heading book-search-heading">本の検索 (投稿記事の内容を一部自動入力いたします)</h2>
<div class="book-search">
  <div class="input-group md-form form-sm form-1 pl-0">
    <input class="form-control my-0 py-1" id="query-words" type="text" placeholder="Search" aria-label="Search">
    <div class="input-group-prepend">
      <button class="input-group-text blue-gradient lighten-2" id="search" old="search"><i class="fas fa-search text-white"
          aria-hidden="true"></i></button>
    </div>
  </div>

  <h3 class="serch-result-heading">検索結果</h3>
  <div class="search-results-wrapper" id="container">
    <ul id="search-results"></ul>
  </div>

  <ul id="pagination" class="pagination-sm justify-content-center"></ul>
</div>

<h2 class="heading">投稿記事の内容</h2>
<div class="row book_info form-group">

  <div class="col-4 drag-drop-area" id="dragDropArea">
    <div class="drag-drop-inside">
      <p class="drag-drop-info">本の画像をドロップ</p>
      <p>または</p>
      <p class="drag-drop-buttons">
          <input id="fileInput" type="file" accept="image/*" value="ファイルを選択" name="book_img" onChange="photoPreview(event)">
      </p>
      <p class="annotation"><sup>※</sup>本の画像がアップロードされていない場合には、デフォルトのものが使用されます</p>
      <div class="preview" id="previewArea">
      @isset($article->book_img)
        @if (URL::isValidUrl($article->book_img))
        <img id="previewImage" class='book-image card-img-top' src="{{ $article->book_img }}" alt="本の画像">
        @else
        <img id="previewImage" class='book-image card-img-top' src="{{ asset('storage/images/'.$article->book_img) }}" alt="本の画像">
        @endif
      @endisset
      </div>
    </div>
    <div>
      <input id="default_book_image" type="hidden" name="default_book_image" value="{{ old('default_book_image') }}">
    </div>
  </div>

  <div class="col-8">
    <div class="basic-info-wrapper">
      <table border="0">
        <div class="md-form">
          <label for="title">タイトル</label>
          <input type="text" id="title" name="title" class="form-control basic-info" required value="{{ $article->title ?? old('title') }}">
        </div>
        <div class="md-form">
          <label for="author">著者</label>
          <input type="text" id="author" name="author" class="form-control basic-info" required value="{{ $article->author ?? old('author') }}">
        </div>
        <div class="md-form">
          <label for="publication_date">出版日</label>
          <input type="text" id="publication_date" name="publication_date" class="form-control basic-info" required value="{{ $article->publication_date ?? old('publication_date') }}">
        </div>
        <div class="md-form">
          <label for="price">価格</label>
          <input type="text" id="price" name="price" class="form-control basic-info" required value="{{ $article->price ?? old('price') }}">
        </div>
        <div class="md-form">
          <label for="score">評点</label>
          <input type="text" id="score" name="score" class="form-control basic-info" required value="{{ $article->score ?? old('score') }}">
        </div>
      </table>
    </div>
  </div>
</div>

<div class="main-content-wrapper">
  <div class="form-group">
    <label class="input-header">見出し</label>
    <textarea id="caption" name="caption" required class="form-control" rows="8" placeholder="見出し(1000文字以内)">{{ $article->caption ?? old('caption') }}</textarea>
  </div>

  <div class="form-group">
    <label class="input-header">本文</label>
    <textarea name="body" required class="form-control" rows="16" placeholder="本文(2000文字以内)">{{ $article->body ?? old('body') }}</textarea>
  </div>

  @isset($article->body)
    <h2 class="input-header">既存の添付ファイル</h2>
    @if (URL::isValidUrl($article->upfile))
    @php
      $keys = parse_url($article->upfile);
      $path = explode("/", $keys['path']);
      $url = "https://www.youtube.com/embed/".end($path);
    @endphp
    <iframe id="existing_attachment"
      title="existing_attachment"
      width="300"
      height="200"
      src="{{ $url }}"
      frameborder="0"
      allow="accelerometer; encrypted-media; gyroscope; picture-in-picture"
      allowfullscreen>
    </iframe>
    <a class="file-url" href="{{ $article->upfile }}">{{ $article->upfile }}</a>
    @else
    <iframe id="existing_attachment"
      title="existing_attachment"
      width="300"
      height="200"
      src="{{ asset('storage/images/'.$article->upfile) }}"
      frameborder="0"
      allow="accelerometer; encrypted-media; gyroscope; picture-in-picture"
      allowfullscreen>
    </iframe>
    @endif
  @endisset

  <div class="form-group">
    @isset($article)
      <h2 class="input-header">添付ファイルの置き換え（アップロード可能なファイルは１ファイルのみ）</h2>
    @else
      <h2 class="input-header">添付ファイル（アップロード可能なファイルは１ファイルのみ）</h2>
    @endisset
    <label for="file1">添付ファイル : 動画(100M以下), 画像, pdf</label>
    <input type="file" id="upfile" name="upfile" class="form-control-file" accept="video/*, image/*, application/pdf" />
  </div>

  <label for="upmovie-url" class="mt-3">動画へのURL (100Mを超える動画を追加したい場合)</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3">URL：</span>
    </div>
    <input name="upmovie_url" type="text" class="form-control" id="upmovie-url" aria-describedby="basic-addon3">
  </div>
</div>
