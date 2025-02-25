<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nagar-CT | Home</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <link rel="icon" type="image/png" sizes="64x64" href="assets/logo1.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="script.js" defer></script>
    <style>
        /* styles.css */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-img {
            max-height: 2rem;
            max-width: 2rem;
            border: 1px solid black;
            border-radius: 50%;
            cursor: pointer;
            background-color: white;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #092448;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-right: 12rem;
        }

        nav ul li {
            /* display: inline; */
            display: flex;
            align-items: center;
            /* float: left; */

        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .signin-signup ul {
            list-style: none;
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .signin-signup ul li {
            /* display: inline; */
            display: flex;
            align-items: center;
            /* float: left; */
            /* font-size:18px; */

        }

        .signin-signup ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        .sign-button{
            background-color: #092448;
            color: white;
            padding: 0.4rem 0.6rem;
            border-radius: 0.5rem;
        }

        /* search container css */

        .container {
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 95%;
            max-width: 1000px;
            gap:10px;
            padding-right: 20px;
        }

        .search-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
        }

        .search-container div {
            flex: 1;
            min-width: 150px;
            gap: 2;
            margin: 2px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            max-height: 1rem;
        }

        .btn {
            background-color: #002F6C;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            display: block;
            margin-top: 5px;
        }

        .btn:hover {
            background-color: #004aad;
        }

        .chat-icon {
            background: #002F6C;
            color: white;
            padding: 12px;
            
            cursor: pointer;
            text-align: center;
            font-size: 18px;
            /* min-width: 45px; */
        }

        /* Responsive */
        @media (max-width: 768px) {
            .search-container {
                flex-direction: column;
                align-items: stretch;
            }

            .chat-icon {
                align-self: center;
            }
        }

        /* search container css end */

        .filters {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
        }

        .filters select,
        .filters input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .car-list {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }

        .car {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            width: 280px;
            text-align: center;
        }

        .car img {
            width: 100%;
            border-radius: 10px;
        }

        .car h3 {
            font-size: 20px;
            margin: 10px 0;
        }

        .car p {
            color: #666;
            font-size: 14px;
        }

        footer {
            background-color: #092448;
            color: #fff;
            text-align: center;
            padding: 20px;
            margin-top: 20px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: auto;
        }

        .social-links a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">NagarCT</div>
        <nav>
            <ul>
                <li><a href="tel:+9779819099126"><small><i class="fa fa-phone"
                                aria-hidden="true"></i>+977-9819099126</small></a></li>
                <li><a href="index">Home</a></li>
                <li><a href="about">About</a></li>
                <li><a href="contact">Contact</a></li>
            </ul>
        </nav>
        <div class="signin-signup">
            <ul>
                <li><a href="inquire"><small>Inquire About Reservation</small></a></li>
                <?php 
                if(!isset($_SESSION)){
                ?>
                <li><a href="login">
                        <span class="sign-button">
                           <small> Sign In </small>
                        </span>
                    </a></li>
                <li><a href="register">
                        <span class="sign-button">
                        <small>  Sign Up</small>
                        </span>
                    </a></li>
                <li id="country-flag">
                    <img src="assets/flag.png" class="profile-img" alt="Nepal logo">
                </li>
                <?php 
                }
                else{
                ?>
                <li id="country-flag">
                    <img src="assets/flag.png" class="profile-img" alt="Nepal logo">
                </li>
                <li>Welcome,Passenger</li>
                <li>
                    <a href="logout">Log out</a>
                </li>
                <?php 
                }
                // endif
                ?>

            </ul>
        </div>
    </header>

    <!-- search container -->
    <div class="container">
        <div class="search-container">
            <div>
                <label>Pickup Location</label>
                <input type="text" id="pickup-location" placeholder="Enter location">
                <!-- <button class="btn" id="change-location">I want to deliver in a different place</button> -->
            </div>
            <div>
                <label>Pickup Date</label>
                <input type="date" id="pickup-date">
            </div>
            <div>
                <label>Pickup Time</label>
                <input type="time" id="pickup-time">
            </div>
            <div>
                <label>Return Date</label>
                <input type="date" id="return-date">
            </div>
            <div>
                <label>Return Time</label>
                <input type="time" id="return-time">
            </div>
            <div class="chat-icon">Search</div>
        </div>
    </div>
    <!-- end of search container -->


    <section class="filters">
        <select id="gear-type">
            <option value="">Gear Type</option>
            <option value="manual">Manual</option>
            <option value="automatic">Automatic</option>
        </select>
        <select id="fuel-type">
            <option value="">Fuel Type</option>
            <option value="petrol">Petrol</option>
            <option value="diesel">Diesel</option>
            <option value="electric">Electric</option>
        </select>
        <select id="brands">
            <option value="">Brands</option>
            <option value="Toyota">Toyota</option>
            <option value="Ford">Ford</option>
            <option value="Honda">Honda</option>
        </select>
        <input type="text" id="search" placeholder="Search by car name...">
        <select id="sort">
            <option value="price-asc">Price: Low to High</option>
            <option value="price-desc">Price: High to Low</option>
        </select>
    </section>

    <section class="car-list">
        <div class="car" data-gear="manual" data-fuel="petrol" data-brand="Toyota" data-price="500">
            <img src="https://imgd.aeplcdn.com/370x208/n/cw/ec/168707/syros-exterior-right-front-three-quarter.jpeg?isig=0&q=80"
                alt="Toyota Car">
            <h3>Toyota Corolla</h3>
            <p>Manual | Petrol</p>
            <p>Price: $500/day</p>
        </div>
        <div class="car" data-gear="automatic" data-fuel="diesel" data-brand="Ford" data-price="600">
            <img src="https://imagecdnsa.zigwheels.ae/medium/gallery/color/39/2103/suzuki-dzire-2025-color-693065.jpg"
                alt="Ford Car">
            <h3>Ford Focus</h3>
            <p>Automatic | Diesel</p>
            <p>Price: $600/day</p>
        </div>
        <div class="car" data-gear="manual" data-fuel="petrol" data-brand="Toyota" data-price="500">
            <img src="https://imgd.aeplcdn.com/370x208/n/cw/ec/168707/syros-exterior-right-front-three-quarter.jpeg?isig=0&q=80"
                alt="Toyota Car">
            <h3>Toyota Corolla</h3>
            <p>Manual | Petrol</p>
            <p>Price: $500/day</p>
        </div>
        <div class="car" data-gear="manual" data-fuel="petrol" data-brand="Toyota" data-price="500">
            <img src="https://imgd.aeplcdn.com/370x208/n/cw/ec/168707/syros-exterior-right-front-three-quarter.jpeg?isig=0&q=80"
                alt="Toyota Car">
            <h3>Toyota Corolla</h3>
            <p>Manual | Petrol</p>
            <p>Price: $500/day</p>
        </div>
        <div class="car" data-gear="automatic" data-fuel="diesel" data-brand="Ford" data-price="600">
            <img src="https://imagecdnsa.zigwheels.ae/medium/gallery/color/39/2103/suzuki-dzire-2025-color-693065.jpg"
                alt="Ford Car">
            <h3>Ford Focus</h3>
            <p>Automatic | Diesel</p>
            <p>Price: $600/day</p>
        </div>
        <div class="car" data-gear="automatic" data-fuel="diesel" data-brand="Ford" data-price="600">
            <img src="https://imagecdnsa.zigwheels.ae/medium/gallery/color/39/2103/suzuki-dzire-2025-color-693065.jpg"
                alt="Ford Car">
            <h3>Ford Focus</h3>
            <p>Automatic | Diesel</p>
            <p>Price: $600/day</p>
        </div>
        <div class="car" data-gear="manual" data-fuel="petrol" data-brand="Toyota" data-price="500">
            <img src="https://imgd.aeplcdn.com/370x208/n/cw/ec/168707/syros-exterior-right-front-three-quarter.jpeg?isig=0&q=80"
                alt="Toyota Car">
            <h3>Toyota Corolla</h3>
            <p>Manual | Petrol</p>
            <p>Price: $500/day</p>
        </div>
        <div class="car" data-gear="automatic" data-fuel="diesel" data-brand="Ford" data-price="600">
            <img src="https://imagecdnsa.zigwheels.ae/medium/gallery/color/39/2103/suzuki-dzire-2025-color-693065.jpg"
                alt="Ford Car">
            <h3>Ford Focus</h3>
            <p>Automatic | Diesel</p>
            <p>Price: $600/day</p>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <p>&copy; 2025 NAGAR-CT. All rights reserved.</p>
            <div class="social-links">
                <a href="#">Facebook</a>
                <a href="#">Twitter</a>
                <a href="#">Instagram</a>
            </div>
        </div>
    </footer>

    <!-- search container js -->
    <script>
        document.getElementById("change-location").addEventListener("click", function() {
            let newLocation = prompt("Enter a new delivery location:");
            if (newLocation) {
                document.getElementById("pickup-location").value = newLocation;
            }
        });
    </script>
     <!-- end of search container js -->

    <script>
        $(document).ready(function () {
            $('#gear-type, #fuel-type, #brands, #sort').change(function () {
                let gear = $('#gear-type').val();
                let fuel = $('#fuel-type').val();
                let brand = $('#brands').val();
                let sort = $('#sort').val();

                let cars = $('.car');
                cars.show();

                if (gear) cars = cars.filter(`[data-gear="${gear}"]`);
                if (fuel) cars = cars.filter(`[data-fuel="${fuel}"]`);
                if (brand) cars = cars.filter(`[data-brand="${brand}"]`);

                if (sort === "price-asc") {
                    cars.sort((a, b) => $(a).data("price") - $(b).data("price"));
                } else if (sort === "price-desc") {
                    cars.sort((a, b) => $(b).data("price") - $(a).data("price"));
                }

                $('.car-list').html(cars);
            });
        });
    </script>


</body>

</html>