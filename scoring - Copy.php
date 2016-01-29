<?php
	session_start();
	$flag=isset($_SESSION['username']);
	if($flag==false){
		header ('location: ./login.php');
	}
	$_SESSION['active_page']="scoring";
	include("./header.php");
	include("./dbconnect.php");
	$dept=$_SESSION['dept'];
	$flag=isset($_SESSION['process']);
	if($flag==false || isset($_SESSION['error']))
	{
		$_SESSION['process']=0;
	}
	elseif(isset($_POST['teamno']))
	{
		$teamno=$_POST['teamno'];
		$_SESSION['process']=2;
		unset($_POST['event']);
	}
	elseif(isset($_POST['event']))
	{
		$event=$_POST['event'];
		$_SESSION['process']=1;
		unset($_POST['event']);
	}
	else
	{
		unset($_SESSION['process']);
		header ('location: ./scoring.php');
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
        	<div class='col-md-4 col-md-offset-4'>
				<form class='form-horizontal' role='form' action='scoring.php' method='POST'>
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
		echo "<h1>Enter Numbers of Team</h1>
		<br>
        	<div class='col-md-4 col-md-offset-4'>
				<form class='form-horizontal' role='form' action='scoring.php' method='POST'>
				  <div class='form-group'>
					<label for='teamno' class='col-sm-6 control-label'>No. Of Teams</label>
					<div class='col-sm-6'>
						<input type='number' class='form-control' id='teamno' name='teamno' placeholder='Enter No of Teams' required>
					</div>
				  </div>
				  <button type='submit' class='btn btn-default'>Submit</button>
				</form>
			</div>
		</div>";
		}
		elseif($process==2)
		{
		echo "<h1>Enter Details</h1>
		<br>
        <div class='row'>
			<div class='col-md-4 col-md-offset-4'>
				<table class='table table-striped'>
					<thead>
						<tr>
							<th>Team ID</th>
							<th>Marks</th>
							<th>Rank</th>
						</tr>
					</thead>
					<tbody>";
						$result = mysqli_query($con,"SELECT * FROM team_events WHERE event='$event'");
						echo "<form class='form-horizontal' role='form' id='score_form' action='scoring_request.php' method='POST'>";
							$check = mysqli_query($con,"SELECT * FROM event_scored WHERE event='$event'");
							$check = mysqli_fetch_array($check);
							if($check==false)
							{
								$i=0;
								while($row = mysqli_fetch_array($result))
								{
									if($row['registred']==1)
									{
										echo "<tr><td>".$row['team_id']."<input class='hidden' type='text' name='team".$i."' id='team".$i."' value='".$row['team_id']."'></td>";
										echo "<td><div class='form-group'>
										<div class='col-sm-12'>
											<input type='text' class='form-control' id='marks".$i."' name='marks".$i."' placeholder='Marks' required>
										</div>
										</div></td>
										<td><div class='form-group'>
										<div class='col-sm-12'>
											<input type='text' class='form-control' id='rank".$i."' name='rank".$i."' placeholder='Rank' required>
										</div>
										</div></td></tr>";
										$i=$i+1;
									}
								}
								echo "<tr><td><input class='hidden' type='text' name='length' id='length' value='".$i."'></td>";
								echo "<td><button type='submit' class='btn btn-default' data-toggle='modal' data-target='#confirmation' >Submit</button></td>
								<td><input class='hidden' type='text' name='event' id='event' value='".$event."'></td></tr>
								</form>";
							}
					echo"</tbody>
				</table>
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
						if($error=='scored')
						{
							echo "<div class='alert alert-success'>
							Marks Submitted";
						}
						elseif($error=='unscored')
						{
							echo "<div class='alert alert-danger'>
							Error Occured";
						}
						elseif($error=='passinvalid')
						{
							echo "<div class='alert alert-danger'>
							Password Invalid";
						}
						echo "</div>";
						unset($_SESSION['error']);
					}
				?>
			</div>
		</div>
    </div>
	<div class="modal fade" id="confirmation">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Confirm Submission</h4>
			</div>
			<div class="modal-body">
				<p>Enter password to confirm.</p>
				<div class='form-group'>
					<div class='col-sm-12'>
						<input type='password' class='form-control' id="password" name="password" form="score_form" placeholder='Enter Password' required>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary" form="score_form">Confirm</button>
			</div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

    
</div><!-- /.container -->	
<?php
	include("./footer.php");
?>