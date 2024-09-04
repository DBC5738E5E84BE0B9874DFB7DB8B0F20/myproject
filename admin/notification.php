<?php include("adminfunction.html"); ?>
<style>
    label {
        font-size: 30px;
    }
    form {
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
    body {
        background-image: linear-gradient(pink, rgba(214, 225, 226, 0.897));
    }
    button {
        border: 1px transparent solid;
        border-radius: 30px;
        padding: 10px 20px;
        background-color: white;
        font-weight: bold; 
        margin-right: 10px;
    }
    button:hover {
        background-color: pink;
    }
    textarea {
        display: block;
        border: 1px solid transparent;
        border-radius: 20px;
        padding: 10px 10px;
    }
    input[type="text"] {
        display: block;
        width: calc(100% - 20px);
        border: 1px solid transparent;
        border-radius: 20px;
        padding: 10px 10px;
        margin-top: 10px;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enter Notification</title>
</head>
<body>
    <center>
        <form method="post" action="save_notification.php">
            <h1 style="color: black">Enter Notification</h1>
            <label for="notification">Notification:</label><br><br>
            <textarea id="notification" name="notification" rows="4" cols="50"></textarea><br><br>
            <label for="link">Target Page URL:</label><br><br>
            <input type="text" id="link" name="link"><br><br>
            <button type="submit">Submit</button>
        </form>
    </center>
</body>
</html>
