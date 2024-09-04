<style>
     
     label{
        font-size:20px;
     }
        form{
    width: 25rem;
    height: 27rem;
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
input[type="number"],select{
  
  display: block;
 width: 80%;
  border: 1px solid transparent;
  border-radius: 20px;
  padding: 10px 0px;
  font-weight: bold;
  text-align:center; 
}
        </style>
        <body>
<?php
include("C:/xampp/htdocs/my_project/config/config1.php");
include("adminfunction.html");

if (isset($_POST['update'])) {
    $idToUpdate = intval($_POST['id']);
    $internalMarks1 = $_POST['internalMarks1'];
    $internalMarks2 = $_POST['internalMarks2'];
    $internalMarks3 = $_POST['internalMarks3'];
    $internalMarks4 = $_POST['internalMarks4'];
    $internalMarks5 = $_POST['internalMarks5'];

    $updateSql = "UPDATE results SET 
                    internalMarks1='$internalMarks1', 
                    internalMarks2='$internalMarks2', 
                    internalMarks3='$internalMarks3', 
                    internalMarks4='$internalMarks4', 
                    internalMarks5='$internalMarks5'
                  WHERE id=$idToUpdate";
    
    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('Internal Marks updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating internal marks: " . $conn->error . "');</script>";
    }
}

if (isset($_GET['edit'])) {
    $idToEdit = intval($_GET['edit']);
    $editSql = "SELECT * FROM results WHERE id=$idToEdit";
    $editResult = $conn->query($editSql);
    if ($editResult->num_rows > 0) {
        $editRow = $editResult->fetch_assoc();
        echo '<center><h2>Edit Internal Marks</h2></center>
              <form method="post" action="faculty_update_marks.php">
                <input type="hidden" name="id" value="' . $editRow["id"] . '">
                <label>Subject 1: <input type="number" step="0.01" name="internalMarks1" value="' . $editRow["internalMarks1"] . '" required></label><br>
                <label>Subject 2: <input type="number" step="0.01" name="internalMarks2" value="' . $editRow["internalMarks2"] . '" required></label><br>
                <label>Subject 3: <input type="number" step="0.01" name="internalMarks3" value="' . $editRow["internalMarks3"] . '" required></label><br>
                <label>Subject 4: <input type="number" step="0.01" name="internalMarks4" value="' . $editRow["internalMarks4"] . '" required></label><br>
                <label>Subject 5: <input type="number" step="0.01" name="internalMarks5" value="' . $editRow["internalMarks5"] . '" required></label><br>
                <button type="submit" name="update">Update Internal Marks</button>
              </form>';
    }
}

$conn->close();
?>
</body>