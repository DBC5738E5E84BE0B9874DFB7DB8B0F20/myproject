<?php
include("C:/xampp/htdocs/my_project/config/config1.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $notification = $_POST['notification'];
    $link = $_POST['link'];

    $stmt = $conn->prepare("INSERT INTO notifications (message, link) VALUES (?, ?)");
    $stmt->bind_param("ss", $notification, $link);
    
    if ($stmt->execute()) {
        echo "<script>alert('Notification submitted successfully.'); window.location.href = 'notification_success.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
