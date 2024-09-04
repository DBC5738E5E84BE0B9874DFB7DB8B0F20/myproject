<!DOCTYPE html>
<html>
<head>
    <title>Submit Internal Marks</title>
    <style>
        body{
        background-image:linear-gradient(pink,rgb(136, 186, 233));
  background-repeat: no-repeat;
  background-size: 1600px 1000px;
backdrop-filter: blur(5px);
-webkit-backdrop-filter: blur(5px);
font-size: 20px;
        }
        center{
position: relative;
left: 250px;  
    
   width: 60%;
    box-shadow: 0 8px 32px 0 rgba(31,38,135,.37);
    border-radius: 20px;
    padding: 20px 20px;
    border: 1px solid rgba(255,255,255,.3);
   
   margin-top: 30px;
}
h1{
    text-shadow: 2px 2px 4px rgba(0,0,0,.2);
 
}
input[type="submit"]{
    border: 1px transparent solid;
border-radius: 30px;
padding: 10px 20px;
background-color: white;
font-weight: bold; 
margin-right: 10px;
width: 40%;


}
input[type="submit"]:hover{
    background-color: pink;
   
}

        </style>
</head>
<body>
    <center>
    <h1>Submit Internal Marks</h1>
    <form action="submit_marks.php" method="post">
        <label for="student_id">Student ID:</label>
        <input type="text" name="student_id" required><br><br>

        <!-- Subject 1 -->
        <label for="subject1">Subject 1:</label>
        <input type="text" name="subject1" required>
        <label for="internalMarks1">Internal Marks:</label>
        <input type="number" name="internalMarks1" min="1" max="25" required><br><br>

        <!-- Subject 2 -->
        <label for="subject2">Subject 2:</label>
        <input type="text" name="subject2">
        <label for="internalMarks2">Internal Marks:</label>
        <input type="number" name="internalMarks2" min="1" max="25"><br><br>

        <!-- Subject 3 -->
        <label for="subject3">Subject 3:</label>
        <input type="text" name="subject3">
        <label for="internalMarks3">Internal Marks:</label>
        <input type="number" name="internalMarks3" min="1" max="25"><br><br>

        <!-- Subject 4 -->
        <label for="subject4">Subject 4:</label>
        <input type="text" name="subject4">
        <label for="internalMarks4">Internal Marks:</label>
        <input type="number" name="internalMarks4" min="1" max="25"><br><br>

        <!-- Subject 5 -->
        <label for="subject5">Subject 5:</label>
        <input type="text" name="subject5">
        <label for="internalMarks5">Internal Marks:</label>
        <input type="number" name="internalMarks5" min="1" max="25"><br><br>

        <input type="submit" value="Submit Marks">
    </form>
    </center>
    <?php
    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle form data and insert into database
        // Ensure to sanitize and validate input data
        $student_id = $_POST['student_id'];

        // Subject 1
        $subject1 = $_POST['subject1'];
        $internalMarks1 = $_POST['internalMarks1'];

        // Subject 2
        $subject2 = $_POST['subject2'];
        $internalMarks2 = $_POST['internalMarks2'];

        // Subject 3
        $subject3 = $_POST['subject3'];
        $internalMarks3 = $_POST['internalMarks3'];

        // Subject 4
        $subject4 = $_POST['subject4'];
        $internalMarks4 = $_POST['internalMarks4'];

        // Subject 5
        $subject5 = $_POST['subject5'];
        $internalMarks5 = $_POST['internalMarks5'];

        // Connect to database (assume you have a connection)
        include("C:/xampp/htdocs/my_project/config/config1.php"); // Your database connection file

        // Perform SQL insert into results table
        $sql = "INSERT INTO results (student_id, subject1, internalMarks1, subject2, internalMarks2, 
                                     subject3, internalMarks3, subject4, internalMarks4, 
                                     subject5, internalMarks5)
                VALUES ('$student_id', '$subject1', '$internalMarks1', '$subject2', '$internalMarks2', 
                        '$subject3', '$internalMarks3', '$subject4', '$internalMarks4', 
                        '$subject5', '$internalMarks5')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Internal marks submitted successfully!');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close connection
        $conn->close();
    }
    ?>
    <a href="facultyfunction.html">BACK</a>
</body>
</html>

