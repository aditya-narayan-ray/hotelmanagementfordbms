<!DOCTYPE html>
<html>
<head>
	<title>Checkin</title>
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
				<form action="checkinsubmit.php" method="post">
					<label for="name">Name(Enter Fullname):</label>
					<input type="text" class="form-control" name="name">
					<label for="dateofbirth">Date of Birth:</label>
					<input type="Date" class="form-control" name="dateofbirth">
					<label for="Phno">Phone Number:</label>
					<input type="Number" class="form-control" name="Phno">
					<label for="roomnumber">Room Number:</label>
					<input type="Number" class="form-control" name="roomnumber">
					<label for="checkindate">Date of checkin:</label>
					<input type="Date" class="form-control" name="checkindate">
					<label for="occupants">Occupants:</label>
					<input type="Number" class="form-control" name="occupants">
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
				$sql = "SELECT * from room where availability like 'Available'";
				$result = mysqli_query($conn, $sql);
				echo "<div class='container-fluid'><table class='table danger'><tr><th>Room Number</th><th>Type</th><th>Status</th></tr>";
				if (mysqli_num_rows($result) > 0) {
    // output data of each row
					while($row = mysqli_fetch_assoc($result)) {
						echo "<tr><td>" . $row["roomnumber"]. "</td><td>" . $row["type"]. "</td><td>" . $row["availability"]. "</td></tr>";
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