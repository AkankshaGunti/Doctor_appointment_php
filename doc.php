<?php

$depart = $_POST["department"];

$db_host = "localhost";
$db_user = "admin";
$db_pass = "password";
$db_name = "hospitaldb";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$field = strval($depart)

$sql = "SELECT * from doctors where field='$field'";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
	while ($row = $result->fetch_assoc()) {
		echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
	}
} else {
	echo "<option value=''>No doctors found</option>";
}

$conn->close();
?>