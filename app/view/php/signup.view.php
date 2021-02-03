<?php
session_start();
if (!empty($_SESSION) && !empty($_SESSION['login'])){
	// session_destroy();
	header("Location: home.view.php");
}
	
?>

<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />
  <title>Camagru</title>
  <link rel="shortcut icon" type="image/jpg" href="../../../public/icone/logo.jpg">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link class="_css" rel="stylesheet" type="text/css" href="../css/login.css" />
	</head>
	<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php'; ?>
    <div class="content">    
      <div class="form">
		    <form action="../../model/create.model.php" method="POST">
          <h1>Sign Up</h1>
          <h2 class="error"><?= !empty($_GET) && $_GET['error'] ? $_GET['error'] : ''; ?></h2>
			    <input class="left" type="text" placeholder="First Name" name="firstName" value="<?php echo ($_POST && $_POST['firstName']) ? $_POST['firstName'] : "";?>" required/>
          <input class="right" type="text" placeholder="Last Name" name="lastName" value="<?php echo ($_POST && $_POST['lastName']) ? $_POST['lastName'] : "";?>" required/>
          <input class="left" type="text" placeholder="Username" name="login" value="<?php echo ($_POST && $_POST['login']) ? $_POST['login'] : "";?>" required/>
          <input class="right" type="email" placeholder="E-mail Address" name="email" value="<?php echo ($_POST && $_POST['email']) ? $_POST['email'] : "";?>" required/>
          <input class="left" type="password" placeholder="Password" name="passwd" required/>
          <span class="fa fa-eye-slash" onclick='togglePasswd(this)'></span>
          <input class="right" type="password" placeholder="Confirm Password" name="confPasswd" required/>
          <span class="fa fa-eye-slash" onclick='togglePasswd(this)'></span>
          <input class="submit left" type="submit" name="submit" value="OK"/>
		    </form>
      </div>
      <div class="buttomBtn">
        <a class="rightBtn" href="forgetpwd.view.php"><p>Forgotten password?</p></a>
        <a class="leftBtn" href="login.view.php"><p>SignIn</p></a>
      </div>
    </div>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
        <script type="text/javascript" src="../../controller/validateForm.js"></script>
        <script type="text/javascript" src="../js/form.js"></script>

	</body>
</html>