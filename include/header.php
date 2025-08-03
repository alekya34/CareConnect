<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet"  type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-info bg-info justify-content-between">
	<h4 class="text-white">CARE CONNECT</h4>
	<div class="mr-auto">
	<ul class="navbar-nav">
		<?php
	         if(isset($_SESSION['admin']))
	        {	
				$user = $_SESSION['admin'];
			     echo '
		     <li class="nav-item"><a href="#" class="nav-link text-white">'.$user.'</a></li>
		     <li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li> ';
	        }else if(isset($_SESSION['doctor'])){
				 $user =$_SESSION['doctor'];
				echo '
				<li class="nav-item"><a href="#" class="nav-link text-white">'.$user.'</a></li>
				<li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li> ';
			}else if(isset($_SESSION['patient'])){
				$user =$_SESSION['patient'];
				echo '
				<li class="nav-item"><a href="#" class="nav-link text-white">'.$user.'</a></li>
				<li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li> ';

			}
			else{
			echo '
			<li class="nav-item"><a href="index.php" class="nav-link text-white">Home   </a></li>
			<li class="nav-item"><a href="adminlogin.php" class="nav-link text-white">Admin</a></li>
			<li class="nav-item"><a href="doctorlogin.php" class="nav-link text-white">Doctor</a></li>
			<li class="nav-item"><a href="patientlogin.php" class="nav-link text-white">Patient</a></li> ';
			}
		?>
		
		
	</ul>
	</div>
</nav>

</body>

</html>