<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/menu_win.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/menu.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="{{ asset('js/menu.js') }}"></script>
  <title>Document</title>
  <style>
    .form-container {
      position: absolute;
      top: 40%;
      left: 50%;
      transform: translate(-50%, -50%);
      max-width: 70vw;
      width: 450px;
      height: 280px;
      background-color: white;
      box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .category {
      text-align: center;
      margin-bottom: 40px;
    }

    .category p {
      margin: 0;
      font-size: 22px;
    }

    .index-button {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .btn {
      display: inline-block;
      padding: 8px 30px;
      background-color: rgb(87, 101, 223) !important;
      color: white;
      border-radius: 10px;
      border: none;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
      font-size: 16px;
    }
  </style>
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
  <div class="form-container">
    <div class="category">
      <p class="category-title">ご予約ありがとうございます</p>
    </div>
    <div class="index-button">
      <form method="GET" action="{{ route('index') }}">
        @csrf
        <button type="submit" class="btn">戻る</button>
      </form>
    </div>
  </div>
</body>

</html>