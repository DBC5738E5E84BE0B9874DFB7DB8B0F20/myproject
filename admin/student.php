<?php include("adminfunction.html"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        label{
            display: block;
            font-size: 30px;
        }
        form{
    width: 25rem;
    height: 20rem;
    background: rgba(255,255,255,0.06);
    box-shadow: 0 8px 32px 0 rgba(31,38,135,.37);
    border-radius: 20px;
    padding: 20px 20px;
    border: 1px solid rgba(255,255,255,.3);
   position: fixed;
   left: 640px;
   
}
body{
        background-image:linear-gradient(pink,rgba(214, 225, 226, 0.897));
        
    }
    button{
    border: 1px transparent solid;
border-radius: 30px;
padding: 10px 20px;
background-color: white;
font-weight: bold; 
margin-right: 10px;



}
button:hover{
    background-color: pink;
   
}
input[type="text"],select{
  
  display: block;
 width: 80%;
  border: 1px solid transparent;
  border-radius: 20px;
  padding: 10px 0px;
}
        </style>
</head>
<body>
    <center>
    <h1 style="color:black">Student Registration Form</h1>
    <form action="student.php" method="POST">
      <br><br>
        <input type="text" id="registerNumber" name="registerNumber" placeholder="&nbsp;&nbsp;registerNumber" required><br><br>
        
       
        <input type="text" id="name" name="name" placeholder="&nbsp;&nbsp;Name" required><br><br>
        
  
        <select id="course_id" name="course_id" required>
            <option value="">&nbsp;&nbsp;Select Course</option>
            <?php
          include("C:/xampp/htdocs/my_project/config/config1.php");

            // Fetch courses from database
            $sql = "SELECT id, courseName FROM courses";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["courseName"] . "</option>";
                }
            }

           
            ?>
        </select><br><br>
        
        <button type="submit">Register</button>
        
    </form>
        </center>
</body>
</html>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registerNumber = $_POST["registerNumber"];
    $name = $_POST["name"];
    $course_id = $_POST["course_id"];

    // SQL query to insert data into students table
    $sql = "INSERT INTO students (registerNumber, name, course_id) VALUES ('$registerNumber', '$name', '$course_id')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New record created successfully')
        window.location='student_register_update.php'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
