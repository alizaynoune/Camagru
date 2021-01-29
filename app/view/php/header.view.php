
<nav class="navBar">
    <div class="navLeft">
        <a  href="/app/view/php/home.view.php"><h1 >
        <?php 
                session_start();
                if (!empty($_SESSION['login'])) :?>
                   <a href="/app/view/php/profile.view.php"><h1><?php echo $_SESSION['login']; ?><h1></a>
               <?php else :?>
                    <a href="/app/view/php/home.view.php"><h1>Camagru<h1></a>
                <?php endif;?>

        </h1></a>
    </div>
    <div class="navRight">
            <?php 
                if (!empty($_SESSION['login'])) :?>
                   <?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/infouser.view.php';
                else :?>
                    <a href="/app/view/php/login.view.php"><h1>login<h1></a>
                <?php endif;?>
    </div>
</nav>