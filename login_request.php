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
	$result=mysqli_query($con,"SELECT * FROM users WHERE username='$username'");
	$result=mysqli_fetch_array($result);
	if($passhashed==$result['password']){
		echo "Login Successful";
		$_SESSION['username']=$result['username'];
		$_SESSION['usertype']=$result['usertype'];
		$_SESSION['dept']=$result['dept'];
		$lastlogin=date('Y-m-d H:i:s');
		$result=mysqli_query($con,"UPDATE users SET lastlogin='$lastlogin' WHERE username='$username'");
		header ('location: ./index.php');
	}
	else{
		echo "Invalid Password";
		$_SESSION['error']="pass_invalid";
	}
	header ('location: ./login.php');
}
else
{
	echo "Invalid Username";
	$_SESSION['error']="username_invalid";
	header ('location: ./login.php');
}
?>