function toggleFavorite(event) {
  event.target.classList.toggle('clicked');

  var storeId = event.target.getAttribute('data-store-id');
  var userId = event.target.getAttribute('data-user-id');

  if (event.target.classList.contains('clicked')) {
    addFavorite(userId, storeId);
  } else {
    removeFavorite(storeId);
  }
}

function addFavorite(userId, storeId) {
  fetch('/favorites/add', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({
      user_id: userId,
      store_id: storeId
    }),
  })
    .then(response => {
      if (response.ok) {
        console.log('お気に入りが追加されました');
        // ここでお気に入りボタンを無効化するなどの処理を行う
      } else {
        console.error('お気に入りの追加に失敗しました');
      }
    })
    .catch(error => {
      console.error('エラー:', error);
    });
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
