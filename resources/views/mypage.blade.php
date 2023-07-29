<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/mypage.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/menu_win.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/menu.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="{{ asset('js/menu.js') }}"></script>
  <script src="{{ asset('js/mypage_fb.js') }}"></script>
  <script src="{{ asset('js/reservation.js') }}"></script>
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
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <li><a href="{{ route('mypage') }}">Mypage</a></li>
        @endauth
      </ul>
    </div>
  </div>

  @auth
  <h1 class="user-name">{{ auth()->user()->name }}さん</h1>
  @endauth
  <div class="allcard">
    <div class="blue-card">
      <p class="resevations_big_title">予約状況</p>
      <div class="blue_reservations">
        <div class="bulu-container">
          @php
          $sortedReservations = $reservations->sortBy(function ($reservation) {
          return $reservation->reserved_date . ' ' . $reservation->reserved_time;
          });
          $pastReservationCounter = 0; // "来店済み"のカウンター
          $upcomingReservationCounter = 0; // "予約"のカウンター
          @endphp
          @foreach($sortedReservations as $reservation)
          @php
          $now = now(); // 現在の日時を取得
          $reservationDateTime = $reservation->reserved_date . ' ' . $reservation->reserved_time;
          $isPastReservation = $now > $reservationDateTime;
          @endphp
          <div class="blue-reservation-card{{ $isPastReservation ? ' reservation-done' : '' }}" data-reservation-id="{{ $reservation->id }}">
            <div class="resevations_deta">
              <div class="reservation-header">
                <div class="time-icon-container">
                  <img src="/images/time_icon.svg" alt="Time Image" class="time-icon">
                  <div class="circle-overlay"></div>
                </div>
                @if ($isPastReservation)
                @php
                $pastReservationCounter++; // "来店済み"のカウンターをインクリメント
                @endphp
                <p class="reservations_title1">来店済み{{ $pastReservationCounter }}</p>
                @else
                @php
                $upcomingReservationCounter++; // "予約"のカウンターをインクリメント
                @endphp
                <p class="reservations_title2">予約{{ $upcomingReservationCounter }}</p>
                @endif
                @auth
                <button class="delete-icon" onclick="deleteReservation({{ $reservation->id }})">
                  <img src="/images/delete_b.svg" alt="Delete Image" class="no-resize">
                </button>
                @endauth
              </div>
              <div class="reservations_form">
                <form action="{{ route('reservation.update', ['id' => $reservation->id]) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <p><span class="reservation-label">Shop</span> {{ $reservation->restaurant->name }}</p>
                  <p><span class="reservation-label">Date</span> <input type="date" name="reserved_date" value="{{ $reservation->reserved_date }}"></p>
                  <p><span class="reservation-label">Time</span> <input type="time" name="reserved_time" value="{{ $reservation->reserved_time }}"></p>
                  <p><span class="reservation-label">Number</span> <input type="number" name="number_of_guests" value="{{ $reservation->number_of_guests }}"> 人</p>
                  @php
                  $now = now(); // 現在の日時を取得
                  $reservationDateTime = $reservation->reserved_date . ' ' . $reservation->reserved_time;
                  $isPastReservation = $now > $reservationDateTime;
                  @endphp
                  @if ($isPastReservation)
                  <a href="{{ route('store.evaluate', ['id' => $reservation->restaurant->id]) }}" class="evaluate-button">評価する</a>
                  @else
                  <button type="submit">更新</button>
                  @endif
                </form>
              </div>
            </div>
          </div>
          @endforeach
          @if($sortedReservations->count() === 0)
          <p>No reservations found.</p>
          @endif
        </div>
      </div>
    </div>
  <div class="favorite_card">
    <p class="favorite_title">お気に入り店舗</p>
    <div class="card-container">
      @foreach($favoriteStores as $key => $favoriteStore)
      <div class="card_favorite">
        <img src="{{ $favoriteStore->store->shop_image }}" alt="店の画像">
        <div class="info_card" style="margin-top: 10px;">
          <h4>{{ $favoriteStore->store->name }}</h4>
          <div class="store-details" style="margin-top: 10px;">
            <p>#{{ $favoriteStore->store->area->name }}</p>
            <p style="margin-left: 5px;">#{{ $favoriteStore->store->genre->name }}</p>
          </div>
          <div class="infocard_button">
            <a href="{{ route('store.detail', ['id' => $favoriteStore->store->id]) }}" class="btn btn-primary" style="margin-top: 5px;">詳しく見る</a>
            @auth
            <button class="favorite-button clicked" data-user-id="{{ auth()->user()->id }}" data-store-id="{{ $favoriteStore->store->id }}" onclick="toggleFavorite(event, true)"></button>
            @endauth
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  </div>

</body>

</html>