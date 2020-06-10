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

  <h3 class="serch-result-heading">検索結果：</h3>
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
      <div class="preview" id="previewArea"></div>
    </div>
    <div>
      <input id="default_book_image" type="hidden" name="default_book_image" value="{{ old('default_book_image') }}">
    </div>
  </div>

  <div class="col-8">
    <div class="basic-info-wrapper">
      <table border="0">
        @php
          $item_label_list = array( "タイトル", "著者", "出版日", "価格", "評点");
          $item_index_list = array("title", "author", "publication_date", "price", "score")
        @endphp

        @isset($book_info)
          <!-- for edit request -->
          @foreach ($book_info as $index => $bi)
          <div class="md-form">
            <label for="{{ $item_index_list[$index] }}">{{ $item_label_list[$index] }}</label>
            <input type="text" name="{{ $item_index_list[$index] }}" class="form-control" value="{{ old($item_label_list[$index]) }}" value="{{ $bi }}">
          </div>
          @endforeach
        @else
          @foreach ($item_label_list as $index => $item_label)
          <!-- for  new article creation request -->
          <div class="md-form">
            <label>{{ $item_label }}</label>
            @if ($item_index_list[$index] === "title")
            <input type="text" id="{{ $item_index_list[$index] }}" name="{{ $item_index_list[$index] }}" class="form-control basic-info" required value="{{ old($item_label, '不明') }}">
            @else
            <input type="text" id="{{ $item_index_list[$index] }}" name="{{ $item_index_list[$index] }}" class="form-control basic-info" value="{{ old($item_label, '不明') }}">
            @endif
          </div>
          @endforeach
        @endisset
      </table>
    </div>
  </div>

</div>

<div class="main-content-wrapper">
  <div class="form-group mt-5">
    <label>見出し</label>
    <textarea id="caption" name="caption" required class="form-control" rows="8" placeholder="見出し(1000文字以内)">{{ old('caption') }}</textarea>
  </div>

  <div class="form-group mt-5">
    <label>本文</label>
    <textarea name="body" required class="form-control" rows="16" placeholder="本文(2000文字以内)">{{ old('body') }}</textarea>
  </div>

  <div class="form-group mt-5">
    <label for="file1">添付ファイル : 動画(100M以下), 画像, pdf</label>
    <input type="file" id="upfile" name="upfile" class="form-control-file" accept="video/*, image/*, application/pdf" />
  </div>

  <label for="upmovie-url" class="mt-3">動画へのURL (100Mを超える動画を追加したい場合)</label>
  <div class="input-group mb-5">
    <div class="input-group-prepend">
      <span class="input-group-text " id="basic-addon3">URL：</span>
    </div>
    <input name="upmovie_url" type="text" class="form-control" id="upmovie-url" aria-describedby="basic-addon3">
  </div>
</div>
