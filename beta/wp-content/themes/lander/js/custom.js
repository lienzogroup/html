
$(document).ready(function() { 
             
        //result texts  
        //var characters_error = 'Minimum amount of chars is 3';      
       
        //when button is clicked  
        $('#submitbtn').live('click', function(){ 
            var checking_html = 'Checking...';  
            var sEmail = $('#useremail').val();
             $('#availability_result').html('');
            //alert($('#useremail').val());
            //run the character number check  
            if($('#useremail').val()=="info@revelryhouse.com"){  
                //if it's bellow the minimum show characters_error text '  
                $('#availability_result').html("info@revelryhouse.com is not available");  
            }        
            else if (!validateEmail(sEmail)) {
             $('#availability_result').html("Invalid Email Address");
            //alert('Invalid Email Address');
            //e.preventDefault();
            }
            else if($('#pass1').val()!=$('#pass2').val())
            {                 
                $('#availability_result').html("Password and Confirm Password don't match"); 
            }
            else if($('#userename').val()=="revelryhouse")
            {                 
                $('#availability_result').html("Full Name shouldn't be empty"); 
            }
            else if($('#dd').val()=="dd"||$('#mm').val()=="mm"||$('#yyyy').val()=="yyyy")
                {                 
                    $('#availability_result').html("Birth date shouldn't be empty"); 
                }
            else if($('#zipcode').val()=="000000")
            {                 
                $('#availability_result').html("Zip code shouldn't be empty"); 
            }
                
            
            else{  
                //else show the cheking_text and run the function to check  
                $('#availability_result').html(checking_html);  
                check_availability();  
            }  
            
        }); 
        $('#joinsubmit').live('click', function(){ 
           $('#sign-in').submit();
        });
        $('#join-submit').live('click', function(){ 
           $('.canvasloader').show();
        });


$('#sign-in').submit(function() {
    //var loading = '<img src="../beta/wp-content/themes/revelryhouse/images/loading.gif" alt="Loading...">'; 
               
        var data = $(this).serialize();
        //$('.sign-in-sec').html(loading);
       // post data to server
        $.ajax({
            type: "POST",
            url: "splash/register.php",
            data: data,
            success: function(data){
                $('.sign-in-sec').html(data);
            }
        });
        // prevent default browser submit behavior
        return false;
    });
    
function check_availability(){  
  
        //get the username  
        var useremail = $('#useremail').val();  
        //use ajax to run the check  
        $.post("splash/check_user.php", { useremail: useremail },  
            function(result){ 
               // alert("Data Loaded: " + result);
                //if the result is 1  
                if(result == 1){  
                    //show that the username is available  
                   // $('#availability_result').html(useremail + ' is available'); 
                   $(".sign-up").fadeOut();
                   $(".things").fadeIn();
                }else{  
                    //show that the username is NOT available  
                    $('#availability_result').html(useremail + ' is not available');  
                }  
        });  
  
}
  
  }); 
  
  
  function validateEmail(sEmail) {
        
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}
 
