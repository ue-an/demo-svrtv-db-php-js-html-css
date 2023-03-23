var anawimTbl = '';
$(function() {
 function draw_data() {
  if ($.fn.dataTable.isDataTable('#anawim-tbl') && anawimTbl!= '') {
       anawimTbl.draw(true)
   } else {
       load_data_anawim();
   }
 }
 //Load Data
 function load_data_anawim() {
    anawimTbl = $('#anawim-tbl').DataTable({
    dom: '<"row"B>flr<"py-2 my-2"t>ip',
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "./anawim_table/get_anawim.php",
                method: 'POST'
            },
            columns: [{
                    data: 'anawimID',
                    className: 'py-0 px-1'
                },
                {
                    data: 'email',
                    className: 'py-0 px-1'
                },
                {
                    data: 'firstname',
                    className: 'py-0 px-3'
                },
                {
                    data: 'lastname',
                    className: 'py-0 px-1'
                },
                {
                    data: 'mobile',
                    className: 'py-0 px-1'
                },
                {
                    data: 'monthlyDonation',
                    className: 'py-0 px-3'
                },
                {
                    data: 'category',
                    className: 'py-0 px-3'
                },
                {
                    data: null,
                    orderable: false,
                    className: 'text-center py-0 px-3',
                    render: function(data, type, row, meta) {
                        console.log()
                        return '<a class="me-2 btn btn-sm rounded-0 py-0 edit_data_anawim btn-primary" href="javascript:void(0)" data-id="' + (row.anawimID) + '">Edit</a><a class="btn btn-sm rounded-0 py-0 delete_data_anawim btn-danger" href="javascript:void(0)" data-id="' + (row.anawimID) + '">Delete</a>';
                    }
                }
            ],
            drawCallback: function(settings) {
                $('.edit_data_anawim').click(function() {
                    $.ajax({
                        url: './anawim_table/get_single.php',
                        data: { anawimID: $(this).attr('data-id') },
                        method: 'POST',
                        dataType: 'json',
                        error: err => {
                            alert("An error occured while fetching single data")
                        },
                        success: function(resp) {
                            if (!!resp.status) {
                                Object.keys(resp.data).map(k => {
                                    if ($('#edit_modal_anawim').find('input[name="' + k + '"]').length > 0)
                                        $('#edit_modal_anawim').find('input[name="' + k + '"]').val(resp.data[k])
                                })
                                $('#edit_modal_anawim').modal('show')
                            } else {
                                alert("An error occured while fetching single data")
                            }
                        }
                    })
                })
                //try to access the users
                $('.edit_data_anawim').click(function() {
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
                                    if ($('#edit_modal_anawim').find('input[name="' + k + '"]').length > 0)
                                        $('#edit_modal_anawim').find('input[name="' + k + '"]').val(resp.data[k])
                                })
                                $('#edit_modal_anawim').modal('show')
                            } else {
                                alert("An error occured while fetching single data")
                            }
                        }
                    })
                })
                $('.delete_data_anawim').click(function() {
                    $.ajax({
                        url: './anawim_table/get_single.php',
                        data: { anawimID: $(this).attr('data-id') },
                        method: 'POST',
                        dataType: 'json',
                        error: err => {
                            alert("An error occured while fetching single data")
                        },
                        success: function(resp) {
                            if (!!resp.status) {
                                $('#delete_modal_anawim').find('input[name="anawimID"]').val(resp.data['anawimID'])
                                $('#delete_modal_anawim').modal('show')
                            } else {
                                alert("An error occured while fetching single data")
                            }
                        }
                    })
                })
            },
            buttons: [{
                text: "Add Anawim",
                className: "btn btn-primary fw-bold py-0",
                action: function(e, dt, node, config) {
                    $('#add_modal_anawim').modal('show')
                }
            },
            {
                text: "Refresh",
                className: "btn btn-primary fw-bold py-0",
                action: function(e, dt, node, config) {
                    anawimTbl.draw(true);
                }
            },
            ],
            "order": [
                [1, "asc"]
            ],
            initComplete: function(settings) {
                $('.paginate_button_anawim').addClass('p-1')
            }
    });
    }
    //LoadData
    load_data_anawim()
    //Saving new Data
    $('#new-anawim-frm').submit(function(e) {
        e.preventDefault()
        var file_data = $('#file-anawim')[0].files[0];
        var form_data = new FormData();
        form_data.append('#file-anawim', file_data);
        if (file_data != undefined) {
            $('#add_modal_anawim button').attr('disabled', true)
            $('#add_modal_anawim button[form="new-anawim-frm"]').text("importing ...")
            $.ajax({  
                url:"./anawim_table/import_anawim.php",  
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
                        $('#new-anawim-frm').get(0).reset();
                        $('.modal').modal('hide')
                        $('#msg').append(_el)
                        _el.show('slow')
                        draw_data();
                        setTimeout(() => {
                            _el.hide('slow')
                            .remove()
                        }, 2500)
                    }
                    $('#add_modal_anawim button').attr('disabled', false)
                    $('#add_modal_anawim button[form="new-anawim-frm"]').text("Import")
                    $('#add_modal_anawim #file-anawim').val('');
                }
        })  
        }
        return false;
    })

    // Update Data
    $('#edit-anawim-frm').submit(function(e) {
        e.preventDefault()
        $('#edit_modal_anawim button').attr('disabled', true)
        $('#edit_modal_anawim button[form="edit-anawim-frm"]').text("saving ...")
        $.ajax({
            url: './anawim_table/update_data.php',
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
                        $('#edit-anawim-frm').get(0).reset()
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
                        $('#edit-anawim-frm').append(_el)
                        _el.show('slow')
                    } else {
                        alert("An error occured. Please check the source code and try again")
                    }
                } else {
                    alert("An error occurred. Please check the source code and try again")
                }
    
                $('#edit_modal_anawim button').attr('disabled', false)
                $('#edit_modal_anawim button[form="edit-anawim-frm"]').text("Save")
            }
        })
        })

        // Delete Data
    $('#delete-anawim-frm').submit(function(e) {
        e.preventDefault()
        $('#delete_modal_anawim button').attr('disabled', true)
        $('#delete_modal_anawim button[form="delete-anawim-frm"]').text("deleting data ...")
        $.ajax({
            url: './anawim_table/delete_data.php',
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
                        $('#delete-anawim-frm').get(0).reset()
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
                        $('#delete-anawim-frm').append(_el)
                        _el.show('slow')
                    } else {
                        alert("An error occured. Please check the source code and try again")
                    }
                } else {
                    alert("An error occurred. Please check the source code and try again")
                }
    
                $('#delete_modal_anawim button').attr('disabled', false)
                $('#delete_modal_anawim button[form="delete-anawim-frm"]').text("YEs")
            }
        })
        })

})