<?php include("adminfunction.html"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Update External Marks</title>
    <style>
     
        form{
    width: 25rem;
    height: 25rem;
    background: rgba(255,255,255,0.06);
    box-shadow: 0 8px 32px 0 rgba(31,38,135,.37);
    border-radius: 20px;
    padding: 20px 20px;
    border: 1px solid rgba(255,255,255,.3);
   position: fixed;
   left: 500px;
   
}
body{
        background-image:linear-gradient(pink,rgba(214, 225, 226, 0.897));
        
    }
    input[type="submit"]{
    border: 1px transparent solid;
border-radius: 30px;
padding: 10px 20px;
background-color: white;
font-weight: bold; 
margin-right: 10px;



}
input[type="submit"]:hover{
    background-color: pink;
   
}
input[type="number"],input[type="text"],select{
  
  display: block;
 width: 80%;
  border: 1px solid transparent;
  border-radius: 20px;
  padding: 10px 0px;
  font-weight: bold;
  text-align:center; 
}
        </style>
</head>
<body>
  
    <center>
    <h1 style="color:black">Admin Update External Marks</h1>
    
    <form action="admin_update_marks.php" method="post">
   
        <input type="text" name="student_id" placeholder="&nbsp;&nbsp;Student ID:" required><br>

      
        <input type="number" min="1" max="75" name="externalMarks1" placeholder="&nbsp;&nbsp;External Marks (Subject 1):" required><br>

       
        <input type="number" min="1" max="75" name="externalMarks2" placeholder="&nbsp;&nbsp;External Marks (Subject 2):" required><br>

        
        <input type="number"  min="1" max="75" name="externalMarks3" placeholder="&nbsp;&nbsp;External Marks (Subject 3):" required><br>

      
        <input type="number" min="1" max="75" name="externalMarks4" placeholder="&nbsp;&nbsp;External Marks (Subject 4):" required><br>

       
        <input type="number" min="1" max="75" name="externalMarks5" placeholder="&nbsp;&nbsp;External Marks (Subject 5):" required><br>

        <input type="submit" value="Update External Marks">
    </form>
</center>
    <?php
    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle form data and insert into database
        // Ensure to sanitize and validate input data
        $student_id = $_POST['student_id'];
        $externalMarks1 = $_POST['externalMarks1'];
        $externalMarks2 = $_POST['externalMarks2'];
        $externalMarks3 = $_POST['externalMarks3'];
        $externalMarks4 = $_POST['externalMarks4'];
        $externalMarks5 = $_POST['externalMarks5'];

        // Connect to database (assume you have a connection)
        include("C:/xampp/htdocs/my_project/config/config1.php"); // Your database connection file

        // Update externalMarks in results table for the specified student
        $sql = "UPDATE results 
                SET externalMarks1 = '$externalMarks1',
                    externalMarks2 = '$externalMarks2',
                    externalMarks3 = '$externalMarks3',
                    externalMarks4 = '$externalMarks4',
                    externalMarks5 = '$externalMarks5'
                WHERE student_id = '$student_id'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('External marks updated successfully!')
            window.location='admin_result_check.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close connection
        $conn->close();
    }
    ?>
</body>
</html>
