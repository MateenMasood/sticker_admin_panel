
// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ****************************************************************
$(document).ready(function () {
 

  var table = $('#tblContacts').DataTable({
    lengthChange: false,
    dom: 'Bfrtip',
    buttons: ['copy', 'excel', 'pdf', 'csv' , 'colvis' , 'print'],

    ajax: {
        "url": "/admin/contact/datatable",
        "dataSrc": ""
    },
    columns: [
      { data : 'id'},
      { data: "name"},
      { data: "email"},
      { data: "phone" },
      { data: "message" },
      { data: "ip_address" },
     { render : function(data, type, row , full) {
         return `
         <div class="glyph">
             <a class="deleteRecord" href="#" onclick="deleteRecord('`+row.id+`')"> <i class="mdi mdi-delete-alert"></i> </a>
         </div>


         `
        },
     },
    ],
    "rowCallback": function (nRow, aData, iDisplayIndex) {
        var oSettings = this.fnSettings ();
        $("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
        return nRow;
        },
    "drawCallback": function( settings ) {

    }

    // "drawCallback": funcrion
  });

  table.buttons().container().appendTo('#tblHotels_wrapper .col-md-6:eq(0)');
});

// ******************* delete record *********************

function deleteRecord($id)  {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Yes, delete it!"
      }).then(function (result) {

        if (result.value) {

            // **************** delete record ajax **************
            $.ajax({
                url: '/admin/contact/'+$id,
                type: 'DELETE',
                processData: false,
                success: (response)=>{
                        Swal.fire({
                            title: "Deleted!",
                            text: response,
                            type: "success"
                        }).then(function() {
                            window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/contact/";
                        });
                        // Swal.fire("", "Your file has been deleted.", "success");
                        // window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/hotel/";
                },
                error: (errorResponse)=>{
                    $.notify( errorResponse.error, 'error'  );


                }
            })

        }
    });
}