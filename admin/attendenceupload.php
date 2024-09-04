<style>
body{
        background-image:linear-gradient(pink,rgba(214, 225, 226, 0.897));
        

}
table{
    background-color: white;
}
th,td{
  padding: 10px 10px;
}
a{
    text-decoration: none;
    color: blue;
}
a:hover{
    color: red;  
}
button{
    padding: 10px 30px;
    margin: 20px 20px;

}
button:hover{
    background: pink;
}
</style>
<body>
<center>
<?php
include("C:/xampp/htdocs/my_project/config/config1.php");

// Handle delete request
if (isset($_GET['delete'])) {
    $idToDelete = intval($_GET['delete']);
    $deleteSql = "DELETE FROM attendance_percentages WHERE id=$idToDelete";
    if ($conn->query($deleteSql) === TRUE) {
        echo "<script>alert('Record deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
    }
}

// Handle update request
if (isset($_POST['update'])) {
    $idToUpdate = intval($_POST['id']);
    $april = $_POST['april'];
    $may = $_POST['may'];
    $june = $_POST['june'];
    $totalPercentage = ($_POST['april'] + $_POST['may'] + $_POST['june']) / 3;
    $attendanceMarks = ($totalPercentage / 100) * 5; // Assuming max marks are 25

    $updateSql = "UPDATE attendance_percentages SET 
                    april='$april', 
                    may='$may', 
                    june='$june', 
                    totalpercentage='$totalPercentage', 
                    attendancemarks='$attendanceMarks' 
                  WHERE id=$idToUpdate";
    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('Record updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
    }
}

// Fetch attendance records
$sql = "SELECT ap.id, s.name, s.registerNumber, ap.april, ap.may, ap.june, ap.totalpercentage, ap.attendancemarks 
        FROM attendance_percentages ap
        JOIN students s ON ap.student_id = s.id";
$result = $conn->query($sql);

echo "<h1>Attendance Records</h1>";
echo "<table border='1'>
<tr>
<th>ID</th>
<th>Student Name</th>
<th>Register Number</th>
<th>April</th>
<th>May</th>
<th>June</th>
<th>Total Percentage</th>
<th>Marks</th>
<th>Delete</th>
<th>Update</th>
</tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["id"] . "</td>
        <td>" . $row["name"] . "</td>
        <td>" . $row["registerNumber"] . "</td>
        <td>" . $row["april"] . "</td>
        <td>" . $row["may"] . "</td>
        <td>" . $row["june"] . "</td>
        <td>" . $row['totalpercentage'] . "</td>
        <td>" . $row['attendancemarks'] . "</td>
      <td>
            <a href='attendenceupload.php?delete=" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
         </td> 
         <td>
            <a href='attendenceupload.php?edit=" . $row["id"] . "'>Edit</a>
        </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='9'>No records found</td></tr>";
}
echo "</table>";

// If edit is requested
if (isset($_GET['edit'])) {
    $idToEdit = intval($_GET['edit']);
    $editSql = "SELECT * FROM attendance_percentages WHERE id=$idToEdit";
    $editResult = $conn->query($editSql);
    if ($editResult->num_rows > 0) {
        $editRow = $editResult->fetch_assoc();
        echo '<h2>Edit Attendance Record</h2>
              <form method="post" action="attendenceupload.php">
                <input type="hidden" name="id" value="' . $editRow["id"] . '">
                <label>April: <input type="number" name="april" value="' . $editRow["april"] . '" required></label><br>
                <label>May: <input type="number" name="may" value="' . $editRow["may"] . '" required></label><br>
                <label>June: <input type="number" name="june" value="' . $editRow["june"] . '" required></label><br>
                <button type="submit" name="update">Update</button>
              </form>';
    }
}

$conn->close();
?>
<button>
<a href="adminfunction.html">back</a></button>
<center>
</body>