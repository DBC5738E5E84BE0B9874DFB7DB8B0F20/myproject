<?php
include("C:/xampp/htdocs/my_project/config/config1.php");

// Retrieve notifications from the database
$sql = "SELECT id, message, link, created_at FROM notifications ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Current Notifications</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .notification {
      margin: 10px 0;
      margin-left: 20px;
    }
    .notification p {
      margin: 5px 0;
    }
    .notification a {
      color: blue;
      text-decoration: none;
    }
    .notification a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <h2>Current Notifications</h2>
  
  <marquee direction="up" scrollamount="2" >
    <div class="topic">
      <?php
      if ($result->num_rows > 0) {
          // Output data of each row
          while($row = $result->fetch_assoc()) {
              echo "<div class='notification'>";
              echo "<p><strong>Notification:</strong> " . htmlspecialchars($row["message"]) . "</p>";
              echo "<p><small><em>Posted on: " . $row["created_at"] . "</em></small></p>";
              echo "<p><a href='" . htmlspecialchars($row["link"]) . "' target='_blank'>CLICK HERE TO CHECK</a></p>";
              echo "</div><hr>";
          }
      } else {
          echo "No notifications found.";
      }
      ?>
    </div>
  </marquee>
  
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
