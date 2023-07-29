// star.js

// 評価の星をクリックしたときの処理
function handleStarClick(selectedRating) {
  // 選択した星の数に応じて評価点数を設定
  for (let i = 1; i <= 5; i++) {
    const star = document.querySelector(`.star:nth-child(${i})`);
    if (i <= selectedRating) {
      star.classList.add('active'); // クリックされた星とその前の星を黄色にする
    } else {
      star.classList.remove('active'); // それ以外の星はグレーにする
    }
  }

  // フォームのhidden inputに評価点数を設定
  const ratingInput = document.getElementById('rating');
  if (ratingInput) {
    ratingInput.value = selectedRating;
  }
}

// ページロード時に評価の星のクリックイベントを設定
document.addEventListener('DOMContentLoaded', function () {
  const stars = document.querySelectorAll('.star');
  stars.forEach(star => {
    star.addEventListener('click', function () {
      const selectedRating = parseInt(star.getAttribute('data-value'));
      handleStarClick(selectedRating);
    });
  });
});

// レビューの表示後に評価の星の初期表示を設定
document.addEventListener('DOMContentLoaded', function () {
  const reviews = document.querySelectorAll('.reviews .rating');
  reviews.forEach((review, index) => {
    const selectedRating = parseInt(review.getAttribute('data-rating'));
    const stars = review.querySelectorAll('.star');
    stars.forEach(star => {
      const value = parseInt(star.getAttribute('data-value'));
      if (value <= selectedRating) {
        star.classList.add('active');
      } else {
        star.classList.remove('active');
      }
    });
  });
});
