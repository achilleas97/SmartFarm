$(document).ready(function(){
    //Profile Update Ajax Request
    $("#profile-update-form").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'assets/php/process.php',
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(this),
            success:function(response){
                location.reload();
            }
        })
    });

    //Change Password Ajax Request
    $("#changePassBtn").click(function(e){
        if ($("#change-pass-form")[0].checkValidity()){
            e.preventDefault();
            $("#changePassBtn").val('Παρακαλώ περιμένετε...');
            if ($("#newpass").val() != $("#cnewpass").val()){
                $("#changepassError").text('* Ο κώδικός δεν ταιριάζει!');
                $("#changePassBtn").val('Αλλάγή κωδικού');
            }
            else{
                $.ajax({
                    url: 'assets/php/process.php',
                    method: 'post',
                    data: $("#change-pass-form").serialize()+'&action=change_pass',
                    success:function(response){
                        $("#changepassAlert").html(response);
                        $("#changePassBtn").val('Αλλαγή κωδικού');
                        $("#changepassError").text('')
                        $("#change-pass-form")[0].reset();								
                    }
                });
            }
        }
    });

     //Check Notification
     checkNotification();
     function checkNotification(){
         $.ajax({
             url: 'assets/php/process.php',
             method: 'post',
             data: {action: 'checkNotification'},
             success:function(response){
                 $("#checkNotification").html(response);
             }
         });
     }
});