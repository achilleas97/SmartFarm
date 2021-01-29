<?php
    require_once 'assets/php/header.php';
?>
<div class="row justify-content-center">
    <div class="col-lg-12 ">
        <!--Νetwork Card-->
        <div class="card mt-3 border-warning">
            <div class="card-header text-white text-center bg-warning">
                <h5>Δίκτυο Συστημάτων<h5>
            </div>
            <?php 
                $output = '<div class="card-body">';
                if($networkData){
                    $output .= '<div class="card-deck">
                                    <div class="card" id = "tableNetwork">	
                                    </div>
                                </div>';
                }
                else{
                    $output .= '<div class="card-deck">
                                    <div class="card border-success">
                                        <div class="card-header bg-success text-white text-center">
                                        Εισαγωγή Δικτύου
                                        </div>
                                        <form action="#" method="post" class="px-3 mt-2" id="networkForm">
                                            <div class="form-group">
                                                <label for="newNameNet">Όνομα Δικτύου</label>
                                                <input type="txt" name="newNameNet" class="form-control form-control-lg" id="newNameNet" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="newPositionNet">Θέση Δικτύου</label>
                                                <select class="form-control form-control-lg " name="newPositionNet" id="newPositionNet" required>
                                                    <option value="select">select</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="newNetBtn" value="Δημιουργία Δικτύου" class="btn btn-success btn-block btn-lg" id="newNetBtn">
                                            </div>
                                        </form>
                                    </div>
                                </div>';    
                }
                $output .='
                            </div>				
                        </div>';
                echo $output; 
            ?>
        
        <!--System Card-->
        <div class="card mt-3 border-warning">
			<div class="card-header text-white text-center bg-warning">
				<h5>Συστήματα</h5> 
			</div>
            <div class="card-header border">
                <ul class="nav nav-tabs card-header-tabs">
                   <li class="nav-item">
                        <a href="#editSystem" class="nav-link active font-weight-bold" data-toggle="tab">Επεξεργασία Συστημάτων</a> 
                    </li>
                    <li class="nav-item">
                        <a href="#newSystem" class="nav-link font-weight-bold" data-toggle="tab">Εισαγωγή Συστήματος</a> 
                    </li>
                </ul>						
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <!--Edit System Tab Content Start-->
                    <div class="tab-pane container active" id="editSystem">
                        <div class="card-deck">
                            <div class="table-responsive" id = "tableSystems">	       
                            </div>
                        </div>
                    </div> 
                    <!--Edit System Tab Content End-->
                    
                    <!--Created System Tab Content Start -->
                    <div class="tab-pane container fade" id="newSystem">
                        <div id="editSystemAlert"></div>
                        <div class="card-deck">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white text-center">
                                Εισαγωγή Συστήματος
                                </div>
                                <form action="#" method="post" class="px-3 mt-2" id="new-system-form">
                                    <div class="form-group">
                                        <label for="newNameSystem">Όνομα Συστήματος</label>
                                        <input type="txt" name="newNameSystem" class="form-control form-control-lg" id="newNameSystem" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="newMacSystem">Mac Address System</label>
                                        <input type="txt" name="newMacSystem" class="form-control form-control-lg" id="newMacSystem" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="newPositionSystem">Θέση Συστήματος</label>
                                        <select name="newPositionSystem"  class="form-control form-control-lg" id="newPosition" required>
                                            <option value="select">select</option>
                                        <select>
                                    </div>

                                    <div class="form-group">
                                        <p id="changepassError" class="text-danger"></p>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" name="newSystem" value="Δημιουργία Συστήματος" class="btn btn-success btn-block btn-lg" id="newSystemBtn">
                                    </div>
                                </form>
                            </div>
                        </div>								
                    </div>
                    <!--Created System Tab Content End -->
                </div>
            </div>					
        </div>

        <!--Start edit system modal-->
        <div class="modal fade" id="editSystemModal">
            <div class="modal-dialog modal-dialog-centered"> 
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h4 class="modal-title text-light">Επεξεργασία Συστήματος</h4>
                        <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    <form action="" method="post" class="px-3 mt-2" id="system-update-form">
						<input type="hidden" name="idSystem" id="idSystem">
                        <div class="form-group ">
                            <label for="nameSystem">Όνομα Συστήματος</label>
                            <input type="text" name="nameSystem" id="nameSystem" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="positionSystem">Θέση Συστήματος</label>
                            <select name="positionSystem" id="positionSystem" class="form-control form-control-lg">
                                <option value="select">select</option>
                            <select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="systems_update" value="Αποθήκευση Συστήματος" class="btn btn-primary btn-block btn-lg" id="SystemUpdateBtn">
                        </div>
                    </form>	
                    </div>
                </div>
            </div>
        </div>
		<!--End add system modal--> 

         <!--Start edit network modal-->
         <div class="modal fade" id="editNetworkModal">
            <div class="modal-dialog modal-dialog-centered"> 
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h4 class="modal-title text-light">Επεξεργασία Δικτύου</h4>
                        <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    <form action="" method="post" class="px-3 mt-2" id="network-update-form">
						<input type="hidden" name="idNet" id="idNet">
                        <div class="form-group ">
                            <label for="nameNet">Όνομα Δικτύου</label>
                            <input type="text" name="nameNet" id="nameNet" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="positionNet">Θέση Δικτύου</label>
                            <select class="form-control form-control-lg" name="positionNet" id="positionNet" required>
                                <option value="select">select</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="network_update" value="Αποθήκευση Δικτύου" class="btn btn-primary btn-block btn-lg" id="NetUpdateBtn">
                        </div>
                    </form>	
                    </div>
                </div>
            </div>
        </div>
		<!--End add network modal--> 
    </div>
</div>
<!--Footer...-->
</div>
</div>
</div>
<!--...Area-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="assets/js/JS_system.js" type="text/javascript"></script>

