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
            var dataTemp = []; //Πίνακας Θερμοκρασίας Περιβάλλοντος
            var dataHum = []; //Πίνακας Υγρασίας Περιβάλλοντος
            var dataHygro = []; //Πίνακας Υγρασίας Εδάφους
            var labels = []; //Πίνακας Ημερομηνιών εισαγωγής δεδομένων
            
            $.each(data[name], function(index,val){
                dataHum.push(val["humidity"]);
                dataTemp.push(val["temperature"]);   
                dataHygro.push(val["hygrometer"]);
                labels.push(val["created_at"]);
            });         
            
            var ctx = document.getElementById("chart"+name).getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels.slice(-30),
                    datasets: [
                        {
                            label: 'Θερμοκρασία °C',
                            data: dataTemp.slice(-30),
                            borderColor: 'rgba(255,0,0,0.7)',
                            backgroundColor: 'rgba(0,0,0,0)',
                        },
                        {
                            label: 'Υγρασία Περιβάλλοντος %',
                            data: dataHum.slice(-30),
                            borderColor: 'rgba(0, 0, 255, 0.7)',
                            backgroundColor: 'rgba(0,0,0,0)',
                            type: 'line'
                        },
                        {
                            label: 'Υγρασία  Εδάφους %',
                            data: dataHygro.slice(-30),
                            borderColor: 'rgba(61, 151, 55, 0.7)',
                            backgroundColor: 'rgba(0, 0, 0,0)',
                            type: 'line'
                        },
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function (value, index, values) {
                                    return (value).toFixed(2);
                                }
                            }
                        }]
                    },
                }
            });                          
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
