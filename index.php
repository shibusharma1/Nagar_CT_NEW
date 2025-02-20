<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nagar-CT | EV Booking System</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        header {
            background-color: #28a745;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            font-size: 1.5rem;
            font-weight: 700;
        }

        header nav ul {
            list-style: none;
            display: flex;
        }

        header nav ul li {
            margin-left: 20px;
        }

        header nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: 500;
            transition: color 0.3s;
        }

        header nav ul li a:hover {
            color: #d4edda;
        }

        .hero {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 4rem 2rem;
            background: url('https://via.placeholder.com/1500x500.png?text=Green+EV+Booking') no-repeat center center/cover;
            color: black;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .hero button {
            background-color: #28a745;
            border: none;
            color: white;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .hero button:hover {
            background-color: #218838;
        }

        .features {
            padding: 2rem;
            text-align: center;
        }

        .features h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }

        .features .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .features .card {
            background-color: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .features .card:hover {
            transform: translateY(-5px);
        }

        footer {
            background-color: #28a745;
            color: white;
            text-align: center;
            padding: 1rem;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                text-align: center;
            }

            header nav ul {
                flex-direction: column;
                margin-top: 1rem;
            }

            header nav ul li {
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Nagar-CT</div>
        <nav>
            <ul>
                <li><a href="#services">Services</a></li>
                <li><a href="#earn">Earn</a></li>
                <li><a href="#help">Help</a></li>
                <li><a href="#blog">Blog</a></li>
                <li><a href="frontend/driver/login">Become a Driver</a></li>
                <li><a href="frontend/passenger/login">Login</a></li>
            </ul>
        </nav>
    </header>

    <div class="hero">
        <h1>Drive the Future of Green Mobility</h1>
        <p>Book your eco-friendly ride in just a few clicks.</p>
       <a href="register">
     <button>Book Now</button>
     </a>
    </div>

    <section class="features" id="services">
        <h2>Why Choose Nagar-CT?</h2>
        <div class="grid">
            <div class="card">
                <h3>Real-Time Tracking</h3>
                <p>Track your rides in real-time with accurate updates.</p>
            </div>
            <div class="card">
                <h3>Fair Pricing</h3>
                <p>Affordable and transparent pricing for all rides.</p>
            </div>
            <div class="card">
                <h3>Eco-Friendly</h3>
                <p>Reduce your carbon footprint with electric vehicles.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Nagar-CT. All rights reserved.</p>
    </footer>
</body>
</html>
