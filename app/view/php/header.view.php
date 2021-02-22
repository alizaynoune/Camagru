
<nav class="navBar">
    <div class="navLeft">
        <?php 
                if (!empty($_SESSION['login'])){
                   echo "<a href=\"/app/view/php/profile.view.php\">";
                   echo "<h1>".$_SESSION['name']."</h1>";
                   echo "</a>";
                }
               else{
                echo "<a href=\"/app/view/php/home.view.php\">";
                echo "<h1>Camagru</h1>";
                echo "</a>";
               }
        ?>
    </div>
    <div class="navRight">
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
