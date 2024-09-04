
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.Com Applicants - Personal Information</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Personal Information of Students Who Applied for B.Com</h1>

    <?php 
   include("C:/xampp/htdocs/my_project/config/config.php");
    $sql="SELECT id, name, dob, gender, email, phone, address, caste, aadhaarno FROM information WHERE course1='bcom' OR course2='bcom' OR course3='bcom'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Id</th><th>Name</th><th>Date of Birth</th><th>Gender</th><th>Email</th><th>Phone</th><th>Address</th><th>Caste</th><th>Aadhaar No</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo  "<td>". htmlspecialchars($row["id"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["name"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["dob"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["gender"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["email"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["phone"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["address"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["caste"]) ."</td>";
            echo  "<td>". htmlspecialchars($row["aadhaarno"]) ."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No data found.";
    }
    ?>

    <br>
    <a href="bcom_academic_info.php">Next: Academic Information -></a>
</body>
</html>
