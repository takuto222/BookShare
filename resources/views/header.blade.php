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
          <li class="nav-item">
            <a class="login nav-link" href=""><i class="login-icon fas fa-sign-in-alt fa-2x"></i></a>
          </li>
          <li class="nav-item">
            <a class="register nav-link" href=""><i class="reg-icon fas fa-user-plus fa-2x"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
