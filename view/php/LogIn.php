<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />
  <title>Camagru</title>
  <link class="_css" rel="stylesheet" type="text/css" href="../css/login.css" />
	</head>
	<body>
	<?php include'header.php'; ?>
        <div class="form">
		<form action="login.php" method="POST">
			<h1>Log In</h1>
			<input class="left User" type="text" placeholder="Username" name="login" required/></br>
			<input class="right Pass" type="password" placeholder="Password" name="passwd" required/></br>
			<input class="submit left" type="submit" name="submit" value="OK"/></br>
		</form>
        </div>
		<div class="buttomBtn">
			<a class="leftBtn" href="SignUp.php"><p>Create New Account</p></a>
			<a class="rightBtn" href="ForgetPass.php"><p>Forgotten password?</p></a>
		</div>
		<?php include'footer.php'; ?>
		<script type="text/javascript" src="../../controller/validateForm.js"></script>
	</body>
</html>