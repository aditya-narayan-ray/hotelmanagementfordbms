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
$roomnumber=$_POST["roomnumber"];
$enddate=$_POST["enddate"];
$sql3="SELECT * FROM room where roomnumber=".$roomnumber;
$result = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result);
if (strcmp($row3["availability"], "Occupied")===0) {

	$sql = "UPDATE customer set checkoutdate='".$enddate."'";
	if ($conn->query($sql) === TRUE) {
		echo "Checked Out";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$sql1="UPDATE `room` SET `availability` = 'Available' WHERE `room`.`roomnumber` = ".$roomnumber;
	$conn->query($sql1);
	$sql1="SELECT type from room WHERE roomnumber=".$roomnumber;
//$conn->query($sql1);
	$result = mysqli_query($conn, $sql1);
	$row = mysqli_fetch_assoc($result);
	$sql2="UPDATE roomcategory SET availrooms = availrooms + 1 WHERE type = '".$row["type"]."'";
	$conn->query($sql2);
	$sql1="SELECT * from customer where roomnumber=".$roomnumber;
//$conn->query($sql1);
	$result = mysqli_query($conn, $sql1);
	$row = mysqli_fetch_assoc($result);
	$sql2="SELECT DATEDIFF('".$row["checkoutdate"]."','".$row["checkindate"]."') as noofdays";
	$result = mysqli_query($conn, $sql2);
	$row = mysqli_fetch_assoc($result);
	$noofdays=$row["noofdays"]+1;
	$sql2="SELECT * from roomcategory where type = '".$row3["type"]."'";
	$result = mysqli_query($conn, $sql2);
	$row = mysqli_fetch_assoc($result);
	$costperday=$row["costperday"];
	$roomcharge=$noofdays*$costperday;
	$servicecharge=0;
	$sql1="SELECT * from extraservice where roomnumber=".$roomnumber;
	$result = mysqli_query($conn, $sql1);
	if (mysqli_num_rows($result) > 0) {

		while($row = mysqli_fetch_assoc($result)) {
			if(is_null($row["enddate"])){
				$servenddate=$enddate;
				$sql6="UPDATE extraservice set enddate='".$servenddate."'"." where roomnumber=".$row["roomnumber"]." AND servicetype=".$row["servicetype"];
				$conn->query($sql6);
			}
			else{
				$servenddate=$row["enddate"];
			}
			$sql2="SELECT DATEDIFF('".$servenddate."','".$row["startdate"]."') as noofdays";
			$result = mysqli_query($conn, $sql2);
			$row2 = mysqli_fetch_assoc($result);
			$noofdays=$row2["noofdays"]+1;
			$sql4="SELECT * from extraservicecategory where servicetype = ".$row["servicetype"];
			$result = mysqli_query($conn, $sql4);
			$row4 = mysqli_fetch_assoc($result);
			$Price=$row4["Price"];
			$servicecharge=$servicecharge+$Price*$noofdays;
		}
	}
	$totalcharge=$roomcharge+$servicecharge;
	$sql5="INSERT INTO bill (room,servicescharge,roomcharge,totalcharge) VALUES (".$roomnumber.",".$servicecharge.",".$roomcharge.",".$totalcharge.")";
	$conn->query($sql5);
	echo "<h4><br>roomcharge:".$roomcharge;
	echo "<br>servicecharge".$servicecharge;
	echo "<br>total bill".$totalcharge."</h4>";
}
else{
	echo "Room is unoccupied";
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