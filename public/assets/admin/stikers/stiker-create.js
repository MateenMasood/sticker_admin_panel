
// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
Dropzone.autoDiscover = false;

// ****************************************************************
$(document).ready(()=>{

    $('#icons').dropify();
    $('#stikers').dropify();



    $("#category").select2({
        ajax: {
            url: "/admin/pack/select2-categories",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term, // search term
                };
            },
            processResults: function (response) {

                return {
                    results: $.map(response, function (obj) {
                        return {
                            text: obj.title,
                            id: obj.id
                        }
                    }),
                }
            },
            cache: true
        },
        // formatResult: FormatResult,
    }).on("change", function (e) {
        $(this).valid();
    });



    // ********************* form validation ***********

      $("#formCreateStiker").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },
            rules: {
                title: {
                    required: true,
                },
                tags: {
                    required: true,
                },
                premium: {
                    required: true,
                },
                icons: {
                required: true,
                extension: "png|PNG|jpg|jpeg|JPG|JPEG"
            },
                stikers: {
                required: true,
                extension: "png|PNG|jpg|jpeg|JPG|JPEG"
            },


            },
            messages: {
                title: {
                    required: "Please enter title",

                },
                tags: {
                    required: "Please enter tags",

                },
                premium: {
                    required: "Please select premium or not",

                },
                icons: {
                required: "Please upload icons",
                extension: "Only this file formate Supported (png,PNG,jpg,jpeg,JPG,JPEG)"

                },
                stikers: {
                    required: "Please upload stikers",
                    extension: "Only this file formate Supported (png,PNG,jpg,jpeg,JPG,JPEG)"

                },

            },

            submitHandler: function(form) {
                addStikers(form)
            }

      });

});



function addStikers(form) {

    $.ajax({
        url: '/admin/stikers',
        type: 'post',
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        success: (response) => {
            console.log(response);
            if (response.status=="200")
            {
                $.notify(response.message, 'success');
            }
        },
        error: (errorResponse) => {

            console.log(errorResponse.responseJSON.errors);

            // console.log("hello");
            // console.log(errorResponse);

            $.each( errorResponse.responseJSON.errors, function( key, value ) {
                $.notify(value[0], "error");
                // $('#'+key).addClass( "error");
            //     $('#'+key).css('border' , '2px solid red');
            //     setTimeout(function(){
            //         $('#'+key).css('border' , '1px solid black');
            //     } , 4000)
              });
        }
    });

}
