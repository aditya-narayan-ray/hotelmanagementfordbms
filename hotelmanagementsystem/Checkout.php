<!DOCTYPE html>
<html>
<head>
	<title>Add Extra Service</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>

<body class="bg">

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<br><br><br><br>
				<br>
				<form action="checkoutsubmit.php" method="post">
					<label for="roomnumber">Room Number:</label>
					<input type="Number" class="form-control" name="roomnumber">
					<label for="startdate">End Date:</label>
					<input type="Date" class="form-control" name="enddate">
					<br><br>
					<input type="submit" value="Submit" class="btn btn-primary">
				</form>
			</div>
			<div class="col-lg-4"></div>
		</div>
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<br><br><br>
				<?php

				include 'db_connection.php';

				$conn = OpenCon();
				$sql = "SELECT roomnumber,availability from room where availability like 'Occupied'";
				$result = mysqli_query($conn, $sql);
				echo "<div class='container-fluid'><table class='table'><tr><th>Room Number</th><th>Status</th></tr>";
					if (mysqli_num_rows($result) > 0) {

					while($row = mysqli_fetch_assoc($result)) {
					echo "<tr><td>" . $row["roomnumber"]. "</td><td>" . $row["availability"]. "</td></tr>";
				}
			}
		echo "</table></div>";
		CloseCon($conn);
		?>
	</div>
	<div class="col-lg-3"></div>

</div>
</div>



</body>


</html>