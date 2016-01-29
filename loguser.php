<?php
	session_start();
	$flag=isset($_SESSION['username']);
	if($flag==false){
		header ('location: ./login.php');
	}
	$_SESSION['active_page']="loguser";
	include("./header.php");
?>

<div class="container">


    <div class="starter-template">
        <h1>Log User</h1>
		<br>
        <div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form class="form-horizontal" role="form" action="loguser_request.php" method="POST">
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
				  <button type="submit" class="btn btn-default">Log User</button>
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
						if($error=="username_invalid")
						{
							echo "<div class='alert alert-danger'>
							Invalid Username";
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