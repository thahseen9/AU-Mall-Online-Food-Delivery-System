<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AU Mall</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
  <header>
    <table class="header-table">
      <tr class="header-row">
        <td><img src="Images/AuLogo.jpeg" alt="logo" class="logo" /></td>
        <td class="center-text">AU Mall Cafeteria</td>
        <td class="admin-vendor-cell">
          <span class="right-text" style="text-decoration: none; color: antiquewhite;  margin-left: 20px;"><a href="Loginvendor.php">Vendor</a></span>
        </td>
      </tr>
    </table>
  </header>
  <nav>
    <ul>
      <li><a href="Index.php">Home</a></li>
      <li class="dropdown">
        <a href="#" class="dropbtn">Shops</a>
        <div class="dropdown-content">
          <?php
          include 'connect.php';

          // Query to fetch restaurant names
          $query = "SELECT R_ID, name FROM restaurants";
          $result = $conn->query($query);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $restaurant_name = $row['name'];
              $restaurant_id = $row['R_ID'];
              echo "<a href='Login_customer.php'>$restaurant_name</a>";
            }
          }
          ?>
        </div>
      </li>
      <li><a href="aboutUs.php">About Us</a></li>
      <li><a href="#contact">Contact Us</a></li>

      <li style="float: right;"><a href="Login_customer.php">Login</a></li>
    </ul>
  </nav>
  <section style="background-image: url('Images/Lobster.jpg'); background-size: 100% auto; background-repeat: no-repeat; background-position: center; max-width: 100%; height: 40%; background-color: rgba(0, 0, 0, 0.5); transition: transform 0.2s;">
  <h1 style="font-size: 35px; color: white; font-style: italic; padding: 100px; ">Are You Hungry?</h1>
  <h2 style="font-size: 35px; color: white; font-style: italic; padding: 50px; text-align: center; text-shadow: 2px 2px 4px rgba(0, 0, 0, 10);">Dont Wait!!!!</h2>
  <h3 style="font-size: 30px; color: white; font-style: italic; padding: 50px; text-align: center; text-shadow: 2px 2px 4px rgba(0, 0, 0, 10); ">Let's start to order food now!</h3>
  </section>
  <section style="text-align: center;">
  <img src="Images/how-it-works.png" alt="how-it-work" style="max-width: 100%; height: auto;"/>
  </section>

  <nav style="color:antiquewhite; text-align:center; font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size:35px; background-color:rgb(130, 40, 30);; padding: 20px">Menu</nav>
  <section class="shop-section">
    <div class="shop-card restaurant-card"">
        <a href='Login_customer.php' class="shop-link">
            <img src="Images/taiwan-chicken-noodle-soup.jpeg" alt="Shop 1" class="shop-image" style='max-width: 350px; max-height: 350px;'/>
            <p>Taiwanese Restaurant</p>
        </a>
    </div>
    <div class="shop-card restaurant-card"">
        <a href='Login_customer.php' class="shop-link">
            <img src="Images/Dim-sum-china.jpeg" alt="Shop 2" class="shop-image" style='max-width: 350px; max-height: 350px;'/>
            <p>Chinese Restaurant</p>
        </a>
    </div>
    <div class="shop-card restaurant-card"">
        <a href='Login_customer.php' class="shop-link">
            <img src="Images/Pad-krapow-thai.jpg" alt="Shop 3" class="shop-image" style='max-width: 350px; max-height: 350px;'/>
            <p>Thai Restaurant</p>
        </a>
    </div>
</section>
<section  class="shop-section">
<div class="shop-card restaurant-card"">
        <a href='Login_customer.php' class="shop-link">
            <img src="Images/Garlic-naan-india.jpeg" alt="Shop 3" class="shop-image" style='max-width: 350px; max-height: 350px;'/>
            <p>Indian Restaurant</p>
        </a>
    </div>
    <div class="shop-card restaurant-card"">
        <a href='Login_customer.php' class="shop-link">
            <img src="Images/Goi cuon vietnam.jpeg" alt="Shop 3" class="shop-image" style='max-width: 350px; max-height: 350px;'/>
            <p>Vietnamese Restaurant</p>
        </a>
    </div>
    <div class="shop-card restaurant-card"">
        <a href='Login_customer.php' class="shop-link">
            <img src="Images/Mee goreng mamak malay.jpeg" alt="Shop 3" class="shop-image" style='max-width: 350px; max-height: 350px;'/>
            <p>Malaysian Restaurant</p>
        </a>
    </div>
</section>

<footer id="contact">
    <table>
      <tr>
        <td class="contact-info">Contact Information</td>
      </tr>
      <tr>
        <td>+66 2 723 2323</td>
      </tr>
      <tr>
        <td><a href="mailto:abac@au.edu" class="email-link">abac@au.edu</a></td>
      </tr>
      <tr>
        <td>Mailing Address : <br>
          88 Moo 8 Bang Na-Trad Km. 26, <br>
          Bangsaothong <br>
          Samuthprakarn 10570 Thailand</td>
        </tr>
        <tr>
          <td>&copy; 2023 AU Mall. All rights reserved.</td>
        </tr>
    </table>
  </footer>
</body>
</html>