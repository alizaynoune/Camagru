
<nav class="navBar">
    <a class="navLeft" href="<?= '/index.php'?>"> <h1 >Camagru</h1></a>
    <h2 class="navRight">
        <?php echo $_SESSION['login'] ? $_SESSION['login'] : 'Gallery'; ?>
    </h2>
</nav>