<style>
body{
        background-image:linear-gradient(pink,rgba(214, 225, 226, 0.897));
        

}
</style>
<center>
<?php
include("C:/xampp/htdocs/my_project/config/config1.php");


// Prepare data from POST
$registerNumber = $_POST['registerNumber'];
$studentName = $_POST['studentName'];
$course = $_POST['course'];
$aprilPercentage = $_POST['aprilPercentage'];
$mayPercentage = $_POST['mayPercentage'];
$junePercentage = $_POST['junePercentage'];
$totalPercentage = $_POST['totalPercentage'];
$attendanceMarks = $_POST['attendanceMarks'];

// Find the student ID based on register number
$sql_student = "SELECT id FROM students WHERE registerNumber = '$registerNumber'";
$result_student = $conn->query($sql_student);
$student_id = $result_student->fetch_assoc()['id'];

// Find the course ID based on course name
$sql_course = "SELECT id FROM courses WHERE courseName = '$course'";
$result_course = $conn->query($sql_course);
$course_id = $result_course->fetch_assoc()['id'];

// SQL statement to insert data
$sql = "INSERT INTO attendance_percentages (student_id, course_id, april, may, june, totalpercentage, attendancemarks)
        VALUES ('$student_id', '$course_id', '$aprilPercentage', '$mayPercentage', '$junePercentage', '$totalPercentage', '$attendanceMarks')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Submitted successfully');</script>";
} else {
    echo $conn->error;
}

$conn->close();
?>

<a href="attendancerecord.html">Add another</a>

<?php
include("C:/xampp/htdocs/my_project/config/config1.php");

$sql = "SELECT 
students.name, 
students.registerNumber, 
attendance_percentages.april, 
attendance_percentages.may, 
attendance_percentages.june, 
attendance_percentages.totalpercentage, 
attendance_percentages.attendancemarks
FROM 
students
JOIN 
attendance_percentages 
ON 
students.id = attendance_percentages.student_id";
$result = $conn->query($sql);

echo "<h1>Attendance Records</h1>";
echo "<table border='1'>
<tr>
<th>Student Name</th>
<th>Register Number</th>
<th>April</th>
<th>May</th>
<th>June</th>
<th>Total Percentage</th>
<th>Marks</th>
</tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["name"] . "</td>
        <td>" . $row["registerNumber"] . "</td>
        <td>" . $row["april"] . "</td>
        <td>" . $row["may"] . "</td>
        <td>" . $row["june"] . "</td>
        <td>" . $row['totalpercentage'] . "</td>
        <td>" . $row['attendancemarks'] . "</td>
        </tr>";
    }
} else {
    echo "0 results";
}
echo "</table>";

$conn->close();
?>
<a href="facultyfunction.html">back</a>
</center>