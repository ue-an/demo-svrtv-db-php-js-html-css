var authorsTbl = '';
$(function() {
    // draw function [called if the database updates]
    function draw_data() {
        if ($.fn.dataTable.isDataTable('#authors-tbl') && authorsTbl != '') {
            authorsTbl.draw(true)
        } else {
            load_data();
        }
    }
 
    //Load Data
    function load_data() {
        authorsTbl = $('#authors-tbl').DataTable({
            dom: '<"row"B>flr<"py-2 my-2"t>ip',
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "./users_table/get_users.php",
                method: 'POST'
            },
            columns: [{
                    data: 'userID',
                    className: 'py-0 px-1'
                },
                {
                    data: 'email',
                    className: 'py-0 px-1'
                },
                {
                    data: 'lastname',
                    className: 'py-0 px-1'
                },
                {
                    data: 'firstname',
                    className: 'py-0 px-1'
                },
                {
                    data: 'mobile',
                    className: 'py-0 px-1'
                },
                {
                    data: 'isBonafied',
                    className: 'py-0 px-1'
                },
                {
                    data: 'isFeastAttendee',
                    className: 'py-0 px-1'
                },
                {
                    data: 'feastName',
                    className: 'py-0 px-1'
                },
                {
                    data: 'district',
                    className: 'py-0 px-1'
                },
                {
                    data: 'address',
                    className: 'py-0 px-1'
                },
                {
                    data: 'city',
                    className: 'py-0 px-1'
                },
                {
                    data: 'country',
                    className: 'py-0 px-1'
                },
                {
                    data: null,
                    orderable: false,
                    className: 'text-center py-0 px-1',
                    render: function(data, type, row, meta) {
                        console.log()
                        return '<a class="me-2 btn btn-sm rounded-0 py-0 edit_data btn-primary" href="javascript:void(0)" data-id="' + (row.userID) + '">Edit</a><a class="btn btn-sm rounded-0 py-0 delete_data btn-danger" href="javascript:void(0)" data-id="' + (row.userID) + '">Delete</a>';
                    }
                }
            ],
            drawCallback: function(settings) {
                $('.edit_data').click(function() {
                    $.ajax({
                        url: './users_table/get_single.php',
                        data: { userID: $(this).attr('data-id') },
                        method: 'POST',
                        dataType: 'json',
                        error: err => {
                            alert("An error occured while fetching single data")
                        },
                        success: function(resp) {
                            if (!!resp.status) {
                                Object.keys(resp.data).map(k => {
                                    if ($('#edit_modal').find('input[name="' + k + '"]').length > 0)
                                        $('#edit_modal').find('input[name="' + k + '"]').val(resp.data[k])
                                })
                                $('#edit_modal').modal('show')
                            } else {
                                alert("An error occured while fetching single data")
                            }
                        }
                    })
                })
                $('.delete_data').click(function() {
                    $.ajax({
                        url: './users_table/get_single.php',
                        data: { userID: $(this).attr('data-id') },
                        method: 'POST',
                        dataType: 'json',
                        error: err => {
                            alert("An error occured while fetching single data")
                        },
                        success: function(resp) {
                            if (!!resp.status) {
                                $('#delete_modal').find('input[name="userID"]').val(resp.data['userID'])
                                $('#delete_modal').modal('show')
                            } else {
                                alert("An error occured while fetching single data")
                            }
                        }
                    })
                })
            },
            buttons: [{
                text: "Import/ Bulk Entry",
                className: "btn btn-primary fw-bold py-0",
                action: function(e, dt, node, config) {
                    $('#add_modal').modal('show')
                }
            },
            {
                text: "Refresh",
                className: "btn btn-primary fw-bold py-0",
                action: function(e, dt, node, config) {
                    authorsTbl.draw(true);
                }
            },
            //will add new button for single entry
            {
                text: "Add Record",
                className: "btn btn-primary fw-bold py-0",
                action: function(e, dt, node, config) {
                    $('#add_modal').modal('show')
                }
            },
            ],
            "order": [
                [1, "asc"]
            ],
            initComplete: function(settings) {
                $('.paginate_button').addClass('p-1')
            }
        });
    }
    load_data()
    //Saving new Data (Single)
    $('#new-sauthor-frm').submit(function(e) {
        e.preventDefault()
        $('#add_modal_sauthor button').attr('disabled', true)
        $('#add_modal_sauthor button[form="new-sauthor-frm"]').text("saving ...")
        $.ajax({  
            url:"./users_table/add_users.php",  
            method:"POST",
            data:new FormData(this),  
            contentType:false,          // The content type used when sending data to the server.  
            cache:false,                // To unable request pages to be cached  
            processData:false,          // To send DOMDocument or non processed data file it is set to false 
            error: err => {
                alert("An error occured. Please check the source code and try again")
            }, 
            success: function(resp) {
                let res = $.parseJSON(resp);
                console.log(res);
                if (!!res.status) {
                    if (res.status == 'success') {
                        var _el = $('<div>')
                        _el.hide()
                        _el.addClass('alert alert-primary alert_msg')
                        _el.text("Data successfully added");
                        $('#new-sauthor-frm').get(0).reset()
                        $('.modal').modal('hide')
                        $('#msg').append(_el)
                        _el.show('slow')
                        draw_data();
                        setTimeout(() => {
                            _el.hide('slow')
                                .remove()
                        }, 2500)
                    } else if (res.status == 'failed' && !!res.msg) {
                        var _el = $('<div>')
                        _el.hide()
                        _el.addClass('alert alert-danger alert_msg form-group')
                        _el.text(res.msg);
                        $('#new-sauthor-frm').append(_el)
                        _el.show('slow')
                    } else {
                        alert("An error occured. Please check that the file selected isn't uploaded already.\nNo new record(s) found.");
                       
                    }
                } else {
                    alert("An error occurred. Please check the source code and try again")
                }

                $('#add_modal_sauthor button').attr('disabled', false)
                $('#add_modal_sauthor button[form="new-sauthor-frm"]').text("Import")
                
            }
        })  
    })
        //Saving new Data (Bulk)
    $('#new-author-frm').submit(function(e) {
            e.preventDefault()
            var file_data = $('#file')[0].files[0];
            var form_data = new FormData();
            form_data.append('#file', file_data);
            if (file_data != undefined) {
                $('#add_modal button').attr('disabled', true)
                $('#add_modal button[form="new-author-frm"]').text("importing ...")
                $.ajax({  
                    url:"./users_table/import_users.php",  
                    method:"POST",
                    data:new FormData(this),  
                    contentType:false,          // The content type used when sending data to the server.  
                    cache:false,                // To unable request pages to be cached  
                    processData:false,          // To send DOMDocument or non processed data file it is set to false 
                    error: err => {
                        alert("An error occured. Please check the source code and try again")
                    }, 
                    success: function(resp) {
                        const resp_arr = resp.split("}");
                        if (resp_arr.some(res => res.status === 'failed')) {
                            alert("add message here if found some 'failed' result");
                        } else {
                            var _el = $('<div>')
                                    _el.hide()
                                    _el.addClass('alert alert-primary alert_msg')
                                    _el.text("Data successfully imported");
                                    $('#new-author-frm').get(0).reset()
                                    $('.modal').modal('hide')
                                    $('#msg').append(_el)
                                    _el.show('slow')
                                    draw_data();
                                    setTimeout(() => {
                                        _el.hide('slow')
                                            .remove()
                                    }, 2500)
                        }
                        $('#add_modal button').attr('disabled', false)
                        $('#add_modal button[form="new-author-frm"]').text("Import")
                        $('#add_modal #file').val('');
                    }
               })  
            }
            return false;
        })
        // Update Data
    $('#edit-author-frm').submit(function(e) {
            e.preventDefault()
            $('#edit_modal button').attr('disabled', true)
            $('#edit_modal button[form="edit-author-frm"]').text("saving ...")
            $.ajax({
                url: './users_table/update_data.php',
                data: $(this).serialize(),
                method: 'POST',
                dataType: "json",
                error: err => {
                    alert("An error occured. Please check the source code and try again")
                },
                success: function(resp) {
                    if (!!resp.status) {
                        if (resp.status == 'success') {
                            var _el = $('<div>')
                            _el.hide()
                            _el.addClass('alert alert-primary alert_msg')
                            _el.text("Data successfully updated");
                            $('#edit-author-frm').get(0).reset()
                            $('.modal').modal('hide')
                            $('#msg').append(_el)
                            _el.show('slow')
                            draw_data();
                            setTimeout(() => {
                                _el.hide('slow')
                                    .remove()
                            }, 2500)
                        } else if (resp.status == 'success' && !!resp.msg) {
                            var _el = $('<div>')
                            _el.hide()
                            _el.addClass('alert alert-danger alert_msg form-group')
                            _el.text(resp.msg);
                            $('#edit-author-frm').append(_el)
                            _el.show('slow')
                        } else {
                            alert("An error occured. Please check the source code and try again")
                        }
                    } else {
                        alert("An error occurred. Please check the source code and try again")
                    }
 
                    $('#edit_modal button').attr('disabled', false)
                    $('#edit_modal button[form="edit-author-frm"]').text("Save")
                }
            })
        })
        // DELETE Data
    $('#delete-author-frm').submit(function(e) {
        e.preventDefault()
        $('#delete_modal button').attr('disabled', true)
        $('#delete_modal button[form="delete-author-frm"]').text("deleting data ...")
        $.ajax({
            url: './users_table/delete_data.php',
            data: $(this).serialize(),
            method: 'POST',
            dataType: "json",
            error: err => {
                alert("An error occured. Please check the source code and try again")
            },
            success: function(resp) {
                if (!!resp.status) {
                    if (resp.status == 'success') {
                        var _el = $('<div>')
                        _el.hide()
                        _el.addClass('alert alert-primary alert_msg')
                        _el.text("Data successfully deleted");
                        $('#delete-author-frm').get(0).reset()
                        $('.modal').modal('hide')
                        $('#msg').append(_el)
                        _el.show('slow')
                        draw_data();
                        setTimeout(() => {
                            _el.hide('slow')
                                .remove()
                        }, 2500)
                    } else if (resp.status == 'success' && !!resp.msg) {
                        var _el = $('<div>')
                        _el.hide()
                        _el.addClass('alert alert-danger alert_msg form-group')
                        _el.text(resp.msg);
                        $('#delete-author-frm').append(_el)
                        _el.show('slow')
                    } else {
                        alert("An error occured. Please check the source code and try again")
                    }
                } else {
                    alert("An error occurred. Please check the source code and try again")
                }
 
                $('#delete_modal button').attr('disabled', false)
                $('#delete_modal button[form="delete-author-frm"]').text("YEs")
            }
        })
    })
});

