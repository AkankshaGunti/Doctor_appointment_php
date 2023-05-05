
<?php session_start(); 

$db_host = "localhost";
$db_user = "admin";
$db_pass = "password";
$db_name = "hospitaldb";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
	<script defer src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="user.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	
</head>
<body>
	<?php 
		if(isset($_SESSION['email'])) {
			$email = $_SESSION['email'];
			$name  = $_SESSION['name'];
			$dob = $_SESSION['dob'] ;
			$city = $_SESSION['city'];
			$gender = $_SESSION['gender'];
			$phone = $_SESSION['phone'];
		} else {
            header("Location: ../hosp_login.html");	
		}       
	?>

	<div class="container profile"> 
		<div class="row">
			<div class="col-lg-4 col-sm-12">
				<div class="card " style="width: 18rem;">
  					<div class="card-body">
  						<center><i class="icon fa-8x fa-solid fa-user"></i>
    					<h5 class="card-title"> <?php echo $name; ?> </h5> 
						<hr>
						<p><i class=" fa-1x fa-solid fa-envelope"></i> 
						<?php echo $email; ?></p>
						<p><i class="fa-solid fa-calendar-days"></i>
						<?php echo $dob; ?>
						</p> <br> 
						<p>
							<?php
							if ($gender == 'male')
								echo "<i class='fa-solid fa-person'></i>";
							else
								echo "<i class='fa-solid fa-person-dress'></i>" ;
							?>
							<?php echo $gender; ?>
						</p>
						<p><i class="fa-solid fa-location-dot"></i>
						<?php echo $city; ?></p>
						<p><i class="fa-solid fa-phone"></i>
							<?php echo $phone; ?>
						</p></center>
					</div>
				</div>
			</div>
			<div class="col-lg-8 col-sm-12 ">
			<div class="row justify-content-end">
			<div class="col-auto">
					<button type="button" class="btn btn-outline-success mr-4">Make an Appointment</button>
					<a class="btn btn-outline-primary ml-4" href="logout.php">Log out</a>
			</div>
			</div>

				<hr>
				<div class="row">
				
				<?php 
					$sql = "SELECT * FROM history WHERE email='$email'";
					$result = mysqli_query($conn, $sql);
					if (mysqli_num_rows($result) > 0) {
						echo "<table class='table table-bordered table-striped'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th>Date</th>";
		echo "<th>Doctor</th>";
		echo "<th>Illness</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		while ($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>" . $row['date'] . "</td>";
			echo "<td>" . $row['doctor'] . "</td>";
			echo "<td>" . $row['illness'] . "</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";	
						// logic for displaying history data
						
		} else {
					echo "<center> No History Found ! Make Your First Appointment Now </center>";
		}
					
					mysqli_close($conn);
				?>
				</div>
			</div>
		</div>
	</div>
	<!--end of container-->
	
</body>
</html>