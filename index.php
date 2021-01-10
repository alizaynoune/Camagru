<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />
  <title>Camagru</title>
  <link class="_css" rel="stylesheet" type="text/css" href="view/css/login.css" />
	</head>
	<body>
        <nav class="navBar">
            <h1>Camagru</h1>
            <h2>logUp</h2>
        </nav>
		<form class="form" action="login.php" method="POST">
			<h1>Login</h1>
			<input class="right" type="text" placeholder="username" name="login"/></br>
			<input class="left" type="password" placeholder="       password" name="passwd"/></br>
			<input class="submit right" type="submit" name="submit" value="OK"/></br>
			<a class="logUpIn" href="#"><p>Create New Account</p></a>
			<a class="forgetPass" href="#"><p>Forgotten password?</p></a>

		</form>

	</body>
</html>