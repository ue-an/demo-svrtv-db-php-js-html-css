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
                data: 'user_id',
                className: 'py-0 px-1'
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
                data: 'ticket_cost',
                className: 'py-0 px-1'
            },
            {
                data: 'no_of_tickets_bought',
                className: 'py-0 px-1'
            },
            {
                data: 'total_cost',
                className: 'py-0 px-1'
            },
        ],
        drawCallback: function(settings) {
            
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
                $('#add_modal_feastmedia button').attr('disabled', false)
                $('#add_modal_feastmedia button[form="new-feastmedia-frm"]').text("Import")
                $('#add_modal_feastmedia #file-feastmedia').val('');
            }
    })  
    }
    return false;
})
})