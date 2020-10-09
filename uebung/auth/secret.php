<!DOCTYPE html>
<html>

<?php
// include auth.php file on all secure pages
include("auth.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay"
        crossorigin="anonymous"/>
</head>



<body>
    <header>
        <?php include('../inc/loggedNav.inc.php'); ?>
    </header>
    
    <main>

    <main>
        <!-- Here could be your content -->
        <h1 class="my-title anim-typewriter2">Here could be your content</h1>

        <article class="my-container">
            <section class="my-picture-section">
                <?php
                include('../inc/login.inc.php');

                // Query statement
                $qeury = "SELECT id, title, teaser, imgpath FROM content";
                $result = $connection->query($qeury);

                // Card Beginn
                while($row = $result->fetch_assoc()) { ?>
                <!-- create div where all the elements are put in -->
                <div class="my-picture-div" id="<?php echo $row['id'] ?>">

                    <!-- Picture is available -->
                    <?php if($row['imgpath']) { ?>
                        <img class="my-pic" src="../img/<?php echo $row['imgpath'] ?>" alt="">
                    <?php } ?>

                    <div class="my-card-body">
                        <!-- Button  -->
                        <button type="button" class="my-card-button ajaxModalSecret" data-toggle="modal" data-id="<?php echo $row['id'] ?>">
                            <?php echo $row['title']; ?>
                        </button>

                        <!-- Text -->
                        <p class="my-card-text">
                            <?php echo $row['teaser']; ?>
                        </p>
                    </div>

                </div>
                <!-- Card End -->

                <?php }
                // var_dump($result);
                $connection->close(); // close connection to the database
                ?>
            </section>
        </article>

        <!-- Modal Cards -->
        <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="lexikon-entry" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content custom-content-secret my-modal-content">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Info End -->
    </main>


    <footer>
    </footer>

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <!-- JS -->
    <script type ="text/javascript" src="../js/script.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Bootstrap JS -->        
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>