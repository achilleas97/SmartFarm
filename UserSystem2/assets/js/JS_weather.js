$(document).ready(function(event) {
    performSearch(event); 
    checkNotification();
});
  
function performSearch(event) {
    var key = ""; 
    var city = $("#city").text(); 
    var url1 ="https://api.openweathermap.org/data/2.5/weather"; //url για το πακέτο Current Weather Data
    var url2 ="https://api.openweathermap.org/data/2.5/forecast"; //url για το πακέτο Hourly Forecast 4 days
    var request;
    
    /////////////////////////////////////////////////////////////////////////////////////////
                                    //Current Weather Data//
    /////////////////////////////////////////////////////////////////////////////////////////

    // Send the request
    request = $.ajax({
        url: url1,
        type: "GET",
        data: { 
        q:city, 
        appid: key, 
        units: 'metric'
        }
    });
    
    // Callback handler for success
    request.done(function (response){
        formatResults(response);
    });

    //εισαγωγή δεδομένων απο json στα αντίστοιχα πεδία
    function formatResults(jsonObject) {
        var city_weather = jsonObject.weather[0].main;
        var city_temp = jsonObject.main.temp;
        var imgurl  = 'https://openweathermap.org/img/wn/' + jsonObject.weather[0].icon + '@2x.png';
    
        $("img").attr('src', imgurl);
        $("#city-weather").text(city_weather);
        $("#city-temp").text(city_temp+" Celsius");  
    }
       
    /////////////////////////////////////////////////////////////////////////////////////////
                                    //Hourly Forecast 4 days//
    /////////////////////////////////////////////////////////////////////////////////////////

    // Send the request
    request2 = $.ajax({
        url: url2, //API Call
        dataType: "json",
        type: "GET",
        data: {
        q: city,
        appid: key,
        lang: "el",
        units: "metric",
        cnt: "40"
        },
    });

    // Callback handler for success
    request2.done(function (response){
        format(response);
    });

    //εισαγωγή δεδομένων απο json και προβολή τους σε πίνακα
    function format(data) {
        var wf = "";
        var d = []; //πίνακας με ημερομηνίες
        $.each(data.list, function(index, val) {
            var date = new Date (val.dt_txt);
            var options = { hour12: false, timeStyle: "short"}; //format date 
            var options2 = {weekday:"long", month:"short", day:"2-digit"}; //format Date
            var Direction = val.wind.deg; //format ταχύτητας και κατεύθηνσης ανέμου
            d[index] = date.toLocaleDateString("el-GR", options2);
            //έλεγχος εάν υπάρχει αλαγή ημέρας και επιστροφή πίνακα
            if(d[index] != d[index-1]){
                wf += '<thead class="thead-dark">'
                wf += "<tr>" 
                wf += '<th colspan="2">'+ date.toLocaleDateString("el-GR", options2)+"</th>"
                wf += "<th></th>"
                wf += "<th></th>"
                wf += "<th></th>"
                wf += "<th></th>"
                wf += "<th></th>"
                wf += "</tr>"
                wf += '</thead>'
                wf += '<tbody>'
                wf += '<tr>'
                wf += "<td>" + date.toLocaleTimeString("el-GR", options) + "</td>" // Day
                wf += "<td>" + (val.main.temp).toFixed(0) + "&degC"+"</td>" // Temperature
                wf += "<td>" + val.main.humidity + '% <span class ="small">υγρ</span>.</td>' //humidity
                wf += "<td>" + (val.wind.speed *3.6).toFixed(0) + ' km/h' +"<br>"+ getCardinalDirection(Direction) + '</td>'//speed wind 
                wf += "<td>" + val.weather[0].description + "</td>"; // Description
                wf += "<td><img src='https://openweathermap.org/img/w/" + val.weather[0].icon + ".png'>"+"</td>" // Icon
                wf += '</tr>'
                wf += '</tbody>'
            }
            else{
                wf += '<tbody>'
                wf += '<tr>'
                wf += "<td>" + date.toLocaleTimeString("el-GR", options) + "</td>" // Day
                wf += "<td>" + (val.main.temp).toFixed(0) + "&degC"+"</td>" // Temperature
                wf += "<td>" + val.main.humidity + '% <span class ="small">υγρ</span>.</td>' //humidity
                wf += "<td>" + (val.wind.speed *3.6).toFixed(0) + ' km/h' +"<br>"+ getCardinalDirection(Direction) + '</td>'//speed wind 
                wf += "<td>" + val.weather[0].description + "</td>"; // Description
                wf += "<td><img src='https://openweathermap.org/img/w/" + val.weather[0].icon + ".png'>"+"</td>" // Icon
                wf += '</tr>'
                wf += '</tbody>'
            }
        });
   
        $("#showWeatherForcast").html(wf);
    }
    
    //Συνάρτηση για τη κατευθηνση του ανέμου σε συμβολισμούς από μοίρες
    function getCardinalDirection(Direction) {
        const directions = ['↑ Β', '↗ ΒΑ', '→ Α', '↘ ΝΑ', '↓ Ν', '↙ ΝΔ', '← Δ', '↖ ΒΔ'];
        return directions[Math.round(Direction / 45) % 8];
    }
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