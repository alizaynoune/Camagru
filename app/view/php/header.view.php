
<nav class="navBar navbar navbar-expand-lg">
<div class="navCenter"><p class="global_msj">tessdfljsdjfkljsadkfj sdkfjlakj kjdfskj jfjksifjjft</p></div>

    <div class="navLeft navbar-left">
        <?php 
                if (!empty($_SESSION['login'])){
                   echo "<a href=\"/app/view/php/profile.view.php\">";
                   echo "<h1 class='login'>".$_SESSION['login']."</h1>";
                   echo "</a>";
                }
               else{
                echo "<a href=\"/app/view/php/home.view.php\">";
                echo "<h1>Camagru</h1>";
                echo "</a>";
               }
        ?>
    </div>
    <div class="navRight navbar-right">
            <?php 
                if (!empty($_SESSION['login']))
                    require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/php/infouser.view.php';
                 else{
                     echo "<a href=\"/app/view/php/login.view.php\">";
                     echo "<h1>login</h1>";
                     echo "</a>";
                 }
            ?>
                
    </div>
</nav>
<script type="text/javascript" src="../js/header.js"></script>

