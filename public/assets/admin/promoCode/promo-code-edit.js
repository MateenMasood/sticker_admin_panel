
// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ****************************************************************
$(document).ready(()=>{

    // ********************* start date *******************************
    $('#datepicker-start-date').datepicker({
        autoclose: true,
        todayHighlight: true
      });

    // ********************* end date *******************************
    $('#datepicker-end-date').datepicker({
        autoclose: true,
        todayHighlight: true
      });


        // ***************** letters only and allow space in a name only *********

        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetical characters");


    // ********************* form validation ***********

      $("#formEditCoupon").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },
            rules: {
                code: {
                    required: true,
                    // lettersonly: true
                },
                discountType: {
                    required: true,
                },
                Value: {
                    required: true,
                    number: true
                },
                startDate: {
                    required: true,
                },

                endDate: {
                    required: true,
                },
                perCouponUsageLimit: {
                    required: true,
                    number: true,
                },

                usageLimitPerPerson: {
                    required: true,
                    number: true,
                },

            },
            messages: {
                code: {
                    required: "Please enter coupon code here",

                } ,
                discountType: {
                    required: "Please select discount type ",

                } ,
                Value: {
                    required: "Please enter value here",

                } ,
                startDate: {
                    required: "Please enter start date here",
                },
                endDate: {
                    required: "Please enter end date here",
                },
                perCouponUsageLimit: {
                    required: "Please enter Usage Limit Per Coupon here",
                },
                usageLimitPerPerson: {
                    required: "Please enter Usage Limit of coupon Per Customer",
                },

            },

            submitHandler: function(form) {
                form_Create(form)
            }

      });

})

// ****************** create from ajax request ********************
// ***************** for adding product tinot database ************

function form_Create(formData) {
   let createFormData = $('#formEditCoupon').serialize();
// var createFormData = new FormData (formData);
    // console.log(createFormData);
    $.ajax({
        url: '/admin/promo-code/'+id,
        type: 'PATCH',
        data: createFormData,
        processData: false,

        success: (response)=>{
            if (response.status == 'true') {
                $.notify(response.message , 'success'  );
                window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/admin/promo-code";
            }else{
                $.notify(response.message , 'error');

            }
        },
        error: (errorResponse)=>{
            $.notify( errorResponse, 'error'  );


        }
    })

}
