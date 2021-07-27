
// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ****************************************************************
Dropzone.autoDiscover = false;
$(document).ready(()=>{
    // 'use strict';

    // ********************** image preview *******************************
    $("#roomTypeBackgroundPic").fileinput({
        
        showUpload:false,
        showRemove:true,
        required:true,

        theme: 'fas',
        language: 'fr',
        uploadUrl: '#',

        allowedFileExtensions: ['jpg', 'png', 'gif']
        
        }); 

    // ******************* form repeater ************************************


    $('.repeater').repeater({
        btnAddClass: 'r-btnAdd',
        btnRemoveClass: 'r-btnRemove',
        groupClass: 'r-group',
        minItems: 1,
        maxItems: 5,
        startingIndex: 0,
        showMinItemsOnLoad: false,
        reindexOnDelete: true,
        // repeatMode: 'append',
        animation: null,
        animationSpeed: 400,
        animationEasing: 'swing',
        clearValues: true,

        show: function show() {
          $(this).slideDown();
        },
        hide: function hide(deleteElement) {
          if (confirm('Are you sure you want to delete this element?')) {
            $(this).slideUp(deleteElement);
          }
        },
        ready: function ready(setIndexes) {
            console.log(setIndexes);
        }
      });


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

    // ******************* dropzone ***********************************

        // ************* image upload dropzone
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        // if ($().dropzone && !$(".dropzone").hasClass("disabled")) {
            var myDropZone = $(".dropzone").dropzone({
                maxFiles: 2000,
                url: "/admin/rooms-type",
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

                        formData.append("hotelId", $("#hotel").val());
                        formData.append("roomType", $("#roomType").val());

                        formData.append("noOfPerson", $("#noOfPerson").val());
                        formData.append("noOfKids", $("#noOfKids").val());
                        formData.append("bedType", $("#bedType").val());
                        formData.append("roomSize", $("#roomSize").val());
                        formData.append("tax", $("#tax").val());
                        formData.append("amenities", $("#amenities").val());

                        formData.append("pricePerRoom", $("#pricePerRoom").val());
                        formData.append("description", $("#description").val());

                        formData.append("roomPoicyTitle", $('#formCreateRoomType').serialize());


                        formData.append("roomTypeBackgroundImage" , $("#roomTypeBackgroundPic")[0].files[0]);

                    });

                    this.on("successmultiple", function(files, response) {
                        console.log('success sending')
                        console.log(response);
                        $.notify(response , 'success'  );
                        window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/rooms-type";



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



    // ****************************************************************


        // ***************** letters only and allow space in a name only *********

        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetical characters");


    // ********************* form validation ***********

      $("#formCreateRoomType").validate({

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
                pricePerRoom: {
                    required: true,
                    number: true
                },
                file: {
                    requireed: true,
                },
                amenities: {
                    required: true,
                },
                description: {
                    required: true,
                }


            },
            messages: {
                hotel: {
                    required: "Please select hotel",

                } ,
                roomType: {
                    required: "Please enter room type",

                } ,
                pricePerRoom: {
                    required: "Please enter price per room here",

                } ,
                file: {
                    required: "Please upload at least one image",
                }
                ,
                amenities: {
                    required: "Please enter amenities ",
                },
                description: {
                    required: "Please enter description",
                }



            },

            submitHandler: function(form) {
                // console.log($('#formCreateRoomType').serialize());
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
//         url: '/admin/rooms-type',
//         type: 'POST',
//         data: createFormData,
//         contentType: false,
//         processData: false,

//         success: (response)=>{
//             if (response.status == 'true') {
//                 $.notify(response.message , 'success'  );
//                 window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/hotel";
//             }else{
//                 $.notify(response.message , 'error');

//             }
//         },
//         error: (errorResponse)=>{
//             $.notify( errorResponse, 'error'  );


//         }
//     })

// }
