<?php
	session_start();
	$flag=isset($_SESSION['username']);
	if($flag==false){
		header ('location: ./login.php');
	}
	$_SESSION['active_page']="adduser";
	include("./header.php");
?>

<div class="container">


    <div class="starter-template">
        <h1>Add New User</h1>
		<br>
        <div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form class="form-horizontal" role="form" action="adduser_request.php" method="POST">
				  <div class="form-group">
					<label for="username" class="col-sm-3 control-label">Username</label>
					<div class="col-sm-9">
						<input type="username" class="form-control" id="username" name="username" placeholder="Enter Username" required>
					</div>
				  </div>
				  <div class="form-group">
					<label for="password" class="col-sm-3 control-label">Password</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="password" name="password" placeholder="Enter Password" required>
					</div>
				  </div>
				  <div class="form-group">
					<label for="dept" class="col-sm-3 control-label">Department</label>
					<div class="col-sm-9">
						<select class="form-control" id="dept" name="dept" required>
							<option value="jw">Junkyard Wars</option>
							<option value="tff">Thought for Food</option>
							<option value="cry">CRY</option>
							<option value="gp">Green Peace</option>
							<option value="sd">Shell Day</option>
							<option value="cop">Construct O Polis</option>
							<option value="aur">Aurora</option>
							<option value="tgw">The Green Walk</option>
							<option value="sci">Sciennovate</option>
							<option value="fin">Finesse</option>
							<option value="tbi">The Bron Identita</option>
							<option value="amd">Armageddon</option>
							<option value="pd">Powerdrift</option>
							<option value="rs">Robosapiens</option>
							<option value="cb">Cyborg Breakin</option>
							<option value="an">Aeronave</option>
							<option value="cec">Chem-E-Car</option>
							<option value="cor">Corpostrat</option>
							<option value="rbc">Rubiks Cube</option>
							<option value="crx">Chain Reaction</option>
							<option value="ign">Ignite</option>
							<option value="ele">Elevator Pitch</option>
							<option value="tss">Techno Startup Showcase</option>
							<option value="rc">Rural Congress</option>
							<option value="sc">Silence Calling</option>
							<option value="mun">IITR MUN</option>
							<option value="vp">Vox Populi</option>
							<option value="quz">Quizzotica</option>
							<option value="ahec">AHEC</option>
							<option value="archi">Architecture</option>
							<option value="bio">Biotech</option>
							<option value="trans">C-Trans</option>
							<option value="ch">Chemical</option>
							<option value="chem">Chemistry</option>
							<option value="ce">Civil</option>
							<option value="coedmm">COEDMM</option>
							<option value="cse">Computer Science</option>
							<option value="dom">Doms</option>
							<option value="es">Earth Science</option>
							<option value="eq">Earthquake department</option>
							<option value="ec">Electronics</option>
							<option value="ee">Electrical</option>
							<option value="hyd">Hydrology</option>
							<option value="math">Maths</option>
							<option value="meta">Metallurgy</option>
							<option value="mied">MIED</option>
							<option value="nano">Nanotechnology</option>
							<option value="phy">Physics</option>
							<option value="wrdm">WRDM</option>
							<option value="central">Central</option>
							<option value="admin">Admin</option>
						</select>
					</div>
				  </div>
				  <div class="form-group">
					<label for="usertype" class="col-sm-3 control-label">Usertype</label>
					<div class="col-sm-9">
						<select class="form-control" id="usertype" name="usertype" required>
							<option value="admin">Admin</option>
							<option value="central">Central</option>
							<option value="dept">Department</option>
						</select>
					</div>
				  </div>
				  <button type="submit" class="btn btn-default">Add User</button>
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
						if($error=="user_created")
						{
							echo "<div class='alert alert-success'>
							User Created";
						}
						elseif($error=="user_exist")
						{
							echo "<div class='alert alert-danger'>
							User Exist";
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