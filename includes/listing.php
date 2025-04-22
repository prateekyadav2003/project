<div class="pg-wrapper">
  <style>
    .pg-wrapper {
      padding: 20px;
      background-color: rgb(255, 255, 255);
      font-family: Arial, sans-serif;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 70vh;
      flex-direction: column;
      font-family;Arial,senserif;
    }

    .pg-wrapper * {
      box-sizing: border-box;
    }

    .outer-box {
      width: 100%;
      max-width: 1200px;
      background-color: rgb(255, 255, 255);
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
      padding: 20px;
      display: flex;
      flex-direction: column;
    }

    .pg-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }

    .pg-header h2 {
      font-size: 24px;
      margin: 0 10px 10px 0;
    }

    .view-all-btn {
      background-color: #4B47D9;
      color: #fff;
      border: none;
      padding: 10px 20px;
      font-size: 14px;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .view-all-btn:hover {
      background-color: #3a36b3;
    }

    .card-container {
      display: flex;
      overflow-x: auto;
      gap: 20px;
      scroll-behavior: smooth;
      padding-bottom: 10px;
    }

    .card-container::-webkit-scrollbar {
      height: 8px;
    }

    .card-container::-webkit-scrollbar-track {
      background: #1e1e1e;
      border-radius: 4px;
    }

    .card-container::-webkit-scrollbar-thumb {
      background: #4B47D9;
      border-radius: 4px;
    }

    .pg-card {
  width: calc(100% / 3 - 20px); /* Show 3 cards at a time */
  background-color: #292929;
  border-radius: 10px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  flex-shrink: 0;
}


    .pg-card:hover {
      transform: scale(1.03);
      box-shadow: 0 8px 20px rgba(75, 71, 217, 0.5);
    }

    .pg-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .pg-details {
      padding: 15px;
    }

    .pg-name {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 8px;
      color: #ffffff;
    }

    .pg-location,
    .pg-type,
    .pg-rent {
      font-size: 14px;
      color: #cccccc;
      margin-bottom: 5px;
    }

    .pg-rent {
      color: #4B47D9;
      font-weight: bold;
    }

    .pg-rating {
      margin-top: 8px;
      color: #FFD700;
      font-size: 16px;
    }

    @media (max-width: 600px) {
      .pg-card {
        min-width: 250px;
      }
    }

    .header-section {
      text-align: center;
      margin-bottom: 40px;
    }

    .header-section h1 {
      font-size: 32px;
      color: #333;
      margin-bottom: 10px;
    }

    .header-section p {
      font-size: 16px;
      color: #777;
    }
  </style>

  <div class="header-section">
    <h1>Featured PG Listings</h1>
    <p>Discover our handpicked selection of quality PG accommodations</p>
  </div>

  <div class="outer-box">
    <div class="pg-header">
      <button class="view-all-btn" onclick="scrollToEnd()">View All Listings</button>
    </div>

    <div class="card-container" id="pgScroll">
      <!-- PG Cards -->
      <div class="pg-card">
        <img src="img/bg.png" alt="PG Image">
        <div class="pg-details">
          <div class="pg-name">Sunrise PG</div>
          <div class="pg-location">Gorakhpur</div>
          <div class="pg-type">Single Room</div>
          <div class="pg-rent">₹5000/month</div>
          <div class="pg-rating">★★★★☆</div>
        </div>
      </div>

      <div class="pg-card">
        <img src="img/bg.png" alt="PG Image">
        <div class="pg-details">
          <div class="pg-name">Urban Stay</div>
          <div class="pg-location">Lucknow</div>
          <div class="pg-type">Double Room</div>
          <div class="pg-rent">₹6500/month</div>
          <div class="pg-rating">★★★☆☆</div>
        </div>
      </div>

      <div class="pg-card">
        <img src="img/bg.png" alt="PG Image">
        <div class="pg-details">
          <div class="pg-name">City Comfort</div>
          <div class="pg-location">Kanpur</div>
          <div class="pg-type">Triple Room</div>
          <div class="pg-rent">₹4500/month</div>
          <div class="pg-rating">★★★★★</div>
        </div>
      </div>

      <div class="pg-card">
        <img src="img/bg.png" alt="PG Image">
        <div class="pg-details">
          <div class="pg-name">Girls Nest</div>
          <div class="pg-location">Varanasi</div>
          <div class="pg-type">Single Room</div>
          <div class="pg-rent">₹5200/month</div>
          <div class="pg-rating">★★★☆☆</div>
        </div>
      </div>

      <div class="pg-card">
        <img src="img/bg.png" alt="PG Image">
        <div class="pg-details">
          <div class="pg-name">Boys Home</div>
          <div class="pg-location">Prayagraj</div>
          <div class="pg-type">Double Room</div>
          <div class="pg-rent">₹4800/month</div>
          <div class="pg-rating">★★★★☆</div>
        </div>
      </div>

      <div class="pg-card">
        <img src="img/bg.png" alt="PG Image">
        <div class="pg-details">
          <div class="pg-name">Shiv Residency</div>
          <div class="pg-location">Noida</div>
          <div class="pg-type">AC Room</div>
          <div class="pg-rent">₹7500/month</div>
          <div class="pg-rating">★★★☆☆</div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function scrollToEnd() {
      const scrollBox = document.getElementById("pgScroll");
      scrollBox.scrollLeft += 500;
    }
  </script>
</div>
