<?php
	session_start();
	$flag=isset($_SESSION['username']);
	if($flag==false)
	{
		header ('location: ./login.php');
	}
	$_SESSION['active_page']="home";
	include("./header.php");
?>
<div class="container">


      <div class="starter-template">
        <h1>Welcome</h1>
        <p class="lead"></p>
		<?php
			$usertype=$_SESSION['usertype'];
			if($usertype=="central")
			{
				echo "<div class='row'>
				<div class='col-md-4 col-md-offset-4'>
				<table class='table table-striped'>
					<thead>
						<tr>
							<th>Dept</th>
							<th>Event</th>
							<th>Hide</th>
						</tr>
					</thead>
					<tbody>";
						include 'dbconnect.php';
						$result = mysqli_query($con,"SELECT * FROM event_done WHERE notification='0'");
						while($row = mysqli_fetch_array($result))
						{
							echo "<tr><td>".$row['dept']."</td>";
							echo "<td>".$row['event']."</td>";
							echo "<td>
							<form action='notify_clear.php' method='POST'>
							<input class='hidden' type='text' name='dept' value='".$row['dept']."' id='dept'>
							<input class='hidden' type='text' name='event' value='".$row['event']."' id='event'>
							<button type='submit' class='btn btn-default'>Hide</button>
							</form>
							</td></tr>";
						}
						echo"</tbody>
				</table>
			</div>
		</div>";
			}
		?>
      </div>

    
</div><!-- /.container -->	
<?php
	include("./footer.php");
?>