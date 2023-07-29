// deleteIcons変数の宣言を削除する
// const deleteIcons = document.querySelectorAll('.delete-icon');

// 新たな変数名を使用する
const deleteButtons = document.querySelectorAll('.delete-icon');
deleteButtons.forEach(button => {
  button.addEventListener('click', () => {
    const reservationId = button.dataset.reservationId;
    deleteReservation(reservationId);
  });
});

function deleteReservation(reservationId) {
  fetch(`/reservations/delete`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({ reservationId: reservationId })
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        const reservationCard = document.querySelector(`.blue-reservation-card[data-reservation-id="${reservationId}"]`);
        if (reservationCard) {
          reservationCard.remove();
        }
      } else {
        console.error('予約の削除中にエラーが発生しました。');
      }
    })
    .catch(error => {
      console.error('予約の削除中にエラーが発生しました:', error);
    });
}
