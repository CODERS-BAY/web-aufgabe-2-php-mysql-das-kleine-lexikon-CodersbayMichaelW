<?php define('ROOTPATH', '/php-mysql-das-kleine-lexikon/uebung') ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php if (!isset($_SESSION["username"])) { ?>
                <a class="navbar-brand" href="<?php echo ROOTPATH; ?>/index.php">Home</a>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#regitry">Register</a>
                </li>
            <?php }
            else { ?>
                <a class="navbar-brand" href="<?php echo ROOTPATH; ?>/auth/secret.php">Home</a>
                <li class="nav-item text-white p-2">
                    Hello <?php echo $_SESSION["username"] ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo ROOTPATH; ?>/auth/editLexikon.php"> >> Backend</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo ROOTPATH; ?>/auth/logout.php"> >> Logout</a>
                </li>
            <?php } ?>
        </ul>
        
        <form class="form-inline my-2 my-lg-0 search-box">
            <input class="form-control mr-sm-2" type="text" autocomplete="off" placeholder="Search" aria-label="Search">
            <!-- <div class="result bg-white col-12 fixed-top mt-5 card"></div> -->
        </form>
    </div>

</nav>