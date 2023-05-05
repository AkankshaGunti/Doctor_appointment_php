<?php session_start();

$db_host = "localhost";
$db_user = "admin";
$db_pass = "password";
$db_name = "hospitaldb";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);


if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$email = $_SESSION['email'];
$illness = $_POST['illness'];
$doctor = $_POST['doctor'];
$date =$_POST['date'];
$symptoms = $_POST['symptoms'];
$message = $_POST['message'];

$sql = "INSERT INTO history (email,illness,doctor,date,symptoms,message) VALUES ('$email','$illness','$doctor','$date','$symptoms','$message')";
if (mysqli_query($conn, $sql)) {
    header("Location: ./user.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>