<?php
    require_once 'assets/php/header.php';
    
    $output = '';
    if ($systemsUser){
        foreach($systemsUser as $row){
            $output .= '
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-deck my-3">
                        <div class="card border-warning">
                            <div class="card-header bg-warning text-center text-white ">
                                <p class="h5">Διάγραμματα για '.$row['name'].'</p>
                            </div>
                            <div class="card-body">
                                <!--Επιλογή Δεδομένων Εμφάνισης Απο τον Χρήστη-->
                                <div class="form-group">
                                    
                                </div>
                                <div class="chart-container">
                                    <canvas id="chart'.$row['name'].'"width="700" height="300"></canvas>
                                </div>
                            </div>                
                        </div>
                    </div>
                </div>
            </div>';  
        }
    }else{
        echo $method-> showMessage('warning','Δεν υπάρχουν Συστήματα Προς το Παρόν',false);
    }	
    echo $output;
?>

<!--Footer...-->	
</div>
</div>
</div>
<!--...Area-->
<script src="assets/js/JS_charts.js" type="text/javascript"></script>
