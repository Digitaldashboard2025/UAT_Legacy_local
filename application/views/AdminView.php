<?php
$this->load->view('./templates/header.php');
?>

<style>
	.search-icon,
	.search-bar {
		background-color: #fff;
		border: none;
		border-radius: 0;
	}

	#searchForm {
        display: flex;
        align-items: center;
    }

    .search-bar {
        flex: 1;
    }

    .search-icon {
        flex-shrink: 0;
    }

	.remove-user,
	.modify-roles {
		margin: 0 10px;
	}

	.user-table {
		background-color: #fff;
		margin: 1% 0;
	}
</style>
<div class="main-body">
	<div class="page-wrapper">
		<div class="page-body">
			<div class="row">
				<div class="col col-md-4">
					<h4 style="margin:0 auto 30px">User Management</h4>
				</div>
				<div class="col col-md-4 text-right">
					<div class="input-group mb-3">
						<form id="searchForm">
							<input type="text" class="form-control search-bar input-group-sm" placeholder="Search User" aria-label="Recipient's username" aria-describedby="button-addon2">
							<button class="search-icon btn-outline-primary btn-sm" type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div>
				</div>

				<div class="col col-md-2 text-right">
					<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addNewOpcoModal" style="color:white">Add New Opco</a>
				</div>

				<div class="col col-md-2 text-right">
					<a style="color:#fff" data-toggle="modal" data-target="#addNewUserModal" class="btn btn-primary btn-sm">Add user</a>
				</div>
			</div>


			<div class="table-div">
				<table id="userTable" class="table table-sm table-borderless user-table">
					<thead class="table-dark">
						<tr>
							<th class="text-center">
								<h6>Emp id</h6>
							</th>
							<th class="text-center">
								<h6>Username</h6>
							</th>
							<th class="text-center">
								<h6>User Role</h6>
							</th>
							<th class="text-center">
								<h6>Actions</h6>
							</th>
						</tr>
					</thead>
					<tbody id="user-table-body">

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
	$(document).ready(function() {
		// Load dynamic content using AJAX when the document is ready
		$.ajax({
			url: "<?php echo base_url('IndexController/loadDynamicContent'); ?>",
			method: "GET",
			dataType: "json", // Specify that the response is JSON
			success: function(response) {
				// Update the table body with the dynamic content
				$('#user-table-body').html(response.content);
			},
			error: function(xhr, status, error) {
				console.log(xhr.responseText);
			}
		});

		// Handle the search form submission
		$('#searchForm').on('submit', function(event) {
			event.preventDefault(); // Prevent default form submission behavior

			// Get the search query from the form input
			var searchQuery = $(this).find('.search-bar').val();

			// Send the search query via AJAX to the searchUser method
			$.ajax({
				url: "<?php echo base_url('IndexController/searchUser'); ?>",
				method: "POST",
				data: {
					search_query: searchQuery
				},
				dataType: "json", // Specify that the response is JSON
				success: function(response) {
					// Update the table body with the search results
					$('#user-table-body').html(response.content);
				},
				error: function(xhr, status, error) {
					console.log(xhr.responseText);
				}
			});
		});
	});
</script>


<?php
$this->load->view('./templates/footer.php');
$this->load->view('./NewUserView.php');
$this->load->view('./metaDataScript.php');
$this->load->view('./LoadNewOpco.php');
?>
