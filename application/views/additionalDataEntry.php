<?php
$this->load->view("./templates/header.php")
?>

<div class="page-header-breadcrumb">
	<ul class="breadcrumb-title">
		<li class="breadcrumb-item">
			<a href="<?php echo base_url(); ?>MsoMonthlyReview/indexController/dashboard"><i class="ti-home"></i> Dashboard</a>
		</li>
		<li class="breadcrumb-item">
			<a>Additional Data</a>
		</li>
	</ul>
</div>


<form class="form-material" id="additionalDataForm" method="post" action="<?php echo base_url(); ?>/indexController/submitAdditionalData">
	<div class="main-body">
		<div class="page-wrapper">
			<div class="page-body">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header" data-toggle="collapse" data-target="#opcodetails" aria-expanded="true" aria-controls="opcodetails" style="cursor:pointer;">
								<h5>OPCO DETAILS</h5>
							</div>
							<div id="opcodetails" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-block">
									<div class="row form-group">
										<div class="col-md-4">
											<select class="form-control" name="opco_name" id="opco_name">
												<option value="">Select Opco</option>
											</select>
										</div>
										<div class="col-md-4">
											<select class="form-control" name="month" id="month">
												<option value="">Select Month</option>
												<option value="1">January</option>
												<option value="2">February</option>
												<option value="3">March</option>
												<option value="4">April</option>
												<option value="5">May</option>
												<option value="6">June</option>
												<option value="7">July</option>
												<option value="8">August</option>
												<option value="9">September</option>
												<option value="10">October</option>
												<option value="11">November</option>
												<option value="12">December</option>
											</select>
										</div>
										<div class="col-md-4">
											<input class="form-control" type="text" name="year" id="year" />
										</div>
										<div class="col-md-4 mt-3" data-toggle="modal" data-target="#addNewOpcoModal">
											<a class="btn btn-primary" style="color:white">Add New Opco</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header" style="cursor:pointer;" data-toggle="collapse" data-target="#teamsize" aria-expanded="true" aria-controls="teamsize">
								<h5>TEAM SIZE</h5>
							</div>
							<div id="teamsize" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-block">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group row">
												<label style="align-self:end;" class="col-sm-6 col-form-label">Onsite Local</label>
												<div class="col-sm-6">
													<input type="number" onwheel="return false;" onwheel="return false;" class="form-control" id="onsite_local_count" name="onsite_local_count">
												</div>
											</div>
											<div class="form-group row">
												<label style="align-self:end;" class="col-sm-6 col-form-label">Onsite Expat</label>
												<div class="col-sm-6">
													<input type="number" onwheel="return false;" onwheel="return false;" class="form-control" id="onsite_expat_count" name="onsite_expat_count">
												</div>
											</div>
											<div class="form-group row">
												<label style="align-self:end;" class="col-sm-6 col-form-label">Offshore Local</label>
												<div class="col-sm-6">
													<input type="number" onwheel="return false;" onwheel="return false;" class="form-control" id="offshore_local_count" name="offshore_local_count">
												</div>
											</div>
											<div class="form-group row">
												<label style="align-self:end;" class="col-sm-6 col-form-label">Offshore Expat</label>
												<div class="col-sm-6">
													<input type="number" onwheel="return false;" onwheel="return false;" class="form-control" id="offshore_expat_count" name="offshore_expat_count">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">
							<div class="card-header" style="cursor:pointer;" data-toggle="collapse" data-target="#effort_utilization_profitability" aria-expanded="true" aria-controls="effort_utilization_profitability">
								<h5>HEALTH / EFFORT / UTILIZATION / PROFITABILITY</h5>
							</div>
							<div id="effort_utilization_profitability" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-block">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group row">
												<label style="align-self:end;" class="col-sm-6 col-form-label">Overall Health</label>
												<div class="col-sm-6">
													<select class="form-control" id="overall_health" name="overall_health">
														<option value="">Select Health</option>
														<option value="green">Green</option>
														<option value="amber">Amber</option>
														<option value="red">Red</option>
													</select>
												</div>
											</div>
											<div class="form-group row">
												<label style="align-self:end;" class="col-sm-6 col-form-label">Effort in PMS</label>
												<div class="col-sm-6">
													<input type="text" class="form-control" id="efforts" name="efforts">
												</div>
											</div>
											<div class="form-group row">
												<label style="align-self:end;" class="col-sm-6 col-form-label">Utilization %</label>
												<div class="col-sm-6">
													<input type="text" class="form-control" id="utilization" name="utilization">
												</div>
											</div>
											<div class="form-group row">
												<label style="align-self:end;" class="col-sm-6 col-form-label">Profitability (YTD) %</label>
												<div class="col-sm-6">
													<input type="text" class="form-control" id="profitability" name="profitability">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" data-toggle="collapse" data-target="#ongoing_escalations" aria-expanded="true" aria-controls="ongoing_escalations" style="cursor:pointer;">
							<h5>ONGOING ESCALATION</h5>
						</div>
						<div id="ongoing_escalations" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-block">
								<div class="row">
									<div class="col-md-12">
										<table class="table">
											<thead>
												<tr>
													<th>#</th>
													<th>Type</th>
													<th>Description</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="ongoing_escalations_table">
												<tr id="ongoing_escalations_row_0">
													<td style="vertical-align:middle;">
														<select class="form-control" name="ongoing_escalations_details[]" id="ongoing_escalations_detail0">
															<option value="">Select</option>
															<option value="yes">Yes</option>
															<option value="no">No</option>
														</select>
													</td>
													<td style="vertical-align:middle;">
														<select class="form-control" name="ongoing_escalations_status[]" id="ongoing_escalations_status0">
															<option value="">Select Status</option>
															<option value="inprogress">Inprogress</option>
														</select>
													</td>
													<td>
														<textarea class="form-control" placeholder="Description" name="ongoing_escalations_desc[]" id="ongoing_escalations_desc0"></textarea>
													</td>
													<td>
														<a class="btn btn-outline-primary" onclick="addOngoingEscalationRow()">+</a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" data-toggle="collapse" data-target="#id_ch_co" aria-expanded="true" aria-controls="id_ch_co" style="cursor:pointer;">
							<h5>IMPROVEMENTS DONE / CHALLENGES / COMMENTS</h5>
						</div>
						<!--
                                id_ch_co
                                    id : improvements done
                                    ch : challenges
                                    co : comments
                            -->
						<div id="id_ch_co" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-block">
								<div class="row">
									<div class="col-md-12">
										<table class="table">
											<thead>
												<tr>
													<th>Type</th>
													<th>Description</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="id_ch_co_table">
												<tr id="id_ch_co_row_0">
													<td style="vertical-align:middle;">
														<select class="form-control" name="id_ch_co_type[]" id="id_ch_co_type0">
															<option value="">Select Type</option>
															<option value="improvement">Improvememt</option>
															<option value="challenge">Challenge</option>
															<option value="comment">Comment</option>
														</select>
													</td>
													<td>
														<textarea class="form-control" placeholder="Description" name="id_ch_co_desc[]" id="id_ch_co_desc0"></textarea>
													</td>
													<td>
														<a class="btn btn-outline-primary" onclick="addIdChCoRow()">+</a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<input type="submit" class="btn btn-primary">
				</div>
			</div>
		</div>
	</div>
	</div>
</form>
<?php
$this->load->view("./templates/footer.php");
?>
<?php
$this->load->view('./metaDataScript.php');
?>

<script>
	function addIdChCoRow() {
		var row_id = $('#id_ch_co_table tr:last').attr('id')
		var html = `
            <tr id="id_ch_co_row_${parseInt(row_id.split('_')[3])+1}">
                <td style="vertical-align:middle;">
                    <select class="form-control" name="id_ch_co_type[]" id="id_ch_co_type${parseInt(row_id.split('_')[3])+1}">
                        <option value="">Select Summary Type</option>
                        <option value="improvement">Improvement</option>
                        <option value="challenge">Challenge</option>
                        <option value="comment">Comment</option>
                    </select>
                </td>
                <td>
                    <textarea class="form-control" name="id_ch_co_desc[]" id="id_ch_co_desc${parseInt(row_id.split('_')[3])+1}" rows="3"></textarea>
                </td>
                <td>
                    <a class="btn btn-outline-danger" onclick="removeIdChCoRow(${parseInt(row_id.split('_')[3])+1})">X</a>
                </td>
            </tr>
        `;
		$("#id_ch_co_table").append(html);
	}

	function removeIdChCoRow(id) {
		$("#id_ch_co_row_" + id).remove();
	}

	function addOngoingEscalationRow() {
		var row_id = $('#ongoing_escalations_table tr:last').attr('id')
		var html = `
            <tr id="ongoing_escalations_row_${parseInt(row_id.split('_')[3])+1}">
                <td style="vertical-align:middle;">
                    <select class="form-control" name="ongoing_escalations_details[]" id="ongoing_escalations_detail${parseInt(row_id.split('_')[3])+1}">
                        <option value="">Select</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </td>
                <td style="vertical-align:middle;">
                    <select class="form-control" name="ongoing_escalations_status[]" id="ongoing_escalations_status${parseInt(row_id.split('_')[3])+1}">
                        <option value="">Select Status</option>
                        <option value="inprogress">Inprogress</option>
                    </select>
                </td>
                <td>
                    <textarea class="form-control" placeholder="Description" name="ongoing_escalations_desc[]" id="ongoing_escalations_desc${parseInt(row_id.split('_')[3])+1}"></textarea>
                </td>
                <td>
                <a class="btn btn-outline-danger" onclick="removeOngoingEscalationRow(${parseInt(row_id.split('_')[3])+1})">X</a>
                </td>
            </tr>
        `;
		$("#ongoing_escalations_table").append(html);
	}

	function removeOngoingEscalationRow(id) {
		$("#ongoing_escalations_row_" + id).remove();
	}
</script>
