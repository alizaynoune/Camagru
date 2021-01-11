
<nav class="navBar">
    <a class="navLeft" href="../../index.php"> <h1 >Camagru</h1></a>
    <h2 class="navRight">
        <?php if (isset($_SESSION['USER_NAME'])) echo $_SESSION['USER_NAME']; ?>
    </h2>
</nav>