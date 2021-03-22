
<nav class="navBar navbar">

    <div class="navLeft nav-item">
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
    <div class="navCenter nav-item "><p class="global_msj"></p></div>

    <div class="navRight nav-item">
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

