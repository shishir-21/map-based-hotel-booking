document.addEventListener('DOMContentLoaded', function () {

  // STEP 1️⃣: Hotels data fetch
  fetch(mbhb_ajax.ajax_url + '?action=mbhb_get_hotels')
    .then(res => res.json())
    .then(hotels => {

      // STEP 2️⃣: Hotel list render
      const container = document.getElementById('hotel-list');
      if (container) {
        container.innerHTML = '';

        hotels.forEach(hotel => {
          container.innerHTML += `
            <div class="hotel-card" style="border:1px solid #ddd;padding:15px;border-radius:10px;margin-bottom:15px;">
              ${hotel.image ? `
                <img src="${hotel.image}"
                     style="width:100%;height:200px;object-fit:cover;border-radius:8px;margin-bottom:10px;">
              ` : ''}
              <h3>${hotel.title}</h3>
              <p>💰 Price: ₹${hotel.price}</p>
            </div>
          `;
        });
      }

      // STEP 3️⃣: Existing markers ke popup replace karo
      attachHotelPopups(hotels);
    });

});


/* ==================================
   STEP 4️⃣: LEAFLET MARKER POPUPS
=================================
