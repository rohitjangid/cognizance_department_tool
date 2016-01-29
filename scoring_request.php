<?php
session_start();
$username=$_SESSION['username'];
$password=$_POST['password'];
include 'dbconnect.php';
$result=mysqli_query($con,"SELECT * FROM users where username='$username'");
$result=mysqli_fetch_array($result);
$salt=$result['salt'];
$passhashed=md5(md5($password).md5($salt));
if($passhashed==$result['password'])
{
	$teamno=$_POST['teamno'];
	$dept=$_POST['dept'];
	$event=$_POST['event'];
	$flag=true;
	for($i=0;$i<$teamno;$i++)
	{
		$teamid=$_POST['teamid'.$i];
		$participant=$_POST['participant'.$i];
		$bankname=$_POST['bankname'.$i];
		$bankaccount=$_POST['bankaccount'.$i];
		$accountname=$_POST['accountname'.$i];
		$ifsccode=$_POST['ifsccode'.$i];
		$marks=$_POST['marks'.$i];
		$rank=$_POST['rank'.$i];
		$memcid=array();
		$memname=array();
		$name="";
		$cid="";
		for($j=0;$j<$participant;$j++)
		{
			$memname[$j]=$_POST['membername'.$i."-".$j];
			$memcid[$j]=$_POST['membercid'.$i."-".$j];
			$name.=$memname[$j].";";
			$cid.=$memcid[$j].";";
		}
		$result=mysqli_query($con,"INSERT INTO event_scored (dept, event, team_id, member_name, member_cid, marks, rank, bank_name, ifsc_code, account_number, account_name)
		VALUES ('$dept', '$event', '$teamid', '$name', '$cid', '$marks', '$rank', '$bankname', '$ifsccode', '$bankaccount', '$accountname')");
		if($result==false) $flag=false;
	}
	$result = mysqli_query($con,"INSERT INTO event_done (dept, event, notification) VALUES ('$dept', '$event', '0')");
	$flag = $result;
	if($flag)
	{
		$_SESSION['error']="scored";
		header ('location: ./scoring.php');
	}
	else
	{
		$_SESSION['error']="unscored";
		header ('location: ./scoring.php');
	}
}
else
{
	$_SESSION['error']="passinvalid";
	header ('location: ./scoring.php');
}
?>