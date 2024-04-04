<!-- <?php
main_header(['user']);
?>
<!-- ############ PAGE START-->
<div class="padding">
	<div class="p-a teal-A700 It box-shadow">
		<div class="row">
			<div class="col-sm-12">
				<p class="m-b-0 _400"><i class="fa fa-book"></i> EDIT ACCOUNT</p>
			</div>
		</div>
	</div>
	<div id="pageMessages"></div>
	<div class='box p-a'>
		<div class="box box-body">
			<div class="b-b nav-active-bg">
				<div class="row">
					<div class="col-sm-4">
						<h4 class="font-weight-bold">Edit Schedule</h4>
						<form>
							<div class="form-group">
								<div class="row">
									<input type="text" class="form-control" id="ID" value="<?=@$details->ID?>" hidden>

									<label>First Name</label>
									<input type="text" class="form-control" id="Fname" value="<?=@$details->Fname?>" placeholder="Enter First Name">
									
									<label>Last Name</label>
									<input type="text" class="form-control" id="Lname" value="<?=@$details->Lname?>" placeholder="Enter Last Name">
								

									<label>Contact Number</label>
									<input type="number" class="form-control" id="Cnum" value="<?=@$details->Cnum?>" placeholder="Enter Contact number">
								</div>
							</div>
						</form>
						<button type="submit" class="btn btn-primary" id="edit">Save edit</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/phonebook/index.js"></script> -->