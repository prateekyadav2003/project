<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG Finder Features</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0f172a;
            color: white;
            margin: 0;
            padding: 0;
        }
        .features {
            padding: 50px 20px;
            text-align: center;
        }
        .features-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: auto;
        }
        .feature-box {
            background-color: #1e293b;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0px 4px 15px rgba(99, 102, 241, 0.8);
        }
        .icon {
            font-size: 30px;
            display: block;
            margin-bottom: 10px;
            color: #6366f1;
            transition: color 0.3s ease;
        }
        .feature-box:hover .icon {
            color: #818cf8;
        }
    </style>
</head>
<body>
    <section id="feature" class="features">
        <h2>Everything You Need</h2>
        <p>Comprehensive features for both PG owners and students</p>
        <div class="features-container">
            <div class="feature-box">
                <span class="icon"><i class="fas fa-home"></i></span>
                <h3>Easy Registration</h3>
                <p>Simple and quick registration process for both property owners and students.</p>
            </div>
            <div class="feature-box">
                <span class="icon"><i class="fas fa-search"></i></span>
                <h3>Smart Search</h3>
                <p>Advanced filters to find the perfect PG based on location, price, and amenities.</p>
            </div>
            <div class="feature-box">
                <span class="icon"><i class="fas fa-map-marked-alt"></i></span>
                <h3>Map Integration</h3>
                <p>Interactive maps to find PGs near your preferred location.</p>
            </div>
            <div class="feature-box">
                <span class="icon"><i class="fas fa-check-circle"></i></span>
                <h3>Verified Listings</h3>
                <p>All PG listings go through a strict verification process.</p>
            </div>
            <div class="feature-box">
                <span class="icon"><i class="fas fa-comments"></i></span>
                <h3>Direct Communication</h3>
                <p>Chat directly with property owners and get quick responses.</p>
            </div>
            <div class="feature-box">
                <span class="icon"><i class="fas fa-calendar-check"></i></span>
                <h3>Online Booking</h3>
                <p>Secure online booking and payment system.</p>
            </div>
        </div>
    </section>
</body>
</html>
