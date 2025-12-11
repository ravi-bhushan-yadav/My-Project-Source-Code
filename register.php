<?php
//Save this as register.php inside your XAMPP htdocs/agriculture folder.
// Database connection
$conn = mysqli_connect("localhost", "root", "", "agriculture");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$fullname = $_POST['fullname'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm_password'];
$address = $_POST['address'];
$usertype = $_POST['usertype'];

// Check password match
if ($password != $confirm) {
    die("Error: Passwords do not match!");
}

// Check if email already exists
$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($check) > 0) {
    die("Error: Email already registered!");
}

// Encrypt password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user
$sql = "INSERT INTO users(fullname, mobile, email, password, address, usertype)
        VALUES('$fullname', '$mobile', '$email', '$hashed_password', '$address', '$usertype')";

if (mysqli_query($conn, $sql)) {
    echo "<h2>Registration Successful!</h2>";
    echo "<p>You can now <a href='login.html'>login here</a>.</p>";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
