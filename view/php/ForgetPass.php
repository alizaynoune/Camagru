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
            <h1>Recover Password</h1>
            <input class="left" type="text" placeholder="Username" name="login"/></br>
			<input class="right" type="email" placeholder="Email" name="login"/></br>
			<input class="submit left" type="submit" name="submit" value="OK"/></br>
		</form>
			<a class="leftBtn" href="SignUp.php"><p>Create New Account</p></a>
			<a class="rightBtn" href="LogIn.php"><p>SignIn</p></a>
        </div>
        <?php include'footer.php'; ?>
	</body>
</html>