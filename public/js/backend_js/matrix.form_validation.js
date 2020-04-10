$(document).ready(function () {
    $("#current_pwd").keyup(function () {
        var current_pwd = $("#current_pwd").val();
//        $.ajax({
//            type: 'get',
//            url: '/admin/check-pwd',
//            data: {current_pwd:current_pwd},
//            success: function (resp) {
//                alert(resp);
//            },error:function(){
//            alert("error2");
//        }
        $.ajax({
			type:'get',
			url:'../admin/check-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
                //alert(resp)
				//alert(resp);
				if(resp=="false"){
					$("#chkpwd").html("<font color='red'>Current Password is Incorrect</font>");
				}else if(resp=="true"){
					$("#chkpwd").html("<font color='green'>Current Password is Correct</font>");
				}
			},error:function(){
				alert("Error");
			}
        });
    });
    $('input[type=checkbox],input[type=radio],input[type=file]').uniform();

    $('select').select2();

    // Form Validation
    $("#basic_validate").validate({
        rules: {
            required: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            date: {
                required: true,
                date: true
            },
            url: {
                required: true,
                url: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });
    
      // Category Validation
    $("#add_category").validate({
        rules: {
            
            name: {
                required: true,
             
            },
            desc: {
                required: true,
            
            },
             
            url: {
                required: true,
             
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#adit_category").validate({
        rules: {
            
            name: {
                required: true,
             
            },
            description: {
                required: true,
            
            },
            url: {
                required: true,
             
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });
    
    $("#add_product").validate({
        rules: {
            
            category_id: {
                required: true,
             
            },
            product_name: {
                required: true,
            
            },
             
            product_color: {
                required: true,
             
            },
            product_code: {
                required: true,
                number:true,
             
            },
           
            description: {
                required: true,
             
            },
            price: {
                required: true,
                number: true,
            },
             image: {
                required: true,
             
            },
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });
    
    $("#edit_product").validate({
        rules: {
            
           
            name: {
                required: true,
            
            },
             
            color: {
                required: true,
             
            },
            code: {
                required: true,
                number:true,
             
            },
           
            description: {
                required: true,
             
            },
            price: {
                required: true,
                number: true,
            },
             
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });
    
//    $('#delcat').click(function(){
//        if(confirm("are you sure that you want to delete category")){
//              return true;
//           }
//            return false;
//    });
    //sweet alert1
//     $('.deleteRecord').click(function(){
//         var id=$(this).attr('rel');
//         var deletefunction=$(this).attr('rel1');
//       swal({
//           title:"are you sure",
//           text: "you will not be able to recover this record again",
//           type: "warning",
//           showCancelButton:true,
//           confirmButtonClass: "btn-danger",
//           confirmButtonText:"yes, delete it"
//       },
//        function(){
//              window.location.href="/ecommercelaravel/ecommerce/public/admin/"+deletefunction+"/"+id;
//            });
//         
//     });
    
    //sweet alert2
    //for deleting product
    $(document).ready(function(){
    $('.deleteRecord').on('click', function(e){
        e.preventDefault(); //cancel default action

        //Recuperate href value
        var href = $(this).attr('href');
        var message = $(this).data('confirm');
        var id=$(this).attr('rel');
        var deletefunction=$(this).attr('rel1');
        //pop up
        swal({
            title: "Are you sure ??",
            text: message, 
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
              window.location.href="/ecommercelaravel/ecommerce/public/admin/"+deletefunction+"/"+id;
            swal("Poof! Your imaginary file has been deleted!", {
              icon: "success",
            });
            
          } else {
            swal("Your imaginary file is safe!");
          }
        });
    });
});
    
    //codex world for multi selection

$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML =  '<div><div class=" wrapper"style="margin-left:180px;"> <input type="text" name="sku[]" id="sku" Placeholder="Sku" style="width:120px"/><input type="text" name="size[]" id="size" Placeholder="Size" style="width:120px" /><input type="text" name="price[]" id="price" Placeholder="Price" style="width:120px" /><input type="text" name="stock[]" id="stock" Placeholder="Stock" style="width:120px;margin-left:5px;"/><a href="javascript:void(0);" class="remove_button">Remove</a></div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

    
     //sweet alert2
    //for deleting category
    $(document).ready(function(){
    $('.deleteRecord').on('click', function(e){
        e.preventDefault(); //cancel default action

        //Recuperate href value
        var href = $(this).attr('href');
        var message = $(this).data('confirm');
        var id=$(this).attr('rel');
        var deletefunction=$(this).attr('rel1');
        //pop up
        swal({
            title: "Are you sure ??",
            text: message, 
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
              window.location.href="/ecommercelaravel/ecommerce/public/admin/"+deletefunction+"/"+id;
            swal("Poof! Your imaginary file has been deleted!", {
              icon: "success",
            });
            
          } else {
            swal("Your imaginary file is safe!");
          }
        });
    });
});

    $("#number_validate").validate({
        rules: {
            min: {
                required: true,
                min: 10
            },
            max: {
                required: true,
                max: 24
            },
            number: {
                required: true,
                number: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#password_validate").validate({
        rules: {
            current_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            new_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20,
               // equalTo: "#pwd"
            },

            confirm_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20,
               // equalTo: "#pwd"
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });
});
