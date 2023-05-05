<?php session_start(); ?>

<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
container{
padding-top:200px !important;

}
</style>
<script type="text/javascript">
		// Function to populate doctors based on selected department
		function populateDoctors() {
			var department = document.getElementById("first").value;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("doctor").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("POST", "doc.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("department=" + department);
		}
	</script>


</head>
<?php

$db_host = "localhost";
$db_user = "admin";
$db_pass = "password";
$db_name = "hospitaldb";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT distinct(field) FROM doctors";

$result = mysqli_query($conn, $sql);





?>


<body>
<form action="./history.php" method="post">    
<div class="container">
<div class="jumbotron">
    
<table class="table">
 
    <tr>
      <th scope="col">Disease related to </th>
     <td>
        <?php
        echo "<select id='first' name ='illness' onchange='populateDoctors()'><option value=''>Select option</option>";
        while($row  = $result->fetch_assoc())
        {
            echo "<option value = ' ".$row["field"] . " '>".$row["field"]."</option>";
        }
        echo "</select>";
        ?>
    <td>
    </tr>
 
  <tbody>
    <tr>
 <th scope="col">Specialists</th>
      <td>
      <select id="doctor" name="doctor">
			<option value="">Select a doctor</option>
		</select>

    </tr>
    <tr>
      <th>Symptoms</th>
      <td><textarea rows="3" name="symptoms" cols="60"></textarea></td>
    </tr>
    <tr>
      <th>Date of appointment</th>
      <td> <input type="date" name="date" style="width:100%"><br></td>
    </tr>
<tr>
<th>  <label> Any message </label></th>
<td><textarea rows="3" name="message" cols="60"></textarea></td>
  </tbody>
</table>

<center> <button type="submit" id="regbtn" class="btn btn-primary" >Cancel</button>
<button type="submit" id="regbtn" class="btn btn-primary" >Book</button></center></div></div>
</form>
</body>

</html>