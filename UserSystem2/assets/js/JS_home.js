window.onload = function() {
    loaddata();
    checkNotification();
};
    
//Εισαγωγή δεδομένων απο το αρχείο read.php με ajax κλήση
function loaddata(){
    //var url = "https://projectuth.000webhostapp.com/user_system/assets/php/read.php";
    var url = 'assets/php/read.php';

    $.getJSON(url, function(data) {
        $.each(Object.keys(data), function(index, name) {
            var temper=(data[name][(Object.keys(data[name]).length)-1]['temperature']);
            var humid=(data[name][(Object.keys(data[name]).length)-1]['humidity']);
            var hygro=(data[name][(Object.keys(data[name]).length)-1]['hygrometer']);
            document.getElementById("temp"+name).innerHTML = temper + "°C";
            document.getElementById("hum"+name).innerHTML = humid + "%";
            document.getElementById("hygro"+name).innerHTML = hygro + "%";
            
            wf = "";
            $.each(data[name], function(index, value) {
                wf += '<tr>'
                    wf += "<td>" +value["temperature"] +" %</td>"
                    wf += "<td>" +value["humidity"] +" %</td>"
                    wf += "<td>" +value["hygrometer"] +" %</td>"
                    wf += "<td>" +value["created_at"] + '</td>'
                wf += '</tr>'
            }); //Προβολή δεδομένων σε πίνακα
        
            $("#showData"+name).html(wf);
        });
        
        $("table").DataTable({
            order: [0,'desc']
        });
    });
}

 //Check Notification
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
