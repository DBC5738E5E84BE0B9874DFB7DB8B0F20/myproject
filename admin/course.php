

<?php include("adminfunction.html"); ?>
<style>
    h1.course{
        color: black;
        padding: 20px 20px;
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
input[type="text"]{
  
  display: block;
 
  border: 1px solid transparent;
  border-radius: 20px;
  padding: 10px 40px;
}
    </style>
    <body>
        <center>
        <h1 class="course">COURSE OFFERED IN OUR COLLEGE</h1>
<form action="course.php" method="post">

   <label for="course">ENTER THE COURSE NAME YOU WANT TO ADD:</label>
   <br><br>
   <input type="text" name="course" required>
   <br><br>
   <input type="submit" value="submit">
</form>
<?php
include("C:/xampp/htdocs/my_project/config/config1.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $course = htmlspecialchars($_POST['course']);
    

    $sql = "INSERT INTO courses (courseName) VALUES ('$course')";

    if ($conn->query($sql) === TRUE) {
  
        echo "<script>alert('course is added successfully')</script>";
    } 
    
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>
<h2> ADMIN PANEL</h2>
<?php
if (isset($_GET['delete'])) {
    $idToDelete = intval($_GET['delete']);
    $deleteSql = "DELETE FROM courses WHERE id=$idToDelete";
    $conn->query($deleteSql);
}


$sql = "SELECT id, courseName FROM courses ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>COURSE ID</th><th>COURSE NAME</th><th>DELETE</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["courseName"] . "</td>";
        echo "<td><a href='course.php?delete=" . $row["id"] . "'>Delete</a></td>";
        echo "</tr>";
    }
    
    echo "</table>";
}else {
      echo "No courses found.";
  }
  ?>
  </center>
  </body>