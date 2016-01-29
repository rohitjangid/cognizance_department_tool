<?php
session_start();
$username=$_POST['username'];
include 'dbconnect.php';
$result = mysqli_query($con,"SELECT * FROM users");
$flag=mysqli_query($con,"SELECT * FROM users WHERE username='$username'");
$flag=mysqli_fetch_array($flag);
$usertype=$flag['usertype'];
$dept=$flag['dept'];
if ($flag)
{
	$_SESSION['username']=$username;
	$_SESSION['usertype']=$usertype;
	$_SESSION['dept']=$dept;
	header ('location: ./index.php');
}
else
{
	echo "Invalid Username";
	$_SESSION['error']="username_invalid";
	header ('location: ./loguser.php');
}
?>