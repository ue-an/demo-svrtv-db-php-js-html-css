var eventsordersTbl = '';
$(function() {
    // draw function [called if the database updates]
    function draw_data() {
     if ($.fn.dataTable.isDataTable('#events-orders-tbl') && eventsordersTbl != '') {
         eventsordersTbl.draw(true)
     } else {
         load_data_events_orders();
     }
 }

 //Load Data
 function load_data_events_orders() {
    eventsTbl = $('#events-orders-tbl').DataTable({
        dom: '<"row"B>flr<"py-2 my-2"t>ip',
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "./events_table/get_events_orders.php",
            method: 'POST'
        },
        columns: [{
                data: 'order_no',
                className: 'py-0 px-1'
            },
            {
                data: 'receipt_no',
                className: 'py-0 px-1'
            },
            {
                data: 'order_status',
                className: 'py-0 px-1'
            },
            {
                data: 'order_created_date',
                className: 'py-0 px-1'
            },
            {
                data: 'order_completed_date',
                className: 'py-0 px-1'
            },
            {
                data: 'pay_method',
                className: 'py-0 px-1'
            }
            //
            // {
            //     data: null,
            //     orderable: false,
            //     className: 'text-center py-0 px-1',
            //     render: function(data, type, row, meta) {
            //         console.log()
            //         return '<a class="me-2 btn btn-sm rounded-0 py-0 edit_data_feastcon btn-primary" href="javascript:void(0)" data-id="' + (row.event_id) + '">Edit</a><a class="btn btn-sm rounded-0 py-0 delete_data_feastcon btn-danger" href="javascript:void(0)" data-id="' + (row.feastconID) + '">Delete</a>';
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
                $('#add_modal_event_order').modal('show')
            }
        },
        {
            text: "Refresh",
            className: "btn btn-primary fw-bold py-0",
            action: function(e, dt, node, config) {
                eventsTbl.draw(true);
            }
        },
        ],
        "order": [
            [1, "asc"]
        ],
        initComplete: function(settings) {
            $('.paginate_button_events').addClass('p-1')
        }
    });
}
load_data_events_orders();

//Saving new Data (Bulk)
$('#new-event-order-frm').submit(function(e) {
    e.preventDefault()
    var file_data = $('#file-event-order')[0].files[0];
    var form_data = new FormData();
    form_data.append('#file-event-order', file_data);
    if (file_data != undefined) {
        $('#add_modal_event_order button').attr('disabled', true)
        $('#add_modal_event_order button[form="new-event-order-frm"]').text("importing ...")
        $.ajax({  
            url:"./events_table/import_events_orders.php",  
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
                            $('#new-event-order-frm').get(0).reset()
                            $('.modal').modal('hide')
                            $('#msg').append(_el)
                            _el.show('slow')
                            draw_data();
                            setTimeout(() => {
                                _el.hide('slow')
                                    .remove()
                            }, 2500)
                }
                $('#add_modal_event_order button').attr('disabled', false)
                $('#add_modal_event_order button[form="new-event-order-frm"]').text("Import")
                $('#add_modal_event_order #file-event-order').val('');
            }
       })  
    }
    return false;
})
})