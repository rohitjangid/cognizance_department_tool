<?php
@session_start();
$username=$_POST['username'];
$password=$_POST['password'];
$usertype=$_POST['usertype'];
$dept=$_POST['dept'];
include 'dbconnect.php';
$result = mysqli_query($con,"SELECT * FROM users");
$flag=true;
while($row = mysqli_fetch_array($result))
{
	if($row['username']==$username)
	{
		$flag=false;
	}
}
include 'salt.php';
$salt=salt(8);
$passhashed=md5(md5($password).md5($salt));
$lastlogin=date('Y-m-d H:i:s');
if ($flag==true)
{
	$result=mysqli_query($con,"INSERT INTO users (username, salt, password, usertype, dept, lastlogin)
VALUES ('$username','$salt','$passhashed','$usertype','$dept','$lastlogin')");
	$_SESSION['error']="user_created";
	header ('location: ./adduser.php');
}
else
{
	$_SESSION['error']="user_exist";
	header ('location: ./adduser.php');
}
?>