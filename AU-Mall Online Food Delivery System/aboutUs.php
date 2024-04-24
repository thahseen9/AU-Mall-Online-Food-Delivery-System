<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Food Service and Cafeterias</title>
    <link rel="stylesheet" href="CSS/style.css">
    <style>

        h2 {
            margin: 1;
            font-style: italic;
            color:  rgb(124, 30, 30);
        }
        p{
          font-size: 20px;
        }

        section {
            background-color: #fff;
            margin: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        ul {
            list-style-type: disc;
            margin-left: 20px;
        }
        li {
          font-size: 18px;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        table {
            width: 100%;
        }

        td {
            vertical-align: top;
            padding: 0px;
        }

        .logo {
            max-width: 100px;
            height: auto;
        }

        .center-text {
            font-weight: bold;
            font-size: 24px;
        }

        .contact-info {
            font-weight: bold;
        }

        .email-link {
            color: #fff;
            text-decoration: none;
        }

        /* Add hover effect to images */
        img:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body>
    <header>
        <table class="header-table">
            <tr class="header-row">
                <td><img src="Images/AuLogo.jpeg" alt="logo" class="logo" /></td>
                <td class="center-text">About Us - AU Mall Cafeteria</td>
                <td class="admin-vendor-cell">
                    <span></span>
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
                            echo "<a href='menu.php?R_ID=$restaurant_id'>$restaurant_name</a>";
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
    <section>
        <table>
            <tr>
                <td rowspan="2"><img src="Images/store.jpeg" style='max-width: 350px; max-height: 350px;' /></td>
                <td>
                    <h2>Catering Facilities</h2>
                    <p>Catering facilities are available to faculty, staff, and students throughout both campuses. Contractor-operated facilities are in operation daily from 7.00 a.m. to 8.00 p.m. (Hours may change during semester breaks).</p>
                </td>
            </tr>
            <tr>
                <td>
                    <h2>AU Mall</h2>
                    <p>Located in Assumption University, Suvarnabhumi Campus. There are two buildings as follows:</p>
                    <ul>
                        <li>Two-story commercial Building</li>
                        <li>Three-story cafeteria</li>
                    </ul>
                </td>
            </tr>
        </table>
        <section>
          <table>
            <tr>
              <td><h2>Objective</h2></td>
              <td rowspan="6"><img src="Images/aumall.jpeg" alt="AU Mall" style='max-width: 100%; max-height: auto;' /></td>
            </tr>
            <tr>
              <td><p>Our objective is to provide the facility for students, lecturers, and university staff.</p></td>
            </tr>
            <tr>
            <td><p>We aim to be the integrated retail store that provides a center for food, service, and edutainment.</p></td>
            </tr>
            <tr>
              <td><h2>Cafeteria Details</h2></td>
            </tr>
            <tr>
              <td>
              <p>AU Mall Retail Store:</p>
              <ul>
                  <li>Two storeys with a usable area of 5,031.40 sq.m.</li>
                  <li>Total of 47 units.</li>
              </ul>
              </td>
            </tr>
            <tr>
              <td>
              <p>Cafeteria:</p>
              <ul>
                  <li>Three storeys with a usable area of 1,879.07 sq.m.</li>
                  <li>1st and 2nd Floor – Cafeteria with a total of 15 restaurants.</li>
                  <li>3rd Floor – The entertainment hall "Albert Hall" with 100 seats.</li>
              </ul>
              </td>
            </tr>
          </table>
        </section>
    </section>
    <section>
      <h2>Route to Cafeteria/AU Mall</h2>
      <p>Zone C</p>
        <img src="Images/campus_map.jpeg" style="max-width: 50%; height: auto;" />
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
