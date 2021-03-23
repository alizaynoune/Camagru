<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/schimaDefine.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/model/class.model.php';
if ((new Session())->SessionStatus() === true){
    header("Location: home.view.php");
	exit();
}

if ((empty($_GET['id']) && empty($_POST['id']))|| (empty($_GET['token']) && empty($_POST['token']))){
    header("Location: home.view.php");
}
$token = (new dbselect())->select($DB_SELECT['_uid'], '*', 'tempemail', $_GET['id'], $PARAM['int'], 1);
$exist_token = false;
foreach($token as $value){
    if ($value['uid'] === $_GET['id'] && $value['token'] === $_GET['token']){
        $exist_token = true;
        break;
    }
}
if ($exist_token === false)
    header("Location: forgetpwd.view.php?error=invalid token");
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
    <div class="container page">    
      <div class="form">
		    <form action="../../model/changepwd.model.php" method="POST">
          <h1>Change password</h1>
          <h2 class="error"><?= !empty($_GET) && $_GET['error'] ? $_GET['error'] : ''; ?></h2>
          <input class="left" type="password" placeholder="New Password" name="passwd" required/>
          <span class="fa fa-eye-slash" onclick='togglePasswd(this.previousElementSibling, this)'></span>
          <span class="fa fa-eye-slash" onclick='togglePasswd(this.nextElementSibling, this)'></span>
          <input class="right" type="password" placeholder="Confirm Password" name="confPasswd" required/>
          <input style='display: none;' name="id"  value="<?php echo !empty($_GET['id']) ? $_GET['id'] : $_POST['id'];?>"/>
          <input style='display: none;' name="token" value="<?php echo !empty($_GET['token']) ? $_GET['token'] : $_POST['token'];?>"/>
          <input class="submit" type="submit" name="submit" value="OK"/>
		    </form>
      </div>
    </div>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/footer.view.php'; ?>
        <script type="text/javascript" src="../../controller/validateForm.js"></script>
        <script type="text/javascript" src="../js/form.js"></script>

	</body>
</html>