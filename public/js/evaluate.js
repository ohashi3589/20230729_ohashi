    let rating = 0;

    function setRating(selectedRating) {
      for (let i = 1; i <= 5; i++) {
        const star = document.querySelector(`.star:nth-child(${i})`);
        if (i <= selectedRating) {
          star.style.color = '#ffc107'; 
        } else {
          star.style.color = '#ccc';
        }
      }

      rating = selectedRating; 
    
      const ratingInput = document.getElementById('rating');
      if (ratingInput) {
        ratingInput.value = rating;
      }
    }