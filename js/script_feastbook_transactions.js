var feastbooktransactionsTbl = '';
$(function() {
    // draw function [called if the database updates]
    function draw_data() {
        if ($.fn.dataTable.isDataTable('#feastbook-transactions-tbl') && feastbooktransactionsTbl != '') {
         feastbooktransactionsTbl.draw(true)
        } else {
            load_data_feastbook_transactions();
        }
    }
 
    //Load Data
    function load_data_feastbook_transactions() {
     feastbookproducts = $('#feastbook-transactions-tbl').DataTable({
            dom: '<"row"B>flr<"py-2 my-2"t>ip',
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "./feastbooks_table/get_feastbook_transactions.php",
                method: 'POST'
            },
            columns: [{
                    data: 'feastbook_id',
                    className: 'py-0 px-1'
                },
                {
                    data: 'order_id',
                    className: 'py-0 px-1'
                },
                {
                    data: 'product_id',
                    className: 'py-0 px-1'
                },
                {
                    data: 'first_name',
                    className: 'py-0 px-1'
                },
                {
                 data: 'quantity',
                 className: 'py-0 px-1'
                },
                {
                    data: null,
                    orderable: false,
                    className: 'text-center py-0 px-1',
                    render: function(data, type, row, meta) {
                        console.log()
                        return '<a class="me-2 btn btn-sm rounded-0 py-0 edit_data_feastbook_transaction btn-primary" href="javascript:void(0)" data-id="' + (row.feastbook_id) + '">Edit</a><a class="btn btn-sm rounded-0 py-0 delete_data_feastbook_transaction btn-danger" href="javascript:void(0)" data-id="' + (row.feastbook_id) + '">Delete</a>';
                    }
                }
            ],
            drawCallback: function(settings) {
                $('.edit_data_feastbook_transaction').click(function() {
                    $.ajax({
                        url: './feastbooks_table/get_single_feastbook_transaction.php',
                        data: { fbtransactionID: $(this).attr('data-id') },
                        method: 'POST',
                        dataType: 'json',
                        error: err => {
                            alert("An error occured while fetching single data")
                        },
                        success: function(resp) {
                            if (!!resp.status) {
                                Object.keys(resp.data).map(k => {
                                    if ($('#edit_modal_feastbook_transaction').find('input[name="' + k + '"]').length > 0)
                                        $('#edit_modal_feastbook_transaction').find('input[name="' + k + '"]').val(resp.data[k])
                                })
                                $('#edit_modal_feastbook_transaction').modal('show')
                            } else {
                                alert("An error occured while fetching single data")
                            }
                        }
                    })
                })
                $('.delete_data_feastbook_transaction').click(function() {
                    $.ajax({
                        url: './feastbooks_table/get_single_feastbook_transaction.php',
                        data: { fbID: $(this).attr('data-id') },
                        method: 'POST',
                        dataType: 'json',
                        error: err => {
                            alert("An error occured while fetching single data")
                        },
                        success: function(resp) {
                            if (!!resp.status) {
                                $('#delete_modal_feastbook_transaction').find('input[name="fbID"]').val(resp.data['feastbook_id'])
                                $('#delete_modal_feastbook_transaction').modal('show')
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
                    $('#add_modal_feastbook_transaction').modal('show')
                }
            },
            {
                text: "Refresh",
                className: "btn btn-primary fw-bold py-0",
                action: function(e, dt, node, config) {
                    feastbooktransactionsTbl.draw(true);
                }
            },
            //will add new button for single entry
            // {
            //     text: "Add Record",
            //     className: "btn btn-primary fw-bold py-0",
            //     action: function(e, dt, node, config) {
            //         $('#add_modal_single').modal('show')
            //     }
            // },
            ],
            "order": [
                [1, "asc"]
            ],
            initComplete: function(settings) {
                $('.paginate_button').addClass('p-1')
            }
        });
    }
    load_data_feastbook_transactions();
    //Saving new Data (Bulk)
    $('#new-fbtransaction-frm').submit(function(e) {
            e.preventDefault()
            var file_data = $('#file-feastbook-transaction')[0].files[0];
            var form_data = new FormData();
            form_data.append('#file-feastbook-transaction', file_data);
            if (file_data != undefined) {
                $('#add_modal_fbtransaction button').attr('disabled', true)
                $('#add_modal_fbtransaction button[form="new-fbtransaction-frm"]').text("importing ...")
                $.ajax({  
                    url:"./feastbooks_table/import_feastbook_transaction.php",  
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
                                    $('#new-fbtransaction-frm').get(0).reset()
                                    $('.modal').modal('hide')
                                    $('#msg').append(_el)
                                    _el.show('slow')
                                    draw_data();
                                    setTimeout(() => {
                                        _el.hide('slow')
                                            .remove()
                                    }, 2500)
                        }
                        $('#add_modal_fbtransaction button').attr('disabled', false)
                        $('#add_modal_fbtransaction button[form="new-fbtransaction-frm"]').text("Import")
                        $('#add_modal_fbtransaction #file-feastbook-transaction').val('');
                    }
               })  
            }
            return false;
        })
        // Update Data
    $('#edit-fbtransaction-frm').submit(function(e) {
            e.preventDefault()
            $('#edit_modal_fbtransaction button').attr('disabled', true)
            $('#edit_modal_fbtransaction button[form="edit-fbtransaction-frm"]').text("saving ...")
            $.ajax({
                url: './feastbooks_table/update_data_feastbook_transaction.php',
                data: $(this).serialize(),
                method: 'POST',
                dataType: "json",
                error: err => {
                    alert("An error occured. Please check the source code and try again")
                    $('#edit-fbtransaction-frm').get(0).reset()
                },
                success: function(resp) {
                    if (!!resp.status) {
                        if (resp.status == 'success') {
                            var _el = $('<div>')
                            _el.hide()
                            _el.addClass('alert alert-primary alert_msg')
                            _el.text("Data successfully updated");
                            $('#edit-fbtransaction-frm').get(0).reset()
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
                            $('#edit-fbtransaction-frm').append(_el)
                            _el.show('slow')
                        } else {
                            alert("An error occured. Please check the source code and try again")
                            $('#edit-fbtransaction-frm').get(0).reset()
                        }
                    } else {
                        alert("An error occurred. Please check the source code and try again")
                        $('#edit-fbtransaction-frm').get(0).reset()
                    }
 
                    $('#edit_modal_fbtransaction button').attr('disabled', false)
                    $('#edit_modal_fbtransaction button[form="edit-fbtransaction-frm"]').text("Save")
                    $('#edit-fbtransaction-frm').get(0).reset()
                }
            })
        })
        // DELETE Data
    $('#delete-fbtransaction-frm').submit(function(e) {
        e.preventDefault()
        $('#delete_modal_fbtransaction button').attr('disabled', true)
        $('#delete_modal_fbtransaction button[form="delete-fbtransaction-frm"]').text("deleting data ...")
        $.ajax({
            url: './feastbooks_table/delete_data_feastbook_transaction.php',
            data: $(this).serialize(),
            method: 'POST',
            dataType: "json",
            error: err => {
                alert("An error occured. Please check the source code and try again")
                $('#delete-fbtransaction-frm').get(0).reset()
            },
            success: function(resp) {
                if (!!resp.status) {
                    if (resp.status == 'success') {
                        var _el = $('<div>')
                        _el.hide()
                        _el.addClass('alert alert-primary alert_msg')
                        _el.text("Data successfully deleted");
                        $('#delete-fbtransaction-frm').get(0).reset()
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
                        $('#delete-fbtransaction-frm').append(_el)
                        _el.show('slow')
                    } else {
                        alert("An error occured. Please check the source code and try again")
                        $('#delete-fbtransaction-frm').get(0).reset()
                    }
                } else {
                    alert("An error occurred. Please check the source code and try again")
                    $('#delete-fbtransaction-frm').get(0).reset()
                }
 
                $('#delete_modal_fbtransaction button').attr('disabled', false)
                $('#delete_modal_fbtransaction button[form="delete-fbtransaction-frm"]').text("YEs")
                $('#delete-fbtransaction-frm').get(0).reset()
            }
        })
    })
});