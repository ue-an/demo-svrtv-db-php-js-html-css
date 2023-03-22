var eventTbl = '';
$(function() {
    // draw function [called if the database updates]
    function draw_data() {
     if ($.fn.dataTable.isDataTable('#event-tbl') && eventTbl != '') {
         eventTbl.draw(true)
     } else {
         load_data_event();
     }
 }

 //Load Data
 function load_data_event() {
    eventTbl = $('#event-tbl').DataTable({
        dom: '<"row"B>flr<"py-2 my-2"t>ip',
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "./event_table/get_event.php",
            method: 'POST'
        },
        columns: [{
                data: 'orderNo',
                className: 'py-0 px-1'
            },
            {
                data: 'receiptNo',
                className: 'py-0 px-1'
            },
            {
                data: 'userID',
                className: 'py-0 px-1'
            },
            {
                targets: 2,
                data: 'firstname',
                className: 'py-0 px-1',
                render: function (data, type, row) {
                    return row.firstname+' '+row.lastname;
                }
            },
            {
                data: 'transactionDate',
                className: 'py-0 px-1'
            },
            {
                data: 'transactionAmount',
                className: 'py-0 px-1'
            },
            {
                data: 'eventName',
                className: 'py-0 px-1'
            },
            {
                data: 'ticketType',
                className: 'py-0 px-1'
            },
            {
                data: 'eventType',
                className: 'py-0 px-1'
            },
            {
                data: 'paymentMethod',
                className: 'py-0 px-1'
            },
            //
            // {
            //     data: null,
            //     orderable: false,
            //     className: 'text-center py-0 px-1',
            //     render: function(data, type, row, meta) {
            //         console.log()
            //         return '<a class="me-2 btn btn-sm rounded-0 py-0 edit_data_feastcon btn-primary" href="javascript:void(0)" data-id="' + (row.feastconID) + '">Edit</a><a class="btn btn-sm rounded-0 py-0 delete_data_feastcon btn-danger" href="javascript:void(0)" data-id="' + (row.feastconID) + '">Delete</a>';
            //     }
            // }
        ],
        drawCallback: function(settings) {
            // $('.edit_data_feastcon').click(function() {
            //     $.ajax({
            //         url: './feastcon_table/get_single.php',
            //         data: { feastconID: $(this).attr('data-id') },
            //         method: 'POST',
            //         dataType: 'json',
            //         error: err => {
            //             alert("An error occured while fetching single data")
            //         },
            //         success: function(resp) {
            //             if (!!resp.status) {
            //                 Object.keys(resp.data).map(k => {
            //                     if ($('#edit_modal_feastcon').find('input[name="' + k + '"]').length > 0)
            //                         $('#edit_modal_feastcon').find('input[name="' + k + '"]').val(resp.data[k])
            //                 })
            //                 $('#edit_modal_feastcon').modal('show')
            //             } else {
            //                 alert("An error occured while fetching single data")
            //             }
            //         }
            //     })
            // })
            // $('.delete_data_feastcon').click(function() {
            //     $.ajax({
            //         url: './feastcon_table/get_single.php',
            //         data: { feastconID: $(this).attr('data-id') },
            //         method: 'POST',
            //         dataType: 'json',
            //         error: err => {
            //             alert("An error occured while fetching single data")
            //         },
            //         success: function(resp) {
            //             if (!!resp.status) {
            //                 $('#delete_modal_feastcon').find('input[name="feastconID"]').val(resp.data['feastconID'])
            //                 $('#delete_modal_feastcon').modal('show')
            //             } else {
            //                 alert("An error occured while fetching single data")
            //             }
            //         }
            //     })
            // })
        },
        buttons: [{
            text: "Add Event",
            className: "btn btn-primary fw-bold py-0",
            action: function(e, dt, node, config) {
                $('#add_modal_event').modal('show')
            }
        },
        {
            text: "Refresh",
            className: "btn btn-primary fw-bold py-0",
            action: function(e, dt, node, config) {
                eventTbl.draw(true);
            }
        },
        ],
        "order": [
            [1, "asc"]
        ],
        initComplete: function(settings) {
            $('.paginate_button_event').addClass('p-1')
        }
    });
}
// /LoadData
load_data_event()
//Saving new Data
$('#new-event-frm').submit(function(e) {
    e.preventDefault()
    var file_data = $('#file-event')[0].files[0];
    var form_data = new FormData();
    form_data.append('#file-event', file_data);
    if (file_data != undefined) {
        $('#add_modal_event button').attr('disabled', true)
        $('#add_modal_event button[form="new-event-frm"]').text("importing ...")
        $.ajax({  
            url:"./event_table/import_event.php",  
            method:"POST",
            data:new FormData(this),  
            contentType:false,          // The content type used when sending data to the server.  
            cache:false,                // To unable request pages to be cached  
            processData:false,          // To send DOMDocument or non processed data file it is set to false 
            error: err => {
                alert("An error occured. Please check the source code and try again")
            }, 
            success: function(resp) {
                // let res = $.parseJSON(resp);
                // console.log(res);
                console.log(resp);
                // if (!!res.status) {
                //     if (res.status == 'success') {
                //         var _el = $('<div>')
                //         _el.hide()
                //         _el.addClass('alert alert-primary alert_msg')
                //         _el.text("Data successfully imported");
                //         $('#new-event-frm').get(0).reset()
                //         $('.modal').modal('hide')
                //         $('#msg').append(_el)
                //         _el.show('slow')
                //         draw_data();
                //         setTimeout(() => {
                //             _el.hide('slow')
                //                 .remove()
                //         }, 2500)
                //     } else if (res.status == 'failed' && !!res.msg) {
                //         var _el = $('<div>')
                //         _el.hide()
                //         _el.addClass('alert alert-danger alert_msg form-group')
                //         _el.text(res.msg);
                //         $('#new-event-frm').append(_el)
                //         _el.show('slow')
                //     } else {
                //         alert("An error occured. Please check that the file selected isn't uploaded already.\nNo new record(s) found.");
                //         $('#add_modal_event button[form="new-event-frm"]').attr('disabled', false);
                //         $('#add_modal_event button').attr('disabled', true);
                //         $('#add_modal_event #file-event').val('');
                //     }
                // } else {
                //     alert("An error occurred. Please check the source code and try again")
                // }
  
                $('#add_modal_event button').attr('disabled', false)
                $('#add_modal_event button[form="new-event-frm"]').text("Import")
                $('#add_modal_event #file-event').val('');
            }
       })  
    }
    return false;
  })

  // Update Data
    // $('#edit-feastcon-frm').submit(function(e) {
    // e.preventDefault()
    // $('#edit_modal_feastcon button').attr('disabled', true)
    // $('#edit_modal_feastcon button[form="edit-feastcon-frm"]').text("saving ...")
    // $.ajax({
    //     url: './feastcon_table/update_data.php',
    //     data: $(this).serialize(),
    //     method: 'POST',
    //     dataType: "json",
    //     error: err => {
    //         alert("An error occured. Please check the source code and try again")
    //     },
    //     success: function(resp) {
    //         if (!!resp.status) {
    //             if (resp.status == 'success') {
    //                 var _el = $('<div>')
    //                 _el.hide()
    //                 _el.addClass('alert alert-primary alert_msg')
    //                 _el.text("Data successfully updated");
    //                 $('#edit-feastcon-frm').get(0).reset()
    //                 $('.modal').modal('hide')
    //                 $('#msg').append(_el)
    //                 _el.show('slow')
    //                 draw_data();
    //                 setTimeout(() => {
    //                     _el.hide('slow')
    //                         .remove()
    //                 }, 2500)
    //             } else if (resp.status == 'success' && !!resp.msg) {
    //                 var _el = $('<div>')
    //                 _el.hide()
    //                 _el.addClass('alert alert-danger alert_msg form-group')
    //                 _el.text(resp.msg);
    //                 $('#edit-feastcon-frm').append(_el)
    //                 _el.show('slow')
    //             } else {
    //                 alert("An error occured. Please check the source code and try again")
    //             }
    //         } else {
    //             alert("An error occurred. Please check the source code and try again")
    //         }

    //         $('#edit_modal_feastcon button').attr('disabled', false)
    //         $('#edit_modal_feastcon button[form="edit-feastcon-frm"]').text("Save")
    //     }
    // })
    // })

    // Delete Data
    // $('#delete-feastcon-frm').submit(function(e) {
    // e.preventDefault()
    // $('#delete_modal_feastcon button').attr('disabled', true)
    // $('#delete_modal_feastcon button[form="delete-feastcon-frm"]').text("deleting data ...")
    // $.ajax({
    //     url: './feastcon_table/delete_data.php',
    //     data: $(this).serialize(),
    //     method: 'POST',
    //     dataType: "json",
    //     error: err => {
    //         alert("An error occured. Please check the source code and try again")
    //     },
    //     success: function(resp) {
    //         if (!!resp.status) {
    //             if (resp.status == 'success') {
    //                 var _el = $('<div>')
    //                 _el.hide()
    //                 _el.addClass('alert alert-primary alert_msg')
    //                 _el.text("Data successfully deleted");
    //                 $('#delete-feastcon-frm').get(0).reset()
    //                 $('.modal').modal('hide')
    //                 $('#msg').append(_el)
    //                 _el.show('slow')
    //                 draw_data();
    //                 setTimeout(() => {
    //                     _el.hide('slow')
    //                         .remove()
    //                 }, 2500)
    //             } else if (resp.status == 'success' && !!resp.msg) {
    //                 var _el = $('<div>')
    //                 _el.hide()
    //                 _el.addClass('alert alert-danger alert_msg form-group')
    //                 _el.text(resp.msg);
    //                 $('#delete-feastcon-frm').append(_el)
    //                 _el.show('slow')
    //             } else {
    //                 alert("An error occured. Please check the source code and try again")
    //             }
    //         } else {
    //             alert("An error occurred. Please check the source code and try again")
    //         }

    //         $('#delete_modal_feastcon button').attr('disabled', false)
    //         $('#delete_modal_feastcon button[form="delete-feastcon-frm"]').text("YEs")
    //     }
    // })
    // })
})