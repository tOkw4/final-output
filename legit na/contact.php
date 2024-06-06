<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="dashboard">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="legal-documents.php">Make an Appointment</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="check-appointments.php">Check Appointments</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <div class="content">
            <h3>Contact</h3>
            <p>This is the contact section of the dashboard.</p>
        </div>
    </div>
</body>

</html>