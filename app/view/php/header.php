<?php session_start(); ?>
<nav class="navBar">
    <a class="navLeft" href="<?=(!empty($_SESSION['login'])) ? '/app/view/php/home.php': '/index.php';?>">
    <h1 >Camagru</h1></a>
    <div class="navRight">
            <?php 
                if (!empty($_SESSION['login'])) :?>
                   <?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/infouser.php';
                else :?>
                    <a href="/app/view/php/logout.php"><h1>Gallery<h1></a>
                <?php endif;?>
    </div>
</nav>