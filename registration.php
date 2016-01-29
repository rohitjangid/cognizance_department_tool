<?php
	session_start();
	$flag=isset($_SESSION['username']);
	if($flag==false){
		header ('location: ./login.php');
	}
	$_SESSION['active_page']="registration";
	include("./header.php");
	include("./dbconnect.php");
	$dept=$_SESSION['dept'];
	$flag=isset($_SESSION['process']);
	if($flag==false)
	{
		$_SESSION['process']=0;
	}
	elseif(isset($_POST['event']))
	{
		$event=$_POST['event'];
		if(strchr($event,"Ideaz"))
		{
			$teamidcode=$dept."i";
		}
		elseif(strchr($event,"Spotlight"))
		{
			$teamidcode=$dept."s";
		}
		elseif(strchr($event,"Prototype"))
		{
			$teamidcode=$dept."p";
		}
		$_SESSION['process']=1;
		unset($_POST['event']);
	}
	elseif(isset($_POST['teamid']))
	{
		$teamid=$_POST['teamid'];
		$_SESSION['team']=$teamid;
		$_SESSION['process']=2;
		unset($_POST['teamid']);
	}
	elseif(isset($_POST['submit']))
	{
		$teamid=$_SESSION['team'];
		unset($_SESSION['team']);
		include 'dbconnect.php';
		$result = mysqli_query($con,"UPDATE team_events SET registred='1' WHERE team_id='$teamid'");
		if($result)
		{
			$_SESSION['error']="submitted";
		}
		else
		{
			$_SESSION['error']="unsubmitted";
		}
	}
	else
	{
		unset($_SESSION['process']);
		header ('location: ./registration.php');
	}
?>

<div class="container">

    <div class="starter-template">
		<?php
		$process=$_SESSION['process'];
		if($process==0)
		{
		echo "<h1>Select Event</h1>
		<br>
        <div class='row'>
			<div class='col-md-4 col-md-offset-4'>
				<form class='form-horizontal' role='form' action='registration.php' method='POST'>
				  <div class='form-group'>
					<label for='event' class='col-sm-3 control-label'>Event</label>
					<div class='col-sm-9'>
						<select class='form-control' id='event' name='event' required>";
						$result=mysqli_query($con,"SELECT * FROM deptevent WHERE deptcode='$dept'");
						$row=mysqli_fetch_array($result);
						$events=explode(",",$row['event']);
						foreach($events as $event)
						{
							echo "<option value='$event'>$event</option>";
						}
						echo "</select>
					</div>
				  </div>
				  <button type='submit' class='btn btn-default'>Submit</button>
				</form>
			</div>
		</div>";
		}
		elseif($process==1)
		{
		echo "<h1>Select Team ID</h1>
		<br>
        <div class='row'>
			<div class='col-md-4 col-md-offset-4'>
				<form class='form-horizontal' role='form' action='registration.php' method='POST'>
				  <div class='form-group'>
					<label for='teamid' class='col-sm-3 control-label'>Team ID</label>
					<div class='col-sm-9'>
						<select class='form-control' id='teamid' name='teamid' required>";
							// $result = mysqli_query($con,"SELECT * FROM team_events WHERE registred='0'");
							// $flag=true;
							// while($row = mysqli_fetch_array($result))
							// {
								// if($row['event']==$event)
								// {
									// echo "<option value='";echo $row['team_id'];echo "'>";echo $row['team_id']; echo "</option>";
								// }
							// }
							$result = mysqli_query($con,"SELECT * FROM teams WHERE team_id LIKE '$teamidcode%' ORDER BY team_id");
							while($row = mysqli_fetch_array($result))
							{
								$teamid=$row['team_id'];
								echo "<option value='$teamid'>$teamid</option>";
							}
						echo "</select>
					</div>
				  </div>
				  <button type='submit' class='btn btn-default'>Submit</button>
				</form>
			</div>
		</div>";
		}
		elseif($process==2)
		{
		echo "<h1>Team Members</h1>
		<br>
        <div class='row'>
			<div class='col-md-4 col-md-offset-4'>
				<table class='table table-striped'>
					<thead>
						<tr>
							<th>Name</th>
							<th>Cogni ID</th>
						</tr>
					</thead>
					<tbody>";
						include 'dbconnect.php';
						$result = mysqli_query($con,"SELECT * FROM teams WHERE team_id='$teamid'");
						$row = mysqli_fetch_array($result);
						$c=$row['participants'];
						$mems=$row['member'];
						$mem=explode(";",$mems);
						for($i=0;$i<$c;$i++)
						{
							$M=explode("/",$mem[$i]);
							$M=$M[1];
							echo "<script>alert('".$M."')</script>";
							$Q=mysqli_query($con,"SELECT * FROM student WHERE cogni_id='$M'");
							$R=mysqli_fetch_array($Q);
							echo "<tr><td>".$R['first_name']." ".$R['last_name']."</td><td>COG14/".$R['cogni_id']."</td></tr>";
						}
						// if($mrow['member1']!='')
						// {
							// $cogniid=$mrow['member1'];
							// $result = mysqli_query($con,"SELECT * FROM participants WHERE cogniid='$cogniid'");
							// $row = mysqli_fetch_array($result);
							// echo "<tr><td>".$row['name']."</td><td>".$row['cogniid']."</td></tr>";
						// }
						// if($mrow['member1']!='')
						// {
							// $cogniid=$mrow['member2'];
							// $result = mysqli_query($con,"SELECT * FROM participants WHERE cogniid='$cogniid'");
							// $row = mysqli_fetch_array($result);
							// echo "<tr><td>".$row['name']."</td><td>".$row['cogniid']."</td></tr>";
						// }
						// if($mrow['member3']!='')
						// {
							// $cogniid=$mrow['member3'];
							// $result = mysqli_query($con,"SELECT * FROM participants WHERE cogniid='$cogniid'");
							// $row = mysqli_fetch_array($result);
							// echo "<tr><td>".$row['name']."</td><td>".$row['cogniid']."</td></tr>";
						// }
						// if($mrow['member4']!='')
						// {
							// $cogniid=$mrow['member4'];
							// $result = mysqli_query($con,"SELECT * FROM participants WHERE cogniid='$cogniid'");
							// $row = mysqli_fetch_array($result);
							// echo "<tr><td>".$row['name']."</td><td>".$row['cogniid']."</td></tr>";
						// }
						// if($mrow['member5']!='')
						// {
							// $cogniid=$mrow['member5'];
							// $result = mysqli_query($con,"SELECT * FROM participants WHERE cogniid='$cogniid'");
							// $row = mysqli_fetch_array($result);
							// echo "<tr><td>".$row['name']."</td><td>".$row['cogniid']."</td></tr>";
						// }
						
					echo"</tbody>
				</table>
			</div>
			<div class='col-md-4 col-md-offset-4'>
				<form class='form-horizontal' role='form' action='registration.php' method='POST'>
					<input type='text' class='hidden' name='submit' id='submit' value='true'>
				  <button type='submit' class='btn btn-default'>Confirm Registration</button>
				</form>
			</div>
		</div>";
		}
		?>
		<br/>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<?php
					if(isset($_SESSION['error']))
					{
						$error=$_SESSION['error'];
						if($error=='submitted')
						{
							echo "<div class='alert alert-success'>
							Registration Confirmed";
						}
						elseif($error=='unsubmitted')
						{
							echo "<div class='alert alert-danger'>
							Error Occured";
						}
						echo "</div>";
						unset($_SESSION['error']);
					}
				?>
			</div>
		</div>
    </div>

    
</div><!-- /.container -->	
<?php
	include("./footer.php");
?>