<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
	<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet"> 

</head>
<body class="bg">

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<br><br><br><br>
				<br>
				<?php

				include 'db_connection.php';

				$conn = OpenCon();
				$name=$_POST["name"];
				$dateofbirth=$_POST["dateofbirth"];
				$Phno=$_POST["Phno"];
				$roomnumber=$_POST["roomnumber"];
				$checkindate=$_POST["checkindate"];
				$occupants=$_POST["occupants"];
				$sql3="SELECT * FROM room where roomnumber=".$roomnumber;
				$result = mysqli_query($conn, $sql3);
				$row = mysqli_fetch_assoc($result);
				if (strcmp($row["availability"], "Available")===0) {

					$sql = "INSERT INTO customer(Name,DOB,Phone,roomnumber,checkindate,occupants) VALUES ('".$name."','".$dateofbirth."',".$Phno.",".$roomnumber.",'".$checkindate."',".$occupants.")";
					if ($conn->query($sql) === TRUE) {
						echo "<h1>You have Checked in. Welcome to the Hotel</h1>";
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
					$sql1="UPDATE `room` SET `availability` = 'Occupied' WHERE `room`.`roomnumber` = ".$roomnumber;
					$conn->query($sql1);
					$sql1="SELECT type from room WHERE roomnumber=".$roomnumber;
					$conn->query($sql1);
					$result = mysqli_query($conn, $sql1);
					$row = mysqli_fetch_assoc($result);
					$sql2="UPDATE roomcategory SET availrooms = availrooms - 1 WHERE type = '".$row["type"]."'";
					$conn->query($sql2);
				}
				else{
					echo "Room already occupied";
				}

				CloseCon($conn);
				?>

			</div>
			<div class="col-lg-4"></div>
		</div>
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<br><br><br><br>
				<br>
				<a href="http://localhost/hotelmanagementsystem/Checkin.php"><button type="button" class="btn btn-primary btn-block" style="background-color:transparent">Checkin</button></a>
				<br>
				<a href="http://localhost/hotelmanagementsystem/Checkout.php"><button type="button" class="btn btn-success btn-block" style="background-color:transparent">Checkout</button></a>
				<br>
				<a href="http://localhost/hotelmanagementsystem/addextraservice.php"><button type="button" class="btn btn-info btn-block" style="background-color:transparent">Add extra service</button></a>
				<br>
				<a href="http://localhost/hotelmanagementsystem/endextraservice.php"><button type="button" class="btn btn-warning btn-block" style="background-color:transparent">End extra service</button></a>
			</div>
			<div class="col-lg-4"></div>
		</div>
	</div>



</body>
</html>