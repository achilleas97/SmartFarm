$(document).ready(function(){
    //Fetch Notificcation of an User
    fetchNotification();
    function fetchNotification(){
        $.ajax({
            url: 'assets/php/process.php',
            method: 'post',
            data:{ action: 'fetchNotification'},
            success:function(response){
                $("#showAllNotification").html(response);
            }
        });
    }

    //Remove Notification 
    $("body").on("click", ".close", function(e){
        e.preventDefault();
        notification_id = $(this).attr('id');
        $.ajax({
            url: 'assets/php/process.php',
            method: 'post',
            data: {notification_id: notification_id},
            success:function(response){	
                fetchNotification();
                checkNotification();
            }
        });
    });

    //insert rulle
    $("#BtnInsertRulle").click(function(e){
        if ($("#FormRulles")[0].checkValidity()){
            e.preventDefault();
            $.ajax({
                url: 'assets/php/process.php', 
                method: 'post', 
                data: $("#FormRulles").serialize()+'&action=rulles',
                success: function(response){
                    displayRulles();
                    location.reload(); 
                }
            });
        }
    });

    displayRulles();
    //Display Rulles 
    function displayRulles(){
        $.ajax({
            url: 'assets/php/process.php',
            method: 'post',
            data: {action: 'displayRulles'},
            success:function(response){
                $("#showTableRulles").html(response);
            } 
        });
    }
    
    //Deleted Rulles
    $("body").on("click", ".deleteBtn", function(e){
        e.preventDefault();
        delRulle = $(this).attr('id');
        $.ajax({
            url: 'assets/php/process.php',
            method: 'post',
            data: { delRulle: delRulle},
            success:function(response){
                displayRulles();
                location.reload();
            }
        });
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