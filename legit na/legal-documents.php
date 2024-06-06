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
    <title>Legal Documents</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
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
            <h3>Legal Documents</h3>
            <form id="appointment-form" action="submit-appointment.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="date">Appointment Date:</label>
                <input type="date" id="date" name="date" required>

                <label for="time">Appointment Time:</label>
                <input type="time" id="time" name="time" required>

                <label for="signature">Digital Signature:</label>
                <canvas id="signature-pad" class="signature-pad" width=400 height=200 style="border: 1px solid #000;"></canvas>
                <input type="hidden" id="signature" name="signature">

                <button type="submit">Submit</button>
                <button type="button" id="clear">Clear Signature</button>
            </form>
        </div>
    </div>

    <script>
        var canvas = document.getElementById('signature-pad');
        var signaturePad = new SignaturePad(canvas);

        document.getElementById('appointment-form').addEventListener('submit', function(event) {
            if (signaturePad.isEmpty()) {
                alert("Please provide a signature first.");
                event.preventDefault();
            } else {
                var signatureData = signaturePad.toDataURL('image/png');
                document.getElementById('signature').value = signatureData;
            }
        });

        document.getElementById('clear').addEventListener('click', function() {
            signaturePad.clear();
        });
    </script>
</body>

</html>