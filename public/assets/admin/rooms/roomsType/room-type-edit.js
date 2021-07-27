
// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ****************************************************************
Dropzone.autoDiscover = false;
$(document).ready(()=>{

    // ******************* dropzone ***********************************

        // ************* image upload dropzone
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        // if ($().dropzone && !$(".dropzone").hasClass("disabled")) {
            var myDropZone = $(".dropzone").dropzone({
                maxFiles: 2000,
                url: "/admin/rooms-type/"+id,
                headers: {
                    'x-csrf-token': CSRF_TOKEN,
                },
                // method: "POST",
                acceptedFiles: ".jpeg,.jpg,.png,.pdf",
                addRemoveLinks: true,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 100,
                paramName: "file",
                autoProcessQueue: false,
                contentType: false,
                processData: false,
                cache: false,
                thumbnailWidth: 150,
                thumbnailHeight: 150,
                removedfile: function(file) {
                    var fileName = file.name;
                    console.log(file);
                    $.ajax({
                      type: 'POST',
                      url: '/admin/rooms-type/rooms-type-file-delete',
                      data: {name: fileName,request: 'delete'},
                      sucess: function(data){
                         console.log('success: ' + data);
                      }
                    });

                    var _ref;
                     return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                },

                init: function(){
                    dzClosure = this;
                    $("#submit").click(function(e) {
                        console.log('submite');
                        // e.preventDefault();
                        e.stopPropagation();
                        dzClosure.processQueue();

                    });

                    // ************************** preview images *********************
                    images.forEach(image => {
                        var mockFile = { name: image.file_name, size: image.size, type: image.mime_type };
                        this.options.addedfile.call(this, mockFile);
                        this.options.thumbnail.call(this, mockFile, assetBaseUrl+"/"+image.path);
                        mockFile.previewElement.classList.add('dz-success');
                        mockFile.previewElement.classList.add('dz-complete');
                    });



                    // ***************************************************************

                    this.on("sendingmultiple", function(data, xhr, formData) {

                        formData.append("hotelId", $("#hotel").val());
                        formData.append("roomType", $("#roomType").val());
                        formData.append("pricePerRoom", $("#pricePerRoom").val());
                        formData.append("description", $("#description").text());
                        formData.append("_method", $("#method").val());

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


            },

            submitHandler: function(form) {
            }

      });

})
