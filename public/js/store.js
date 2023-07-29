    document.addEventListener('DOMContentLoaded', function() {
      const dateSelect = document.getElementById('date');
      const timeSelect = document.getElementById('time');
      const guestsSelect = document.getElementById('guests');

      const selectedDate = document.getElementById('selected-date');
      const selectedTime = document.getElementById('selected-time');
      const selectedGuests = document.getElementById('selected-guests');

      dateSelect.addEventListener('change', (event) => {
        selectedDate.textContent = event.target.value;
      });

      timeSelect.addEventListener('change', (event) => {
        selectedTime.textContent = event.target.value;
      });

      guestsSelect.addEventListener('change', (event) => {
        selectedGuests.textContent = event.target.value;
      });
    });