$(document).ready(function(){
    $("#register-link").click(function(){
        $("#login-box").hide();
        $("#register-box").show();
    });

    $("#login-link").click(function(){
        $("#login-box").show();
        $("#register-box").hide();
    });	 

    $("#forgot-link").click(function(){
        $("#login-box").hide();
        $("#forgot-box").show();
    });

    $("#back-link").click(function(){
        $("#login-box").show();
        $("#forgot-box").hide();
    });

    //Register Ajax Request
    $("#register-btn").click(function(e){
        if($("#register-form")[0].checkValidity()){
            e.preventDefault();
            $("#register-btn").val('Παρακαλώ περιμένετε...'); 
            if($("#rpassword").val() != $("#cpassword").val()){
                $("#passError").text('* Ο κωδικός δεν ταιριάζει!');
                $("#register-btn").val('Σύνδεση'); 
            }
            else{
                $("#passError").text('');
                $.ajax({
                    url: 'assets/php/action.php', 
                    method: 'post', 
                    data: $("#register-form").serialize()+'&action=register',
                    success: function(response){
                        $("#register-btn").val('Σύνδεση');
                        $("#regAlert").html(response); 
                    }
                });
            }
        }
    });
    
    //Login Ajax Request
    $("#login-btn").click(function(e){
        if($("#login-form")[0].checkValidity()){
            e.preventDefault(); 	

            $("#login-btn").val('Παρακαλώ περιμένετε...');
            $.ajax({
                url: 'assets/php/action.php',
                method:'post',
                data: $("#login-form").serialize()+"&action=login",
                success:function(response){
                    console.log(response);
                    $("#login-btn").val('Σύνδεση');
                    
                    if(response.trim() === 'login') {
                        window.location = 'home.php';
                            console.log('ok');
                    }
                    else{
                        $("#loginAlert").html(response);
                        console.log(response);
                    }
                }
            });
        }
    });

    //Forgot Password Ajax Request
    $("#forgot-btn").click(function(e){
        if($("#forgot-form")[0].checkValidity()){
            e.preventDefault();
            $("#forgot-btn").val('Παρακαλώ περιμένετε...');
            $.ajax({
                url: 'assets/php/action.php',
                method:'post',
                data: $("#forgot-form").serialize()+'&action=forgot',
                success:function(response){
                    $("#forgot-btn").val('Reset Password');
                    $("#forgot-form")[0].reset();
                    $("#forgotAlert").html(response);
                }
            });
        }
    });

}); 