<?php
	session_start();
	$flag=isset($_SESSION['username']);
	if($flag==false){
		header ('location: ./login.php');
	}
	$_SESSION['active_page']="event";
	include("./header.php");
?>

<div class="container">

    <div class="starter-template">
		<h1>Select Event</h1>
		<br>
        <div class='row'>
			<div class='col-md-4 col-md-offset-4'>
				<form class='form-horizontal' role='form' action='score_report.php' method='POST'>
				<input type='hidden' name='type' value='central'>
				  <div class='form-group'>
					<label for='event' class='col-sm-3 control-label'>Event</label>
					<div class='col-sm-9'>
						<select class='form-control' id='event' name='event' required>
						<?php
							session_start();
							include 'dbconnect.php';
							$result=mysqli_query($con,"SELECT * FROM event_done");
							while($row=mysqli_fetch_array($result))
							{
								echo "<option value='".$row['dept']."/".$row['event']."'>".$row['dept']."/".$row['event']."</option>";
							}
							
						?>
						</select>
					</div>
				  </div>
				  <button type='submit' class='btn btn-default'>Submit</button>
				</form>
			</div>
		</div>
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