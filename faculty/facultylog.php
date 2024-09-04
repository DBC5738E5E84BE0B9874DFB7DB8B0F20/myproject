
<?php
include("C:/xampp/htdocs/my_project/config/config1.php");

// Get form data
$user = $_POST['email'];
$pass = $_POST['password'];

// Fetch user from database
$sql = "SELECT password FROM faculty WHERE facultyemail='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
 
    $row = $result->fetch_assoc();
    if ($pass== $row['password']) {
    
        echo '<script>alert("Login successful!");
        window.location="facultyfunction.html"</script>';
       
    } else {
      
        echo '<script>alert("Invalid username or password.");
        window.location="facultylog.html"</script>';
    }
} else {
    echo '<script>alert("Invalid username or password.");
    window.location="index.php"</script>';
}


?>