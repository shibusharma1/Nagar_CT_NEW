<?php
// Start output buffering to prevent header issues
ob_start();

// Show JavaScript alert first
echo '<script>alert("Please remove the config word from the URL.");</script>';

// Redirect after the alert
header("Refresh: 1; URL=../index.php"); // Redirects after 1 second

// Ensure no further execution
exit();
?>
