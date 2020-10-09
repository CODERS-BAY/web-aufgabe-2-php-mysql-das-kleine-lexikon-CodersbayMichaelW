<!DOCTYPE html>
<html>
<?php
// include auth.php file on all secure pages
include("auth.php");
define("SECURE", true);
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
        <?php include("../inc/loggedNav.inc.php") ?>
    </header>
    
    <main>
        <section class="pt-5 mt-5" id="lexikon">
            <!-- Button trigger modal -->
            <div class="ribbon">
                <div class="ribbon-fold">
                    <button type="button" class="btn" data-toggle="modal" data-target="#addEntry">
                        <i class="fas fa-plus"></i> Add Entry
                    </button>
                </div>
            </div>

            <?php include("../inc/dataTable.inc.php") ?>

            <!-- Modal Add -->
            <div class="modal fade" id="addEntry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Card</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="../inc/saveEntry.inc.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="titel">Titel (max. 550 Zeichen)</label>
                                    <input type="text" class="form-control" name="title" require>
                                </div>

                                <div class="form-group">
                                    <label for="teaser">Teaser (max. 550 Zeichen)</label>
                                    <textarea class="form-control" rows="3" name="teaser" require></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" name="description" require></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="description">File Upload</label>
                                    <input type="file" class="form-control-file" name="fileUpload" id="fileUpload">
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        </section>
        <!-- Modal Ende -->

        <!-- Modal Edit -->
        <div class="modal fade" id="add_data_Modal" tabindex="-1" role="dialog" aria-labelledby="lexikon-entry" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Card</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <form method="post" id="insert_form">
                            <input type="hidden" name="entry_id" id="entry_id" />

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" class="form-control" name="title">
                            </div>

                            <div class="form-group">
                                <label for="teaser">Teaser</label>
                                <textarea type="text" id="teaser" class="form-control" name="teaser"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" id="description" class="form-control" name="description"></textarea>
                            </div>

                            <div class="form-group">
                                <img src="" class="img-fluid" id="imgOld">
                            </div>

                            <div class="form-group">
                                <label for="description">New Picture</label>
                                <input type="file" class="form-control-file" name="fileUpdate" id="fileUpdate">
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" name="insert" id="insert">Insert</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- Modal Ende -->

        <!-- Modal Delete -->
        <div id="delete_data_Modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Card</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <p id="titleDelete"></p>
                        <p id="descriptionDelete"></p>
                        <p id="teaserDelete"></p>
                        <p id="imgDelete"></p>

                        <form method="post" id="delete_form">
                            <input type="hidden" id="deleteIMG" name="deleteIMG">
                            <input type="hidden" name="entry_id" id="entryDelete_id">
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" name="delete" id="delete">Delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Ende -->






    </main>

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