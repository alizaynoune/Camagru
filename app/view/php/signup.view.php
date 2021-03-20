<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
if ((new Session())->SessionStatus() === true){
    header("Location: home.view.php");
	exit();
}
	
?>

<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />
  <title>Camagru</title>
  <link rel="shortcut icon" type="image/jpg" href="../../../public/icone/logo.jpg">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link class="_css" rel="stylesheet" type="text/css" href="../css/headerFooter.css" />
    <link class="_css" rel="stylesheet" type="text/css" href="../css/form.css" />
    <link class="_css" rel="stylesheet" type="text/css" href="../css/btns.css"/>
	</head>
	<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php'; ?>
    <div class="container">    
      <div class="form form-group container">
		    <form action="../../model/create.model.php" method="POST">
          <h1>Sign Up</h1>
          <h2 class="error"><?= !empty($_GET) && $_GET['error'] ? $_GET['error'] : ''; ?></h2>
			    <input class="left" type="text" placeholder="First Name" name="firstName" value="<?php echo ($_POST && $_POST['firstName']) ? $_POST['firstName'] : "";?>" required/>
          <input class="right" type="text" placeholder="Last Name" name="lastName" value="<?php echo ($_POST && $_POST['lastName']) ? $_POST['lastName'] : "";?>" required/>
          <input class="left" type="text" placeholder="Username" name="login" value="<?php echo ($_POST && $_POST['login']) ? $_POST['login'] : "";?>" required/>
          <input class="right" type="email" placeholder="E-mail Address" name="email" value="<?php echo ($_POST && $_POST['email']) ? $_POST['email'] : "";?>" required/>
          <input class="left" type="password" placeholder="Password" name="passwd" required/>
          <span class="fa fa-eye-slash icon_left" onclick='togglePasswd(this.previousElementSibling, this)'></span>
          <span class="fa fa-eye-slash icon_right" onclick='togglePasswd(this.nextElementSibling, this)'></span>
          <input class="right" type="password" placeholder="Confirm Password" name="confPasswd" required/>
          
          <input class="submit" type="submit" name="submit" value="OK"/>
		    </form>
      </div>
      <div class="container">
				<div class="buttomBtn row ">
					<div class="col row justify-content-start">
						<a class="leftBtn Btn col-9 col-sm-8 col-md-5 col-xl-3" href="login.view.php">SingnIn</a>
					</div>
					<div class="col row justify-content-end">
						<a class="rightBtn Btn col-12 col-sm-9 col-md-7 col-xl-5" href="forgetpwd.view.php">Forgotten password?</a>
					</div>
				</div>
			</div>

    </div>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
        <script type="text/javascript" src="../../controller/validateForm.js"></script>
        <script type="text/javascript" src="../js/form.js"></script>

	</body>
</html>