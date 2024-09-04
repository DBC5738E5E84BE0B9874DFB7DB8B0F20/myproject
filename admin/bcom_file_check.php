<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.Com Applicants - File Checking</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>File Checking for Students Who Applied for B.Com</h1>

    <?php 
     include("C:/xampp/htdocs/my_project/config/config.php");
    $sql="SELECT id, name, photo, signature, transfer, aadharfile, tenthmarksheet, twelfthmarksheet, community FROM information WHERE course1='bcom' OR course2='bcom' OR course3='bcom'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th><th>Photo</th><th>Signature</th><th>Transfer Certificate</th><th>Aadhaar File</th><th>10th Marksheet</th><th>12th Marksheet</th><th>Community Certificate</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo  "<td>". htmlspecialchars($row["id"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["name"]) ."</td>";
            echo  "<td><img src='data:image/jpeg;base64,". base64_encode($row["photo"]) ."' width='100' height='100' /></td>";
            echo  "<td><img src='data:image/jpeg;base64,". base64_encode($row["signature"]) ."' width='100' height='100' /></td>";
            echo  "<td><img src='data:image/jpeg;base64,". base64_encode($row["transfer"]) ."' width='100' height='100' /></td>";
            echo  "<td><img src='data:image/jpeg;base64,". base64_encode($row["aadharfile"]) ."' width='100' height='100' /></td>";
            echo  "<td><img src='data:image/jpeg;base64,". base64_encode($row["tenthmarksheet"]) ."' width='100' height='100' /></td>";
            echo  "<td><img src='data:image/jpeg;base64,". base64_encode($row["twelfthmarksheet"]) ."' width='100' height='100' /></td>";
            echo  "<td><img src='data:image/jpeg;base64,". base64_encode($row["community"]) ."' width='100' height='100' /></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No data found.";
    }
    ?>

    <br>
    <a href="bcom_course_info.php">Next: Course Details -></a>
</body>
</html>
