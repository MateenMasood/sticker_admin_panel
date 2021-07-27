
// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ****************************************************************
$(document).ready(()=>{

    // *************************** select2 *****************************

        $("#hotel").select2({

            // theme: "bootstrap",
            // dir: direction,
            allowClear: true,
            placeholder: "Select a hotel",
            "pagination": {
            "more": true
            },
            ajax: {
                url: "/admin/hotel/select2",
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

      $("#formEditPolicy").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },
            rules: {
                hotel: {
                    required: true,
                    // lettersonly: true
                },
                title: {
                    required: true,
                },

                description: {
                    required: true,
                },

            },
            messages: {
                hotel: {
                    required: "Please select hotel",

                } ,
                title: {
                    required: "Please enter policy title",

                } ,
                description: {
                    required: "Please enter policy description",

                } ,




            },

            submitHandler: function(form) {
                form_edit(form)
            }

      });

})

// ****************** create from ajax request ********************
// ***************** for adding product tinot database ************

function form_edit(formData) {
   let createFormData = $('#formEditPolicy').serialize();
// var createFormData = new FormData (formData);
    // console.log(createFormData);
    $.ajax({
        url: '/admin/policy/'+id,
        type: 'PATCH',
        data: createFormData,
        // contentType: false,
        processData: false,

        success: (response)=>{
            if (response.status == 'true') {
                $.notify(response.message , 'success'  );
                window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/policy";
            }else{
                $.notify(response.message , 'error');

            }
        },
        error: (errorResponse)=>{
            $.notify( errorResponse, 'error'  );


        }
    })

}
