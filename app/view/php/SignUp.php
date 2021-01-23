<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />
  <title>Camagru</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link class="_css" rel="stylesheet" type="text/css" href="../css/login.css" />
	</head>
	<body>
    <?php include'header.php'; ?>
        <div class="form">
		<form action="../../model/create.php" method="POST">
			<h1>Sign Up</h1>
			<input class="left" type="text" placeholder="First Name" name="firstName" required/>
            <input class="right" type="text" placeholder="Last Name" name="lastName" value="<?= $_POST['lastName']?>" required/>
            <input class="left" type="text" placeholder="Username" name="login" value="<?= $_POST['login']?>" required/>
            <input class="right" type="email" placeholder="E-mail Address" name="email" value="<?= $_POST['email']?>" required/>
            <input class="left" type="password" placeholder="Password" name="passwd" required/>
            <span class="fa fa-eye-slash" onclick='togglePasswd(this)'></span>
            <input class="right" type="password" placeholder="Confirm Password" name="confPasswd" required/>
            <span class="fa fa-eye-slash" onclick='togglePasswd(this)'></span>
            <input class="submit left" type="submit" name="submit" value="OK"/>
            
		</form>
        </div>
        <div class="buttomBtn">
        <a class="leftBtn" href="LogIn.php"><p>SignIn</p></a>

        </div>
        <?php include'footer.php'; ?>
        <script type="text/javascript" src="../../controller/validateForm.js"></script>
        <script type="text/javascript" src="../js/form.js"></script>

	</body>
</html>