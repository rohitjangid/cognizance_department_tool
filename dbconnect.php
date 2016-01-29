<?php

// Create connection
$con=mysqli_connect("localhost","audegn","h3bJxq7aJcqYMmFr","deptsoft");
// $con=mysqli_connect("localhost","root","","cognireg");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>