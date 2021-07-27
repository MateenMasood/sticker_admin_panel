
// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ****************************************************************
$(document).ready(()=>{
    // ***** for shuffling idetifier  **************
    function shuffle(s) {
        var arr = s.split('');           // Convert String to array
        
        arr.sort(function() {
          return 0.5 - Math.random();
        });  
        s = arr.join('');                // Convert Array to string
        return s;                        // Return shuffled string
      }

    let id = new Date().valueOf().toString(16).toUpperCase()+Math.random(14).toString(16).substr(2, 8);
    $("input[name=identifier]").val(shuffle(id));


        // ***************** letters only and allow space in a name only *********

        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetical characters");


    // ********************* form validation ***********

      $("#formCreateCategory").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },
            rules: {
                title: {
                    required: true,
                    // lettersonly: true
                },
                identifier: {
                    required: true,
                },
                publisher: {
                    required: true,
                },
                
            },

            submitHandler: function(form) {
                formCreate(form)
            }

      });

})

// ****************** create from ajax request ********************
// ***************** for adding product tinot database ************

function formCreate(formData) {
var createFormData = new FormData (formData);
    // console.log(createFormData);
    $.ajax({
        url: '/admin/pack',
        type: 'POST',
        data: createFormData,
        contentType: false,
        processData: false,

        success: (response)=>{
            if (response.status == '200') {
                $.notify(response.message , 'success' );
                setInterval(() => {
                    window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/pack"    
                },1500 ); ;
            }else{
                $.notify(response.message , 'error');

            }
        },
        error: (errorResponse)=>{
            $.each( errorResponse.responseJSON.errors, function( key, value ) {
                $.notify(value[0], "error");
              });


        }
    })

}
