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
				<form action="endextraservicesubmit.php" method="post">
					<label for="roomnumber">Room Number:</label>
					<input type="Number" class="form-control" name="roomnumber">
					<label for="servicetype">Service code:</label>
					<input type="Number" class="form-control" name="servicetype">
					<label for="checkindate">End date:</label>
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
				$sql = "SELECT * from extraservicecategory";
				$result = mysqli_query($conn, $sql);
				echo "<div class='container-fluid'><table class='table'><tr><th>Service code</th><th>Service</th><th>Price</th></tr>";
					if (mysqli_num_rows($result) > 0) {

					while($row = mysqli_fetch_assoc($result)) {
					echo "<tr><td>" . $row["servicetype"]. "</td><td>" . $row["description"]. "</td><td>" . $row["Price"]. "</td></tr>";
				}
			}
		echo "</table></div>";
		$sql = "SELECT roomnumber, servicetype, startdate from extraservice where enddate IS NULL";
				$result1 = mysqli_query($conn, $sql);
				echo "<div class='container-fluid'><table class='table'><tr><th>Room Number</th><th>Service</th><th>Start Date</th></tr>";
					if (mysqli_num_rows($result1) > 0) {

					while($row1 = mysqli_fetch_assoc($result1)) {
					echo "<tr><td>" . $row1["roomnumber"]. "</td><td>" . $row1["servicetype"]. "</td><td>" . $row1["startdate"]. "</td></tr>";
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