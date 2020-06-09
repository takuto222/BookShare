
<div class="book-list-wrapper container">
  @for ($i = 0; $i < 3; $i++)
  <h2 class="heading">本のカテゴリ</h2>
  <div id="carousel-card{{$i}}" class="carousel slide" data-interval="false">
    <ol class="carousel-indicators">
      <li data-target="#carousel-card{{$i}}" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-card{{$i}}" data-slide-to="1"></li>
      <li data-target="#carousel-card{{$i}}" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
      @for ($j = 0; $j < 3; $j++)
        @if($j===0)
        <div class="carousel-item px-5 active">
        @else
        <div class="carousel-item px-5">
        @endif
          <div class="row">
            <div class="col-4">
              <div class="card">
                <img class="card-img-top" src="https://placehold.it/200x200" alt="Card image cap">
                <div class="card-body">
                  <h3 class="card-title">book title{{$j*3+1}}</h3>
                  <p>著者</p>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="card">
                <img class="card-img-top" src="https://placehold.it/200x200" alt="Card image cap">
                <div class="card-body">
                  <h3 class="card-title">book title{{$j*3+2}}</h3>
                  <p>著者</p>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="card">
                <img class="card-img-top" src="https://placehold.it/200x200" alt="Card image cap">
                <div class="card-body">
                  <h3 class="card-title">book title{{$j*3+3}}</h3>
                  <p>著者</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endfor
    </div>

    <a class="carousel-control-prev" href="#carousel-card{{$i}}" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-card{{$i}}" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  @endfor
</div>

<style>
.book-list-wrapper {
  width: 100%;
  margin: -30px 0 0 0;
  padding: 0;
}
}
.book-list-wrapper .heading {
  width: 100%;
  margin: 0;
  padding: 0;
}
.book-list-wrapper .slide {
  /* margin-bottom: 30px; */
}
.book-list-wrapper .heading {
  margin-top: 30px;
  margin-right: 10px;
}

</style>
