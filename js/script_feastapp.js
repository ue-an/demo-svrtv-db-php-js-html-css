var feastappTbl = '';
$(function() {
 function draw_data() {
  if ($.fn.dataTable.isDataTable('#feastapp-tbl') && feastappTbl!= '') {
   feastappTbl.draw(true)
   } else {
       load_data_feastapp();
   }
 }
 //Load Data
 function load_data_feastapp() {
  feastappTbl = $('#feastapp-tbl').DataTable({
   dom: '<"row"B>flr<"py-2 my-2"t>ip',
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "./feastapp_table/get_feastapp.php",
            method: 'POST'
        },
        columns: [{
                data: 'feastapp_id',
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
                data: 'date_downloaded',
                className: 'py-0 px-1'
            },
        ],
        drawCallback: function(settings) {
            
        },
        buttons: [{
            text: "Add Feast App",
            className: "btn btn-primary fw-bold py-0",
            action: function(e, dt, node, config) {
                $('#add_modal_feastapp').modal('show')
            }
        },
        {
            text: "Refresh",
            className: "btn btn-primary fw-bold py-0",
            action: function(e, dt, node, config) {
                feastappTbl.draw(true);
            }
        },
        ],
        "order": [
            [1, "asc"]
        ],
        initComplete: function(settings) {
            $('.paginate_button_feastapp').addClass('p-1')
        }
  });
 }
 // /LoadData
load_data_feastapp()
//Saving new Data
$('#new-feastapp-frm').submit(function(e) {
    e.preventDefault()
    var file_data = $('#file-feastapp')[0].files[0];
    var form_data = new FormData();
    form_data.append('#file-feastapp', file_data);
    if (file_data != undefined) {
        $('#add_modal_feastapp button').attr('disabled', true)
        $('#add_modal_feastapp button[form="new-feastapp-frm"]').text("importing ...")
        $.ajax({  
            url:"./feastapp_table/import_feastapp.php",  
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
                    $('#new-feastapp-frm').get(0).reset()
                    $('.modal').modal('hide')
                    $('#msg').append(_el)
                    _el.show('slow')
                    draw_data();
                    setTimeout(() => {
                        _el.hide('slow').remove()
                    }, 2500)
                }
                $('#add_modal_feastapp button').attr('disabled', false)
                $('#add_modal_feastapp button[form="new-feastapp-frm"]').text("Import")
                $('#add_modal_feastapp #file-feastapp').val('');
            }
    })  
    }
    return false;
})
})