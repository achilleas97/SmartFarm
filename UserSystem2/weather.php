<?php
	require_once 'assets/php/header.php';
	require_once 'assets/php/session.php';
?>
<div class="row justify-content-center my-4">
    <div class="col-lg-12">
            <div class="card text-center border-warning">
                <div class="card-header text-white bg-warning">
                    <h5><b id="city"><?= $nposition;?></b></h5>
                </div>
    			<div class="card-body">                                                
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table" id="showWeatherForcast">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<!--Footer...-->	
</div>
</div>
</div>
<!--...Area-->	

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="assets/js/JS_weather.js" type="text/javascript"></script>