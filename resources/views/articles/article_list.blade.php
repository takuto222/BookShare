<h2 class="article-list-heading heaing">記事一覧</h2>
<div class="row justify-content-center container">
  @foreach($articles as $article)
  <div class="col-md-4 article-wrapper">
    <div class="card mb50">
      <a href="#">
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
        </div>
      </a>
    </div>
  </div>
  @endforeach
</div>

<div class="pagination">{{ $articles->links() }}</div>

<style media="screen">
.article-list-heading {
  padding-right: 20px;
}
.article-wrapper {
  margin-bottom: 30px;
  white-space: nowrap;
  overflow: hidden;
}
.article {
  height: 300px;
  overflow: hidden;
}
.book-image {
  height: 200px;
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
</style>
