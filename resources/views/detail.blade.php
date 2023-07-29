<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/detail.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/menu_win.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/menu.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/menu.js') }}"></script>
  <script src="{{ asset('js/store.js') }}"></script>
  <title>Document</title>
</head>

<body>
  <div class="menu-button" onclick="openMenuModal()">
    <span class="menu-icon"></span>
    <span class="site-name">Rese</span>
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
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
        <li><a href="{{ route('mypage') }}">Mypage</a></li>
        @endauth
      </ul>
    </div>
  </div>

  <div class="left-section">
    <img src="{{ $store->shop_image }}" alt="店の画像">
    <div class="store_tag">
      <p>#{{ $store->area->name }}</p>
      <p>#{{ $store->genre->name }}</p>
    </div>
    <div class="store_text_gp">
      <p>{{ $store->shop_text }}</p>
    </div>
    @if ($evaluations->count() > 0)
    <div class="reviews">
      <h2>お店のレビュー</h2>
      <ul>
        @foreach ($evaluations as $evaluation)
        <li>
          <p>名前：{{ $evaluation->name }}</p>
          <div class="rating">
            <div class="stars">
              <span class="rating-title">評価：</span>
              @for ($i = 1; $i <= 5; $i++) @if ($i <=$evaluation->rating)
                <span class="star active">&#9733;</span>
                @else
                <span class="star">&#9733;</span>
                @endif
                @endfor
            </div>
          </div>
          <p>コメント：{{ $evaluation->comment }}</p>
          @if (isset($evaluation) && $evaluation->created_at)
          <p class="write-time">書き込み日時: {{ $evaluation->created_at->format('Y年m月d日 H:i') }}</p>
          @endif
        </li>
        @endforeach
      </ul>
    </div>
    @endif

  </div>
  <div class="card">
    <div class="right-section">
      <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <h1 class="reservation-heading">予約</h1>
        @if ($errors->has('date'))
        <div class="alert alert-danger">
          {{ $errors->first('date') }}
        </div>
        @endif

        <input type="date" id="date" name="date" value="{{ old('date') }}" required>
        <br>
        @if ($errors->has('time'))
        <div class="alert alert-danger">
          {{ $errors->first('time') }}
        </div>
        @endif

        <select id="time" name="time" required>
          <option value="">-- 選択してください --</option>
          <option value="10:00">10:00</option>
          <option value="11:00">11:00</option>
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
          <option value="18:00">18:00</option>
          <option value="19:00">19:00</option>
          <option value="20:00">20:00</option>
          <option value="21:00">21:00</option>
          <option value="22:00">22:00</option>
          <option value="23:00">23:00</option>
        </select>
        <br>
        @if ($errors->has('guests'))
        <div class="alert alert-danger">
          {{ $errors->first('guests') }}
        </div>
        @endif

        <select id="guests" name="guests" required>
          <option value="">-- 選択してください --</option>
          <option value="1">1人</option>
          <option value="2">2人</option>
          <option value="3">3人</option>
          <option value="4">4人</option>
          <option value="5">5人</option>
          <option value="6">6人</option>
          <option value="7">7人</option>
          <option value="8">8人</option>
          <option value="9">9人</option>
          <option value="10">10人</option>
        </select>
        <br>
        @if ($errors->has('restaurant_id'))
        <div class="alert alert-danger">
          {{ $errors->first('restaurant_id') }}
        </div>
        @endif

        <div class="store_confir">
          <p>Shop <span class="store-name">{{ $store->name }}</span></p>
          <input type="hidden" name="restaurant_id" value="{{ $store->id }}">
          <p>Date <span id="selected-date" name="selected-date"></span></p>
          <p>Time <span id="selected-time" name="selected-time"></span></p>
          <p>Number <span id="selected-guests" name="selected-guests"></span></p>
        </div>
        <button type="submit">予約する</button>
      </form>
    </div>
  </div>

  </div>
</body>

</html>