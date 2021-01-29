$(document).ready(function(){
    //Add New Note Ajax Request
    $("#addNoteBtn").click(function(e){
        if($("#add-note-form")[0].checkValidity()){
            e.preventDefault();
            $("#addNoteBtn").val('Παρακαλώ Περιμένετε...');
            $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: $("#add-note-form").serialize()+'&action=add_note',
                success:function(response){
                    $("#addNoteBtn").val('Προσθήκη σημείωσης');
                    $("#add-note-form")[0].reset();
                    $("#addNoteModal").modal('hide'); 
                    Swal.fire({
                        title:'Η σημείωση προσθέθηκε επιτυχώς!',
                        type: 'success'
                    });
                    displayAllNotes();
                }
            });
        }
    });

    //Edit Note of An User Ajax Request
    $("body").on("click",".editBtn",function(e){
        e.preventDefault();
        edit_id = $(this).attr('id');

        $.ajax({
            url: 'assets/php/process.php',
            method:'post',
            data:{ edit_id: edit_id },
            success:function(response){
                data = JSON.parse(response);
                $("#id").val(data.id);
                $("#title").val(data.title);
                $("#note").val(data.note);
            }
        });
    });

    //Update Note of an User Ajax Request
    $("#editNoteBtn").click(function(e){
        if($("#edit-note-form")[0].checkValidity()){
            e.preventDefault();
            $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: $("#edit-note-form").serialize()+"&action=update_note",
                success:function(response){
                    Swal.fire({
                        title: 'Η σημείωση αποθηκεύτηκε επιτυχώς!',
                        type: 'success'
                    });
                    $("#edit-note-form")[0].reset();
                    $("#editNoteModal").modal('hide');
                    displayAllNotes();						
                }
            });
        }
    });

    //Delete a Note of An User Ajax Request
    $("body").on("click", ".deleteBtn", function(e){
        e.preventDefault();
        del_id = $(this).attr('id');
        Swal.fire({
            title: 'Είστε σίγουρος;',
            text: "Δεν θα μπορέσετε να επαναφέρετε την σημείωση!",
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
                    data: { del_id: del_id 	},

                    success:function(response){
                        Swal.fire(
                            'Deleted!',
                            'Η σημείωση διαγράφηκε με επιτυχία!',
                            'success'
                        )
                        displayAllNotes();
                    }
                });
            }	
        })
    });

    //Display All Note of an User
    $("body").on("click",".infoBtn", function(e){
        e.preventDefault();
        info_id = $(this).attr('id');
        $.ajax({
            url: 'assets/php/process.php',
            method: 'post',
            data:{ info_id: info_id},
            success:function(response){
                data = JSON.parse(response);
                console.log(response);
                Swal.fire({
                    title: '<strong>Τίτλος: '+data.title+'</strong>',
                    type: 'info',
                    html: '<b>Σημείωση: </b>'+data.note+'<br> </br><b>Γράφτηκε στις:  </b>'+data.created_at+'<br> </br><b>Ενημερώθηκε στις:  </b>'+data.update_at,
                    showCloseButton: true,
                });
            } 
        });
    });

    displayAllNotes();
    //Display All Note of an User 
    function displayAllNotes(){
        $.ajax({
            url: 'assets/php/process.php',
            method: 'post',
            data: {action: 'display_notes'},
            success:function(response){
                $("#showNote").html(response);
                $("table").DataTable({
                    order: [0,'desc']
                });
            } 
        });
    }

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