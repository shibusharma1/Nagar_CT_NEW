<?php
session_start();
// Example user data (Fetch from database in real implementation)
$user = [
    "name" => "John Doe",
    "email" => "abc@gmail.com",
    "profile_image" => "profile.png" // Change to actual path
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
        }

        .profile-card {
            background: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .profile-actions button {
            background: green;
            color: white;
            border: none;
            padding: 10px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
        }

        .profile-actions button:hover {
            background: darkgreen;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            width: 300px;
            border-radius: 10px;
            text-align: center;
        }

        .close {
            float: right;
            cursor: pointer;
            font-size: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                <img src="<?php echo $user['profile_image']; ?>" alt="Profile" class="profile-img">
                <h2><?php echo $user['name']; ?></h2>
                <p><?php echo $user['email']; ?></p>
            </div>

            <div class="profile-actions">
                <button onclick="openEditModal()">Edit Profile</button>
                <button onclick="openPasswordModal()">Change Password</button>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div id="editProfileModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Edit Profile</h2>
            <form action="update_profile.php" method="POST">
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $user['name']; ?>" required>

                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

                <label>Profile Image:</label>
                <input type="file" name="profile_image">

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div id="passwordModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closePasswordModal()">&times;</span>
            <h2>Change Password</h2>
            <form action="change_password.php" method="POST">
                <label>Old Password:</label>
                <input type="password" name="old_password" required>

                <label>New Password:</label>
                <input type="password" name="new_password" required>

                <label>Confirm Password:</label>
                <input type="password" name="confirm_password" required>

                <button type="submit">Update Password</button>
            </form>
        </div>
    </div>

    <!-- <script src="script.js"></script> -->
    <script>
        function openEditModal() {
            document.getElementById("editProfileModal").style.display = "flex";
        }

        function closeEditModal() {
            document.getElementById("editProfileModal").style.display = "none";
        }

        function openPasswordModal() {
            document.getElementById("passwordModal").style.display = "flex";
        }

        function closePasswordModal() {
            document.getElementById("passwordModal").style.display = "none";
        }

    </script>
</body>

</html>