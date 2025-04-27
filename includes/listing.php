<?php
// listing.php

// 1. Include your database configuration
require_once 'database_connect.php';

// 2. Helper: renders star ratings out of 5
function generateStars($rating) {
    $full = floor($rating);
    $half = ($rating - $full) >= 0.5 ? 1 : 0;
    $empty = 5 - $full - $half;
    return str_repeat('★', $full) . ($half ? '½' : '') . str_repeat('☆', $empty);
}

// 3. Fetch all properties along with city name and alias id
$sql = "
    SELECT 
        p.*, 
        p.id AS property_id,
        c.name AS city_name
    FROM properties p
    LEFT JOIN cities c ON p.city_id = c.id
    ORDER BY p.id DESC
";
$stmt  = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// 4. Filesystem path to your uploads folder (on disk)
$uploadDir = realpath(__DIR__ . '/../uploads/') . '/';

// 5. Web‐facing URL to your uploads folder
$uploadUrl = 'uploads/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Featured PG Listings</title>
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
      width: calc(100% / 3 - 20px);
      background-color: #292929;
      border-radius: 10px;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      flex-shrink: 0;
      cursor: pointer;
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
</head>
<body>
  <div class="pg-wrapper">
    <div class="header-section">
      <h1>Featured PG Listings</h1>
      <p>Discover our handpicked selection of quality PG accommodations</p>
    </div>

    <div class="outer-box">
      <div class="pg-header">
        <button class="view-all-btn" onclick="scrollToEnd()">View All Listings</button>
      </div>

      <div class="card-container" id="pgScroll">
        <?php while ($row = $result->fetch_assoc()):
            $filename = $row['file'] ?? '';
            $filename = str_replace('uploads/', '', $filename);
            $filePath = $uploadDir . $filename;

            if ($filename && file_exists($filePath)) {
                $imageSrc = $uploadUrl . rawurlencode($filename);
            } else {
                $imageSrc = $uploadUrl . 'bg2.jpg';
            }

            $typeLabel = $row['pg_type'] 
                       ?? $row['type'] 
                       ?? 'Not specified';

            $avgRating = isset($row['rating_clean'], $row['rating_food'], $row['rating_safety'])
                       ? ($row['rating_clean'] + $row['rating_food'] + $row['rating_safety']) / 3
                       : 0;
        ?>

        <div class="pg-card" data-property-id="<?= $row['property_id'] ?>">
          <img src="<?= htmlspecialchars($imageSrc) ?>" alt="<?= htmlspecialchars($row['name']) ?>" />
          <div class="pg-details">
            <div class="pg-name"><?= htmlspecialchars($row['name']) ?></div>
            <div class="pg-location"><?= htmlspecialchars($row['city_name']) ?></div>
            <div class="pg-type"><?= htmlspecialchars($typeLabel) ?></div>
            <div class="pg-rent">₹<?= number_format($row['rent']) ?>/month</div>
            <div class="pg-rating"><?= generateStars($avgRating) ?></div>
          </div>
        </div>

        <?php endwhile; ?>
      </div>
    </div>

    <script>
      document.querySelectorAll('.pg-card').forEach(card => {
        card.addEventListener('click', () => {
          const id = card.dataset.propertyId;
          window.location.href = 'property_detail.php?property_id=' + id;
        });
      });

      function scrollToEnd() {
        const scrollBox = document.getElementById('pgScroll');
        scrollBox.scrollLeft += scrollBox.clientWidth;
      }
    </script>
  </div>
</body>
</html>

<?php
// 6. Clean up
$stmt->close();
$conn->close();
?>
