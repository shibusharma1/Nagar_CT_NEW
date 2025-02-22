<?php
$title = "Log out";
session_start(); // Ensure session is started before modifying it
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session to fully log out the user
header("Location: login");

?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500, // Increased to ensure visibility
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    Toast.fire({
        icon: "success",
        title: "Logged out successfully"
    });

    // Redirect after SweetAlert finishes
    setTimeout(() => {
        window.location.href = "login.php";
    }, 1600); // Slightly longer than toast duration
</script>
