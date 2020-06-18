@section('css')
    <link href="{{ asset('css/users/show.css') }}" rel="stylesheet">
@endsection
@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>
  <script src="{{ asset('js/users/FollowButton.js') }}"></script>
  <script src="{{ asset('js/users/show.js') }}"></script>
@endsection

<div class="container user-wrapper">
  <div class="user-content">
    <div class="card-body">
      <div class="d-flex flex-row">
        <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
          <i class="fas fa-user-circle fa-3x"></i>
        </a>

        @if( Auth::id() !== $user->id )
        <div class="user-follow" hidden>
          <div class="initial-is-followed-by">{{ $user->isFollowedBy(Auth::user()) }}</div>
          <div class="authorized">{{ Auth::check() }}</div>
          <div class="url">{{ route('users.follow', ['name' => $user->name]) }}</div>
        </div>
        <div class="ml-auto">
          <meta name="token" content="{{ csrf_token() }}">
          <a id="follow-button" class="btn" href="{{ route('users.follow', ['name' => $user->name]) }}">
            <i id="follow-icon" class="fas fa-user-check fa-2x"><p class="ml-2" id="follow-state">フォロー</p></i>
          </a>
        </div>
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
        <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-muted">
          <p id="count-followings">{{ $user->count_followings }} フォロー</p>
        </a>
        <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted">
          <p id="count-followers">{{ $user->count_followers }} フォロワー</p>
        </a>
      </div>
    </div>
  </div>
</div>
