/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
      
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

$(document).ready(function(){
    $('#selsize').change(function(){
     var idsize = $(this).val();
        if(idsize==""){
            return false; // to avoid error
        }
        //alert(idsize);
    $.ajax({
        type:'get',
        url:'/ecommercelaravel/ecommerce/public/get-product-price',
        data:{idsize:idsize},
        success:function(resp){
            //alert(resp); return false;
            var arr=resp.split('#'); //array splitting from #
            $('#getprice').html("USD" + arr[0]);
            if(arr[1]==0){
                $('#cartbtn').hide();
                $('#availability').text('Out Of Stock');
            }else{
                 $('#cartbtn').show();
                $('#availability').text('In Stock');
            }
        },error:function(){
        alert("error");
    }
    });    
    });
});

$(document).ready(function(){
    $(".changeimage").click(function(){
        //alert("test");
        var image = $(this).attr('src');
        $('.mainimage').attr('src',image); //for changing image in detail page 
        
        });
    });

// Instantiate EasyZoom instances
		var $easyzoom = $('.easyzoom').easyZoom();

		// Setup thumbnails example
		var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

		$('.thumbnails').on('click', 'a', function(e) {
			var $this = $(this);

			e.preventDefault();

			// Use EasyZoom's `swap` method
			api1.swap($this.data('standard'), $this.attr('href'));
		});

		// Setup toggles example
		var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

		$('.toggle').on('click', function() {
			var $this = $(this);

			if ($this.data("active") === true) {
				$this.text("Switch on").data("active", false);
				api2.teardown();
			} else {
				$this.text("Switch off").data("active", true);
				api2._init();
			}
		});
//$().ready(function(){
////    $("#loginregister").validate({
//        alert("test");
//});
//User Sign up
$().ready(function(){
    $("#loginregister").validate({
        //alert("test");
        rules:{
            name:{
                required:true,
                minlength:4,
                accept:"[a-zA-Z]"
            },
            password:{
                required:true,
                minlength:6,
            },
            email:{
                required:true,
                email:true,
                remote:"/ecommercelaravel/ecommerce/public/check-email"
            }
        },
        messages:{
            name:{
                required:"Please enter your name",
                minlength:"Minimum length of name should be 4",
                accept:"name must in letters only"
            },
            password:{
                required:"Please enter your password",
                minlength:"Minimum length of password should be 6",
                
            },
            email:{
                required:"Please enter your email",
                email:"Please enter valid email",
                remote:"Email Already Exists"
            }
        }
    });
    
   $('#password').password();

});

//Account update
$().ready(function(){
    $("#accountform").validate({
        //alert("test");
        rules:{
            name:{
                required:true,
                minlength:4,
                accept:"[a-zA-Z]"
            },
            address:{
                required:true,
                maxlength:50,
            },
            city:{
                required:true,
                maxlength:50,
            },
            state:{
                required:true,
                maxlength:50,
            },
            country:{
                required:true,
                maxlength:50,
            },
            pincode:{
                required:true,
                maxlength:50,
            },            
            mobile:{
                required:true,
                maxlength:50,
            },
            
            
        },
        messages:{
            name:{
                required:"Please enter your name",
                minlength:"Minimum length of name should be 4",
                accept:"name must in letters only"
            },
            address:{
                required:"Please enter your adress",
            },
            city:{
                required:"Please enter your city",
            },
            state:{
                required:"Please enter your state",
            },
            country:{
                required:"Please enter your country",
            },
            pincode:{
                required:"Please enter your pincode",
            },
            mobile:{
                required:"Please enter your mobile",
            },
           
        }
    });
    
   $('#password').password();

});

//Check current user password while updating

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
			url:'../public/check-pwd',
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

//validations user password update form

$().ready(function(){
    $("#userpasswordform").validate({
        //alert("test");
        rules:{
            current_pwd:{
                required:true,
                minlength:6,
            },
            new_pwd:{
                required:true,
                minlength:6,
                //remote:"/ecommercelaravel/ecommerce/public/check-email"
            },
            con_pwd:{
                required:true,
//                email:true,
                equalTo: "#new_pwd",
                //remote:"/ecommercelaravel/ecommerce/public/check-email"
            }
        },
        messages:{
            current_pwd:{
                required:"Please enter your password",
                minlength:"Minimum length of password should be 6",
                
            },
            new_pwd:{
                required:"Please enter new password",
                minlength:"Minimum length of password should be 6",
            },
            con_pwd:{
                required:"Please enter confirm password",
                equalTo:"Please enter same password",
                //remote:"Email Already Exists"
            }
        }
    });

});

//plugin for login
$().ready(function(){
    $("#userlogin").validate({
        //alert("test");
        rules:{
            password:{
                required:true,
                minlength:6,
            },
            email:{
                required:true,
                email:true,
                //remote:"/ecommercelaravel/ecommerce/public/check-email"
            }
        },
        messages:{
            password:{
                required:"Please enter your password",
                minlength:"Minimum length of password should be 6",
                
            },
            email:{
                required:"Please enter your email",
                email:"Please enter valid email",
                //remote:"Email Already Exists"
            }
        }
    });

});

 