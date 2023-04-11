var fmmTbl = '';
$(function() {
 function draw_data() {
  if ($.fn.dataTable.isDataTable('#fmm-tbl') && fmmTbl!= '') {
       fmmTbl.draw(true)
   } else {
       load_data_fmm();
   }
 }
 //Load Data
 function load_data_fmm() {
    fmmTbl = $('#fmm-tbl').DataTable({
    dom: '<"row"B>flr<"py-2 my-2"t>ip',
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "./feastmercyministry_table/get_fmm.php",
                method: 'POST'
            },
            columns: [{
                    data: 'fmm_id',
                    className: 'py-0 px-1'
                },
                {
                    targets: 2,
                    data: 'first_name',
                    className: 'py-0 px-1',
                    render: function ( data, type, row ) {
                    return row.first_name +' '+ row.last_name;
                    }
                },
                {
                    data: 'donor_type',
                    className: 'py-0 px-1'
                },
                {
                    data: 'donation_start_date',
                    className: 'py-0 px-1'
                },
                {
                    data: 'donation_end_date',
                    className: 'py-0 px-1'
                },
                {
                    data: 'amount',
                    className: 'py-0 px-1'
                },
                {
                    data: 'pay_method',
                    className: 'py-0 px-1'
                },
                {
                    data: null,
                    orderable: false,
                    className: 'text-center py-0 px-3',
                    render: function(data, type, row, meta) {
                        console.log()
                        return '<a class="me-2 btn btn-sm rounded-0 py-0 edit_data_fmm btn-primary" href="javascript:void(0)" data-id="' + (row.fmm_id) + '">Edit</a><a class="btn btn-sm rounded-0 py-0 delete_data_fmm btn-danger" href="javascript:void(0)" data-id="' + (row.fmm_id) + '">Delete</a>';
                    }
                }
            ],
            drawCallback: function(settings) {
                $('.edit_data_fmm').click(function() {
                    $.ajax({
                        url: './feastmercyministry_table/get_single_fmm.php',
                        data: { fmmID: $(this).attr('data-id') },
                        method: 'POST',
                        dataType: 'json',
                        error: err => {
                            alert("An error occured while fetching single data")
                        },
                        success: function(resp) {
                            if (!!resp.status) {
                                Object.keys(resp.data).map(k => {
                                    if ($('#edit_modal_fmm').find('input[name="' + k + '"]').length > 0)
                                        $('#edit_modal_fmm').find('input[name="' + k + '"]').val(resp.data[k])
                                })
                                $('#edit_modal_fmm').modal('show')
                            } else {
                                alert("An error occured while fetching single data")
                            }
                        }
                    })
                })
                $('.delete_data_fmm').click(function() {
                    $.ajax({
                        url: './feastmercyministry_table/get_single_fmm.php',
                        data: { fmmID: $(this).attr('data-id') },
                        method: 'POST',
                        dataType: 'json',
                        error: err => {
                            alert("An error occured while fetching single data")
                        },
                        success: function(resp) {
                            if (!!resp.status) {
                                $('#delete_modal_fmm').find('input[name="fmmID"]').val(resp.data['fmm_id'])
                                $('#delete_modal_fmm').modal('show')
                            } else {
                                alert("An error occured while fetching single data")
                            }
                        }
                    })
                })
            },
            buttons: [{
                text: "Add Feast Mercy Ministry",
                className: "btn btn-primary fw-bold py-0",
                action: function(e, dt, node, config) {
                    $('#add_modal_fmm').modal('show')
                }
            },
            {
                text: "Refresh",
                className: "btn btn-primary fw-bold py-0",
                action: function(e, dt, node, config) {
                    fmmTbl.draw(true);
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
    load_data_fmm()
    //Saving new Data
    $('#new-fmm-frm').submit(function(e) {
        e.preventDefault()
        var file_data = $('#file-fmm')[0].files[0];
        var form_data = new FormData();
        form_data.append('#file-fmm', file_data);
        if (file_data != undefined) {
            $('#add_modal_fmm button').attr('disabled', true)
            $('#add_modal_fmm button[form="new-fmm-frm"]').text("importing ...")
            $.ajax({  
                url:"./feastmercyministry_table/import_fmm.php",  
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
                        $('#new-fmm-frm').get(0).reset();
                        $('.modal').modal('hide')
                        $('#msg').append(_el)
                        _el.show('slow')
                        draw_data();
                        setTimeout(() => {
                            _el.hide('slow')
                            .remove()
                        }, 2500)
                    }
                    $('#add_modal_fmm button').attr('disabled', false)
                    $('#add_modal_fmm button[form="new-fmm-frm"]').text("Import")
                    $('#add_modal_fmm #file-fmm').val('');
                }
        })  
        }
        return false;
    })

    //Update Data
    $('#edit-fmm-frm').submit(function(e) {
        e.preventDefault()
        $('#edit_modal_fmm button').attr('disabled', true)
        $('#edit_modal_fmm button[form="edit-fmm-frm"]').text("saving ...")
        $.ajax({
            url: './feastmercyministry_table/update_data_fmm.php',
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
                        $('#edit-fmm-frm').get(0).reset()
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
                        $('#edit-fmm-frm').append(_el)
                        _el.show('slow')
                    } else {
                        alert("An error occured. Please check the source code and try again")
                    }
                } else {
                    alert("An error occurred. Please check the source code and try again")
                }
    
                $('#edit_modal_fmm button').attr('disabled', false)
                $('#edit_modal_fmm button[form="edit-fmm-frm"]').text("Save")
            }
        })
        })

        // Delete Data
    $('#delete-fmm-frm').submit(function(e) {
        e.preventDefault()
        $('#delete_modal_fmm button').attr('disabled', true)
        $('#delete_modal_fmm button[form="delete-fmm-frm"]').text("deleting data ...")
        $.ajax({
            url: './feastmercyministry_table/delete_data_fmm.php',
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
                        $('#delete-fmm-frm').get(0).reset()
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
                        $('#delete-fmm-frm').append(_el)
                        _el.show('slow')
                    } else {
                        alert("An error occured. Please check the source code and try again")
                    }
                } else {
                    alert("An error occurred. Please check the source code and try again")
                }
    
                $('#delete_modal_fmm button').attr('disabled', false)
                $('#delete_modal_fmm button[form="delete-fmm-frm"]').text("YEs")
            }
        })
        })

})