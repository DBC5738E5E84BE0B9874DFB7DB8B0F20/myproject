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
    $deleteSql = "DELETE FROM results WHERE id=$idToDelete";
    if ($conn->query($deleteSql) === TRUE) {
        echo "<script>alert('Record deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
    }
}

// Handle update request
if (isset($_POST['update'])) {
    $idToUpdate = intval($_POST['id']);
    $subject1 = $_POST['subject1'];
    $internalMarks1 = $_POST['internalMarks1'];
    $externalMarks1 = $_POST['externalMarks1'];
    // Repeat for subject2 to subject5

    $updateSql = "UPDATE results SET 
                    subject1='$subject1', 
                    internalMarks1='$internalMarks1', 
                    externalMarks1='$externalMarks1', 
                    ... 
                    WHERE id=$idToUpdate";
    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('Record updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
    }
}

// Fetch result records
$sql = "SELECT r.id, s.name, s.registerNumber, 
               r.subject1, r.internalMarks1, r.externalMarks1, 
               r.subject2, r.internalMarks2, r.externalMarks2, 
               r.subject3, r.internalMarks3, r.externalMarks3, 
               r.subject4, r.internalMarks4, r.externalMarks4, 
               r.subject5, r.internalMarks5, r.externalMarks5 
        FROM results r
        JOIN students s ON r.student_id = s.id";
$result = $conn->query($sql);

echo "<h1>Result Records</h1>";
echo "<table border='1'>
<tr>
<th>ID</th>
<th>Student Name</th>
<th>Register Number</th>
<th>Subject 1</th>
<th>Internal Marks 1</th>
<th>External Marks 1</th>
<th>Subject 2</th>
<th>Internal Marks 2</th>
<th>External Marks 2</th>
<th>Subject 3</th>
<th>Internal Marks 3</th>
<th>External Marks 3</th>
<th>Subject 4</th>
<th>Internal Marks 4</th>
<th>External Marks 4</th>
<th>Subject 5</th>
<th>Internal Marks 5</th>
<th>External Marks 5</th>
<th>Delete</th>
<th>Internal Update</th>
<th>External Update</th>
</tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["id"] . "</td>
        <td>" . $row["name"] . "</td>
        <td>" . $row["registerNumber"] . "</td>
        <td>" . $row["subject1"] . "</td>
        <td>" . $row["internalMarks1"] . "</td>
        <td>" . $row["externalMarks1"] . "</td>
        <td>" . $row["subject2"] . "</td>
        <td>" . $row["internalMarks2"] . "</td>
        <td>" . $row["externalMarks2"] . "</td>
        <td>" . $row["subject3"] . "</td>
        <td>" . $row["internalMarks3"] . "</td>
        <td>" . $row["externalMarks3"] . "</td>
        <td>" . $row["subject4"] . "</td>
        <td>" . $row["internalMarks4"] . "</td>
        <td>" . $row["externalMarks4"] . "</td>
        <td>" . $row["subject5"] . "</td>
        <td>" . $row["internalMarks5"] . "</td>
        <td>" . $row["externalMarks5"] . "</td>
       <td>
            <a href='?delete=" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
        </td>
        <td>
            <a href='admin_update_marks.php?edit=" . $row["id"] . "'>External Edit</a>
        </td>
        <td>
            <a href='faculty_update_marks.php?edit=" . $row["id"] . "'>Internal Edit</a>
        </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='19'>No records found</td></tr>";
}
echo "</table>";

// If edit is requested
if (isset($_GET['edit'])) {
    $idToEdit = intval($_GET['edit']);
    $editSql = "SELECT * FROM results WHERE id=$idToEdit";
    $editResult = $conn->query($editSql);
    if ($editResult->num_rows > 0) {
        $editRow = $editResult->fetch_assoc();
        echo '<h2>Edit Result Record</h2>
              <form method="post" action="admin_update_marks.php">
                <input type="hidden" name="id" value="' . $editRow["id"] . '">
                <label>Subject 1: <input type="text" name="subject1" value="' . $editRow["subject1"] . '" required></label><br>
                <label>Internal Marks 1: <input type="number" step="0.01" name="internalMarks1" value="' . $editRow["internalMarks1"] . '" required></label><br>
                <label>External Marks 1: <input type="number" step="0.01" name="externalMarks1" value="' . $editRow["externalMarks1"] . '" required></label><br>
                <!-- Repeat for subject2 to subject5 -->
                <button type="submit" name="update">Update</button>
              </form>';
    }
}

$conn->close();
?>
<button>
<a href="adminfunction.html">back</a></button>
</center>
</body>