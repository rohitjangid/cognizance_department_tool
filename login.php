<?php
	session_start();
	$flag=isset($_SESSION['username']);
	if($flag){
		header ('location: ./index.php');
	}
	include("./header.php");
?>

<div class="container">


    <div class="starter-template">
        <h1>Login</h1>
		<br>
        <div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form class="form-horizontal" role="form" action="login_request.php" method="POST">
				  <div class="form-group">
					<label for="username" class="col-sm-3 control-label">Username</label>
					<div class="col-sm-9">
						<input type="username" class="form-control" id="username" name="username" placeholder="Enter Username" required>
					</div>
				  </div>
				  <div class="form-group">
					<label for="password" class="col-sm-3 control-label">Password</label>
					<div class="col-sm-9">
						<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
					</div>
				  </div>
				  <button type="submit" class="btn btn-default">Login</button>
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
						echo "<div class='alert alert-danger'>";
						if($error=="pass_invalid")
						{
							echo "Invalid Password";
						}
						elseif($error=="username_invalid")
						{
							echo "Invalid Username";
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