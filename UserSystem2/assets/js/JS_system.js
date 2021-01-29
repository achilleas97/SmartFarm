$(document).ready(function(){

    //Display Network 
    displayNetwork();
    function displayNetwork(){
        $.ajax({
            url: 'assets/php/process.php',
            method: 'post',
            data: {action: 'displayNetwork'},
            success:function(response){
                $("#tableNetwork").html(response);
            } 
        });
    }		

    //Edit Network
    $("body").on("click",".editNetworkBtn",function(e){
        e.preventDefault();
        editNet = $(this).attr('id');

        $.ajax({
            url: 'assets/php/process.php',
            method:'post',
            data:{ editNet: editNet },
            success:function(response){
                data = JSON.parse(response);
                $("#idNet").val(data.id);
                $("#nameNet").val(data.name);
                $("#positionNet").val(data.position);
            }
        });
    });

    //update Network
    $("#NetUpdateBtn").click(function(e){
        if($("#network-update-form")[0].checkValidity()){
            e.preventDefault();
            $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: $("#network-update-form").serialize()+"&action=updateNet",
                success:function(response){
                    Swal.fire({
                        title: 'Το Δίκτυο αποθηκεύτηκε επιτυχώς!',
                        type: 'success'
                    });
                    $("#network-update-form")[0].reset();
                    $("#editNetworkModal").modal('hide');
                    displayNetwork();						
                }
            });
        }
    });

    //Add New Network 
    $("#newNetBtn").click(function(e){
        if($("#networkForm")[0].checkValidity()){
            e.preventDefault();
            $("#newNetBtn").val('Παρακαλώ Περιμένετε...');
            $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: $("#networkForm").serialize()+'&action=addNetwork',
                success:function(response){ 
                    if(response.trim() === 'ok'){
                        Swal.fire({ 
                            title: 'Το σύστημα προστέθηκε επιτυχώς!',
                            type: 'success'
                        });
		            }
                    else if(response.trim() === 'problemNet'){
                        Swal.fire({ 
                            title: 'Ανεπιτυχής Προσθήκη Δικτύου! Δεν γίνεται να εισάγεται παραπάνω από ένα δίκτυο!',
                            type: 'error'
                        });
                    }else{
                        Swal.fire({ 
                            title: 'Κάτι πήγε στραβά, παρακαλώ ξαναπροσπαθήστε',
                            type: 'error'
                        });
                    }
                    
                    $("#newNetBtn").val('Δημιουργία Συστήματος');
                    $("#networkForm")[0].reset();
                    location.reload();                      
                }
            });
            displayNetwork();    
        }
    });    

    //Add New System 
    $("#newSystemBtn").click(function(e){
        if($("#new-system-form")[0].checkValidity()){
            e.preventDefault();
            $("#newSystemBtn").val('Παρακαλώ Περιμένετε...');
            $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: $("#new-system-form").serialize()+'&action=add_system',
                success:function(response){
                    $("#newSystemBtn").val('Δημιουργία Συστήματος');
                    $("#new-system-form")[0].reset();  
                    
		            if(response.trim() === 'ok'){
                        Swal.fire({ 
                            title: 'Το σύστημα προστέθηκε επιτυχώς!',
                            type: 'success'
                        });
		            }
                    else if(response.trim() === 'problemNet'){
                        Swal.fire({ 
                            title: 'Ανεπιτυχής Προσθήκη Συστήματος! Παρακαλώ εισάγετε πρώτα το δίκτυο σας!',
                            type: 'error'
                        });
                    }else{
                        Swal.fire({ 
                            title: 'Ανεπιτυχής Προσθήκη Συστήματος! Παρακαλώ εισάγετε έγκυρα στοιχεία!',
                            type: 'error'
                        });
                    }
                    displaySystems();    
                }
            });
        }
    });    

    displaySystems();
    //Display Systems 
    function displaySystems(){
        $.ajax({
            url: 'assets/php/process.php',
            method: 'post',
            data: {action: 'displaySystems'},
            success:function(response){
                $("#tableSystems").html(response);
            } 
        });
    }		


    //Edit System
    $("body").on("click",".editBtn",function(e){
        e.preventDefault();
        editSystem = $(this).attr('id');

        $.ajax({
            url: 'assets/php/process.php',
            method:'post',
            data:{ editSystem: editSystem },
            success:function(response){
                data = JSON.parse(response);
                $("#idSystem").val(data.id);
                $("#nameSystem").val(data.name);
                $("#positionSystem").val(data.position);
            }
        });
    });

    //update System
    $("#SystemUpdateBtn").click(function(e){
        if($("#system-update-form")[0].checkValidity()){
            e.preventDefault();
            $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: $("#system-update-form").serialize()+"&action=updateSystem",
                success:function(response){
                    Swal.fire({
                        title: 'Το σύστημα αποθηκεύτηκε επιτυχώς!',
                        type: 'success'
                    });
                    $("#system-update-form")[0].reset();
                    $("#editSystemModal").modal('hide');
                    displaySystems();						
                }
            });
        }
    });

    //Deleted System
    $("body").on("click", ".deleteBtn", function(e){
        e.preventDefault();
        delSystem = $(this).attr('id');
        Swal.fire({
            title: 'Είστε σίγουρος;',
            text: "Δεν θα μπορέσετε να επαναφέρετε τo σύστημα!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ναι, διαγραφή!'
        }).then((result) => {
            if (result.value) {		
                $.ajax({
                    url: 'assets/php/process.php',
                    method: 'post',
                    data: { delSystem: delSystem},
                    success:function(response){
                        Swal.fire(
                            'Deleted!',
                            'Το σύστημα διαγράφηκε με επιτυχία!',
                            'success'
                        )
                        displaySystems();
                    }
                });
            }	
        })
    });

    $.getJSON('assets/js/location.json', function(data) {
        $.each(data, function(key, value){
            //For Network. (Edit,Update)
            $('#newPositionNet').append('<option value="'+value.position+'">'+value.name+' | <span class="text-muted">'+value.position+'</span></position>');
            $('#positionNet').append('<option value="'+value.position+'">'+value.name+' | <span class="text-muted">'+value.position+'</span></position>');
            //For System. (Edit,Update)
            $('#newPosition').append('<option value="'+value.position+'">'+value.name+' | <span class="text-muted">'+value.position+'</span></position>');
            $('#positionSystem').append('<option value="'+value.position+'">'+value.name+' | <span class="text-muted">'+value.position+'</span></position>');
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
