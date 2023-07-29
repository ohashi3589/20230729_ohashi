<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/menu_win.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/menu.css') }}">
    <script src="{{ asset('js/menu.js') }}"></script>

    <title>Document</title>
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
                    <li><a href="{{ route('index') }}">Mypage</a></li>
                    @endauth
                </ul>
            </div>
        </div>
        <x-guest-layout>
            <div class="flex justify-center items-center h-screen">
                <div class="form-container">
                    <div class="category">
                        <h2 class="category-title">Login</h2>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="w-full p-6">
                        @csrf
                        @method('POST')

                        <!-- Email Address -->
                        <div class="input-container">
                            <img src="{{ asset('images/mail.svg') }}" alt="Icon" class="input-icon">
                            <input id="email" type="email" name="email" value="" placeholder="email" class="block w-full mt-1 border-none border-b-2 border-gray-300 bg-transparent focus:outline-none focus:border-blue-300" required />
                        </div>

                        <!-- Password -->
                        <div class="input-container">
                            <img src="{{ asset('images/key.svg') }}" alt="Icon" class="input-icon">
                            <input id="password" type="password" name="password" value="" placeholder="password" class="block w-full mt-1 border-none border-b-2 border-gray-300 bg-transparent focus:outline-none focus:border-blue-300" required autocomplete="current-password" />
                        </div>

                        <!-- Login Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="btn">ログイン</button>
                        </div>
                    </form>

                </div>
            </div>
        </x-guest-layout>
</body>

</html>