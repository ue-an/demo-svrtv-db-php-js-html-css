var fmmTbl = '';
$(function() {
 function draw_data() {
  if ($.fn.dataTable.isDataTable('#fmm-tbl') && fmmTbl!= '') {
       fmmTbl.draw(true)
   } else {
       load_data_fmm();
   }
 }
 //Load Data
 function load_data_fmm() {
    fmmTbl = $('#fmm-tbl').DataTable({
    dom: '<"row"B>flr<"py-2 my-2"t>ip',
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "./feastmercyministry_table/get_fmm.php",
                method: 'POST'
            },
            columns: [{
                    data: 'fmm_id',
                    className: 'py-0 px-1'
                },
                {
                    data: 'user_id',
                    className: 'py-0 px-1'
                },
                {
                    data: 'donor_type',
                    className: 'py-0 px-1'
                },
                {
                    data: 'donation_start_date',
                    className: 'py-0 px-1'
                },
                {
                    data: 'donation_end_date',
                    className: 'py-0 px-1'
                },
                {
                    data: 'amount',
                    className: 'py-0 px-1'
                },
                {
                    data: 'pay_method',
                    className: 'py-0 px-1'
                }
                // {
                //     data: null,
                //     orderable: false,
                //     className: 'text-center py-0 px-3',
                //     render: function(data, type, row, meta) {
                //         console.log()
                //         return '<a class="me-2 btn btn-sm rounded-0 py-0 edit_data_anawim btn-primary" href="javascript:void(0)" data-id="' + (row.fmm_id) + '">Edit</a><a class="btn btn-sm rounded-0 py-0 delete_data_anawim btn-danger" href="javascript:void(0)" data-id="' + (row.fmm_id) + '">Delete</a>';
                //     }
                // }
            ],
            drawCallback: function(settings) {
                //
            },
            buttons: [{
                text: "Add Anawim",
                className: "btn btn-primary fw-bold py-0",
                action: function(e, dt, node, config) {
                    $('#add_modal_anawim').modal('show')
                }
            },
            {
                text: "Refresh",
                className: "btn btn-primary fw-bold py-0",
                action: function(e, dt, node, config) {
                    fmmTbl.draw(true);
                }
            },
            ],
            "order": [
                [1, "asc"]
            ],
            initComplete: function(settings) {
                $('.paginate_button_anawim').addClass('p-1')
            }
    });
    }
    //LoadData
    load_data_fmm()
    //Saving new Data
    $('#new-anawim-frm').submit(function(e) {
        e.preventDefault()
        var file_data = $('#file-anawim')[0].files[0];
        var form_data = new FormData();
        form_data.append('#file-anawim', file_data);
        if (file_data != undefined) {
            $('#add_modal_anawim button').attr('disabled', true)
            $('#add_modal_anawim button[form="new-anawim-frm"]').text("importing ...")
            $.ajax({  
                url:"./anawim_table/import_anawim.php",  
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
                        $('#new-anawim-frm').get(0).reset();
                        $('.modal').modal('hide')
                        $('#msg').append(_el)
                        _el.show('slow')
                        draw_data();
                        setTimeout(() => {
                            _el.hide('slow')
                            .remove()
                        }, 2500)
                    }
                    $('#add_modal_anawim button').attr('disabled', false)
                    $('#add_modal_anawim button[form="new-anawim-frm"]').text("Import")
                    $('#add_modal_anawim #file-anawim').val('');
                }
        })  
        }
        return false;
    })

    // Update Data
    // $('#edit-anawim-frm').submit(function(e) {
    //     e.preventDefault()
    //     $('#edit_modal_anawim button').attr('disabled', true)
    //     $('#edit_modal_anawim button[form="edit-anawim-frm"]').text("saving ...")
    //     $.ajax({
    //         url: './anawim_table/update_data.php',
    //         data: $(this).serialize(),
    //         method: 'POST',
    //         dataType: "json",
    //         error: err => {
    //             alert("An error occured. Please check the source code and try again")
    //         },
    //         success: function(resp) {
    //             if (!!resp.status) {
    //                 if (resp.status == 'success') {
    //                     var _el = $('<div>')
    //                     _el.hide()
    //                     _el.addClass('alert alert-primary alert_msg')
    //                     _el.text("Data successfully updated");
    //                     $('#edit-anawim-frm').get(0).reset()
    //                     $('.modal').modal('hide')
    //                     $('#msg').append(_el)
    //                     _el.show('slow')
    //                     draw_data();
    //                     setTimeout(() => {
    //                         _el.hide('slow')
    //                             .remove()
    //                     }, 2500)
    //                 } else if (resp.status == 'success' && !!resp.msg) {
    //                     var _el = $('<div>')
    //                     _el.hide()
    //                     _el.addClass('alert alert-danger alert_msg form-group')
    //                     _el.text(resp.msg);
    //                     $('#edit-anawim-frm').append(_el)
    //                     _el.show('slow')
    //                 } else {
    //                     alert("An error occured. Please check the source code and try again")
    //                 }
    //             } else {
    //                 alert("An error occurred. Please check the source code and try again")
    //             }
    
    //             $('#edit_modal_anawim button').attr('disabled', false)
    //             $('#edit_modal_anawim button[form="edit-anawim-frm"]').text("Save")
    //         }
    //     })
    //     })

        // Delete Data
    // $('#delete-anawim-frm').submit(function(e) {
    //     e.preventDefault()
    //     $('#delete_modal_anawim button').attr('disabled', true)
    //     $('#delete_modal_anawim button[form="delete-anawim-frm"]').text("deleting data ...")
    //     $.ajax({
    //         url: './anawim_table/delete_data.php',
    //         data: $(this).serialize(),
    //         method: 'POST',
    //         dataType: "json",
    //         error: err => {
    //             alert("An error occured. Please check the source code and try again")
    //         },
    //         success: function(resp) {
    //             if (!!resp.status) {
    //                 if (resp.status == 'success') {
    //                     var _el = $('<div>')
    //                     _el.hide()
    //                     _el.addClass('alert alert-primary alert_msg')
    //                     _el.text("Data successfully deleted");
    //                     $('#delete-anawim-frm').get(0).reset()
    //                     $('.modal').modal('hide')
    //                     $('#msg').append(_el)
    //                     _el.show('slow')
    //                     draw_data();
    //                     setTimeout(() => {
    //                         _el.hide('slow')
    //                             .remove()
    //                     }, 2500)
    //                 } else if (resp.status == 'success' && !!resp.msg) {
    //                     var _el = $('<div>')
    //                     _el.hide()
    //                     _el.addClass('alert alert-danger alert_msg form-group')
    //                     _el.text(resp.msg);
    //                     $('#delete-anawim-frm').append(_el)
    //                     _el.show('slow')
    //                 } else {
    //                     alert("An error occured. Please check the source code and try again")
    //                 }
    //             } else {
    //                 alert("An error occurred. Please check the source code and try again")
    //             }
    
    //             $('#delete_modal_anawim button').attr('disabled', false)
    //             $('#delete_modal_anawim button[form="delete-anawim-frm"]').text("YEs")
    //         }
    //     })
    //     })

})