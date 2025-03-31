<div class="header sticky-top">
    <nav class="navbar navbar-expand-md" style="background: #111827; padding: 15px 50px;">
        <a class="navbar-brand text-white" href="index.php" style="font-size: 1.5rem; font-weight: bold;">
            PG Finder
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#my-navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="my-navbar">
            <ul class="navbar-nav" style="gap: 20px;">
                <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="includes/features.php/#feature">Features</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="index.php">Search</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Listings</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Testimonials</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Support</a></li>
            </ul>
            
            <div class="nav-buttons" style="display: flex; gap: 10px; margin-left: 20px;">
                <?php if (!isset($_SESSION["user_id"])) { ?>
                    <button class="btn btn-register" data-toggle="modal" data-target="#signup-modal" style="background: #6366f1; color: white; padding: 8px 15px; border-radius: 5px; font-weight: bold; border: none; transition: all 0.3s ease;">Signup</button>
                    <button class="btn btn-login" data-toggle="modal" data-target="#login-modal" style="background: transparent; color: white; padding: 8px 15px; border-radius: 5px; font-weight: bold; border: 2px solid #6366f1; transition: all 0.3s ease;">Login</button>
                <?php } else { ?>
                    <div class='nav-name text-white' style="margin-right: 10px;">Hi, <a href="./index.php" style="text-decoration: none; color: white; font-weight: bold;"> <?php echo $_SESSION["full_name"] ?> </a></div>
                    <a class="btn btn-login" href="dashboard.php" style="padding: 8px 15px; border-radius: 5px; font-weight: bold; border: 2px solid #6366f1; color: white;">Dashboard</a>
                    <a class="btn btn-register" href="logout.php" style="padding: 8px 15px; border-radius: 5px; font-weight: bold; background: #6366f1; color: white;">Logout</a>
                <?php } ?>
            </div>
        </div>
    </nav>
</div>

<div id="loading"></div>
