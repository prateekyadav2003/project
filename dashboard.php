<?php
session_start();
require "includes/database_connect.php";

// <------code for view my bookings --------->
// redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
// 1) Handle cancel request
if (isset($_GET['cancel_booking_id'])) {
    $booking_id = intval($_GET['cancel_booking_id']);
    $user_id    = $_SESSION['user_id'];

    // Only cancel if it belongs to this user and is still confirmed
    $stmt = $conn->prepare(
      "UPDATE bookings
          SET status = 'cancelled'
        WHERE id = ? AND user_id = ? AND status = 'confirmed'"
    );
    $stmt->bind_param("ii", $booking_id, $user_id);
    $stmt->execute();

    // Redirect to self to clear the GET parameter
    header("Location: dashboard.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// fetch this user’s bookings, most recent first
$sql = "
  SELECT 
    b.id           AS booking_id,
    b.booked_on,
    b.status,
    p.id           AS property_id,
    p.name         AS property_name,
    p.address,
    p.rent,
    c.name         AS city_name
  FROM bookings b
  JOIN properties p ON b.property_id = p.id
  JOIN cities     c ON p.city_id    = c.id
  WHERE b.user_id = ?
    AND b.status = 'confirmed'
  ORDER BY b.booked_on DESC
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$bookings = $result->fetch_all(MYSQLI_ASSOC);


// <----------------------------------------->

// <------code for edit profile--------->

// 1) Handle AJAX update request before any HTML is sent
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fullName'])) {
    header('Content-Type: application/json');
    if (!isset($_SESSION["user_id"])) {
        echo json_encode([ 'status'=>'error', 'message'=>'Not authenticated' ]);
        exit;
    }
    $user_id = (int)$_SESSION['user_id'];

    // validate
    $fields = ['fullName','email','phone','college'];
    foreach($fields as $f){
      if (empty($_POST[$f])) {
        echo json_encode([ 'status'=>'error', 'message'=>"$f is required" ]);
        exit;
      }
    }

    // sanitize
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $phone    = mysqli_real_escape_string($conn, $_POST['phone']);
    $college  = mysqli_real_escape_string($conn, $_POST['college']);

    // update
    $sql = "
      UPDATE users
         SET full_name    = '$fullName',
             email        = '$email',
             phone        = '$phone',
             college_name = '$college'
       WHERE id = $user_id
    ";
    if (mysqli_query($conn, $sql)) {
        echo json_encode([ 'status'=>'success' ]);
    } else {
        echo json_encode([ 'status'=>'error', 'message'=> mysqli_error($conn) ]);
    }
    exit;   // stop here so the rest of the page (HTML) is not rendered for the AJAX call
}

// 2) below is your existing “display” logic
if (!isset($_SESSION["user_id"])) {
    header("location: index.php");
    die();
}
$user_id = $_SESSION['user_id'];
// <------------------------------------>
if (!isset($_SESSION["user_id"])) {
    header("location: index.php");
    die();
}
$user_id = $_SESSION['user_id'];

$sql_1 = "SELECT * FROM users WHERE id = $user_id";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
}
$user = mysqli_fetch_assoc($result_1);
if (!$user) {
    echo "Something went wrong!";
    return;
}

$sql_2 = "SELECT * 
            FROM interested_users_properties iup
            INNER JOIN properties p ON iup.property_id = p.id
            WHERE iup.user_id = $user_id";
$result_2 = mysqli_query($conn, $sql_2);
if (!$result_2) {
    echo "Something went wrong!";
    return;
}
$interested_properties = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | PG Life</title>

    <?php
    include "includes/head_links.php";
    ?>
    <link href="css/dashboard.css" rel="stylesheet" />
</head>

<body>
    <?php
    include "includes/header.php";
    ?>

    <!-- <nav aria-label="breadcrumb"> 
        <ol class="breadcrumb py-2">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Dashboard
            </li>
        </ol>
    </nav>
    ---------->

    <div class="my-profile page-container">
        <h1>My Profile</h1>
        <div class="row">
            <div class="col-md-3 profile-img-container">
                <i class="fas fa-user profile-img"></i>
            </div>
            <div class="col-md-9">
                <div class="row no-gutters justify-content-between align-items-end">
                    <div class="profile">
                        <div class="name"><?= $user['full_name'] ?></div>
                        <div class="email"><?= $user['email'] ?></div>
                        <div class="phone"><?= $user['phone'] ?></div>
                        <div class="college"><?= $user['college_name'] ?></div>
                    </div>
                    <div class="edit">
    <div class="edit-profile" id="editProfileBtn">Edit Profile</div>
</div>
                </div>
            </div>
        </div>
    </div>

    <!-- HTML code for view my bookings  -->
    <div class="page-container my-4">
  <h1>My Bookings</h1>

  <?php if (count($bookings) > 0): ?>
    <table class="table table-striped">
  <thead>
    <tr style="color:white">
      <th>Property</th>
      <th>City</th>
      <th>Rent</th>
      <th>Booked On</th>
      <th>Status</th>
      <th>Action</th>    <!-- renamed from View -->
    </tr>
  </thead>
  <tbody>
    <?php foreach ($bookings as $b): ?>
      <tr style="color:white">
        <td><?= htmlspecialchars($b['property_name']) ?></td>
        <td><?= htmlspecialchars($b['city_name']) ?></td>
        <td>₹ <?= number_format($b['rent']) ?></td>
        <td><?= date("d M, Y", strtotime($b['booked_on'])) ?></td>
        <td><?= ucfirst($b['status']) ?></td>
        <td>
          <!-- always allow viewing -->
          <a href="property_detail.php?property_id=<?= $b['property_id'] ?>"
             class="btn btn-sm btn-outline-primary">
            View
          </a>

          <!-- only show Cancel when still confirmed -->
          <?php if ($b['status'] === 'confirmed'): ?>
            <a href="dashboard.php?cancel_booking_id=<?= $b['booking_id'] ?>"
               class="btn btn-sm btn-outline-danger"
               onclick="return confirm('Are you sure you want to cancel this booking?');">
              Cancel
            </a>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <?php else: ?>
    <div class="alert alert-info">
      You have not booked any PG yet.
    </div>
  <?php endif; ?>
</div>

     <!-- ------------------------------ -->
    <?php
    if (count($interested_properties) > 0) {
    ?>
        <div class="my-interested-properties">
            <div class="page-container">
                <h1>My Interested Properties</h1>

                <?php
                foreach ($interested_properties as $property) {
                    $property_images = glob("img/properties/" . $property['id'] . "/*");
                ?>
                    <div class="property-card property-id-<?= $property['id'] ?> row">
                        <div class="image-container col-md-4">
                            <img src="<?= $property_images[0] ?>" />
                        </div>
                        <div class="content-container col-md-8">
                            <div class="row no-gutters justify-content-between">
                                <?php
                                $total_rating = ($property['rating_clean'] + $property['rating_food'] + $property['rating_safety']) / 3;
                                $total_rating = round($total_rating, 1);
                                ?>
                                <div class="star-container" title="<?= $total_rating ?>">
                                    <?php
                                    $rating = $total_rating;
                                    for ($i = 0; $i < 5; $i++) {
                                        if ($rating >= $i + 0.8) {
                                    ?>
                                            <i class="fas fa-star"></i>
                                        <?php
                                        } elseif ($rating >= $i + 0.3) {
                                        ?>
                                            <i class="fas fa-star-half-alt"></i>
                                        <?php
                                        } else {
                                        ?>
                                            <i class="far fa-star"></i>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="interested-container">
                                    <i class="is-interested-image fas fa-heart" property_id="<?= $property['id'] ?>"></i>
                                </div>
                            </div>
                            <div class="detail-container">
                                <div class="property-name"><?= $property['name'] ?></div>
                                <div class="property-address"><?= $property['address'] ?></div>
                                <div class="property-gender">
                                    <?php
                                    if ($property['gender'] == "male") {
                                    ?>
                                        <img src="img/male.png">
                                    <?php
                                    } elseif ($property['gender'] == "female") {
                                    ?>
                                        <img src="img/female.png">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="img/unisex.png">
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row no-gutters">
                                <div class="rent-container col-6">
                                    <div class="rent">₹ <?= number_format($property['rent']) ?>/-</div>
                                    <div class="rent-unit">per month</div>
                                </div>
                                <div class="button-container col-6">
                                    <a href="property_detail.php?property_id=<?= $property['id'] ?>" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>
    <!-- try to intigrate g map -->
    <iframe src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d56999.19574430583!2d83.36460431685467!3d26.76193054449286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d26.7517815!2d83.4286163!4m5!1s0x399144f941b45b67%3A0x69391121fc9e37c9!2sGorakhpur%20Boys%20Hostel%20%26%20PG%2C%20Asuran%2C%20Near%20M.B.%20Motors%20(Hero%20Bikes%20Showroom%20Khariya%20Pokhra%2C%20Post%2C%20Basharatpur%20Road%2C%20Medical%20College%20Road%2C%20Gorakhpur%2C%20Uttar%20Pradesh%20273004!3m2!1d26.7766001!2d83.38312739999999!5e0!3m2!1sen!2sin!4v1745480898306!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
     <!-- -------------------- -->
    <?php
    include "includes/footer.php";
    ?>

    <script type="text/javascript" src="js/dashboard.js"></script>

    <!-- here is the edit form html  -->
    <div class="edit-profile-modal" id="editProfileModal">
    <div class="modal-content">
        <span class="close-btn" id="closeModal">&times;</span>
        <h2>Edit Profile</h2>
        <form id="editProfileForm">
            <div class="form-group">
                <label for="fullName">Name</label>
                <input type="text" id="fullName" name="fullName" value="<?= $user['full_name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= $user['email'] ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Mobile No</label>
                <input type="text" id="phone" name="phone"  value="<?= $user['phone'] ?>" required>
            </div>
            <div class="form-group">
                <label for="college">College Name</label>
                <input type="text" id="college" name="college" value="<?= $user['college_name'] ?>" required>
            </div>
            <button type="submit">Update Profile</button>
        </form>
    </div>
</div>

<!-- inline the AJAX/Modal script here -->
<script>
    document.addEventListener('DOMContentLoaded', ()=>{

      const editBtn    = document.getElementById('editProfileBtn');
      const modal      = document.getElementById('editProfileModal');
      const closeModal = document.getElementById('closeModal');
      const form       = document.getElementById('editProfileForm');

      // open modal
      editBtn.addEventListener('click', ()=> modal.style.display = 'block');

      // close modal
      closeModal.addEventListener('click', ()=> modal.style.display = 'none');
      window.addEventListener('click', e => {
        if (e.target === modal) modal.style.display = 'none';
      });

      // submit form via AJAX back to this same file
      form.addEventListener('submit', e=>{
        e.preventDefault();
        fetch('dashboard.php', {
          method: 'POST',
          body: new FormData(form)
        })
        .then(r=>r.json())
        .then(json=>{
          if (json.status === 'success') {
            window.location.reload();
          } else {
            alert('Error: '+json.message);
          }
        })
        .catch(err=>{
          console.error(err);
          alert('An unexpected error occurred.');
        });
      });

    });
    </script>

</body>

</html>
