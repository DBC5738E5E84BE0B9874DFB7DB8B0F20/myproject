<style>
    div{
        display: inline-block;
        border: 2px black solid;
        border-radius: 10px;
        margin: 10px 10px;
        padding: 10px 10px;
    }
    #user{
        background-color:hsl(63, 73%, 71%);
        width:18%;
    }
    #bcom
    {
        background-color:rgb(214, 241, 126);
    }
    #bba
    {
        background-color:rgb(170, 187, 233);
    }
    #bca
    {
        background-color:rgb(235, 155, 205);
    }
    </style>
<h3>hello admin</h3>


<h1> NEW APPLICATION FOR COURSES</h1>

<?php

include("C:/xampp/htdocs/my_project/config/config.php");
?>
<div id="user">
<h2>USER</h2>
<?php
$sql="SELECT COUNT('id') as totaluser from information";
$result = $conn->query($sql);
 if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<b>" .$row["totaluser"] ."</b>";
    }
}
else{
    echo "some error occured";
}
?>
<br><hr><br>
total applicants
</div>
<div id="bcom">
<h2>B.COM APPLICANTS</h2>
<?php
$sql="SELECT COUNT('id') as totaluser from information where course1='bcom' or course2='bcom' or course3='bcom'";
$result = $conn->query($sql);
 if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<b>" .$row["totaluser"] ."</b>";
    }
}
else{
    echo "some error occured";
}
?>
<br><hr><br>
    <a href="newapplication.php">B.Com APPLICANTS -></a>

</div>
<div id="bba">
<h2>B.B.A APPLICANTS</h2>
<?php
$sql="SELECT COUNT('id') as totaluser from information where course1='bba' or course2='bba' or course3='bba'";
$result = $conn->query($sql);
 if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<b>" .$row["totaluser"] ."</b>";
    }
}
else{
    echo "some error occured";
}
?>
<br><hr><br>
<a href="newapplication1.php">B.B.A APPLICANTS -></a>

</div>
<div id="bca">
<h2>B.C.A APPLICANTS</h2>
<?php
$sql="SELECT COUNT('id') as totaluser from information where course1='bca' or course2='bca' or course3='bca'";
$result = $conn->query($sql);
 if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<b>" .$row["totaluser"] ."</b>";
    }
}
else{
    echo "some error occured";
}
?>
<br><hr><br>
<a href="newapplication2.php">B.C.A APPLICANTS -></a>

</div>
<div id="user">
<h2>SEATS INFORMATION</h2>
<hr><br>

</div>
<div id="bcom">
<h2>B.COM APPLICANTS</h2>
<hr><br>
<a href="approved_students.php">B.COM APPLICANTS -></a>
</div>
<div id="bba">
<h2>B.B.A APPLICANTS</h2>
<hr><br>
<a href="approved_students_bba.php">B.B.A APPLICANTS -></a>
</div>
<div id="bca">
    
<h2>B.C.A APPLICANTS</h2>
<hr><br>
<a href="approved_students_bca.php">B.C.A APPLICANTS -></a>
</div>
