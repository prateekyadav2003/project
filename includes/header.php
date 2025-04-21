<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PG Finder</title>

  <!-- Bootstrap CSS -->
  <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNVpCFxx6NfQ784/nhbTf0nusCqE+7ujVNfIlkF0p3r56kxo3oJp"
    crossorigin="anonymous"
  >
  <style>
    .bg-pg { background: #111827; }
    .btn-register {
      background: #6366f1;
      color: white;
      border-radius: 5px;
      border: none;
      font-weight: bold;
    }
    .btn-login {
      background: transparent;
      color: white;
      border: 2px solid #6366f1;
      border-radius: 5px;
      font-weight: bold;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-pg py-3 px-4">
  <!-- Brand -->
  <a class="navbar-brand font-weight-bold" href="index.php" style="font-size:1.5rem;">
    PG Finder
  </a>

  <!-- Toggler (visible only on small screens) -->
  <button
    class="navbar-toggler d-lg-none ml-auto"
    type="button"
    data-toggle="collapse"
    data-target="#mainNav"
    aria-controls="mainNav"
    aria-expanded="false"
    aria-label="Toggle navigation"
  >
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible navbar menu for small screens -->
  <div class="collapse navbar-collapse" id="mainNav">
    <!-- Nav links (for small screens) -->
    <ul class="navbar-nav mx-auto mx-lg-0" style="gap:1rem;">
      <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="includes/features.php/#feature">Features</a></li>
      <li class="nav-item"><a class="nav-link" href="index.php">Search</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Listings</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Testimonials</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Support</a></li>
    </ul>

    <!-- Buttons inside the hamburger for small screens -->
    <div class="d-flex d-lg-none flex-column align-items-center mt-3" style="gap:.75rem;">
      <?php if (!isset($_SESSION['user_id'])): ?>
        <button class="btn btn-register w-75 px-4 py-2" data-toggle="modal" data-target="#signup-modal">Register</button>
        <button class="btn btn-login    w-75 px-4 py-2" data-toggle="modal" data-target="#login-modal">Login</button>
      <?php else: ?>
        <span class="text-white">Hi, <strong><?php echo htmlspecialchars($_SESSION['full_name']); ?></strong></span>
        <a href="dashboard.php" class="btn btn-login    w-75 px-4 py-2">Dashboard</a>
        <a href="logout.php"    class="btn btn-register w-75 px-4 py-2">Logout</a>
      <?php endif; ?>
    </div>
  </div>

  <!-- Large screens: buttons pushed to the right -->
  <div class="d-none d-lg-flex ml-auto align-items-center">
    <ul class="navbar-nav mr-3">
      <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="includes/features.php/#feature">Features</a></li>
      <li class="nav-item"><a class="nav-link" href="index.php">Search</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Listings</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Testimonials</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Support</a></li>
    </ul>

    <?php if (!isset($_SESSION['user_id'])): ?>
      <button class="btn btn-register mr-2 px-4 py-1" data-toggle="modal" data-target="#signup-modal">Register</button>
      <button class="btn btn-login    px-4 py-1" data-toggle="modal" data-target="#login-modal">Login</button>
    <?php else: ?>
      <span class="text-white mr-3">Hi, <strong><?php echo htmlspecialchars($_SESSION['full_name']); ?></strong></span>
      <a href="dashboard.php" class="btn btn-login    mr-2 px-4 py-1">Dashboard</a>
      <a href="logout.php"    class="btn btn-register   px-4 py-1">Logout</a>
    <?php endif; ?>
  </div>
</nav>

<div id="loading"></div>

<!-- Full version of jQuery (not slim) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Bootstrap JS + Popper -->
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-o+RDsa0aLu++PJvFQj8L6fQ5YhR0gq0Xb+6bp3FjVjJuZfWNpNoO5p+XrB+yl0RS"
  crossorigin="anonymous"
></script>

<!-- Close navbar on outside click -->
<script>
  $(document).ready(function () {
    $(document).on('click', function (e) {
      var target = $(e.target);
      var navMenu = $('#mainNav');
      var isNavbarOpen = navMenu.hasClass('show');
      var isClickInsideNavbar = target.closest('.navbar').length > 0;

      if (isNavbarOpen && !isClickInsideNavbar) {
        $('.navbar-toggler').click();
      }
    });
  });
</script>

</body>
</html>
