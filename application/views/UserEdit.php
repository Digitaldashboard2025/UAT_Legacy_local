<div class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="permissionModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="permissionModalLabel">Edit user details</h5>

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
									<input type="number" required placeholder="5 digit number" class="form-control" id="new_empid" name="new_empid">
								</div>
							</div>

							<div class="form-group row">
								<label style="align-self:end;" class="col-sm-6 col-form-label">Full name</label>
								<div class="col-sm-6">
									<input type="text" required placeholder="Full name" class="form-control" id="new_user_fullname" name="new_user_fullname">
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
								<label style="align-self:end;" class="col-sm-6 col-form-label">Opco name</label>
							</div>
						</div>

						<div class="col-md-6">

							<div class="form-group row">
								<label style="align-self:end;" class="col-sm-6 col-form-label">User role</label>
								<div class="col-sm-6">
									<input type="text" required placeholder="User role" class="form-control" id="new_user_role" name="new_user_role">
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
								<label style="align-self:end;" class="col-sm-4 col-form-label">Permissions:</label>

								<div class="col-sm-3">
									<label style="align-self:end;" class="col-form-label">Read</label>
									<input type="checkbox" id="read_permission" value="read" name="read_permission">
								</div>
								<div class="col-sm-3">
									<label style="align-self:end;" class="col-form-label">Write</label>
									<input type="checkbox" id="write_permission" value="write" name="write_permission">
								</div>
							</div>

							<!-- Add this code snippet to your NewUserView.php -->
							<div class="form-group row">
								<div class="col-sm-12">
									<div class="dropdown">
										<button class="form-control dropdown-toggle" type="button" id="opcoDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Select Opco(s)
										</button>
										<div class="dropdown-menu" aria-labelledby="opcoDropdown">
											<div class="scrollable-dropdown" id="opco_checkboxes_container">
												<!-- Checkboxes will be dynamically added here -->
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-sm-12 text-right">
									<input type="submit" class="btn btn-primary" onclick="updateUserData()" style="color:white">
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	function addNewUser(formData) {
		$.ajax({
			type: "POST",
			url: '<?php echo site_url('IndexController/updateUserData') ?>',
			data: formData,
			success: function(data) {
				$('#newUserForm')[0].reset();
			}
		});
	}

	document.addEventListener('DOMContentLoaded', function() {
		// Get the modal element
		var modal = document.getElementById('permissionModal');
		// Get the placeholders for user name and empid
		var userNamePlaceholder = document.getElementById('user-name-placeholder');
		var empIdPlaceholder = document.getElementById('emp-id-placeholder');

		// Get all the "Permissions" buttons
		var permissionsButtons = document.querySelectorAll('#userEditButton');
		// Add click event listeners to each "Permissions" button
		permissionsButtons.forEach(function(button) {
			button.addEventListener('click', function() {
				// Get the user's name and empid from data attributes of the clicked button
				var userName = this.dataset.userName;
				var empId = this.dataset.empId;

				// Update the content in the modal placeholders
				userNamePlaceholder.textContent = userName;
				empIdPlaceholder.textContent = empId;
			});
		});

		// Close the modal when the close button is clicked
		var closeButton = modal.querySelector('.close');
		closeButton.addEventListener('click', function() {
			modal.style.display = 'none';
		});
	});
</script>
