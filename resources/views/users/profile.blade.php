<div class="introduction card mb-5">
  <h5 class="card-header">自己紹介</h5>
  <div class="card-body">
    <p class="introduction-text card-text">{!! nl2br($profile->self_intro ?? '') !!}</p>
  </div>
</div>

<div class="recommend card mb-5">
  <h5 class="card-header">私のオススメ</h5>
  <div class="card-body">
    <p class="recommend-text card-text">{!! nl2br($profile->recommend ?? '') !!}</p>
  </div>
</div>
