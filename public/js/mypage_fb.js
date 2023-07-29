function toggleFavorite(event, isFavorite) {
  event.target.classList.toggle('clicked');

  var storeId = event.target.getAttribute('data-store-id');
  var userId = event.target.getAttribute('data-user-id');

  if (event.target.classList.contains('clicked')) {
    if (!isFavorite) {
      addFavorite(userId, storeId);
    }
  } else {
    if (isFavorite) {
      removeFavorite(storeId);
    }
  }
}

function removeFavorite(storeId) {
  fetch(`/favorites/remove/${storeId}`, {
    method: 'DELETE',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
  })
    .then(response => {
      if (response.ok) {
        console.log('お気に入りが削除されました');
      } else {
        console.error('お気に入りの削除に失敗しました');
      }
    })
    .catch(error => {
      console.error('エラー:', error);
    });
}

function deleteReservation(reservationId) {
  fetch(`/reservations/delete`, {
    method: 'DELETE',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({ reservationId: reservationId })
  })
    .then(response => {
      if (response.ok) {
        const reservationCard = document.querySelector(`.blue-reservation-card[data-reservation-id="${reservationId}"]`);
        if (reservationCard) {
          reservationCard.remove();
        }
        console.log('予約が削除されました');
      } else {
        console.error('予約の削除に失敗しました');
      }
    })
    .catch(error => {
      console.error('エラー:', error);
    });
  
  // mypage_fb.js

// ... 他のコード ...

function deleteReservation(reservationId) {
    // 予約カードを削除するAjaxリクエストを送信
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/store/evaluate/complete`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ reservation_id: reservationId })
    })
    .then(response => response.json())
    .then(data => {
        // 予約カードを削除
        const reservationCard = document.querySelector(`[data-reservation-id="${reservationId}"]`);
        if (reservationCard) {
            reservationCard.remove();
        }
    })
    .catch(error => {
        console.error('Error deleting reservation:', error);
    });
}

}
