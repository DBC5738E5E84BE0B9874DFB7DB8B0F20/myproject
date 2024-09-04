<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.Com Applicants - Course Details</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Course Details of Students Who Applied for B.Com</h1>

    <?php 
    include("C:/xampp/htdocs/my_project/config/config.php");
    $sql = "SELECT id, course1,shiftoption1, course2,shiftoption2,
     course3 ,shiftoption3 FROM information WHERE course1='bcom' OR course2='bcom' OR course3='bcom'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Id</th><th>First Course</th><th>shiftoption1</th><th>Second Course</th><th>shiftoption2</th>
        <th>Third Course</th><th>shiftoption3</th><th>Action</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>". htmlspecialchars($row["id"]) ."</td>";
           
            echo "<td>". htmlspecialchars($row["course1"]) ."</td>";
            echo "<td>". htmlspecialchars($row["shiftoption1"]) ."</td>";
            echo "<td>". htmlspecialchars($row["course2"]) ."</td>";
            echo "<td>". htmlspecialchars($row["shiftoption2"]) ."</td>";
            echo "<td>". htmlspecialchars($row["course3"]) ."</td>";
            echo "<td>". htmlspecialchars($row["shiftoption3"]) ."</td>";
            echo "<td><a href='approval.php?id=".$row["id"]."'>Approve</a></td>";
;
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No data found.";
    }
    ?>

    <br>
    <a href="approved_students.php">APPROVED STUDENTS PAGE</a>
</body>
</html>
