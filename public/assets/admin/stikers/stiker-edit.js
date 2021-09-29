
// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
Dropzone.autoDiscover = false;

// ****************************************************************
$(document).ready(()=>{
console.log(assetBaseUrl);
    // ======= stickers 

    var CSRF_TOKEN = $('x   meta[name="csrf-token"]').attr('content');
    // if ($().dropzone && !$(".dropzone").hasClass("disabled")) {
        var myDropZone = $("#stikers").dropzone({
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
            paramName: "stikers",
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
                  url: '/admin/stikers/delete-image',
                  data: {name: fileName,request: 'delete', id: id, path: file.path, fileType:'sticker'},
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
                stikers.forEach(image => {
                    var mockFile = { name: image.name, size: image.size, type: image.type, path:  image.path};
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

    // ===============
    // =========== icons =====================
    var myDropZone = $("#icons").dropzone({
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
        paramName: "icons",
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
              url: '/admin/stikers/delete-image',
              data: {name: fileName,request: 'delete', id: id, path: file.path, fileType:'icon'},
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
            icons.forEach(image => {
                var mockFile = { name: image.name, size: image.size, type: image.type, path:  image.path};
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
                updateStikers(form)
            }

      });

});



function updateStikers(form) {

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
