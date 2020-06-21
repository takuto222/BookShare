<h2 class="article-list-heading heading mr-5">記事一覧</h2>
<div class="row justify-content-center container">
  @foreach($articles as $article)
  <div class="col-md-4 article-wrapper">
    <div class="card mb50">
      @if( Auth::id() === $article->user_id )
      <!-- dropdown -->
      <div class="ml-auto card-text">
        <div class="dropdown">
          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <button type="button" class="btn btn-link text-muted m-0 p-2">
              <i class="fas fa-ellipsis-v"></i>
            </button>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route("articles.edit", ['article' => $article]) }}">
              <i class="fas fa-pen mr-1"></i>記事を更新する
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $article->id }}">
              <i class="fas fa-trash-alt mr-1"></i>記事を削除する
            </a>
          </div>
        </div>
      </div>
      <!-- dropdown -->

      <!-- modal -->
      <div id="modal-delete-{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
              @csrf
              @method('DELETE')
              <div class="modal-body">
                {{ $article->title }}を削除します。よろしいですか？
              </div>
              <div class="modal-footer justify-content-between">
                <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                <button type="submit" class="btn btn-danger">削除する</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->
      @endif

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
  </div>
  @endforeach
</div>

<div class="pagination">{{ $articles->links() }}</div>

<style media="screen">
.article-list-heading {
  padding-right: 30px;
}
.article-wrapper {
  margin-bottom: 30px;
  white-space: nowrap;
  overflow: hidden;
  height: 330px;
}
.article {
  height: 300px;
  overflow: hidden;
}
.book-image {
  height: 200px;
  margin-bottom: 20px;
}
.book-title {
  width: 100%;
  white-space: nowrap;
  overflow: hidden;
  color: #000;
  width: 90%;
  text-overflow: ellipsis;
}
.author {
  width: 100%;
  white-space: nowrap;
  overflow: hidden;
  color: #345edb;
  font-size: 50%;
  text-overflow: ellipsis;
}
.pagination {
  width: 100%;
  margin:20px 40%;
}
.heart-active {
  color: red;
}
.heart {
  color: #7a7a7a;
}
</style>
