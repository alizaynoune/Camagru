<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Camagru</title>
  <link class="_css" rel="stylesheet" type="text/css" href="../css/login.css" />
	</head>
	<body>
	<?php include'header.php'; ?>
        <div class="form">
		<form action="../../model/login.php" method="POST">
			<h1>Log In</h1>
			<input class="left User" type="text" placeholder="Username" name="login" value="<?php echo $_POST["login"]?>" required/></br>
			<input class="right Passwd" type="password" placeholder="Password" name="passwd" required/>
			<span class="fa fa-eye-slash" onclick='togglePasswd(this)'></span></br>
			<input class="submit left" type="submit" name="submit" value="OK"/></br>
			
		</form>
        </div>
		<div class="buttomBtn">
			<a class="leftBtn" href="SignUp.php"><p>Create New Account</p></a>
			<a class="rightBtn" href="ForgetPass.php"><p>Forgotten password?</p></a>
		</div>
		<?php include'footer.php'; ?>
		<script type="text/javascript" src="../../controller/validateForm.js"></script>
		<script type="text/javascript" src="../js/form.js"></script>
	</body>
</html>