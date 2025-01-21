<div class="modal fade" id="addNewUserModal" tabindex="-1" role="dialog" aria-labelledby="addNewUserModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addNewUserModalLabel">Add New User</h5>

				<button type="button" class="close" data-dismOpcoFormiss="modal" aria-label="Close">
					<span data-dismiss="modal" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-material" id="newUserForm" method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label style="align-self:end;" class="col-sm-6 col-form-label">Employee ID</label>
								<div class="col-sm-6">
									<input type="number" onwheel="return false;" required placeholder="5 digit number" class="form-control" id="new_empid" name="new_empid">
								</div>
							</div>
							<div class="form-group row">
                                <label style="align-self:end;" class="col-sm-6 col-form-label">First name</label>
                                <div class="col-sm-6">
                                    <input type="text" required placeholder="First name" class="form-control" id="new_user_firstname" name="new_user_firstname">
                                </div>
                            </div>
							<div class="form-group row">
								<label style="align-self:end;" class="col-sm-6 col-form-label">E-mail id</label>
								<div class="col-sm-6">
									<input type="email" required placeholder="E-mail id" class="form-control" id="new_user_email" name="new_user_email">
								</div>
							</div>
							<div class="form-group row">
								<label style="align-self:end;" class="col-sm-6 col-form-label">Designation</label>
								<div class="col-sm-6">
									<input type="text" required placeholder="Designation" class="form-control" id="new_user_designation" name="new_user_designation">
								</div>
							</div>
							<div class="form-group row">

								<label style="align-self:end;" class="col-sm-6 col-form-label">Permissions</label>

								<div class="col-sm-3">

									<select class="form-control" name="read_permission" id="read_permission">

										<option value="">Read</option>

										<option value="YES">YES</option>

										<option value="NO">NO</option>
									</select>
								</div>

								<div class="col-sm-3">

									<select class="form-control" name="write_permission" id="write_permission">

										<option value="">Write</option>

										<option value="YES">YES</option>

										<option value="NO">NO</option>

									</select>

								</div>
							
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group row">
								<label style="align-self:end;" class="col-sm-6 col-form-label">User role</label>
								<div class="col-sm-6">
									<select class="form-control" name="new_user_role" id="new_user_role">
										<option value="">Role</option>
										<option value="User">User</option>
										<option value="TL">Team Lead</option>
										<option value="Manager">Manager</option>
										<option value="HOO">Head of Operation</option>
										<option value="Director">Director</option>
										<option value="BUH">BU Head</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
                                <label style="align-self:end;" class="col-sm-6 col-form-label">Last Name</label>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="Last name" class="form-control" id="new_user_lastname" name="new_user_lastname" required>
                                </div>
                            </div>
							<div class="form-group row">
								<label style="align-self:end;" class="col-sm-6 col-form-label">Reporting manager</label>
								<div class="col-sm-6">
									<input type="text" placeholder="Reporting manager" class="form-control" id="new_user_manager" name="new_user_manager" required>
								</div>
							</div>
							<div class="form-group row">
								<label style="align-self:end;" class="col-sm-6 col-form-label">Nova ID</label>
								<div class="col-sm-6">
									<input type="text" placeholder="Nova ID" class="form-control" id="new_user_nova" name="new_user_nova" required>
								</div>
							</div>
							<div class="form-group row">
								<label style="align-self:end;" class="col-sm-6 col-form-label">Opco name</label>
								<div class="col-sm-6">
									<input type="text" placeholder="Opco name" class="form-control" id="new_user_OpCo" name="new_user_OpCo" required>
								</div>
							</div>
							
						</div>
					</div>
					<div class="form-group row">
                        <div class="col-sm-6 text-centre">
                        </div>
                        <div class="col-sm-3 text-centre">
                        </div>
                        <div class="col-sm-3 text-centre">
                            <!-- <button type="submit" class="btn btn-primary" data-dismiss="modal" onclick="addNewUser()" style="color:white">Add User</button> -->
                            <input type="submit" class="btn btn-primary" onclick="addNewUser()" style="color:white">
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	function addNewUser() {
		$.ajax({
			type: "POST",
			url: '<?php echo site_url('IndexController/addNewUser') ?>',
			data: $("#newUserForm").serialize(),
			success: function(data) {
				document.getElementById("#newUserForm").reset();
				console.log("Successfully added!")
			}
		});
	}
</script>

<!--var option = ''
				option = option + '<option value="' + opcoCode + '" selected>' + ($("#new_opco_name").val()) + '</option>';
				$("#opco_name").append(option)-->