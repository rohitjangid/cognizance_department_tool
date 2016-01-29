<?php
session_start();
$username=$_POST['username'];
$password=$_POST['password'];
include 'dbconnect.php';
$result = mysqli_query($con,"SELECT * FROM users");
$flag=mysqli_query($con,"SELECT * FROM users WHERE username='$username'");
$flag=mysqli_fetch_array($flag);
$salt=$flag['salt'];
$passhashed=md5(md5($password).md5($salt));
$lastlogin=date('Y-m-d H:i:s');
if ($flag)
{
	$result=mysqli_query($con,"UPDATE users SET password='$passhashed' WHERE username='$username'");
	$_SESSION['error']="password_reset";
	header ('location: ./resetpassword.php');
}
else
{
	$_SESSION['error']="reset_failed";
	header ('location: ./resetpassword.php');
}
?>