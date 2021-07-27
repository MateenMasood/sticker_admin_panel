$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(()=>{

    var table = $('#tblAssignPermissionToRole').DataTable({
      lengthChange: false,
      "paging": false,
    //   dom: 'Bfrtip',
      columns: [
        { data : 'permission'},
        { data : 'create'},
        { data : 'view'},
        { data : 'edit'},
        { data : 'delete'},

      ],
      "rowCallback": function (nRow, aData, iDisplayIndex) {
        //   var oSettings = this.fnSettings ();
        //   $("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
        //   return nRow;
          },
      "drawCallback": function( settings ) {

      }

      // "drawCallback": funcrion
    });
})


function assignPermission(value) {
    $id = $('input[value='+value+']').attr('id');
    $permissionStatus = '';

    if ($("#"+$id).is(':checked')) {
        $permissionStatus = 'checked';
    }else{
        $permissionStatus = 'unchecked';

    }

    $.ajax({
        url: '/admin/rbac/roles/role-permission',
        type: 'POST',
        data: {permission: value , role: roleId , status: $permissionStatus},

        success: (response)=>{
            if (response.status) {
                $("#tblAssignPermissionToRole").DataTable().ajax.reload();
            }else{

            }
        },
        error: (errorResponse)=>{
            // $.notify( errorResponse, 'error'  );


        }
    })

}
