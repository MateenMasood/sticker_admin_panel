var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
// if ($().dropzone && !$(".dropzone").hasClass("disabled")) {
    var myDropZone = $(".dropzone").dropzone({
        maxFiles: 2000,
        url: "/admin/label/"+id,
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