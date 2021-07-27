
// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ****************************************************************
$(document).ready(()=>{

    // *************************** input tags ***************************

    if ($().tagsinput) {
        $(".tags").tagsinput({
          cancelConfirmKeysOnEmpty: true,
          confirmKeys: [13]
        });

        $("body").on("keypress", ".bootstrap-tagsinput input", function (e) {
          if (e.which == 13) {
            e.preventDefault();
            e.stopPropagation();
          }
        });
      }
    // *************************** select2 *****************************

        $("#role").select2({

            // theme: "bootstrap",
            // dir: direction,
            allowClear: true,
            placeholder: "Select a hotel",
            "pagination": {
            "more": true
            },
            ajax: {
                url: "/admin/rbac/roles/select2",
                type: "get",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                         searchTerm: params.term,
                    };
                },
                processResults: function (response) {
                    return {
                        results: $.map(response, function (obj) {
                            return {
                                text: obj.name,
                                id: obj.id
                            }
                        }),
                    }
                },
                cache: true
            },

            // formatResult: FormatResult,

        });

        // **********************************************

        // ***************** letters only and allow space in a name only *********

        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetical characters");


    // ********************* form validation ***********

      $("#formCreateUser").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },
            rules: {
                firstName: {
                    required: true,
                    // lettersonly: true
                },
                lastName: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                phoneNo: {
                    required: true,
                    number: true,
                },

                role: {
                    required: true,
                },
                password: {
                    required: true,

                },
                confirmPassword: {
                    required: true,
                    equalTo: "#password"
                },

            },
            messages: {
                firstName: {
                    required: "Please enter user first name here",

                } ,
                lastName: {
                    required: "Please enter user last name here",

                } ,
                email: {
                    required: "Please enter user email here",

                } ,
                phoneNo: {
                    required: "Please enter user phone number here",
                },
                role: {
                    required: "Please selecct user role here ",
                },
                password: {
                    required: "Please enter user password",

                } ,
                confirmPassword: {
                    required: "Please enter confirm password",
                    equalTo: "your passwword is not matching",

                } ,



            },

            submitHandler: function(form) {
                form_Create(form)
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
        url: '/admin/rbac/users',
        type: 'POST',
        data: createFormData,
        contentType: false,
        processData: false,

        success: (response)=>{
            if (response.status == 'true') {
                $.notify(response.message , 'success'  );
                window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/rbac/users";
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
