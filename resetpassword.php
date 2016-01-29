<?php
	session_start();
	$flag=isset($_SESSION['username']);
	if($flag==false){
		header ('location: ./login.php');
	}
	$_SESSION['active_page']="resetpassword";
	include("./header.php");
?>

<div class="container">


    <div class="starter-template">
        <h1>Reset Password</h1>
		<br>
        <div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form class="form-horizontal" role="form" action="resetpassword_request.php" method="POST">
				  <div class="form-group">
					<label for="username" class="col-sm-3 control-label">Username</label>
					<div class="col-sm-9">
						<select class="form-control" id="username" name="username" required>
							<?php
								include 'dbconnect.php';
								$result = mysqli_query($con,"SELECT * FROM users");
								$flag=true;
								while($row = mysqli_fetch_array($result))
								{
									echo "<option value='".$row['username']."'>".$row['username']."</option>";
								}
							?>
						</select>
					</div>
				  </div>
				  <div class="form-group">
					<label for="password" class="col-sm-3 control-label">Password</label>
					<div class="col-sm-9">
						<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
					</div>
				  </div>
				  <button type="submit" class="btn btn-default">Reset</button>
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
						if($error=='password_reset')
						{
							echo "<div class='alert alert-success'>
							Password Reset Successful";
						}
						elseif($error=='reset_failed')
						{
							echo "<div class='alert alert-danger'>
							Password Reset Failed";
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