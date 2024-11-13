<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Default username for XAMPP is 'root'
$password = ""; // Default password for XAMPP is empty
$dbname = "certificate_db"; // Name of your database

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $fullName = $conn->real_escape_string($_POST['fullName']);
    $guardianName = $conn->real_escape_string($_POST['guardianName']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $address = $conn->real_escape_string($_POST['address']);
    $city = $conn->real_escape_string($_POST['city']);
    $state = $conn->real_escape_string($_POST['state']);
    $postalCode = $conn->real_escape_string($_POST['postalCode']);
    $phoneNumber = $conn->real_escape_string($_POST['phoneNumber']);
    $email = $conn->real_escape_string($_POST['email']);
    $courseName = $conn->real_escape_string($_POST['courseName']);
    $department = $conn->real_escape_string($_POST['department']);
    $rollNumber = $conn->real_escape_string($_POST['rollNumber']);
    $yearOfPassing = $conn->real_escape_string($_POST['yearOfPassing']);
    $certificateType = $conn->real_escape_string($_POST['certificateType']);
    $reason = $conn->real_escape_string($_POST['reason']);
    $copies = (int)$_POST['copies'];

    // SQL query to insert data into the table
    $sql = "INSERT INTO certificate_requests (full_name, guardian_name, dob, gender, address, city, state, postal_code, phone_number, email, course_name, department, roll_number, year_of_passing, certificate_type, reason, copies)
            VALUES ('$fullName', '$guardianName', '$dob', '$gender', '$address', '$city', '$state', '$postalCode', '$phoneNumber', '$email', '$courseName', '$department', '$rollNumber', '$yearOfPassing', '$certificateType', '$reason', $copies)";

    // Execute the query and display success message
    if ($conn->query($sql) === TRUE) {
        echo "Application submitted successfully!<br><br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// CSS Styling for the table
echo '<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    table, th, td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
        text-align: center;
        font-weight: bold;
    }
    td {
        text-align: center;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #ddd;
    }
</style>';

// Query to select all data from certificate_requests table
$result = $conn->query("SELECT * FROM certificate_requests");

if ($result->num_rows > 0) {
    // Display table headers
    echo "<table>
            <tr>
                <th>Full Name</th>
                <th>Guardian Name</th>
                <th>Date Of Birth</th>
                <th>Gender</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Postal Code</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Course Name</th>
                <th>Department</th>
                <th>Roll Number</th>
                <th>Year of Passing</th>
                <th>Certificate Type</th>
                <th>Reason</th>
                <th>Copies</th>
            </tr>";
    
    // Display each row of data
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['full_name']}</td>
                <td>{$row['guardian_name']}</td>
                <td>{$row['dob']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['address']}</td>
                <td>{$row['city']}</td>
                <td>{$row['state']}</td>
                <td>{$row['postal_code']}</td>
                <td>{$row['phone_number']}</td>
                <td>{$row['email']}</td>
                <td>{$row['course_name']}</td>
                <td>{$row['department']}</td>
                <td>{$row['roll_number']}</td>
                <td>{$row['year_of_passing']}</td>
                <td>{$row['certificate_type']}</td>
                <td>{$row['reason']}</td>
                <td>{$row['copies']}</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}

// Close the connection
$conn->close();
?>
