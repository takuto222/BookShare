<select class="item-selection review-item-selection form-control mb-5">
  <option>公開</option>
  <option>非公開</option>
</select>

<div id="reviews-public-wrapper" >
  <ul id="reviews-public-container" class="p-0 m-0">
    @foreach($public_reviews as $public_review)
    <li class="reviews-public-item">
      <p class="m-1 post-date">{{ $public_review->created_at }}</p>
      <div class="review card mb-5">
        <h5 class="review-title card-header">{{ $public_review->article->title }}</h5>
        <div class="card-body">
          <p class="review-text card-text">{{ $public_review->body }}</p>
        </div>
      </div>
    </li>
    @endforeach
  </ul>
  <ul id="reviews--public-pagination"></ul>
</div>

<div id="reviews-plivate-wrapper" class="hidden">
  <ul id="reviews-private-container" class="p-0 m-0">
    @foreach($private_reviews as $private_review)
    <li class="reviews-private-item">
      <p class="m-1 post-date">{{ $private_review->created_at }}</p>
      <div class="review card mb-5">
        <h5 class="review-title card-header">{{ $private_review->article->title }}</h5>
        <div class="card-body">
          <p class="review-text card-text">{{ $private_review->body }}</p>
        </div>
      </div>
    </li>
    @endforeach
  </ul>
  <ul id="reviews-private-pagination"></ul>
</div>
