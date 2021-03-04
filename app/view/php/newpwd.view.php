<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
if ((new Session())->SessionStatus() === false){
    header("Location: home.view.php");
	exit();
}

else if ((empty($_GET['id']) && empty($_POST['id']))|| (empty($_GET['token']) && empty($_POST['token']))){
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
    <link class="_css" rel="stylesheet" type="text/css" href="../css/headerFooter.css" />
    <link class="_css" rel="stylesheet" type="text/css" href="../css/form.css" />
    <link class="_css" rel="stylesheet" type="text/css" href="../css/btns.css"/>
	</head>
	<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/header.view.php'; ?>
    <div class="content">    
      <div class="form">
		    <form action="../../model/changepwd.model.php" method="POST">
          <h1>Change password</h1>
          <h2 class="error"><?= !empty($_GET) && $_GET['error'] ? $_GET['error'] : ''; ?></h2>
          <input class="left" type="password" placeholder="New Password" name="passwd" required/>
          <span class="fa fa-eye-slash" onclick='togglePasswd(this)'></span>
          <input class="right" type="password" placeholder="Confirm Password" name="confPasswd" required/>
          <span class="fa fa-eye-slash" onclick='togglePasswd(this)'></span>
          <input style='display: none;' name="id"  value="<?php echo !empty($_GET['id']) ? $_GET['id'] : $_POST['id'];?>"/>
          <input style='display: none;' name="token" value="<?php echo !empty($_GET['token']) ? $_GET['token'] : $_POST['token'];?>"/>
          <input class="submit left" type="submit" name="submit" value="OK"/>
		    </form>
      </div>
    </div>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
        <script type="text/javascript" src="../../controller/validateForm.js"></script>
        <script type="text/javascript" src="../js/form.js"></script>

	</body>
</html>