<?php
include("C:/xampp/htdocs/my_project/config/config.php");

if(isset($_GET['id'])) {
    $student_id = intval($_GET['id']);

    // Fetch student details
    $sql = "SELECT * FROM information WHERE id=$student_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row) {
        if(isset($_POST['approve'])) {
            // Check if the student is already approved
            if ($row['status'] === 'approved') {
                echo "<script>alert('This student has already been approved.')</script>";
            } else {
                $course = 'bca';

                // Check available seats
                $seat_check_sql = "SELECT available_seats FROM seats WHERE course_name='$course'";
                $seat_result = $conn->query($seat_check_sql);
                $seat_row = $seat_result->fetch_assoc();

                if($seat_row['available_seats'] > 0) {
                    // Approve student
                    $approve_sql = "UPDATE information SET status='approved' WHERE id=$student_id";
                    $conn->query($approve_sql);

                    // Reduce available seats
                    $update_seats_sql = "UPDATE seats SET available_seats = available_seats - 1 WHERE course_name='$course'";
                    $conn->query($update_seats_sql);

                    // Send email
                    $student_email = $row['email'];
                    $subject = "Admission Approved";
                    $message = "Dear Student, Your application has been approved. Please come for counselling on [specific date].";
                    $headers = "From: katheejabarvin15@gmail.com";

                    mail($student_email, $subject, $message, $headers);

                    // Redirect to approved students page
                    header("Location: approved_students_bca.php");
                    exit();
                } else {
                    echo "No available seats.";
                }
            }
        }

        // Display student details
        echo "<form method='POST' action=''>
                <table border='1'>
                    <tr><th>Personal Information</th></tr>
                    <tr>
                        <td>Name: {$row['name']}</td>
                        <td>DOB: {$row['dob']}</td>
                        <td>Gender: {$row['gender']}</td>
                        <td>Email: {$row['email']}</td>
                        <td>Phone: {$row['phone']}</td>
                    </tr>
                    <tr>
                        <td>Address: {$row['address']}</td>
                        <td>Caste: {$row['caste']}</td>
                        <td>Aadhaar No: {$row['aadhaarno']}</td>
                    </tr>
                </table>

                <table border='1'>
                    <tr><th>Academic Information</th></tr>
                    <tr>
                        <td>Tenth Board: {$row['tenthboard']}</td>
                        <td>Tenth School: {$row['tenthschool']}</td>
                        <td>Tenth Passing Year: {$row['tenthpassingyear']}</td>
                        <td>Tenth Percentage: {$row['tenthpercentage']}</td>
                    </tr>
                    <tr>
                        <td>Twelfth Board: {$row['twelfthboard']}</td>
                        <td>Twelfth School: {$row['twelfthschool']}</td>
                        <td>Twelfth Passing Year: {$row['twelfthpassingyear']}</td>
                        <td>Twelfth Percentage: {$row['twelfthpercentage']}</td>
                    </tr>
                    <tr>
                        <td>Subject 1: {$row['subject1']} - Marks: {$row['marks1']}</td>
                        <td>Subject 2: {$row['subject2']} - Marks: {$row['marks2']}</td>
                        <td>Subject 3: {$row['subject3']} - Marks: {$row['marks3']}</td>
                        <td>Subject 4: {$row['subject4']} - Marks: {$row['marks4']}</td>
                    </tr>
                </table>

                <table border='1'>
                    <tr><th>Uploaded Files</th></tr>
                    <tr>
                        <td><img src='data:image/jpeg;base64,".base64_encode($row['photo'])."' alt='Photo' width='100' height='100'/></td>
                        <td><img src='data:image/jpeg;base64,".base64_encode($row['signature'])."' alt='Signature' width='100' height='100'/></td>
                        <td><img src='data:image/jpeg;base64,".base64_encode($row['transfer'])."' alt='Transfer Certificate' width='100' height='100'/></td>
                        <td><img src='data:image/jpeg;base64,".base64_encode($row['aadharfile'])."' alt='Aadhar File' width='100' height='100'/></td>
                        <td><img src='data:image/jpeg;base64,".base64_encode($row['tenthmarksheet'])."' alt='Tenth Marksheet' width='100' height='100'/></td>
                        <td><img src='data:image/jpeg;base64,".base64_encode($row['twelfthmarksheet'])."' alt='Twelfth Marksheet' width='100' height='100'/></td>
                        <td><img src='data:image/jpeg;base64,".base64_encode($row['community'])."' alt='Community Certificate' width='100' height='100'/></td>
                    </tr>
                </table>

                <input type='hidden' name='student_id' value='{$row['id']}' />
                <input type='submit' name='approve' value='Approve' />
            </form>";
    } else {
        echo "No student found with this ID.";
    }
} else {
    echo "No student ID provided.";
}

$conn->close();
?>
