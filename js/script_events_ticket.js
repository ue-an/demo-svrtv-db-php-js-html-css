var eventsticketTbl = '';
$(function() {
    // draw function [called if the database updates]
    function draw_data() {
     if ($.fn.dataTable.isDataTable('#events-ticket-tbl') && eventsticketTbl != '') {
         eventsticketTbl.draw(true)
     } else {
         load_data_events_ticket();
     }
 }

 //Load Data
 function load_data_events_ticket() {
    eventsTbl = $('#events-ticket-tbl').DataTable({
        dom: '<"row"B>flr<"py-2 my-2"t>ip',
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "./events_table/get_events_ticket.php",
            method: 'POST'
        },
        columns: [{
                data: 'ticket_id',
                className: 'py-0 px-1'
            },
            {
                data: 'event_id',
                className: 'py-0 px-1'
            },
            {
                data: 'ticket_type',
                className: 'py-0 px-1'
            },
            {
                data: 'ticket_name',
                className: 'py-0 px-1'
            },
            {
                data: 'ticket_cost',
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
                $('#add_modal_events').modal('show')
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
load_data_events_ticket();
})