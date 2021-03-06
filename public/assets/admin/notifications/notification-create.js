
// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ****************************************************************
$(document).ready(()=>{
        // ***************** letters only and allow space in a name only *********

        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetical characters");


    // ********************* form validation ***********

      $("#formCreateNotification").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },
            rules: {
                title: {
                    required: true,
                    // lettersonly: true
                },
                
            },

            submitHandler: function(form) {
                formCreate(form)
            }

      });

})

// ****************** create from ajax request ********************
// ***************** for adding product tinot database ************

function formCreate(formData) {
var createFormData = new FormData (formData);
    // console.log(createFormData);
    $.ajax({
        url: '/admin/notification',
        type: 'POST',
        data: createFormData,
        contentType: false,
        processData: false,

        success: (response)=>{
            if (response.status == '200') {
                $.notify(response.message , 'success' );
                setInterval(() => {
                    window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/notification"    
                },1500 ); ;
            }else{
                $.notify(response.message , 'error');

            }
        },
        error: (errorResponse)=>{
            $.each( errorResponse.responseJSON.errors, function( key, value ) {
                $.notify(value[0], "error");
              });


        }
    })

}
