// AJAX-Modal
// Cards index-page
$(document).ready(function() {
    $('.ajaxModal').click(function () { 
        var lexikonID = $(this).data('id');

        // AJAX request
        $.ajax ({
            url: './inc/loadModal.inc.php',
            type: 'post',
            data: {
                lexikonID: lexikonID
            },
            success: function (response) {
                // add response in modal body
                $('.custom-content').html(response);
                console.log(response);
                // display modal
                $('#showModal').modal('show');
                // $('#showModal').show();
            }
        });
    });
});
// Cards secret-page
$(document).ready(function() {
    $('.ajaxModalSecret').click(function () { 
        var lexikonID = $(this).data('id');

        // AJAX request
        $.ajax ({
            url: '../inc/loadModalSecret.inc.php',
            type: 'post',
            data: {
                lexikonID: lexikonID
            },
            success: function (response) {
                // add response in modal body
                $('.custom-content-secret').html(response);
                console.log(response);
                // display modal
                $('#showModal').modal('show');
                // $('#showModal').show();
            }
        });
    });
});

// Edit-show
$(document).ready(function() {
    $(document).on("click", ".edit_data", function() {
        var entry_id = $(this).attr("id");
        console.log(entry_id);
        $.ajax({
            url: "fetch.php",
            method: "Post",
            data: {
                entry_id: entry_id
            },
            dataType: "json",
            success: function(data) {
                $("#title").val(data.title);
                $("#teaser").val(data.teaser);
                $("#description").val(data.description);
                $("#entry_id").val(data.id);
                $("#imgOld").attr("src", "../img/" + data.imgpath);
                $("#insert").val("Update");
                $("#add_data_Modal").modal("show");
            },
            error: function(req, err) {
                console.log("my message " + err);
            }
        });
    });
});

// Edit-insert
$(document).on('click', '#insert', function(e) {
    e.preventDefault();
    var form = $('#insert_form')[0];
    var formData = new FormData(form);

    if ($('#title').val() == '') {
        alert("Name is required");
    }
    else if ($('#teaser').val() == '') {
        alert("teaser is required");
    }
    else if ($('#description').val() == '') {
        alert("description is required");
    }
    else {
        $.ajax ({
            url: 'insert.php',
            type: 'POST',
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            dataType: 'html',
            success: function(data) {
                $('#insert_form')[0].reset();
                $('#add_data_Modal').modal('hide');
                $('#lexikon_table').html(data);
            }
        });
    };
});


// Delete-show
$(document).on('click', '.delete_data', function() {
    var entryDelete_id = $(this).attr("id");
    $.ajax ({
        url: "fetch.php",
        method: "POST",
        data: {
            entry_id: entryDelete_id
        },
        dataType: "json",
        success: function(data) {
            $('#titleDelete').html(data.title);
            $('#teaserDelete').html(data.teaser);
            $('#descriptionDelete').html(data,description);
            $('#imgDelete').html(data.imgpath);
            $('#deleteIMG').val(data.imgpath);
            $('#entryDelete_id').val(data.id);
            $('#delete').html("Delete");
            $('#delete_data_Modal').modal('show');
        },
        error: function(req, err) {
            console.log('my message ' + err);
        }
    });
});
// Delete-delete
$(document).on('click', '#delete', function(event) {
    event.preventDefault();

    $.ajax ({
        url: "delete.php",
        method: "POST",
        data: $('#delete_form').serialize(),
        beforeSend: function() {
            $('#delete').val("Deleting");
        },
        success: function(data) {
            $('#delete_form')[0].reset();
            $('#delete_data_Modal').modal('hide');
            $('#lexikon_table').html(data);
        }
    });
});