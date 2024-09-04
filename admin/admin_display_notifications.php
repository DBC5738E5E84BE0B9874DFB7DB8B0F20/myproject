<?php
include("adminfunction.html");
include("C:/xampp/htdocs/my_project/config/config1.php");

// Handle deletion if delete parameter is set
if (isset($_GET['delete'])) {
    $idToDelete = intval($_GET['delete']);
    $deleteSql = "DELETE FROM notifications WHERE id=$idToDelete";
    $conn->query($deleteSql);
}

$sql = "SELECT id, message, link, created_at FROM notifications ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Notifications</title>
  <style>
    .notify {
      border: 1px solid transparent;
      padding: 30px 40px;
      max-width: 800px;
      margin: auto;
      margin-left: 420px;
    }
    .notification-item {
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid grey;
      border-radius: 10px;
    }
    .notification-item p {
      margin: 0;
    }
a {
      border: 2px solid grey;
      padding: 5px 10px;
      text-decoration: none;
      color: black;
      border-radius: 10px;
      margin-top: 10px;
      display: inline-block;
    }
     a:hover {
      background: grey;
      color: white;
    }
    .delete-link {
      background: red;
      color: white;
    }
    .delete-link:hover {
      background: darkred;
    }
  </style>
</head>
<body>
<div class="notify">
<h2>Manage Notifications</h2>
  <?php
  if ($result->num_rows > 0) {
      // Output data of each row
      while($row = $result->fetch_assoc()) {
          echo "<div class='notification-item'>";
          echo "<p><strong>Notification:</strong> " . htmlspecialchars($row["message"]) . "</p>";
          echo "<p><small><em>Posted on: " . $row["created_at"] . "</em></small></p>";
          echo "<a href='" . htmlspecialchars($row["link"]) . "' target='_blank'>Go to Link</a>";
          echo " <a href='admin_display_notifications.php?delete=" . $row["id"] . "' class='delete-link'>Delete</a>";
          echo "</div>";
      }
  } else {
      echo "No notifications found.";
  }
  ?>
  <a href="notification.php">Add Notification</a>
</div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
