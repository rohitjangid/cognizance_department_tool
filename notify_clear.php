<?php
$dept=$_POST['dept'];
$event=$_POST['event'];

include 'dbconnect.php';
$result=mysqli_query($con,"UPDATE event_done SET notification='1' WHERE dept='$dept' AND event='$event'");

header('location: ./index.php');
?>