<link href="{{ asset('css/sidemenu.css') }}" rel="stylesheet">

<div class="sidemenu">
    <h2 class="heading">RANKING</h2>
    <ol class="ranking">
      @foreach($articles as $article)
      <li class="ranking-item">
          <a href="#">
            @if (URL::isValidUrl($article->book_img))
            <img class='image card-img-top' src="{{ $article->book_img }}" alt="本の画像">
            @else
            <img class='book-image card-img-top image' src="{{ asset('storage/images/'.$article->book_img) }}" alt="本の画像">
            @endif
            <span class="order"></span>
            <p class='title'>{{ $article->title }}</p>
          </a>
      </li>
      @endforeach
        </li>
    </ol>
</div>
