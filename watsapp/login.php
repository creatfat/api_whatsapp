<?php
session_start();
if(isset($_SESSION['logined']))
{
header('location:watsapp.php');
exit();
}
else
{
	if(isset($_POST['submit']))
	{	
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
		$_SESSION['logined'] = $username;
		header('location:watsapp.php');
		exit();
	}
}

?>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css" type="text/css">
	<script src="java/jquery.js" type="text/javascript"></script>
<title>laravel project</title>
</head>
<body>
	<div id="login">
		<form method="post" action="">
		<input type="text" name="username" placeholder="UserName" required>
		<input type="password" name="password" placeholder="Password" required>
		<div class="click">
			<input type="submit" name="submit" class='submit' value="Submit">
		</div>
		</form>
	</div>
</body>
</html>
