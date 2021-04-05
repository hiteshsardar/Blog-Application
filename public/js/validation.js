
$(document).ready(function(){
    $('#p_title').hide();
    $('#s_title').hide();
    $('#p_slug').hide();
    $('#author').hide();
    $('#body').hide();

    $('#e_name').hide();
    $('#e_email').hide();
    $('#e_pass').hide();
    $('#e_cpass').hide();

    var title_err =true;
    var sub_title_err  = true;
    var slug_err  = true;
    var author_err = true;
    var body_err = true;

    var name_err  = true;
    var email_err  = true;
    var pass_err = true;
    var cpass_err = true;

    $('#title').keyup(function(){
        title_check();
    });

    $('#sub_title').keyup(function(){
        sub_title_check();
    });

    $('#slug').keyup(function(){
        slug_check ();
    });
    

    $('#name').keyup(function(){
        name_check ();
    });

    $('#pass').keyup(function(){
        pass_check();
    });

    $('#cpass').keyup(function(){
        cpass_check ();
    });
    
    $('#search_btn').attr('disabled', true)
    $('#search').keyup(function(){
        search_check ();
    });


    function search_check (){
        var search_val = $('#search').val();
        
        if(search_val.trim() != ''){
            $('#search_btn').attr('disabled', false)
        }
    }
    function title_check (){
        var tilte_val = $('#title').val();
        
        if(tilte_val.trim() == ''){
            $('#p_title').show();
            $('#p_title').html("* Title Required");
            $('#p_title').focus();
            $('#p_title').css("color", "red");
            title_err = false;
            return false;
        } else if(tilte_val.length < 15){
            $('#p_title').show();
            $('#p_title').html("* Title Must be 15 or more chatacters");
            $('#p_title').focus();
            $('#p_title').css("color", "red");
            title_err = false;
            return false;
        } else {
            $('#p_title').hide();
        }
    }
    function sub_title_check (){
        var sub_title = $('#sub_title').val();
        
        if(sub_title.trim() == ''){
            $('#s_title').show();
            $('#s_title').html("* Subtitle Required");
            $('#s_title').focus();
            $('#s_title').css("color", "red");
            sub_title_err = false;
            return false;
        } else if(sub_title.length < 15){
            $('#s_title').show();
            $('#s_title').html("* Subtitle must be 15 or more characters");
            $('#s_title').focus();
            $('#s_title').css("color", "red");
            sub_title_err = false;
            return false;
        }else {
            $('#s_title').hide();
        }
    }
    function slug_check (){
        var slug = $('#slug').val();
        
        if(slug.trim() == ''){
            $('#p_slug').show();
            $('#p_slug').html("* Slug Required");
            $('#p_slug').focus();
            $('#p_slug').css("color", "red");
            slug_err = false;
            return false;
        } else if(slug.length < 10){
            $('#p_slug').show();
            $('#p_slug').html("* Slug must be 10 or more characters");
            $('#p_slug').focus();
            $('#p_slug').css("color", "red");
            slug_err = false;
            return false;
        }else {
            $('#p_slug').hide();
        }
    }
    
    function body_check (){
        var body = $('#p_body').val();
        
        if(body.trim() == ''){
            $('#body').show();
            $('#body').html("* Body Required");
            $('#body').focus();
            $('#body').css("color", "red");
            body_err = false;
            return false;
        } else if(body.length < 50){
            $('#body').show();
            $('#body').html("* Body must be 50 or more characters");
            $('#body').focus();
            $('#body').css("color", "red");
            body_err = false;
            return false;
        } else {
            $('#body').hide();
        }
    }

    function author_check (){
        var author = $('#author_name option:selected').text();
        
        if(author == "Select"){
            $('#author').show();
            $('#author').html("Please Select Author");
            $('#author').focus();
            $('#author').css("color", "red");
            author_err = false;
            return false;
        } else {
            $('#author').hide();
        }
    }


    function name_check (){
        var name_val = $('#name').val();
        
        if(name_val.trim() == ''){
            $('#e_name').show();
            $('#e_name').html("* Name Required");
            $('#e_name').focus();
            $('#e_name').css("color", "red");
            name_err = false;
            return false;
        } else if(name_val.length < 3){
            $('#e_name').show();
            $('#e_name').html("* Name Must be 3 or more chatacters");
            $('#e_name').focus();
            $('#e_name').css("color", "red");
            name_err = false;
            return false;
        } else {
            $('#e_name').hide();
        }
    }
    function email_check (){
        var email_val = $('#email').val();
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        
        if(email_val.trim() == ''){
            $('#e_email').show();
            $('#e_email').html("* Email Required");
            $('#e_email').focus();
            $('#e_email').css("color", "red");
            email_err = false;
            return false;
        } else if(!regex.test(email_val)){
            $('#e_email').show();
            $('#e_email').html("* Invalid Email Address");
            $('#e_email').focus();
            $('#e_email').css("color", "red");
            email_err = false;
            return false;
        }
        else{
            $('#e_email').hide();
        }
    }


    function pass_check (){
        var pass_val = $('#pass').val();
        
        if(pass_val.trim() == ''){
            $('#e_pass').show();
            $('#e_pass').html("* Password Required");
            $('#e_pass').focus();
            $('#e_pass').css("color", "red");
            pass_err = false;
            return false;
        } else if(pass_val.length < 6){
            $('#e_pass').show();
            $('#e_pass').html("* Password Must be 6 or more chatacters");
            $('#e_pass').focus();
            $('#e_pass').css("color", "red");
            pass_err = false;
            return false;
        } else {
            $('#e_pass').hide();
        }
    }
    function cpass_check (){
        var cpass_val = $('#cpass').val();
        var pass_val = $('#pass').val();
        
        if(cpass_val.trim() == ''){
            $('#e_cpass').show();
            $('#e_cpass').html("* Confirm Password Required");
            $('#e_cpass').focus();
            $('#e_cpass').css("color", "red");
            cpass_err = false;
            return false;
        } else if(cpass_val.length < 6){
            $('#e_cpass').show();
            $('#e_cpass').html("* Password Must be 6 or more chatacters");
            $('#e_cpass').focus();
            $('#e_cpass').css("color", "red");
            cpass_err = false;
            return false;
        }  else if(pass_val != cpass_val){
            $('#e_cpass').show();
            $('#e_cpass').html("* Password and confirm Password aren't matching");
            $('#e_cpass').focus();
            $('#e_cpass').css("color", "red");
            cpass_err = false;
            return false;
        } else {
            $('#e_cpass').hide();
        }
    }

    $('#admin_post').click(function(){

        title_err =true;
        sub_title_err  = true;
        slug_err  = true;
        author_err = true;
        body_err = true;

        title_check();
        sub_title_check();
        slug_check();
        body_check();
        author_check();

        if((title_err == true) && (sub_title_err  == true) && (slug_err  == true) && (author_err == true)
         && (body_err == true)) {
            return true;
        } else {
            return false;
        }

    });
    $('#post_update').click(function(){

        title_err =true;
        sub_title_err  = true;
        slug_err  = true;
        body_err = true;

        title_check();
        sub_title_check();
        slug_check();
        body_check();

        if((title_err == true) && (sub_title_err  == true) && (slug_err  == true) && (body_err == true)) {
            return true;
        } else {
            return false;
        }

    });

    $('#admin_register').click(function(){

        name_err  = true;
        email_err  = true;
        pass_err = true;
        cpass_err = true;

        name_check();
        email_check();
        pass_check();
        cpass_check();

        if((name_err == true) && (email_err  == true) && (pass_err  == true) && (cpass_err == true)) {
            return true;
        } else {
            return false;
        }

    });
    
    $('#admin_login').click(function(){

        email_err  = true;
        pass_err = true;

        email_check();
        pass_check();
       
        if((email_err  == true) && (pass_err  == true)) {
            return true;
        } else {
            return false;
        }

    });

    $('#user_post').click(function(){

        title_err =true;
        sub_title_err  = true;
        slug_err  = true;
        body_err = true;

        title_check();
        sub_title_check();
        slug_check();
        body_check();

        if((title_err == true) && (sub_title_err  == true) && (slug_err  == true) && (body_err == true)) {
            return true;
        } else {
            return false;
        }

    });
    $('#user_register').click(function(){

        name_err  = true;
        email_err  = true;
        pass_err = true;
        cpass_err = true;

        name_check();
        email_check();
        pass_check();
        cpass_check();

        if((name_err == true) && (email_err  == true) && (pass_err  == true) && (cpass_err == true)) {
            return true;
        } else {
            return false;
        }

    });
    $('#user_login').click(function(){

        email_err  = true;
        pass_err = true;

        email_check();
        pass_check();
       
        if((email_err  == true) && (pass_err  == true)) {
            return true;
        } else {
            return false;
        }

    });
});

    