
// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ****************************************************************
$(document).ready(()=>{

    $("#formUpdateCategory").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },
            rules: {
                title: {
                    required: true,
                },
                identifier: {
                    required: true,
                },
                publisher: {
                    required: true,
                },
                
            },

            submitHandler: function(form) {
                formUpdate(form)
            }

      });

})
// ***************** for adding product tinot database ************

function formUpdate(formData) {
   let createFormData = $('#formUpdateCategory').serialize();
// var createFormData = new FormData (formData);
    // console.log(createFormData);
    $.ajax({
        url: '/admin/pack/'+id,
        type: 'PATCH',
        data: createFormData,
        processData: false,

        success: (response)=>{
            if (response.status == 200) {
                $.notify(response.message , 'success'  );
                setTimeout(()=>{window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/pack"} , 1500)
            }else{
                $.notify(response.message , 'error');

            }
        },
        error: (errorResponse)=>{
            $.notify( errorResponse, 'error'  );


        }
    })

}
