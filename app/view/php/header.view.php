<?php session_start(); ?>
<nav class="navBar">
    <a class="navLeft" href="<?= '/app/view/php/home.view.php';?>">
    <h1 >Camagru</h1></a>
    <div class="navRight">
            <?php 
                if (!empty($_SESSION['login'])) :?>
                   <?php require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/infouser.view.php';
                else :?>
                    <a href="/app/view/php/login.view.php"><h1>login<h1></a>
                <?php endif;?>
    </div>
</nav>