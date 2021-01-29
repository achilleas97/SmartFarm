<?php
	require_once 'assets/php/header.php';
?>

	<div class="card my-4 border-warning">
		<h5 class="card-header bg-warning d-flex justify-content-between">
			<span class="text-light align-self-center"><h5>Όλες οι σημειώσεις</h5></span>
			<a href="#" class="btn btn-light" data-toggle="modal" data-target="#addNoteModal"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Προσθήκη Σημείωσης</a>
		</h5>
		<div class="card-body">
			<div class="table-responsive" id="showNote">
				<p class= "text-center lead mt-5">Παρακαλώ Περιμένετε</p>			
			</div>
		</div>
		
		<!--Start add new note modal-->
		<div class="modal fade" id="addNoteModal">
			<div class="modal-dialog modal-dialog-centered"> 
				<div class="modal-content">
					<div class="modal-header bg-success">
						<h4 class="modal-title text-light">Προσθέστε καινούρια σημείωση</h4>
						<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form action="#" method="post" id="add-note-form" class="px-3">
							<div class="form-group">
								<input type="text" name="title" class="form-control form-control-lg" placeholder="Προσθήκη Τίτλου" required>
							</div>
							<div class="form-group">
								<textarea name="note" class="form-control form-control-lg" 	placeholder="Γράψτε την σημείωση σας εδώ..." rows="6" required></textarea>
							</div>
							<div class="form-group">
								<input type="submit" name="addNote" id="addNoteBtn" value="Προσθήκη σημείωσης" class="btn btn-success btn-block btn-lg">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--End add new note modal-->


		<!--Start edit note modal-->
		<div class="modal fade" id="editNoteModal">
			<div class="modal-dialog modal-dialog-centered"> 
				<div class="modal-content">
					<div class="modal-header bg-info">
						<h4 class="modal-title text-light">Επεξεργασία Σημείωσης</h4>
						<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form action="#" method="post" id="edit-note-form" class="px-3">
							<input type="hidden" name="id" id="id">
							<div class="form-group">
								<input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Προσθήκη Τίτλου" required>
							</div>
							<div class="form-group">
								<textarea name="note" id="note" class="form-control form-control-lg" 	placeholder="Γράψτε την σεμείωση σας εδώ..." rows="6" required></textarea>
							</div>
							<div class="form-group">
								<input type="submit" name="editNote" id="editNoteBtn" value="Ενημέρωση σημείωσης" class="btn btn-info btn-block btn-lg">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--End add new note modal-->
	</div>
</div>

<!--Footer...-->
</div>
</div>
</div>
<!--...Area-->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript" src="assets/js/JS_notes.js"></script>