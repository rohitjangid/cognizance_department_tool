<!DOCTYPE html>
<html lang="en">
	<head>
    <title>Cognizance 2014</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	
	<link href="css/style.css" rel="stylesheet">
	
  </head>
  <body>
	
	<?php
		@session_start();
		$flag=isset($_SESSION['username']);
		if($flag==false)
		{
			echo "<div class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
				<div class='container'>
					<div class='row'>
						<div class='navbar-header col-md-4 col-md-offset-4' style='text-align:center;'>
							<a class='navbar-brand col-md-12' href='#'>Welcome to Event Handler</a>
						</div>
					</div>
				</div>
			</div>";
		}
		elseif($flag==true)
		{
			$usertype=$_SESSION['usertype'];
			$activepage=$_SESSION['active_page'];
			if($usertype=="admin")
			{
				echo "<div class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
					<div class='container'>
						<div class='navbar-header'>
							<a class='navbar-brand' href='#'>Welcome Admin</a>
						</div>
						<div class='collapse navbar-collapse'>
							<ul class='nav navbar-nav'>
								<li";if($activepage=="home"){ echo " class='active'";} echo"><a href='index.php'>Home</a></li>
								<li";if($activepage=="adduser"){ echo " class='active'";} echo"><a href='adduser.php'>Add-User</a></li>
								<li";if($activepage=="resetpassword"){ echo " class='active'";} echo"><a href='resetpassword.php'>Reset-Password</a></li>
								<li";if($activepage=="loguser"){ echo " class='active'";} echo"><a href='loguser.php'>Log-User</a></li>
								<li><a href='logout.php'>Logout</a></li>
							</ul>
						</div><!--/.nav-collapse -->
					</div>
				</div>";
			}
			elseif($usertype=="central")
			{
				echo "<div class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
					<div class='container'>
						<div class='navbar-header'>
							<a class='navbar-brand' href='#'>Welcome Central Team</a>
						</div>
						<div class='collapse navbar-collapse'>
							<ul class='nav navbar-nav'>
								<li";if($activepage=="home"){ echo " class='active'";} echo"><a href='index.php'>Home</a></li>
								<li";if($activepage=="event"){ echo " class='active'";} echo"><a href='event.php'>Events</a></li>
								<li><a href='logout.php'>Logout</a></li>
							</ul>
						</div><!--/.nav-collapse -->
					</div>
				</div>";
			}
			elseif($usertype=="dept")
			{
				echo "<div class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
					<div class='container'>
						<div class='navbar-header'>
							<a class='navbar-brand' href='#'>Welcome Team</a>
						</div>
						<div class='collapse navbar-collapse'>
							<ul class='nav navbar-nav'>
								<li";if($activepage=="home"){ echo " class='active'";} echo"><a href='index.php'>Home</a></li>
								<!--li";if($activepage=="registration"){ echo " class='active'";} echo"><a href='registration.php'>Registration</a></li-->
								<li";if($activepage=="scoring"){ echo " class='active'";} echo"><a href='scoring.php'>Scoring</a></li>
								<li";if($activepage=="scoreprint"){ echo " class='active'";} echo"><a href='score_print.php'>Score-Print</a></li>
								<li><a href='logout.php'>Logout</a></li>
							</ul>
						</div><!--/.nav-collapse -->
					</div>
				</div>";
			}
		}
	?>
