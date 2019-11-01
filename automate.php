<?php

include 'db_connection.php';

$conn = OpenCon();

echo "Connected Successfully";

for($i=1;$i<=5;$i++)
{
	for($j=1;$j<=5;$j++)
	{
		$sql = "INSERT INTO room VALUES (".$i."0".$j.", 'Budget', 'Available')";
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

	}
	$sql = "INSERT INTO room VALUES (".$i."0".$j.", 'Premium', 'Available')";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$j++;
	$sql = "INSERT INTO room VALUES (".$i."0".$j.", 'Premium', 'Available')";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$j++;
	$sql = "INSERT INTO room VALUES (".$i."0".$j.", 'Deluxe', 'Available')";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

CloseCon($conn);

?>