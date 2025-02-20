<?php
require_once '../config/connection.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM users WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['delete_success'] = true;
        header("Location: users.php");

    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}
?>
