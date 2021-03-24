
<nav class="navBar navbar">
    <div class="navLeft nav-item">
        <?php 
                if (!empty($_SESSION['login'])) :?>
                   <a href=/app/view/php/profile.view.php><h1 class='login'><?php echo $_SESSION['login'] ?></h1></a>
                   <input type='hidden' name='_USER_LOGIN_' value="<?php echo $_SESSION['login'] ?>"/>
                <?php
               else :?>
                <a href="/app/view/php/home.view.php"><h1>Camagru</h1></a>
        <?php endif;?>
    </div>
    <div class="navCenter nav-item "><p class="global_msj"></p></div>
    <div class="navRight nav-item">
            <?php 
                if (!empty($_SESSION['login']))
                    require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/infouser.view.php';
                 else if (empty($_SESSION['login'])) :?>
                     <a href="/app/view/php/login.view.php"><h1>login</h1></a>
            <?php endif; ?>
                
    </div>
</nav>
<script type="text/javascript" src="../js/header.js"></script>

