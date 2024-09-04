<?php 
include("C:/xampp/htdocs/my_project/config/config1.php");
if (isset($_POST["submit"]))
{
    $facultyname=$_POST["facultyname"];
    $facultyemail=$_POST["facultyemail"];
    $department=$_POST["department"];
    $working=$_POST["working"];
    $year=$_POST["year"];
    $password=$_POST["password"];

    $stmt = $conn->prepare("SELECT password FROM faculty WHERE facultyemail = ?");
    $stmt->bind_param("s", $facultyemail);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo '<script>alert("You are already registered! Please log in.");
        window.location="facultylog.html";</script>';
    }
    
    else{
    $stmt = $conn->prepare("INSERT INTO faculty (facultyname,facultyemail,
    department,working,year,password) values (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $facultyname,$facultyemail,$department,$working,$year, $password);
    if ($stmt->execute())
    {
        echo '<script>alert("New record created successfully"); 
        window.location="facultylog.html"</script>';
    }
  

 else{
        echo "Error: " . $conn->error;
    }
    }
}
?>