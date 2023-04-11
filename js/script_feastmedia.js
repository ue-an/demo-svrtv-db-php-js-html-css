var feastmediaTbl = '';
$(function() {
 function draw_data() {
  if ($.fn.dataTable.isDataTable('#feastmedia-tbl') && feastmediaTbl!= '') {
   feastmediaTbl.draw(true)
   } else {
       load_data_feastmedia();
   }
 }
 //Load Data
 function load_data_feastmedia() {
  feastmediaTbl = $('#feastmedia-tbl').DataTable({
   dom: '<"row"B>flr<"py-2 my-2"t>ip',
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "./feastmedia_table/get_feastmedia.php",
            method: 'POST'
        },
        columns: [{
                data: 'feast_media_event_id',
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
                data: 'event_name',
                className: 'py-0 px-3'
            },
            {
                data: 'ticket_type',
                className: 'py-0 px-1'
            },
            {
                data: 'event_type',
                className: 'py-0 px-1'
            },
            {
                data: 'event_date',
                className: 'py-0 px-1'
            },
            {
                data: 'ticket_cost',
                className: 'py-0 px-1'
            },
            {
                data: null,
                orderable: false,
                className: 'text-center py-0 px-1',
                render: function(data, type, row, meta) {
                    console.log()
                    return '<a class="me-2 btn btn-sm rounded-0 py-0 edit_data_feastmedia btn-primary" href="javascript:void(0)" data-id="' + (row.feast_media_event_id) + '">Edit</a><a class="btn btn-sm rounded-0 py-0 delete_data_feastmedia btn-danger" href="javascript:void(0)" data-id="' + (row.feast_media_event_id) + '">Delete</a>';
                }
            }
        ],
        drawCallback: function(settings) {
            $('.edit_data_feastmedia').click(function() {
                $.ajax({
                    url: './feastmedia_table/get_single_feastmedia.php',
                    data: { feastmediaID: $(this).attr('data-id') },
                    method: 'POST',
                    dataType: 'json',
                    error: err => {
                        alert("An error occured while fetching single data")
                    },
                    success: function (resp) {
                        // alert(resp.data);
                        if (!!resp.status) {
                            Object.keys(resp.data).map(k => {
                                if ($('#edit_modal_feastmedia').find('input[name="' + k + '"]').length > 0)
                                    $('#edit_modal_feastmedia').find('input[name="' + k + '"]').val(resp.data[k])
                            })
                            $('#edit_modal_feastmedia').modal('show')
                        } else {
                            alert("An error occured while fetching single data")
                        }
                    }
                })
            })
            $('.delete_data_feastmedia').click(function() {
                $.ajax({
                    url: './feastmedia_table/get_single_feastmedia.php',
                    data: { feastmediaID: $(this).attr('data-id') },
                    method: 'POST',
                    dataType: 'json',
                    error: err => {
                        alert("An error occured while fetching single data")
                    },
                    success: function(resp) {
                        if (!!resp.status) {
                            $('#delete_modal_feastmedia').find('input[name="feastmediaID"]').val(resp.data['feast_media_event_id'])
                            $('#delete_modal_feastmedia').modal('show')
                        } else {
                            alert("An error occured while fetching single data")
                        }
                    }
                })
            })
        },
        buttons: [{
            text: "Add Feast Media",
            className: "btn btn-primary fw-bold py-0",
            action: function(e, dt, node, config) {
                $('#add_modal_feastmedia').modal('show')
            }
        },
        {
            text: "Refresh",
            className: "btn btn-primary fw-bold py-0",
            action: function(e, dt, node, config) {
                feastmediaTbl.draw(true);
            }
        },
        ],
        "order": [
            [1, "asc"]
        ],
        initComplete: function(settings) {
            $('.paginate_button_feastmedia').addClass('p-1')
        }
  });
 }
 // /LoadData
load_data_feastmedia()

//Saving new Data
$('#new-feastmedia-frm').submit(function(e) {
    e.preventDefault()
    var file_data = $('#file-feastmedia')[0].files[0];
    var form_data = new FormData();
    form_data.append('#file-feastmedia', file_data);
    if (file_data != undefined) {
        $('#add_modal_feastmedia button').attr('disabled', true)
        $('#add_modal_feastmedia button[form="new-feastmedia-frm"]').text("importing ...")
        $.ajax({  
            url:"./feastmedia_table/import_feastmedia.php",  
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
                                    $('#new-feastmedia-frm').get(0).reset()
                                    $('.modal').modal('hide')
                                    $('#msg').append(_el)
                                    _el.show('slow')
                                    draw_data();
                                    setTimeout(() => {
                                        _el.hide('slow')
                                            .remove()
                                    }, 2500)
                }
                $('#add_modal_feastmedia button').attr('disabled', false)
                $('#add_modal_feastmedia button[form="new-feastmedia-frm"]').text("Import")
                $('#add_modal_feastmedia #file-feastmedia').val('');
            }
    })  
    }
    return false;
})
// Update Data
$('#edit-feastmedia-frm').submit(function(e) {
    e.preventDefault()
    $('#edit_modal_feastmedia button').attr('disabled', true)
    $('#edit_modal_feastmedia button[form="edit-feastmedia-frm"]').text("saving ...")
    $.ajax({
        url: './feastmedia_table/update_data_feastmedia.php',
        data: $(this).serialize(),
        method: 'POST',
        dataType: "json",
        error: err => {
            alert("An error occured. Please check the source code and try again")
            $('#edit-feastmedia-frm').get(0).reset()
        },
        success: function(resp) {
            if (!!resp.status) {
                if (resp.status == 'success') {
                    var _el = $('<div>')
                    _el.hide()
                    _el.addClass('alert alert-primary alert_msg')
                    _el.text("Data successfully updated");
                    $('#edit-feastmedia-frm').get(0).reset()
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
                    $('#edit-feastmedia-frm').append(_el)
                    _el.show('slow')
                } else {
                    alert("An error occured. Please check the source code and try again")
                    $('#edit-feastmedia-frm').get(0).reset()
                }
            } else {
                alert("An error occurred. Please check the source code and try again")
                $('#edit-feastmedia-frm').get(0).reset()
            }

            $('#edit_modal_feastmedia button').attr('disabled', false)
            $('#edit_modal_feastmedia button[form="edit-feastmedia-frm"]').text("Save")
            $('#edit-feastmedia-frm').get(0).reset()
        }
    })
})
// DELETE Data
$('#delete-feastmedia-frm').submit(function(e) {
    e.preventDefault()
    $('#delete_modal_feastmedia button').attr('disabled', true)
    $('#delete_modal_feastmedia button[form="delete-feastmedia-frm"]').text("deleting data ...")
    $.ajax({
        url: './feastmedia_table/delete_data_feastmedia.php',
        data: $(this).serialize(),
        method: 'POST',
        dataType: "json",
        error: err => {
            alert("An error occured. Please check the source code and try again")
            $('#delete-feastmedia-frm').get(0).reset()
        },
        success: function(resp) {
            if (!!resp.status) {
                if (resp.status == 'success') {
                    var _el = $('<div>')
                    _el.hide()
                    _el.addClass('alert alert-primary alert_msg')
                    _el.text("Data successfully deleted");
                    $('#delete-feastmedia-frm').get(0).reset()
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
                    $('#delete-feastmedia-frm').append(_el)
                    _el.show('slow')
                } else {
                    alert("An error occured. Please check the source code and try again")
                    $('#delete-feastmedia-frm').get(0).reset()
                }
            } else {
                alert("An error occurred. Please check the source code and try again")
                $('#delete-feastmedia-frm').get(0).reset()
            }

            $('#delete_modal_feastmedia button').attr('disabled', false)
            $('#delete_modal_feastmedia button[form="delete-feastmedia-frm"]').text("YEs")
            $('#delete-feastmedia-frm').get(0).reset()
        }
    })
})
})