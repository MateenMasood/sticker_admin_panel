
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

        // *****************initilization version select2 ****************
    $("#roomType").select2({
        // theme: "bootstrap",
        // dir: direction,
        // allowClear: true,
        placeholder: "Select a room type",
        "pagination": {
            "more": true
          },
        // minimumResultsForSearch: Infinity,
        // dropdownParent:$('#formContainer'),
        // containerCssClass: ":all:",
        ajax: {
            url: "/admin/rooms-type/select2",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    hotelId:$('#hotel').val(),
                    searchTerm: params.term,
                };
            },
            processResults: function (response) {

                return {
                    results: $.map(response, function (obj) {
                        return {
                            text: obj.room_type_name,
                            id: obj.id
                        }
                    }),
                }
            },
            cache: true
        },
        // formatResult: FormatProductVersionModel,
    });



    // ****************************************************************


        // ***************** letters only and allow space in a name only *********

        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetical characters");


    // ********************* form validation ***********

      $("#formCreateRoom").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },
            rules: {
                hotel: {
                    required: true,
                    // lettersonly: true
                },
                roomType: {
                    required: true,
                },

            },
            messages: {
                hotel: {
                    required: "Please select hotel",

                } ,
                roomType: {
                    required: "Please select room type",

                } 
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
        url: '/admin/rooms',
        type: 'POST',
        data: createFormData,
        contentType: false,
        processData: false,

        success: (response)=>{
            if (response.status == 'true') {
                $.notify(response.message , 'success'  );
                window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/rooms";
            }else{
                $.notify(response.message , 'error');

            }
        },
        error: (errorResponse)=>{
            $.notify( errorResponse, 'error'  );


        }
    })

}
