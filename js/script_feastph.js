var feastphTbl = '';
$(function() {
 function draw_data() {
  if ($.fn.dataTable.isDataTable('#feastph-tbl') && feastphTbl!= '') {
   feastphTbl.draw(true)
   } else {
       load_data_feastph();
   }
 }
 //Load Data
 function load_data_feastph() {
  feastphTbl = $('#feastph-tbl').DataTable({
   dom: '<"row"B>flr<"py-2 my-2"t>ip',
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "./feastph_table/get_feastph.php",
            method: 'POST'
        },
        columns: [{
                data: 'feastph_id',
                className: 'py-0 px-1'
            },
            {
                data: 'user_id',
                className: 'py-0 px-1'
            },
            {
                data: 'file_name',
                className: 'py-0 px-3'
            },
            {
                data: 'file_download_date',
                className: 'py-0 px-1'
            },
        ],
        drawCallback: function(settings) {
           
        },
        buttons: [{
            text: "Add FeastPH",
            className: "btn btn-primary fw-bold py-0",
            action: function(e, dt, node, config) {
                $('#add_modal_feastph').modal('show')
            }
        },
        {
            text: "Refresh",
            className: "btn btn-primary fw-bold py-0",
            action: function(e, dt, node, config) {
                feastphTbl.draw(true);
            }
        },
        ],
        "order": [
            [1, "asc"]
        ],
        initComplete: function(settings) {
            $('.paginate_button_feastph').addClass('p-1')
        }
  });
 }
 // /LoadData
load_data_feastph()
//Saving new Data
$('#new-feastph-frm').submit(function(e) {
    e.preventDefault()
    var file_data = $('#file-feastph')[0].files[0];
    var form_data = new FormData();
    form_data.append('#file-feastph', file_data);
    if (file_data != undefined) {
        $('#add_modal_feastph button').attr('disabled', true)
        $('#add_modal_feastph button[form="new-feastph-frm"]').text("importing ...")
        $.ajax({  
            url:"./feastph_table/import_feastph.php",  
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
                                    $('#new-feastph-frm').get(0).reset()
                                    $('.modal').modal('hide')
                                    $('#msg').append(_el)
                                    _el.show('slow')
                                    draw_data();
                                    setTimeout(() => {
                                        _el.hide('slow')
                                            .remove()
                                    }, 2500)
                        }
                        $('#add_modal_feastph button').attr('disabled', false)
                        $('#add_modal_feastph button[form="new-feastph-frm"]').text("Import")
                        $('#add_modal_feastph #file-feastph').val('');
            }
    })  
    }
    return false;
})
})