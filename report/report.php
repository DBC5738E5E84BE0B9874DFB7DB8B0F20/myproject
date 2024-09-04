<?php
include("C:/xampp/htdocs/my_project/config/config.php");

// Fetch daily, monthly, and yearly registrations
$daily = $conn->query("SELECT COUNT(*) AS daily_registrations FROM information WHERE DATE(created_at) = CURDATE()")->fetch_assoc();
$monthly = $conn->query("SELECT COUNT(*) AS monthly_registrations FROM information WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())")->fetch_assoc();
$yearly = $conn->query("SELECT COUNT(*) AS yearly_registrations FROM information WHERE YEAR(created_at) = YEAR(CURDATE())")->fetch_assoc();

// Fetch daily, monthly, and yearly payment amounts
$daily_amount = $conn->query("SELECT SUM(amount) AS daily_amount FROM payments WHERE DATE(created_at) = CURDATE()")->fetch_assoc();
$monthly_amount = $conn->query("SELECT SUM(amount) AS monthly_amount FROM payments WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())")->fetch_assoc();
$yearly_amount = $conn->query("SELECT SUM(amount) AS yearly_amount FROM payments WHERE YEAR(created_at) = YEAR(CURDATE())")->fetch_assoc();

// Fetch course demand
$course_demand = $conn->query("SELECT course_name, 
       SUM(CASE WHEN course1 = course_name THEN 1 ELSE 0 END +
           CASE WHEN course2 = course_name THEN 1 ELSE 0 END +
           CASE WHEN course3 = course_name THEN 1 ELSE 0 END) AS course_demand 
   FROM information 
   JOIN seats ON seats.course_name IN (information.course1, information.course2, information.course3)
   GROUP BY course_name
   ORDER BY course_demand DESC");

// Define query variables for student details based on period selection
$student_details_query = "";
$student_details = false; // Initialize to false to avoid empty query execution

// Check which button was pressed and set the corresponding query
if (isset($_POST['view_daily'])) {
    $student_details_query = "SELECT i.name, i.application_id, i.status, i.course1 AS course_name, 
                              IF(p.amount IS NULL, 'Pending', 'Completed') AS payment_status
                              FROM information i
                              LEFT JOIN payments p ON i.application_id = p.applicationID
                              WHERE DATE(i.created_at) = CURDATE()";
} elseif (isset($_POST['view_monthly'])) {
    $student_details_query = "SELECT i.name, i.application_id, i.status, i.course1 AS course_name, 
                              IF(p.amount IS NULL, 'Pending', 'Completed') AS payment_status
                              FROM information i
                              LEFT JOIN payments p ON i.application_id = p.applicationID
                              WHERE MONTH(i.created_at) = MONTH(CURDATE()) AND YEAR(i.created_at) = YEAR(CURDATE())";
} elseif (isset($_POST['view_yearly'])) {
    $student_details_query = "SELECT i.name, i.application_id, i.status, i.course1 AS course_name, 
                              IF(p.amount IS NULL, 'Pending', 'Completed') AS payment_status
                              FROM information i
                              LEFT JOIN payments p ON i.application_id = p.applicationID
                              WHERE YEAR(i.created_at) = YEAR(CURDATE())";
}

// Execute the query to fetch student details only if the query is not empty
if (!empty($student_details_query)) {
    $student_details = $conn->query($student_details_query);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Application Report</title>
    <link rel="stylesheet" href="report.css">
</head>
<body>
    <h1>College Application Report</h1>
    <div class="report-container">
        <div class="report-section">
            <h2>Registrations Overview</h2>
            <p>Daily Registrations: <?php echo $daily['daily_registrations']; ?></p>
            <p>Monthly Registrations: <?php echo $monthly['monthly_registrations']; ?></p>
            <p>Yearly Registrations: <?php echo $yearly['yearly_registrations']; ?></p>

            <!-- Buttons for viewing student details -->
            <form method="post">
                <button type="submit" name="view_daily">View Daily Registrations</button>
                <button type="submit" name="view_monthly">View Monthly Registrations</button>
                <button type="submit" name="view_yearly">View Yearly Registrations</button>
            </form>
        </div>
<!-- Section to display fetched student details -->
<?php if ($student_details && $student_details->num_rows > 0): ?>
            <div class="report-section">
                <h2>Student Registrations</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Application ID</th>
                            <th>Course Name</th>
                            <th>Payment Status</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($student = $student_details->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $student['name']; ?></td>
                                <td><?php echo $student['application_id']; ?></td>
                                <td><?php echo $student['course_name']; ?></td>
                                <td><?php echo $student['payment_status']; ?></td>
                                <td><?php echo $student['status']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php elseif ($student_details !== false): ?>
            <p>No records found for the selected period.</p>
        <?php endif; ?>
    
        <div class="report-section">
            <h2>Payment Overview</h2>
            <p>Amount Received Today: ₹<?php echo number_format($daily_amount['daily_amount'], 2); ?></p>
            <p>Amount Received This Month: ₹<?php echo number_format($monthly_amount['monthly_amount'], 2); ?></p>
            <p>Amount Received This Year: ₹<?php echo number_format($yearly_amount['yearly_amount'], 2); ?></p>
        </div>

        <div class="report-section">
            <h2>Course Demand</h2>
            <table>
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Registrations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $course_demand->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['course_name']; ?></td>
                            <td><?php echo $row['course_demand']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

                    </div>        
</body>
</html>
