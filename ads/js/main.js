(function ($) {
    "use strict";



    /*==================================================================
    [ Focus Contact2 ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        });   
    });
    $('.selection-2 select').change(function(){
        console.log("Sd");
    });
        
  
    /*==================================================================
    [ Validate ]*/
    var name = $('.validate-input input[name="name"]');
    var contact = $('.validate-input input[name="mobile"]');
    var college = $('.validate-input input[name="college"]');
    var email = $('.validate-input input[name="email"]');
    var teamname = $('.validate-input input[name="teamname"]');
    var teamsize = $('.validate-input input[name="teamsize"]');
    var event = $('.selection-2 option:selected');
    var category = $('.sel-1 option:selected');

    
   // var check = true;

    $('.validate-form').on('submit',function(){
         var check = true;

        if($(name).val().trim() == ''){
            showValidate(name);
            check=false;
        }
        if($(contact).val().length < 10)
        {
            showValidate(contact);
            check=false;
        }
        else
        {   var ch = $(contact).val();
            var count = 0;
            for(var i = 0 ; i < $(contact).val().length ; i++)
            {
                if(ch[i] <'0' || ch[i] >'9' )
                {
                    count = 1;
                    break;
                }
            }
            if(count)
            {
                showValidate(contact);
                check = false;
            }
        }
        if($(email).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
            showValidate(email);
            check=false;
        }
        if($(college).val().trim() == ''){
            showValidate(college);
            check=false;
        }
        if($(teamname).val().trim() == ''){
            showValidate(teamname);
            check=false;
        }
        return check;

    });

    
    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
       });
    });

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    

})(jQuery);

