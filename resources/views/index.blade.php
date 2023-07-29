<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/index_style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/menu_win.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/menu.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/menu.js') }}"></script>
  <script src="{{ asset('js/favorite.js') }}"></script>
  <script src="{{ asset('js/deta.js') }}"></script>


  <title>home</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<body>
  <div class="header">
    <div class="menu-button" onclick="openMenuModal()">
      <span class="menu-icon"></span>
      <span class="site-name">Rese</span> <!-- 追加 -->
    </div>
    <div id="menu-modal" class="modal">
      <div class="modal-content">
        <span class="modal-close" onclick="closeMenuModal()">&times;</span>
        <ul>
          <li><a href="{{ route('index') }}">Home</a></li>
          @guest
          <li><a href="{{ route('register') }}">Register</a></li>
          <li><a href="{{ route('login') }}">Login</a></li>
          @endguest
          @auth
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
          <li><a href="{{ route('mypage') }}">Mypage</a></li>
          @endauth
        </ul>
      </div>
    </div>
    <div class="search-card">
      <form action="{{ route('search') }}" method="GET">
        <select name="area" id="area">
          <option value="all">All area</option>
          <option value="1">東京都</option>
          <option value="2">大阪府</option>
          <option value="3">福岡県</option>
        </select>

        <select name="genre" id="genre">
          <option value="all">All genre</option>
          <option value="1">寿司</option>
          <option value="2">焼肉</option>
          <option value="3">居酒屋</option>
          <option value="4">イタリアン</option>
          <option value="5">ラーメン</option>
        </select>

        <div class="keyword-search">
          <img class="keyword-icon" src="images/mushi.svg" alt="検索" onclick="submitForm()" width="20" height="20">
          <input type="text" name="keyword" id="keyword">
        </div>
      </form>
    </div>
  </div>
  <script>
    function submitForm() {
      document.querySelector('.search-card form').submit();
    }

    document.addEventListener('keydown', function(event) {
      if (event.keyCode === 13) {
        event.preventDefault();
        submitForm();
      }
    });
  </script>

  @foreach ($stores as $store)
  <div class="card">
    <div class="card-body">
      <img src="{{ $store->shop_image }}" alt="店の画像">
      <div class="info_card" style="margin-top: 10px;">
        <h4>{{ $store->name }}</h4>
        <div class="store-details" style="margin-top: 10px;">
          <p>#{{ $store->area->name }}</p>
          <p style="margin-left: 5px;">#{{ $store->genre->name }}</p>
        </div>
        <div class="infocard_button">
          <a href="{{ route('store.detail', ['id' => $store->id]) }}" class="btn btn-primary" style="margin-top: 5px;">詳細はこちら</a>
          @auth
          @php
          $isFavorite = in_array($store->id, $favoriteIds);
          @endphp
          <button class="favorite-button{{ $isFavorite ? ' clicked' : '' }}" data-user-id="{{ auth()->user()->id }}" data-store-id="{{ $store->id }}" onclick="toggleFavorite(event)"></button>
          @endauth
        </div>
      </div>
    </div>
  </div>
  @endforeach

</body>

</html>