<?php include("adminfunction.html"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notification Saved</title>
  <style>
    .notify {
        width: 25rem;
        
        background: rgba(255, 255, 255, 0.06);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, .37);
        border-radius: 20px;
        padding: 20px 20px;
        border: 1px solid rgba(255, 255, 255, .3);
        position: fixed;
        left: 500px;
        top: 50px;
    }
 .notify a {
        text-decoration: none;
        font-size: 20px;
        display: block;
        padding: 10px 20px;
        border: 2px lightblue solid;
        margin: 30px 30px;
        color: darkmagenta;
    }
    a:hover {
        background-color: lightblue;
    }
  </style>
</head>
<body>
<div class="notify">
<center>
  <a href="notification.php">Enter Notification</a>
  <a href="admin_display_notifications.php">View Notifications</a>
  <a href="adminfunction.html">Exit</a>
</center>
</div>
</body>
</html>
