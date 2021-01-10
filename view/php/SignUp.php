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
		<form action="creat.php" method="POST">
			<h1>Sign Up</h1>
			<input class="left" type="text" placeholder="First Name" name="firstName"/></br>
            <input class="right" type="text" placeholder="Last Name" name="lastName"/></br>
            <input class="left" type="email" placeholder="Email Address" name="email"/></br>
			<input class="right" type="password" placeholder="password" name="passwd"/></br>
            <input class="left" type="password" placeholder="Confirm Password" name="passwd"/></br>
			<input class="submit right" type="submit" name="submit" value="OK"/></br>
			
            
			<!-- <a class="forgetPass" href="#"><p>Forgotten password?</p></a> -->

		</form>
        <a class="leftBtn" href="LogIn.php"><p>SignIn</p></a>
        </div>
        <?php include'footer.php'; ?>
	</body>
</html>