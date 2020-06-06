<!--header-->
<header class="header">
  <!--navigation-->
  <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        <img class='navbar-logo' src="{{ asset('images/logo.png') }}">
        {{ config('app.name', 'Laravel') }}
      </a>

      <form class="search-box">
        <input class="search-input" type="text" name="search" placeholder="書籍名/著者名">
        <input class="search-button" type="submit" value="検索">
      </form>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->

          <!--before login-->
          @guest
          <li class="nav-item">
            <a class="login nav-link" href=""><i class="login-icon fas fa-sign-in-alt fa-2x"></i></a>
          </li>
          <li class="nav-item">
            <a class="register nav-link" href="{{ route('register') }}"><i class="reg-icon fas fa-user-plus fa-2x"></i></a>
          </li>
          @endguest
          <!--after login-->
          @auth
          <!-- Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-bars fa-4x"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
              <div class="login-user-info">
                <i class="fas fa-user-circle mr-4 fa-4x"></i>
                <p class="mt-2">ようこそ,<br>takuto さん</p>
              </div>
              <div class="dropdown-divider"></div>
              <button class="dropdown-item" type="button"
                      onclick="location.href=''">
                <i class="fas fa-pen mr-2 fa-1x"></i>投稿
              </button>
              <div class="dropdown-divider"></div>
              <button class="dropdown-item" type="button"
                      onclick="location.href=''">
                <i class="fas fa-user mr-2 fa-1x"></i>マイページ
              </button>
              <div class="dropdown-divider"></div>
              <button form="logout-button" class="dropdown-item" type="submit">
                <i class="fas fa-sign-out-alt mr-2 fa-1x"></i>ログアウト
              </button>
            </div>
          </li>
          <form id="logout-button" method="POST" action="{{ route('logout') }}">
            @csrf
          </form>
          <!-- Dropdown -->
          @endauth
        </ul>
      </div>
    </div>
  </nav>
</header>
<style>
.dropdown-menu {
  width: 180px;
}
.login-user-info {
  display: flex;
}
</style>
