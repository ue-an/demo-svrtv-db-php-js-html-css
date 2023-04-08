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
                data: 'user_id',
                className: 'py-0 px-1'
            },
            {
                data: 'event_date',
                className: 'py-0 px-3'
            },
        ],
        drawCallback: function(settings) {
            // 
        },
        buttons: [{
            text: "Add Holy Week",
            className: "btn btn-primary fw-bold py-0",
            action: function(e, dt, node, config) {
                $('#add_modal_holyweek').modal('show')
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
$('#new-holyweek-frm').submit(function(e) {
    e.preventDefault()
    var file_data = $('#file-holyweek')[0].files[0];
    var form_data = new FormData();
    form_data.append('#file-holyweek', file_data);
    if (file_data != undefined) {
        $('#add_modal_holyweek button').attr('disabled', true)
        $('#add_modal_holyweek button[form="new-holyweek-frm"]').text("importing ...")
        $.ajax({  
            url:"./holyweek_table/import_holyweek.php",  
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
                            $('#new-holyweek-frm').get(0).reset()
                            $('.modal').modal('hide')
                            $('#msg').append(_el)
                            _el.show('slow')
                            draw_data();
                            setTimeout(() => {
                                _el.hide('slow')
                                    .remove()
                            }, 2500)
                }
                $('#add_modal_holyweek button').attr('disabled', false)
                $('#add_modal_holyweek button[form="new-holyweek-frm"]').text("Import")
                $('#add_modal_holyweek #file-holyweek').val('');
            }
    })  
    }
    return false;
})
})