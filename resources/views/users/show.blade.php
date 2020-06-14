@extends('app')

@section('title', $user->name)

@section('css')
    <link href="{{ asset('css/users/FollowButton.css') }}" rel="stylesheet">
@endsection
@section('js')
  <script src="{{ asset('js/users/FollowButton.js') }}"></script>
@endsection

@section('content')
  @include('header')
  <div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <div class="d-flex flex-row">
          <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
            <i class="fas fa-user-circle fa-3x"></i>
          </a>

          <div class="user-follow" hidden>
            <div class="initial-is-followed-by">{{ $user->isFollowedBy(Auth::user()) }}</div>
            <div class="authorized">{{ Auth::check() }}</div>
            <div class="url">{{ route('users.follow', ['name' => $user->name]) }}</div>
          </div>

          @if( Auth::id() !== $user->id )
          <meta name="token" content="{{ csrf_token() }}">
          <a id="follow-button" class="ml-auto btn" href="{{ route('users.follow', ['name' => $user->name]) }}">
            <i id="follow-icon" class="fas fa-user-check fa-2x"><p class="ml-2" id="follow-state">フォロー</p></i>
          </a>
          @endif

          @guest
          <!-- Button trigger modal -->
          <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">アラート</h5>
                  <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  フォロー機能はログイン中のみ使用できます
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
              </div>
            </div>
          </div>
          @endguest
          <!-- /Modal -->
        </div>
        <h2 class="h5 card-title m-0">
          <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
            {{ $user->name }}
          </a>
        </h2>
      </div>
      <div class="card-body">
        <div class="card-text">
          <a href="" class="text-muted">
            <p id="count-followings">{{ $user->count_followings }} フォロー</p>
          </a>
          <a href="" class="text-muted">
            <p id="count-followers">{{ $user->count_followers }} フォロワー</p>
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection

<style media="screen">
#follow-button {
  width: 150px;
  height: 50px;
  color: black;
  border: 2px solid #4285f4;
  border-radius: 7px;
}
#follow-button * {
  display: inline-block;
  margin-top: 3px;
}
#follow-button.active {
  border: none;
  background-color: #4285f4;
  color: #fff;
}
#follow-button.active * {
  margin-top: 4px;
}
.text-muted p {
  display: inline-block;
}
</style>
