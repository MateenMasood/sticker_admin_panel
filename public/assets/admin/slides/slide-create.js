
// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
Dropzone.autoDiscover = false;

// ****************************************************************
$(document).ready(()=>{


       // ******************* dropzone ***********************************
        // ************* image upload dropzone
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        // if ($().dropzone && !$(".dropzone").hasClass("disabled")) {
            var myDropZone = $(".dropzone").dropzone({
                maxFiles: 2000,
                url: "/admin/slides",
                headers: {
                    'x-csrf-token': CSRF_TOKEN,
                },
                acceptedFiles: ".jpeg,.jpg,.png,.pdf",
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 100,
                paramName: "file",
                autoProcessQueue: false,
                contentType: false,
                processData: false,  clickable: true,
                thumbnailWidth: 150,
                thumbnailHeight: 150,

                init: function(){
                    dzClosure = this;
                    $("#submit").click(function(e) {
                        // e.preventDefault();
                        e.stopPropagation();
                        dzClosure.processQueue();
                    });

                    this.on("sendingmultiple", function(data, xhr, formData) {

                        formData.append("title", $("#title").val());


                    });

                    this.on("successmultiple", function(files, response) {
                        console.log('success sending')
                        console.log(response);
                        if(response.message)
                        {
                        $.notify(response.message , 'success' );
                        }
                        window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/slides";

                      });
                      this.on("errormultiple", function(files, response) {
                        console.log(response);
                        if(response.message)
                        {
                            $.notify(response.message , 'error');
                        }

                        if(response.errors)
                        {
                            $.each( response.errors, function( key, value ) {
                                $.notify(value[0], "error");
                              });
                        }

                      });
                },
                removedfile: function(file) {
                    file.previewElement.remove();
                },

            });


    // ********************* form validation ***********

      $("#formCreateSlide").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },
            rules: {
                title: {
                    required: true,
                },


            },
            messages: {
                title: {
                    required: "Please enter title",

                } ,

            },

            submitHandler: function(form) {
                // form_Create(form)
            }

      });

})

// ****************** create from ajax request ********************
// ***************** for adding product tinot database ************

// function form_Create(formData) {
// //    let createFormData = $('#formCreate').serialize();
// var createFormData = new FormData (formData);
//     // console.log(createFormData);
//     $.ajax({
//         url: '/admin/policy',
//         type: 'POST',
//         data: createFormData,
//         contentType: false,
//         processData: false,

//         success: (response)=>{
//             if (response.status == 'true') {
//                 $.notify(response.message , 'success'  );
//                 window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/policy";
//             }else{
//                 $.notify(response.message , 'error');

//             }
//         },
//         error: (errorResponse)=>{
//             $.notify( errorResponse, 'error'  );


//         }
//     })

// }
