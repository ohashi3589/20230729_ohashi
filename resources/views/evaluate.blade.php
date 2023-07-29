<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/evaluate.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <title>レストラン評価: {{ $store->name }}</title>
</head>

<body>
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <div class="container">
    <h1 class="restaurant-name">レストラン名: {{ $store->name }}</h1>
    <img class="restaurant-image" src="{{ $store->shop_image }}" alt="レストラン画像">
    <div class="rating">
      <span class="star" onclick="setRating(1)">&#9733;</span>
      <span class="star" onclick="setRating(2)">&#9733;</span>
      <span class="star" onclick="setRating(3)">&#9733;</span>
      <span class="star" onclick="setRating(4)">&#9733;</span>
      <span class="star" onclick="setRating(5)">&#9733;</span>
    </div>
    <p>（１〜５点で点数分の星を選んでください）</p>
    <div class="comment-form">
      <h2>お店のレビューを投稿する</h2>

      <form action="{{ route('store.evaluate', ['id' => $store->id]) }}" method="POST">
        @csrf
        @if(isset($evaluation)) 
        @method('PUT') 
        @endif
        <input type="hidden" id="rating" name="rating" value="{{ isset($evaluation) ? $evaluation->rating : '' }}">
        <div class="form-group">
          <label for="name">お名前</label>
          <input type="text" id="name" name="name" value="{{ isset($evaluation) ? $evaluation->name : '' }}" required>
        </div>
        <div class="form-group">
          <label for="comment">コメント</label>
          <textarea id="comment" name="comment" required>{{ isset($evaluation) ? $evaluation->comment : '' }}</textarea>
        </div>
        <button type="submit">{{ isset($evaluation) ? 'レビューを更新する' : '投稿する' }}</button>
      </form>

    </div>
  </div>
  <script src="{{ asset('js/evaluate.js') }}"></script>
</body>

</html>