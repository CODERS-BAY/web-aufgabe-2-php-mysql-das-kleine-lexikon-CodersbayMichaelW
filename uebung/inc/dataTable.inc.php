<div class="table-responsive" id="lexikon_table">
    <table class="table table-striped table-default">
        <tbody>
            <?php
            include("login.inc.php");
            $result = $connection->query("SELECT id, title FROM content ORDER BY id ASC");
            while($entry = $result->fetch_assoc()) {
                if(mb_detect_encoding($entry['title']) != 'UTF-8' || 'ASCII') {
                    $entry['title'] = utf8_encode($entry['title']);
                }
                ?>

                <tr>
                    <td><?php echo $entry['id']; ?></td>
                    <td><?php echo $entry['title']; ?></td>

                    <td>
                        <button type="button" class="card-title btn edit_data" name="edit" value="Edit" data-toggle="modal" id="<?php echo $entry['id'] ?>">
                            <i class="fas fa-edit">Edit</i>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="card-title btn delete_data" name="delete" value="Delete" data-toggle="modal" id="<?php echo $entry['id'] ?>">
                            <i class="fas fa-trash">Delete</i>
                        </button>
                    </td>
                </tr>
            <?php } 
            $connection->close(); ?>
        </tbody>
    </table>
</div>