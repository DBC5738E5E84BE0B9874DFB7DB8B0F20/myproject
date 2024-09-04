<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.Com Applicants - Academic Information</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Academic Information of Students Who Applied for B.Com</h1>

    <?php 
     include("C:/xampp/htdocs/my_project/config/config.php");
    $sql="SELECT id, tenthboard, tenthschool, tenthpassingyear, tenthpercentage, twelfthboard, twelfthschool, twelfthpassingyear, subject1, marks1, subject2, marks2, subject3, marks3, subject4, marks4 FROM information WHERE course1='bcom' OR course2='bcom' OR course3='bcom'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>10th Board</th><th>10th School</th><th>10th Passing Year</th><th>10th Percentage</th><th>12th Board</th><th>12th School</th><th>12th Passing Year</th></tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo  "<td>". htmlspecialchars($row["id"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["tenthboard"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["tenthschool"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["tenthpassingyear"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["tenthpercentage"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["twelfthboard"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["twelfthschool"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["twelfthpassingyear"]) ."</td>";
            echo "</tr>";
        }
        echo "</table>";

        // Reset the result pointer and iterate through again for marks
        $result->data_seek(0);
        
        echo "<h2>Marks in Twelfth</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Subject 1</th><th>Marks 1</th><th>Subject 2</th><th>Marks 2</th><th>Subject 3</th><th>Marks 3</th><th>Subject 4</th><th>Marks 4</th><th>12th Marks (Except Languages)</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo  "<td>". htmlspecialchars($row["subject1"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["marks1"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["subject2"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["marks2"]) ."</td>"; 
            echo  "<td>". htmlspecialchars($row["subject3"]) ."</td>"; 
            echo  "<td>". htmlspecialchars($row["marks3"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["subject4"]) ."</td>"; 
            echo  "<td>". htmlspecialchars($row["marks4"]) ."</td>";
            echo  "<td>". (htmlspecialchars($row["marks1"]) + htmlspecialchars($row["marks2"]) + htmlspecialchars($row["marks3"]) + htmlspecialchars($row["marks4"])) ."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No data found.";
    }
    ?>

    <br>
    <a href="bcom_file_check.php">Next: File Checking -></a>
</body>
</html>
