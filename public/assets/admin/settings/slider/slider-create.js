
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
                url: "/admin/slider",
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

                        // formData.append("hotelId", $("#hotel").val());
                        // formData.append("title", $("#title").val());
                        // formData.append("description", $("#description").text());

                    });

                    this.on("successmultiple", function(files, response) {
                        console.log('success sending')
                        console.log(response);
                        $.notify(response , 'success'  );
                        window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/slider";



                      });
                      this.on("errormultiple", function(files, response) {
                        $.notify(response , 'error'  );

                      });
                },
                removedfile: function(file) {
                    file.previewElement.remove();
                },

            });


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

      $("#formCreateSlider").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },
            rules: {
                // hotel: {
                //     required: true,
                //     // lettersonly: true
                // },


            },
            messages: {
                // hotel: {
                //     required: "Please select hotel",

                // } ,

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
