<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php echo $title; ?>
    </title>
    <link rel="icon" type="image/png" sizes="64x64" href="../assets/logo1.png" />
    <link rel="stylesheet" href="../css/admin_header.css">
    <link rel="stylesheet" href="../css/admin_feedback_form.css">
    <link rel="stylesheet" href="../css/feedback.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- For Dashboard -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDumdDv9jxmpC0yaURPXnqkk4kssB8R3C4&libraries=places"></script>
    <style>
        a {
            text-decoration: none;
        }

        .dashboard-card {
            padding: 20px;
            border-radius: 10px;
            color: #fff;
        }

        .bg-blue {
            background-color: #007bff;
        }

        .bg-green {
            background-color: #28a745;
        }

        .bg-yellow {
            background-color: #ffc107;
        }

        .bg-red {
            background-color: #dc3545;
        }

        .chart-container {
            width: 100%;
            max-width: 600px;
            margin: auto;
        }

        #map {
            height: 300px;
            border-radius: 10px;
        }
    </style>

</head>

<body style="padding: 0;">
    <!-- Sidebar Menu -->
    <div class="menu-bar">

        <a href="index">
            <div class="logo-img">
                <img src="../assets/logo1.png" alt="Nagar-CT">
            </div>
        </a>

        <div class="menu-items">

            <a href="index">
                <div class="item <?php echo ($current_page == 'index') ? 'active' : ''; ?>">
                    <i class="fa fa-home" aria-hidden="true"></i> &nbsp; Dashboard
                </div>
            </a>

            <a href="drivers">
                <div class="item <?php echo ($current_page == 'drivers') ? 'active' : ''; ?>">
                    <i class="fa fa-id-card-o" aria-hidden="true"></i> &nbsp; Drivers
                </div>
            </a>

            <a href="vehicles">
                <div class="item <?php echo ($current_page == 'vehicles') ? 'active' : ''; ?>">
                    <i class="fa fa-id-card-o" aria-hidden="true"></i> &nbsp; vehicles
                </div>
            </a>

            <a href="users">
                <div class="item <?php echo ($current_page == 'users') ? 'active' : ''; ?>">
                    <i class="fa fa-users" aria-hidden="true"></i> &nbsp; Users
                </div>
            </a>

            <a href="cities">
                <div class="item <?php echo ($current_page == 'cities') ? 'active' : ''; ?>">
                    <i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp; Cities
                </div>
            </a>

            <a href="fairs">
                <div class="item <?php echo ($current_page == 'fairs') ? 'active' : ''; ?>">
                    <i class="fa fa-money" aria-hidden="true"></i> &nbsp; Fairs
                </div>
            </a>
            <a href="feedbacks">
                <div class="item <?php echo ($current_page == 'feedback') ? 'active' : ''; ?>">
                    <i class="fa fa-commenting-o" aria-hidden="true"></i> &nbsp; Feedback
                </div>
            </a>
            <div class="item">
                <i class="fa fa-sign-out" aria-hidden="true"></i> &nbsp; Logout
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="contents-side">
        <!-- Header Section -->
        <div class="header-content">
            <a href="index">
                <span style="color:#000000;">Nagar-CT</span>
            </a>

            <div class="notification-account-info">
                <!-- Bell Icon with Notification Badge -->
                <div class="notification">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    <sup class="badge">3</sup>
                    <div class="dropdown">
                        <div class="notif-item">Notification 1</div>
                        <div class="notif-item">Notification 2</div>
                        <div class="notif-item">Notification 3</div>
                    </div>
                </div>
                <!-- User Profile Icon -->
                <div class="account-info">
                    <!-- <i class="fa fa-user-circle" aria-hidden="true"></i> -->
                    <img src="../assets/logo1.png" class="profile-img" alt="Nagar-CT">


                    <div class="user-menu">
                        <div class="user-header">
                            <img src="../assets/logo1.png" alt="Nagar-CT">
                            <span>John Doe</span>
                        </div>
                        <a href="profile" style="text-decoration:none;color:#000000;">
                        <div class="menu-item">Edit Profile</div>
                        </a>
                        <a href="change_password" style="text-decoration:none;color:#000000;">
                        <div class="menu-item">Change Password</div>
                        </a>
                        <a href="logout">
                            <div class="menu-item">Logout</div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
        <div class="main-content">