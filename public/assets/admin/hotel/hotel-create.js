

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

      $("#formCreateHotel").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },
            rules: {
                name: {
                    required: true,
                    // lettersonly: true
                },
                phoneNo: {
                    required: true,
                    number: true
                },
                email: {
                    required: true,
                    email: true
                },
                state: {
                    required: true,
                    // number: true
                },
                city: {
                    required: true,

                },
                zipCode: {
                    required: true,
                    number: true,
                },
                address: {
                    required: true,
                },

            },
            messages: {
                name: {
                    required: "Please enter hotel name here",

                } ,
                phoneNo: {
                    required: "Please enter hotel phone numer here",

                } ,
                email: {
                    required: "Please enter hotel email here",

                } ,
                state: {
                    required: "Please select state",
                    // number: "Please enter valid integer",
                } ,
                city: {
                    required: "Please enter city name here",

                } ,
                zipCode: {
                    required: "Please enter zip code here ",

                } ,
                address: {
                    required: "Please enter hotel address here",

                } ,

            },

            submitHandler: function(form) {
               form_Create(form);
            }

      });

})

// ****************** create from ajax request ********************
// ***************** for adding product tinot database ************

function form_Create(formData) {
//    let createFormData = $('#formCreate').serialize();
var createFormData = new FormData (formData);
    // console.log(createFormData);
    $.ajax({
        url: '/admin/hotel',
        type: 'POST',
        data: createFormData,
        contentType: false,
        processData: false,

        success: (response)=>{
            if (response.status == 'true') {
                $.notify(response.message , 'success'  );
                window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/hotel";
            }else{
                $.notify(response.message , 'error');

            }
        },
        error: (errorResponse)=>{
            $.notify( errorResponse, 'error'  );


        }
    })

}
