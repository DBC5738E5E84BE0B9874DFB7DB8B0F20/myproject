<?php
include("C:/xampp/htdocs/my_project/config/config.php");

// Fetch approved students
$sql = "SELECT id, name, application_id, email, phone FROM information WHERE status='approved' && course1='bca' OR course2='bca' OR course3='bca'";
$result = $conn->query($sql);

// Fetch available seats
$seat_check_sql = "SELECT available_seats FROM seats WHERE course_name='bca'";
$seat_result = $conn->query($seat_check_sql);
$seat_row = $seat_result->fetch_assoc();
$available_seats = $seat_row['available_seats'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Students</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Approved Students</h1>

    <p><strong>Available Seats: <?php echo $available_seats; ?></strong></p>

    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>S.No</th><th>Name</th><th>Application ID</th><th>Email</th><th>Phone Number</th></tr>";
        $s_no = 1;
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>". $s_no++ ."</td>";
            echo "<td>". htmlspecialchars($row["name"]) ."</td>";
            echo "<td>". htmlspecialchars($row["application_id"]) ."</td>";
            echo "<td>". htmlspecialchars($row["email"]) ."</td>";
            echo "<td>". htmlspecialchars($row["phone"]) ."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No students have been approved yet.";
    }
    ?>

    <br>
    <a href="mainapplicationpage.php">Back to Main Page</a>
</body>
</html>

<?php
$conn->close();
?>
