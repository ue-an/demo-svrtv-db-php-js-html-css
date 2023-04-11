var holyweekTbl = '';
$(function() {
 function draw_data() {
  if ($.fn.dataTable.isDataTable('#hwr-tbl') && holyweekTbl!= '') {
   holyweekTbl.draw(true)
   } else {
       load_data_holyweek();
   }
 }
 //Load Data
 function load_data_holyweek() {
  holyweekTbl = $('#hwr-tbl').DataTable({
   dom: '<"row"B>flr<"py-2 my-2"t>ip',
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "./holyweek_retreat_table/get_holyweek_retreat.php",
            method: 'POST'
        },
        columns: [{
                data: 'hwr_id',
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
                data: 'event_date',
                className: 'py-0 px-3'
            },
            {
                data: null,
                orderable: false,
                className: 'text-center py-0 px-1',
                render: function(data, type, row, meta) {
                    console.log()
                    return '<a class="me-2 btn btn-sm rounded-0 py-0 edit_data_hwr btn-primary" href="javascript:void(0)" data-id="' + (row.hwr_id) + '">Edit</a><a class="btn btn-sm rounded-0 py-0 delete_data_hwr btn-danger" href="javascript:void(0)" data-id="' + (row.hwr_id) + '">Delete</a>';
                }
            }
        ],
        drawCallback: function(settings) {
            $('.edit_data_hwr').click(function() {
                $.ajax({
                    url: './holyweek_retreat_table/get_single_hwr.php',
                    data: { hwrID: $(this).attr('data-id') },
                    method: 'POST',
                    dataType: 'json',
                    error: err => {
                        alert("An error occured while fetching single data")
                    },
                    success: function(resp) {
                        if (!!resp.status) {
                            Object.keys(resp.data).map(k => {
                                if ($('#edit_modal_hwr').find('input[name="' + k + '"]').length > 0)
                                    $('#edit_modal_hwr').find('input[name="' + k + '"]').val(resp.data[k])
                            })
                            $('#edit_modal_hwr').modal('show')
                        } else {
                            alert("An error occured while fetching single data")
                        }
                    }
                })
            })
            $('.delete_data_hwr').click(function() {
                $.ajax({
                    url: './holyweek_retreat_table/get_single_hwr.php',
                    data: { hwrID: $(this).attr('data-id') },
                    method: 'POST',
                    dataType: 'json',
                    error: err => {
                        alert("An error occured while fetching single data")
                    },
                    success: function(resp) {
                        if (!!resp.status) {
                            $('#delete_modal_hwr').find('input[name="hwrID"]').val(resp.data['hwr_id'])
                            $('#delete_modal_hwr').modal('show')
                        } else {
                            alert("An error occured while fetching single data")
                        }
                    }
                })
            })
        },
        buttons: [{
            text: "Add Holy Week",
            className: "btn btn-primary fw-bold py-0",
            action: function(e, dt, node, config) {
                $('#add_modal_hwr').modal('show')
            }
        },
        {
            text: "Refresh",
            className: "btn btn-primary fw-bold py-0",
            action: function(e, dt, node, config) {
                holyweekTbl.draw(true);
            }
        },
        ],
        "order": [
            [1, "asc"]
        ],
        initComplete: function(settings) {
            $('.paginate_button_holyweek').addClass('p-1')
        }
  });
 }
 // /LoadData
load_data_holyweek()

//Saving new Data
$('#new-hwr-frm').submit(function(e) {
    e.preventDefault()
    var file_data = $('#file-hwr')[0].files[0];
    var form_data = new FormData();
    form_data.append('#file-hwr', file_data);
    if (file_data != undefined) {
        $('#add_modal_hwr button').attr('disabled', true)
        $('#add_modal_hwr button[form="new-hwr-frm"]').text("importing ...")
        $.ajax({  
            url:"./holyweek_retreat_table/import_holyweek_retreat.php",  
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
                            $('#new-hwr-frm').get(0).reset()
                            $('.modal').modal('hide')
                            $('#msg').append(_el)
                            _el.show('slow')
                            draw_data();
                            setTimeout(() => {
                                _el.hide('slow')
                                    .remove()
                            }, 2500)
                }
                $('#add_modal_hwr button').attr('disabled', false)
                $('#add_modal_hwr button[form="new-hwr-frm"]').text("Import")
                $('#add_modal_hwr #file-hwr').val('');
            }
    })  
    }
    return false;
})
// Update Data
$('#edit-hwr-frm').submit(function(e) {
    e.preventDefault()
    $('#edit_modal_hwr button').attr('disabled', true)
    $('#edit_modal_hwr button[form="edit-hwr-frm"]').text("saving ...")
    $.ajax({
        url: './holyweek_retreat_table/update_data_hwr.php',
        data: $(this).serialize(),
        method: 'POST',
        dataType: "json",
        error: err => {
            alert("An error occured. Please check the source code and try again")
            $('#edit-hwr-frm').get(0).reset()
        },
        success: function(resp) {
            if (!!resp.status) {
                if (resp.status == 'success') {
                    var _el = $('<div>')
                    _el.hide()
                    _el.addClass('alert alert-primary alert_msg')
                    _el.text("Data successfully updated");
                    $('#edit-hwr-frm').get(0).reset()
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
                    $('#edit-hwr-frm').append(_el)
                    _el.show('slow')
                } else {
                    alert("An error occured. Please check the source code and try again")
                    $('#edit-hwr-frm').get(0).reset()
                }
            } else {
                alert("An error occurred. Please check the source code and try again")
                $('#edit-hwr-frm').get(0).reset()
            }

            $('#edit_modal_hwr button').attr('disabled', false)
            $('#edit_modal_hwr button[form="edit-hwr-frm"]').text("Save")
            $('#edit-hwr-frm').get(0).reset()
        }
    })
})
// DELETE Data
$('#delete-hwr-frm').submit(function(e) {
    e.preventDefault()
    $('#delete_modal_hwr button').attr('disabled', true)
    $('#delete_modal_hwr button[form="delete-hwr-frm"]').text("deleting data ...")
    $.ajax({
        url: './holyweek_retreat_table/delete_data_hwr.php',
        data: $(this).serialize(),
        method: 'POST',
        dataType: "json",
        error: err => {
            alert("An error occured. Please check the source code and try again")
            $('#delete-hwr-frm').get(0).reset()
        },
        success: function(resp) {
            if (!!resp.status) {
                if (resp.status == 'success') {
                    var _el = $('<div>')
                    _el.hide()
                    _el.addClass('alert alert-primary alert_msg')
                    _el.text("Data successfully deleted");
                    $('#delete-hwr-frm').get(0).reset()
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
                    $('#delete-hwr-frm').append(_el)
                    _el.show('slow')
                } else {
                    alert("An error occured. Please check the source code and try again")
                    $('#delete-hwr-frm').get(0).reset()
                }
            } else {
                alert("An error occurred. Please check the source code and try again")
                $('#delete-hwr-frm').get(0).reset()
            }

            $('#delete_modal_hwr button').attr('disabled', false)
            $('#delete_modal_hwr button[form="delete-hwr-frm"]').text("YEs")
            $('#delete-hwr-frm').get(0).reset()
        }
    })
})
})