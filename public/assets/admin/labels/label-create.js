
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
                url: "/admin/label",
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
                        e.stopPropagation();
                        dzClosure.processQueue();
                    });

                    this.on("sendingmultiple", function(data, xhr, formData) {

                        formData.append("status", $("input[name=status]:checked").val());
                        // formData.append("title", $("#title").val());
                        // formData.append("description", $("#description").text());

                    });

                    this.on("successmultiple", function(files, response) {
                        console.log('success sending')
                        console.log(response);
                        $.notify(response , 'success'  );
                        // window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/near-by-places";



                      });
                      this.on("errormultiple", function(files, response) {
                        $.notify(response , 'error'  );

                      });
                },
                removedfile: function(file) {
                    file.previewElement.remove();
                },

            });
        // ***************** letters only and allow space in a name only *********

        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetical characters");


    // ********************* form validation ***********

      $("#formCreateLabel").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },
            status: {
                hotel: {
                    required: true,
                    number: true
                },


            },
            submitHandler: function(form) {
                // form_Create(form)
                return false;
            }

      });

})