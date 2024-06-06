<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $signature = $_POST['signature'];

    // Load or create the XML document
    $file = 'appointments.xml';
    if (file_exists($file)) {
        $xml = simplexml_load_file($file);
    } else {
        $xml = new SimpleXMLElement('<appointments/>');
    }

    // Create a new appointment entry
    $appointment = $xml->addChild('appointment');
    $appointment->addChild('name', $name);
    $appointment->addChild('email', $email);
    $appointment->addChild('date', $date);
    $appointment->addChild('time', $time);
    $appointment->addChild('signature', $signature);


    // Save the XML document
    $xml->asXML($file);

    echo "Appointment submitted successfully. <a href='legal-documents.php'>Back to Legal Documents</a>";
}
