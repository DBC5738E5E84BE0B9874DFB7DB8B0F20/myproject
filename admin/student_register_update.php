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
    $deleteSql = "DELETE FROM students WHERE id=$idToDelete";
    if ($conn->query($deleteSql) === TRUE) {
        echo "<script>alert('Record deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
    }
}

// Handle update request
if (isset($_POST['update'])) {
    $idToUpdate = intval($_POST['id']);
    $registerNumber = $_POST["registerNumber"];
    $name = $_POST["name"];
    $course_id = $_POST["course_id"];

    

    $updateSql = "UPDATE students SET 
                    registerNumber='   $registerNumber', 
                   name=' $name', 
                    course_id=' $course_id', 
                  WHERE id=$idToUpdate";
    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('Record updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
    }
}

// Fetch attendance records
$sql = "SELECT * from students";
$result = $conn->query($sql);

echo "<h1>Student Records</h1>";
echo "<table border='1'>
<tr>
<th>ID</th>
<th>Student Name</th>
<th>Register Number</th>
<th>Course_id</th>

<th>Delete</th>
<th>Update</th>
</tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["id"] . "</td>
        <td>" . $row["name"] . "</td>
        <td>" . $row["registerNumber"] . "</td>
        <td>" . $row["course_id"] . "</td>
      
        <td>
            <a href='student.php?delete=" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
         </td> <td>
            <a href='student.php?edit=" . $row["id"] . "'>Edit</a>
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
    $editSql = "SELECT * FROM students WHERE id=$idToEdit";
    $editResult = $conn->query($editSql);
    if ($editResult->num_rows > 0) {
        $editRow = $editResult->fetch_assoc();
        echo '<h2>Edit Students Record</h2>
              <form method="post" action="student.php">
                <input type="text" name="id" value="' . $editRow["id"] . '">
                <label>NAME: <input type="text" name="name" value="' . $editRow["name"] . '" required></label><br>
                <label>RegisterNumber <input type="text" name="registerNumber" value="' . $editRow["registerNumber"] . '" required></label><br>
                <label>Course_Id: <input type="text" name="course_id" value="' . $editRow["course_id"] . '" required></label><br>
                <button type="submit" name="update">Update</button>
              </form>';
    }
}

$conn->close();
?>
<button>
<a href="adminfunction.html">back</a></button>
<button>
<a href="student.php">Add Another</a></button>
</center>
</body>