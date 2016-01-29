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
	elseif(isset($_POST['event']))
	{
		$event=$_POST['event'];
		$_SESSION['event']=$event;
		$_SESSION['process']=1;
		unset($_POST['event']);
	}
	elseif(isset($_POST['teamno']))
	{
		$teamno=$_POST['teamno'];
		$_SESSION['process']=2;
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
							$R=mysqli_query($con,"SELECT * FROM event_done WHERE dept='$dept' AND event='$event'");
							if(!mysqli_fetch_array($R))
							{
								echo "<option value='$event'>$event</option>";
							}
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
		$event=$_SESSION['event'];
		
		echo "<h1>Enter Details</h1>
		<br>
        <div class='row'>
			<div class='col-md-12'>
				<table class='table table-striped'>
					<thead>
						<tr>
							<th>Team Details</th>
							<th>Members Details</th>
							<th>Marks</th>
							<th>Rank</th>
						</tr>
					</thead>
					<tbody>";
						echo "<form class='form-horizontal' role='form' id='score_form' action='scoring_request.php' method='POST'>";
						echo "<input type='hidden' name='teamno' value='$teamno'>";
						echo "<input type='hidden' name='dept' value='$dept'>";
						echo "<input type='hidden' name='event' value='$event'>";
						for($i=0;$i<$teamno;$i++)
						{
							echo "<tr>
								<td>
									<table>
										<tr>
											<td>
												<input type='text' class='form-control' id='teamid".$i."' name='teamid".$i."' placeholder='Team ID' required>
											</td>
										</tr>
										<tr>
											<td><div class='form-group'>
													<label for='event' class='col-sm-6 control-label'>No of participant</label>
												<div class='col-sm-6'>
													<select class='form-control no-of-participant' id='participant".$i."' name='participant".$i."' required>
													<option value='1'>1</option>
													<option value='2'>2</option>
													<option value='3'>3</option>
													<option value='4'>4</option>
													<option value='5'>5</option>
													</select>
												</div>
											  </div>
											</td>
										</tr>
										<tr>
											<td>
												<input type='text' class='form-control' id='bankname".$i."' name='bankname".$i."' placeholder='Bank Name'>
											</td>
										</tr>
										<tr>
											<td>
												<input type='text' class='form-control' id='ifsccode".$i."' name='ifsccode".$i."' placeholder='IFSC Code'>
											</td>
										</tr>
										<tr>
											<td>
												<input type='text' class='form-control' id='bankaccount".$i."' name='bankaccount".$i."' placeholder='Bank Account No'>
											</td>
										</tr>
										<tr>
											<td>
												<input type='text' class='form-control' id='accountname".$i."' name='accountname".$i."' placeholder='Account Holder Name'>
											</td>
										</tr>
									</table>
								</td>
								<td>
									<table id='memberappend".$i."'>
										<tr class='member member1'><td><input type='text' class='form-control' id='membername".$i."-0' name='membername".$i."-0' placeholder='Member 1 Name' required></td></tr>
										<tr class='member member1'><td><input type='text' class='form-control' id='membercid".$i."-0' name='membercid".$i."-0' placeholder='Member 1 Cogni ID' required></td></tr>
									
										<tr class='member member2'><td><input type='text' class='form-control' id='membername".$i."-1' name='membername".$i."-1' placeholder='Member 2 Name'></td></tr>
										<tr class='member member2'><td><input type='text' class='form-control' id='membercid".$i."-1' name='membercid".$i."-1' placeholder='Member 2 Cogni ID'></td></tr>

										<tr class='member member3'><td><input type='text' class='form-control' id='membername".$i."-2' name='membername".$i."-2' placeholder='Member 3 Name'></td></tr>
										<tr class='member member3'><td><input type='text' class='form-control' id='membercid".$i."-2' name='membercid".$i."-2' placeholder='Member 3 Cogni ID'></td></tr>
										
										<tr class='member member4'><td><input type='text' class='form-control' id='membername".$i."-3' name='membername".$i."-3' placeholder='Member 4 Name'></td></tr>
										<tr class='member member4'><td><input type='text' class='form-control' id='membercid".$i."-3' name='membercid".$i."-3' placeholder='Member 4 Cogni ID'></td></tr>
										
										<tr class='member member5'><td><input type='text' class='form-control' id='membername".$i."-4' name='membername".$i."-4' placeholder='Member 5 Name'></td></tr>
										<tr class='member member5'><td><input type='text' class='form-control' id='membercid".$i."-4' name='membercid".$i."-4' placeholder='Member 5 Cogni ID'></td></tr>
									</table>
								</td>
								<td>
									<input type='number' class='form-control' id='marks".$i."' name='marks".$i."' placeholder='Marks' required>
								</td>
								<td>
									<input type='number' class='form-control' id='rank".$i."' name='rank".$i."' placeholder='Rank' required>
								</td>
							</tr>";
						}
						echo "<td></td><td><button type='submit' class='btn btn-default' data-toggle='modal' data-target='#confirmation' >Submit</button></td><td></td><td></td></tr>
						</form>";
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
					<button type="submit" class="btn btn-primary" form="score_form" name="confirm">Confirm</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

    
</div><!-- /.container -->	
<?php
	include("./footer.php");
?>