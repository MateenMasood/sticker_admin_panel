
// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// **************************************************************** ready 
$(document).ready(function () {
  $('#datatable').DataTable(); //Buttons examples

  var table = $('#tblLabels').DataTable({
    lengthChange: false,
    dom: 'Bfrtip',
    buttons: ['copy', 'excel', 'pdf', 'csv' , 'colvis'],

    ajax: {
        "url": "/admin/label/datatable",
        "dataSrc": ""
    },
    columns: [
      { data : 'id'},
      { data: "identifier"},
      { render : function(data, type, row , full) {
  
        if (row.label_status == '1') {
            return `<span class="badge badge-pill badge-success">Yes, it is premium</span>`
        }else{
            return `<span class="badge badge-pill badge-success">No, it is not premium</span>`
        }
         },
      },
     { render : function(data, type, row , full) {
      
         return `
         <div class="glyph">
             <a href="/admin/label/`+row.id+`/edit"> <i class="mdi mdi-home-edit"></i> </a>
             <a class="deleteRecord" href="#" onclick="deleteRecord('`+row.id+`')"> <i class="mdi mdi-delete-alert"></i> </a>
             <a href="/label/`+row.id+`"> <i class="mdi mdi-file-eye"></i> </a>
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

function deleteRecord($id) {
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
                url: '/admin/label/'+$id,
                type: 'DELETE',
                processData: false,

                success: (response)=>{


                        Swal.fire({
                            title: "Deleted!",
                            text: response,
                            type: "success"
                        }).then(function() {
                            window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/label/";

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

// ******************************* deactive record *****************************

function change_status(id , status) {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to change the status of coupon code!",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "change status"
      }).then(function (result) {

        if (result.value) {

            // **************** delete record ajax **************
            $.ajax({
                url: '/admin/near-by-places/change-status',
                type: 'POST',
                data: {id: id , status: status},



                success: (response)=>{


                        Swal.fire({
                            title: "success!",
                            text: response,
                            type: "success"
                        }).then(function() {

                            window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/near-by-places/";

                        });

                        // Swal.fire("", "Your file has been deleted.", "success");
                        // window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/hotel/";
                },
                error: (errorResponse)=>{
                    $.notify( errorResponse, 'error'  );


                }
            })

        }
    });
}


