<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}

// Load the XML file with error handling
$file = 'appointments.xml';
if (file_exists($file)) {
    libxml_use_internal_errors(true); // Enable internal error handling
    $xml = simplexml_load_file($file);

    if ($xml === false) {
        echo "Failed to load XML file.";
        foreach (libxml_get_errors() as $error) {
            echo "<br>", htmlspecialchars($error->message);
        }
        libxml_clear_errors();
        exit();
    }
} else {
    echo "No appointments found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Appointments</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .signature-info {
            display: none;
            position: absolute;
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="legal-documents.php">Legal Documents</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="check-appointments.php">Check Appointments</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <div class="content">
            <h3>Check Appointments</h3>
            <?php
            // Display the appointments
            if (count($xml->appointment) > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Name</th><th>Email</th><th>Date</th><th>Time</th><th>Signature</th></tr>";
                foreach ($xml->appointment as $appointment) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($appointment->name) . "</td>";
                    echo "<td>" . htmlspecialchars($appointment->email) . "</td>";
                    echo "<td>" . htmlspecialchars($appointment->date) . "</td>";
                    echo "<td>" . htmlspecialchars($appointment->time) . "</td>";
                    echo "<td><img src='" . htmlspecialchars($appointment->signature) . "' alt='Signature' width='200' onclick='showSignatureInfo(this, \"" . htmlspecialchars($appointment->name) . "\", \"" . htmlspecialchars($appointment->time) . "\")'></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No appointments found.";
            }
            ?>
            <div class="signature-info" id="signatureInfo"></div>
        </div>
    </div>

    <script>
        function showSignatureInfo(element, name, time) {
            var signatureInfo = document.getElementById('signatureInfo');
            var rect = element.getBoundingClientRect();
            signatureInfo.innerHTML = "<strong>Name:</strong> " + name + "<br><strong>Time:</strong> " + time;
            signatureInfo.style.top = rect.bottom + 'px';
            signatureInfo.style.left = rect.left + 'px';
            signatureInfo.style.display = 'block';
        }

        document.addEventListener('click', function(event) {
            var signatureInfo = document.getElementById('signatureInfo');
            if (!signatureInfo.contains(event.target)) {
                signatureInfo.style.display = 'none';
            }
        });
    </script>
</body>

</html>