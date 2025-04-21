<!-- New PG Finder Footer -->
<style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    .footer {
      background-color:rgb(17, 27, 51);
      color: white;
      padding: 40px 50px;
    }

    .footer-container {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .footer-section {
      width: 22%;
      margin-bottom: 20px;
    }

    .footer-section h3 {
      font-size: 1.2em;
      margin-bottom: 10px;
    }

    .footer-section p,
    .footer-section ul li a,
    .footer-bottom p,
    .footer-links a {
      font-size: 0.9em;
      line-height: 1.5;
      color: white;
      text-decoration: none;
    }
    .footer-section p{
      margin-bottom: 10px;
    }
    .footer-section ul {
      list-style: none;
      padding: 0;
    }

    .footer-section ul li {
      margin: 5px 0;
    }

    .footer-section ul li a:hover,
    .social-icons a:hover,
    .footer-links a:hover {
      color: #4B47D9;
    }

    .social-icons a {
      font-size: 1.2em;
      margin-right: 10px;
      color: white;
      transition: 0.3s;
    }

    .newsletter form {
      display: flex;
      margin-top: 10px;
    }

    .newsletter input {
      padding: 8px;
      border: none;
      border-radius: 5px 0 0 5px;
      outline: none;
      flex: 1;
    }

    .newsletter button {
      padding: 8px 15px;
      background-color: #4B47D9;
      color: white;
      border: none;
      cursor: pointer;
      border-radius: 0 5px 5px 0;
      transition: 0.3s;
    }

    .newsletter button:hover {
      background-color: #3C3ABE;
    }

    .footer-bottom {
      text-align: center;
      margin-top: 30px;
      padding-top: 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .footer-links {
      margin-top: 10px;
    }

    .footer-links a {
      margin: 0 10px;
      transition: 0.3s;
    }

    @media (max-width: 768px) {
      .footer-container {
        flex-direction: column;
        align-items: center;
      }

      .footer-section {
        width: 100%;
        text-align: center;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        padding-top: 20px;
      }

      .footer-section:first-child {
        border-top: none;
        padding-top: 0;
      }
    }
  </style>
<footer class="footer">
  <div class="footer-container">
    <div class="footer-section">
      <h3>PG Finder</h3>
      <p>Find the perfect PG around you or list yours in minutes. PG Finder connects tenants with trusted PG owners easily.</p>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>

    <div class="footer-section">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="property_list.php">Browse PGs</a></li>
        <li><a href="../../pgmaalik/index.html">PG Owner</a></li>
        <li><a href="tenant-dashboard.php">Tenant Dashboard</a></li>
        <li><a href="admin-login.html">Admin Panel</a></li>
      </ul>
    </div>

    <div class="footer-section">
      <h3>Contact Us</h3>
      <p>📞 +91 987 654 3210</p>
      <p>📧 help@pgfinder.com</p>
    </div>

    <div class="footer-section newsletter">
      <h3>Newsletter</h3>
      <p>Stay updated with new listings and best deals on PGs near you.</p>
      <form>
        <input type="email" placeholder="Enter your email" required />
        <button type="submit">Subscribe</button>
      </form>
    </div>
  </div>

  <div class="footer-bottom">
    <p>© 2024 PG Finder. All rights reserved.</p>
    <div class="footer-links">
      <a href="#">Privacy Policy</a>
      <a href="#">Terms & Conditions</a>
      <a href="#">Help Center</a>
    </div>
  </div>
</footer>

<!-- Scripts -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
