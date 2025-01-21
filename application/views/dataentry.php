<?php
$this->load->view('./templates/header.php');
?>
<div class="page-header-breadcrumb">
	<ul class="breadcrumb-title">
		<li class="breadcrumb-item">
			<a href="<?php echo base_url(); ?>MsoMonthlyReview/indexController/dashboard"><i class="ti-home"></i> Dashboard</a>
		</li>
		<li class="breadcrumb-item">
			<a>Monthly Data</a>
		</li>
	</ul>
</div>
<form class="form-material" id="dataForm" method="post" action="<?php echo base_url(); ?>/indexController/submitData">
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
											<select class="form-control" name="opco_name" id="opco_name" onchange="getBillCyclePeriods()">
												<option value>Select Opco</option>
											</select>
										</div>
										<div class="col-md-4">
											<select class="form-control" name="month" id="month" onchange="getAvaibaleData()">
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
											<input class="form-control" type="text" name="year" id="year" onchange="getAvaibaleData()" />
										</div>
										<div class="col-md-4 mt-3">
											<a class="btn btn-primary" data-toggle="modal" data-target="#addNewOpcoModal" style="color:white">Add New Opco</a>
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
							<div class="card-header" style="cursor:pointer;" data-toggle="collapse" data-target="#incsummary" aria-expanded="true" aria-controls="incsummary">
								<h5>Incidents summary</h5>
							</div>
							<div id="incsummary" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-block">
									<div class="row">
										<div class="form-group form-primary col-md-6">
											<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="s1_inc_count" id="s1_inc_count" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">S1 Incidents Count</label>
										</div>
										<div class="form-group form-primary col-md-6">
											<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="s1_inc_sla_met_count" id="s1_inc_sla_met_count" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">S1 SLA Incidents Count</label>
										</div>
									</div>
									<div class="row">
										<div class="form-group form-primary col-md-6">
											<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="s2_inc_count" id="s2_inc_count" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">S2 Incidents Count</label>
										</div>
										<div class="form-group form-primary col-md-6">
											<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="s2_inc_sla_met_count" id="s2_inc_sla_met_count" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">S2 SLA Incidents Count</label>
										</div>
									</div>
									<div class="row">
										<div class="form-group form-primary col-md-6">
											<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="s3_inc_count" id="s3_inc_count" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">S3 Incidents Count</label>
										</div>
										<div class="form-group form-primary col-md-6">
											<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="s3_inc_sla_met_count" id="s3_inc_sla_met_count" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">S3 SLA Incidents Count</label>
										</div>
									</div>
									<div class="row">
										<div class="form-group form-primary col-md-6">
											<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="s4_inc_count" id="s4_inc_count" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">S4 Incidents Count</label>
										</div>
										<div class="form-group form-primary col-md-6">
											<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="s4_inc_sla_met_count" id="s4_inc_sla_met_count" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">S4 SLA Incidents Count</label>
										</div>
									</div>
									<div class="row">
										<div class="form-group form-primary col-md-12">
											<input type="text" name="mttr" id="mttr" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">Mean Time To Resolve (hh:mm:ss)</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">
							<div class="card-header" style="cursor:pointer;" data-toggle="collapse" data-target="#srsummary" aria-expanded="true" aria-controls="srsummary">
								<h5>Workorder summary</h5>
							</div>
							<div id="srsummary" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-block">
									<div class="row">
										<div class="form-group form-primary col-md-6">
											<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="s1_sr_count" id="s1_sr_count" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">S1 Service Request Count</label>
										</div>
										<div class="form-group form-primary col-md-6">
											<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="s1_sr_sla_met_count" id="s1_sr_sla_met_count" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">S1 SLA Service Request Count</label>
										</div>
									</div>
									<div class="row">
										<div class="form-group form-primary col-md-6">
											<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="s2_sr_count" id="s2_sr_count" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">S2 Service Request Count</label>
										</div>
										<div class="form-group form-primary col-md-6">
											<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="s2_sr_sla_met_count" id="s2_sr_sla_met_count" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">S2 SLA Service Request Count</label>
										</div>
									</div>
									<div class="row">
										<div class="form-group form-primary col-md-6">
											<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="s3_sr_count" id="s3_sr_count" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">S3 Service Request Count</label>
										</div>
										<div class="form-group form-primary col-md-6">
											<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="s3_sr_sla_met_count" id="s3_sr_sla_met_count" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">S3 SLA Service Request Count</label>
										</div>
									</div>
									<div class="row">
										<div class="form-group form-primary col-md-6">
											<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="s4_sr_count" id="s4_sr_count" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">S4 Service Request Count</label>
										</div>
										<div class="form-group form-primary col-md-6">
											<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="s4_sr_sla_met_count" id="s4_sr_sla_met_count" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">S4 SLA Service Request Count</label>
										</div>
									</div>
									<div class="row">
										<div class="form-group form-primary col-md-12">
											<input type="text" name="mttf" id="mttf" class="form-control" required="">
											<span class="form-bar"></span>
											<label class="float-label">Mean Time To Fullfill (hh:mm:ss)</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<!-- <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" data-toggle="collapse" data-target="#repeat_ticket_details" aria-expanded="true" aria-controls="repeat_ticket_details" style="cursor:pointer;">
							<h5>Repeat ticket details</h5>
						</div>
						<div id="repeat_ticket_details" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-block">
								<div class="row">
									<div class="col-md-12">
										<table class="table" id="repeat_ticket_details_table">
											<thead>
												<tr>
													<th>Item</th>
													<th>Description</th>
													<th>Resoluion</th>
													
													<th>Actions</th>
												</tr>
											</thead>
											<tbody id="repeat_ticket_details_rows">
												<tr id="repeat_case_row_0">
													<td><input type="text" class="form-control" name="repeat_case_item[]" id="repeat_case_item_0" placeholder="Item"></td>
													<td><textarea class="form-control" name="repeat_case_desc[]" id="repeat_case_desc_0" placeholder="Description"></textarea></td>
													<td><textarea class="form-control" name="repeat_case_resolution[]" id="repeat_case_res_0" placeholder="Resolution"></textarea></td>
													<td><a class="btn btn-outline-primary" onclick="addRepeatTicketDetailsRow()">+</a></td>
													<td></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->


			<!-- <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" data-toggle="collapse" data-target="#report_summary" aria-expanded="true" aria-controls="report_summary" style="cursor:pointer;">
							<h5>Report summary</h5>
						</div>
						<div id="report_summary" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-block">
								<div class="row">
									<div class="col-md-12">
										<table class="table">
											<thead>
												<tr>
													<th>Summary type</th>
													<th>Summary description</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="report_summary_table">
												<tr id="report_summary_row_0">
													<td style="vertical-align:middle;">
														<select class="form-control" name="report_summary_type[]" id="report_summary_type0">
															<option value="">Select Summary Type</option>
															<option value="improvement">Improvememts</option>
															<option value="initiative">Initiatives</option>
															<option value="critical_activitie">Critical Activities</option>
														</select>
													</td>
													<td>
														<textarea class="form-control" placeholder="Description" name="report_summary_desc[]" id="report_summary_desc0" rows="9"></textarea>
													</td>
													<td>
														<a class="btn btn-outline-primary" onclick="addReportSummaryRow()">+</a>
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
			</div> -->


			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" data-toggle="collapse" data-target="#bill_run_status" aria-expanded="true" aria-controls="bill_run_status" style="cursor:pointer;">
							<h5>Bill run status</h5>
						</div>
						<div id="bill_run_status" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-block" id="bill_run_status_forms">


							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" data-toggle="collapse" data-target="#dashboards" aria-expanded="true" aria-controls="dashboards" style="cursor:pointer;">
                                <h5>DASHBOARDS</h5>
                            </div>
                            <div id="dashboards" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h6>Automations</h6>
                                            <input id="validations_count" type="text" class="form-control" placeholder="No of Automations" onchange="appendAutomationsList()">
                                            <span id="automations_list">

                                            </span>
                                        </div>
                                        <div class="col-md-3">
                                            <h6>Knwoledge Management</h6>
                                            <input id="km_count" type="text" class="form-control" placeholder="KM Count" onchange="appendKMList()">
                                            <span id="km_list">

                                            </span>
                                        </div>
                                        <div class="col-md-3">
                                            <h6>Security Incidents</h6>
                                            <input id="si_count" type="text" class="form-control" placeholder="SI Count" onchange="appendSIList()">
                                            <span id="si_list">

                                            </span>
                                        </div>
                                        <div class="col-md-3">
                                            <h6>Open Incidents</h6>
                                            <input id="oi_count" type="text" class="form-control" placeholder="OI Count" onchange="appendOIList()">
                                            <span id="oi_list">

                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->


			<!-- <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" data-toggle="collapse" data-target="#automations_dashboard" aria-expanded="true" aria-controls="automations_dashboard" style="cursor:pointer;">
							<h5>Automations dashboard</h5>
						</div>
						<div id="automations_dashboard" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-block">
								<div class="row">
									<label style="align-self:end;text-align-last: end;" class="col-md-4 col-form-label">Number of Automations Done</label>
									<div class="col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="automation_count" id="automation_count" class="form-control" required="">
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-md-12">
										<table class="table">
											<thead>
												<tr>
													<th>Automation name</th>
													<th>Description</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="automations_dashboard_table">
												<tr id="automations_dashboard_row_0">
													<td style="vertical-align:middle;">
														<textarea class="form-control" placeholder="Automation name" name="automations_name[]" id="automations_name0" rows="9"></textarea>
													</td>
													<td>
														<textarea class="form-control" placeholder="Description" name="automations_desc[]" id="automations_desc0" rows="9"></textarea>
													</td>
													<td>
														<a class="btn btn-outline-primary" onclick="addAutomationDashboardRow()">+</a>
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
			</div> -->



			<!-- <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" data-toggle="collapse" data-target="#km_dashboard" aria-expanded="true" aria-controls="km_dashboard" style="cursor:pointer;">
							<h5>Knowledge management dashboard</h5>
						</div>
						<div id="km_dashboard" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-block">
								<div class="row">
									<label style="align-self:end;text-align-last: end;" class="col-md-4 col-form-label">Knowledge Management Done</label>
									<div class="col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="km_count" id="km_count" class="form-control" required="">
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-md-12">
										<table class="table">
											<thead>
												<tr>
													<th>KM name</th>
													<th>Description</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="km_dashboard_table">
												<tr id="km_dashboard_row_0">
													<td style="vertical-align:middle;">
														<textarea class="form-control" placeholder="Knowledge management name" name="km_name[]" id="km_name0" rows="9"></textarea>
													</td>
													<td>
														<textarea class="form-control" placeholder="Description" name="km_desc[]" id="km_desc0" rows="9"></textarea>
													</td>
													<td>
														<a class="btn btn-outline-primary" onclick="addkMDashboardRow()">+</a>
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
			</div> -->



			<!-- <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" data-toggle="collapse" data-target="#si_dashboard" aria-expanded="true" aria-controls="si_dashboard" style="cursor:pointer;">
							<h5>Security incidents dashboard</h5>
						</div>
						<div id="si_dashboard" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-block">
								<div class="row">
									<label style="align-self:end;text-align-last: end;" class="col-md-4 col-form-label">Number of Security Incidents</label>
									<div class="col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="si_count" id="si_count" class="form-control" required="">
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-md-12">
										<table class="table">
											<thead>
												<tr>
													<th>KM Name</th>
													<th>Description</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="si_dashboard_table">
												<tr id="si_dashboard_row_0">
													<td style="vertical-align:middle;">
														<textarea class="form-control" placeholder="Security Incident Name" name="si_name[]" id="si_name0" rows="9"></textarea>
													</td>
													<td>
														<textarea class="form-control" placeholder="Description" name="si_desc[]" id="si_desc0" rows="9"></textarea>
													</td>
													<td>
														<a class="btn btn-outline-primary" onclick="addSIDashboardRow()">+</a>
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
			</div> -->


			<!-- <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" data-toggle="collapse" data-target="#oi_dashboard" aria-expanded="true" aria-controls="oi_dashboard" style="cursor:pointer;">
							<h5>Open incidents dashboard</h5>
						</div>
						<div id="oi_dashboard" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-block">
								<div class="row">
									<label style="align-self:end;text-align-last: end;" class="col-md-4 col-form-label">Number of Open Incidents</label>
									<div class="col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="oi_count" id="oi_count" class="form-control" required="">
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-md-12">
										<table class="table">
											<thead>
												<tr>
													<th>KM name</th>
													<th>Description</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="oi_dashboard_table">
												<tr id="oi_dashboard_row_0">
													<td style="vertical-align:middle;">
														<textarea class="form-control" placeholder="Open incident name" name="oi_name[]" id="oi_name0" rows="9"></textarea>
													</td>
													<td>
														<textarea class="form-control" placeholder="Description" name="oi_desc[]" id="oi_desc0" rows="9"></textarea>
													</td>
													<td>
														<a class="btn btn-outline-primary" onclick="addOIDashboardRow()">+</a>
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
			</div> -->


			<!-- <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" data-toggle="collapse" data-target="#kpi_dashboard" aria-expanded="true" aria-controls="kpi_dashboard" style="cursor:pointer;">
							<h5>Business KPI dashboard</h5>
						</div>
						<div id="kpi_dashboard" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-block">
								<div class="row">
									<div class="col-md-12">
										<table class="table">
											<thead>
												<tr>
													<th>KPI name</th>
													<th>KPI description</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="kpi_dashboard_table">
												<tr id="kpi_dashboard_row_0">
													<td><input type="text" class="form-control" name="kpi_dashboard_name[]" id="kpi_dashboard_name_0" placeholder="KPI name"></td>
													<td><input type="text" class="form-control" name="kpi_dashboard_desc[]" id="kpi_dashboard_desc_0" placeholder="KPI description"></td>
													<td><a class="btn btn-outline-primary" onclick="addKPIDashboardDetailsRow()">+</a></td>
													<td></td>
													</select>
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
			</div> -->


			
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" style="cursor:pointer;" data-toggle="collapse" data-target="#incresolved" aria-expanded="true" aria-controls="incsummary">
							<h5>Incidents resolved by groups</h5>
						</div>
						<div id="incresolved" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-block">
								<div class="row">
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="inc_Service_desk" id="inc_Service_desk" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Service desk</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="inc_L1_MSO_count" id="inc_L1_MSO_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">L1/MSO</label>
									</div>
								</div>
								<div class="row">
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="inc_L2_count" id="inc_L2_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">L2</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="inc_L3_count" id="inc_L3_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">L3</label>
									</div>
								</div>
								<div class="row">
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="inc_L4_count" id="inc_L4_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">L4</label>
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
						<div class="card-header" style="cursor:pointer;" data-toggle="collapse" data-target="#woresolved" aria-expanded="true" aria-controls="incsummary">
							<h5>Workorders resolved by groups</h5>
						</div>
						<div id="woresolved" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-block">
								<div class="row">
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="Service_desk" id="serviceDesk_inc_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Service Desk</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="L1_MSO_count" id="L1_MSO_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">L1/MSO</label>
									</div>
								</div>
								<div class="row">
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="L2_count" id="L2_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">L2</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="L3_count" id="L3_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">L3</label>
									</div>
								</div>
								<div class="row">
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="L4_count" id="L4_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">L4</label>
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
						<div class="card-header" style="cursor:pointer;" data-toggle="collapse" data-target="#increason" aria-expanded="true" aria-controls="incsummary">
							<h5>Incidents due to</h5>
						</div>
						<div id="increason" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-block">
								<div class="row">
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="inc_app_issue_count" id="inc_app_issue_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Application issue</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="inc_fun_issue_count" id="inc_fun_issue_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Functionality issue</label>
									</div>
								</div>
								<div class="row">
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="inc_data_issue_count" id="inc_data_issue_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Data issue</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="inc_plat_issue_count" id="inc_plat_issue_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Platform issue</label>
									</div>
								</div>
								<div class="row">
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="inc_NFR_issue_count" id="inc_NFR_issue_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">NFR issue</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="inc_tec_issue_count" id="inc_tec_issue_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Technology issue</label>
									</div>
								</div>
								<div class="row">
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="inc_3pp_issue_count" id="inc_3pp_issue_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">3PP issue</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="inc_clar_issue_count" id="inc_clar_issue_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Clarification</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="inc_no_fcr_count" id="inc_no_fcr_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">No FCR training</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="inc_process_gap_count" id="inc_process_gap_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Process gap</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="inc_know_gap_count" id="inc_know_gap_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Knowledge gap</label>
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
						<div class="card-header" style="cursor:pointer;" data-toggle="collapse" data-target="#woreason" aria-expanded="true" aria-controls="incsummary">
							<h5>Workorders due to</h5>
						</div>
						<div id="woreason" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-block">
								<div class="row">
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="app_issue_count" id="app_issue_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Application issue</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="fun_issue_count" id="fun_issue_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Functionality issue</label>
									</div>
								</div>
								<div class="row">
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="data_issue_count" id="data_issue_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Data issue</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="plat_issue_count" id="plat_issue_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Platform issue</label>
									</div>
								</div>
								<div class="row">
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="NFR_issue_count" id="NFR_issue_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">NFR issue</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="tec_issue_count" id="tec_issue_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Technology issue</label>
									</div>
								</div>
								<div class="row">
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="3pp_issue_count" id="3pp_issue_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">3PP issue</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="clar_issue_count" id="clar_issue_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Clarification</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="no_fcr_count" id="no_fcr_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">No FCR training</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="process_gap_count" id="process_gap_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Process gap</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="know_gap_count" id="know_gap_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Knowledge gap</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" name="service_request_count" id="service_request_count" class="form-control" required="">
										<span class="form-bar"></span>
										<label class="float-label">Service Request</label>
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
						<div class="card-header" style="cursor:pointer;" data-toggle="collapse" data-target="#woreason" aria-expanded="true" aria-controls="incsummary">
							<h5>Incidents outages</h5>
						</div>
						<div id="woreason" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-block">
								<div class="row">
									<div class="col-sm-6">
										<input type="text" autocomplete="off" name="outage-date" class="form-control dateClass" id="outage-date">
										<span class="form-bar"></span>
										<label class="float-label">Date of outage</label>
									</div>
									<div class="form-group form-primary col-md-6">
										<input type="text" name="outage-duration" id="outage-duration" class="form-control">
										<span class="form-bar"></span>
										<label class="float-label">Outage duration (hh:mm:ss)</label>
									</div>
								</div>
								<div class="row">
									<div class="form-group form-primary col-md-12">
										<input type="text" name="outage-description" id="outage-description" class="form-control">
										<span class="form-bar"></span>
										<label class="float-label">Outage Count</label>
									</div>
								</div>
								<div class="row">
									<div class="form-group form-primary col-md-12">
										<input type="text" name="outage-cause" id="outage-cause" class="form-control">
										<span class="form-bar"></span>
										<label class="float-label">Outage cause</label>
									</div>
								</div>
								<div class="row">
									<div class="form-group form-primary col-md-12">
										<input type="text" name="outage-resolution" id="outage-resolution" class="form-control">
										<span class="form-bar"></span>
										<label class="float-label">Resolution</label>
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
$this->load->view('./templates/footer.php');
?>
<?php
$this->load->view('./metaDataScript.php');
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js" integrity="sha512-frFP3ZxLshB4CErXkPVEXnd5ingvYYtYhE5qllGdZmcOlRKNEPbufyupfdSTNmoF5ICaQNO6SenXzOZvoGkiIA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
	function pagination(page_count) {
		var pages = page_count;
		$('#pagination-demo').twbsPagination({
			totalPages: pages,
			startPage: 1,
			visiblePages: pages,
			initiateStartPageClick: true,
			href: false,
			onPageClick: function(event, page) {
				$('.page-active').removeClass('page-active');
				$('#page' + page).addClass('page-active');
			},
		});
	}
</script>

<script>
	$(document).ready(function() {
		$('body').on('focus', ".dateClass", function() {
			$(this).datepicker({
				format: 'dd-mm-yyyy',
				ignoreReadonly: true,
				showTodayButton: true,
				autoclose: true
			});
		});
	})

	function addRepeatTicketDetailsRow() {
		var row_id = $('#repeat_ticket_details_table tr:last').attr('id')
		var html = `
            <tr class="repeatTicketDetailsRow" id="repeat_case_row_${parseInt(row_id.split('_')[3])+1}">
                <td><input type="text" class="form-control" name="repeat_case_item[]" id="repeat_case_item_${parseInt(row_id.split('_')[3])+1}" placeholder="Item"></td>
                <td><textarea class="form-control" name="repeat_case_desc[]" id="repeat_case_desc_${parseInt(row_id.split('_')[3])+1}" placeholder="Description"></textarea></td>
                <td><textarea class="form-control" name="repeat_case_resolution[]" id="repeat_case_res_${parseInt(row_id.split('_')[3])+1}" placeholder="Resolution"></textarea></td>
                <td><a class="btn btn-outline-danger" onclick="removeRepeatTicketDetailsRow(${parseInt(row_id.split('_')[3])+1})">X</a></td>
            </tr>
        `;
		$("#repeat_ticket_details_rows").append(html);
	}

	function removeRepeatTicketDetailsRow(id) {
		$("#repeat_case_row_" + id).remove();
	}

	function addReportSummaryRow() {
		var row_id = $('#report_summary_table tr:last').attr('id')
		var html = `
            <tr class="reportSummaryRow" id="report_summary_row_${parseInt(row_id.split('_')[3])+1}">
                <td style="vertical-align:middle;">
                    <select class="form-control" name="report_summary_type[]" id="report_summary_type${parseInt(row_id.split('_')[3])+1}">
                        <option value="">Select Summary Type</option>
                        <option value="improvement">Improvement</option>
                        <option value="initiative">Initiative</option>
                        <option value="critical_activity">Critical Activity</option>
                    </select>
                </td>
                <td>
                    <textarea class="form-control" name="report_summary_desc[]" id="report_summary_desc${parseInt(row_id.split('_')[3])+1}" rows="3"></textarea>
                </td>
                <td>
                    <a class="btn btn-outline-danger" onclick="removeReportSummaryRow(${parseInt(row_id.split('_')[3])+1})">X</a>
                </td>
            </tr>
        `;
		$("#report_summary_table").append(html);
	}

	function removeReportSummaryRow(id) {
		$("#report_summary_row_" + id).remove();
	}

	function addAutomationDashboardRow() {
		var row_id = $('#automations_dashboard_table tr:last').attr('id')
		var html = `
            <tr class="automationDashboardRow" id="automations_dashboard_row_${parseInt(row_id.split('_')[3])+1}">
                <td style="vertical-align:middle;">
                    <textarea class="form-control" placeholder="Automation Name" name="automations_name[]" id="automations_name${parseInt(row_id.split('_')[3])+1}" rows="9"></textarea>
                </td>
                <td>
                    <textarea class="form-control" placeholder="Description" name="automations_desc[]" id="automations_desc${parseInt(row_id.split('_')[3])+1}" rows="9"></textarea>
                </td>
                <td>
                    <a class="btn btn-outline-danger" onclick="removeAutomationDashboardRow(${parseInt(row_id.split('_')[3])+1})">X</a>
                </td>
            </tr>
        `;
		$("#automations_dashboard_table").append(html);
	}

	function removeAutomationDashboardRow(id) {
		$("#automations_dashboard_row_" + id).remove();
	}

	function addkMDashboardRow() {
		var row_id = $('#km_dashboard_table tr:last').attr('id')
		var html = `
            <tr class="kmDashboardRow" id="km_dashboard_row_${parseInt(row_id.split('_')[3])+1}">
                <td style="vertical-align:middle;">
                    <textarea class="form-control" placeholder="Knowledge Management Name" name="km_name[]" id="km_name${parseInt(row_id.split('_')[3])+1}" rows="9"></textarea>
                </td>
                <td>
                    <textarea class="form-control" placeholder="Description" name="km_desc[]" id="km_desc${parseInt(row_id.split('_')[3])+1}" rows="9"></textarea>
                </td>
                <td>
                    <a class="btn btn-outline-danger" onclick="removeKMRow(${parseInt(row_id.split('_')[3])+1})">X</a>
                </td>
            </tr>
        `;
		$("#km_dashboard_table").append(html);
	}

	function removeKMRow(id) {
		$("#km_dashboard_row_" + id).remove();
	}

	function addSIDashboardRow() {
		var row_id = $('#si_dashboard_table tr:last').attr('id')
		var html = `
            <tr class="siDashboardRow" id="si_dashboard_row_${parseInt(row_id.split('_')[3])+1}">
                <td style="vertical-align:middle;">
                    <textarea class="form-control" placeholder="Security Incident Name" name="si_name[]" id="si_name${parseInt(row_id.split('_')[3])+1}" rows="9"></textarea>
                </td>
                <td>
                    <textarea class="form-control" placeholder="Description" name="si_desc[]" id="si_desc${parseInt(row_id.split('_')[3])+1}" rows="9"></textarea>
                </td>
                <td>
                    <a class="btn btn-outline-danger" onclick="removeSIDashboardRow(${parseInt(row_id.split('_')[3])+1})">X</a>
                </td>
            </tr>
        `;
		$("#si_dashboard_table").append(html);
	}

	function removeSIDashboardRow(id) {
		$("#si_dashboard_row_" + id).remove();
	}

	function addOIDashboardRow() {
		var row_id = $('#oi_dashboard_table tr:last').attr('id')
		var html = `
            <tr class="oiDashboardRow" id="oi_dashboard_row_${parseInt(row_id.split('_')[3])+1}">
                <td style="vertical-align:middle;">
                    <textarea class="form-control" placeholder="Open Incident Name" name="oi_name[]" id="oi_name${parseInt(row_id.split('_')[3])+1}" rows="9"></textarea>
                </td>
                <td>
                    <textarea class="form-control" placeholder="Description" name="oi_desc[]" id="oi_desc${parseInt(row_id.split('_')[3])+1}" rows="9"></textarea>
                </td>
                <td>
                    <a class="btn btn-outline-danger" onclick="removeOIDashboardRow(${parseInt(row_id.split('_')[3])+1})">X</a>
                </td>
            </tr>
        `;
		$("#oi_dashboard_table").append(html);
	}

	function removeOIDashboardRow(id) {
		$("#oi_dashboard_row_" + id).remove();
	}

	function addKPIDashboardDetailsRow() {
		var row_id = $('#kpi_dashboard_table tr:last').attr('id')
		var html = `
            <tr class="kpiDashboardRow" id="kpi_dashboard_row_${parseInt(row_id.split('_')[3])+1}">
                <td><input type="text" class="form-control" name="kpi_dashboard_name[]" id="kpi_dashboard_name_${parseInt(row_id.split('_')[3])+1}" placeholder="KPI Name"></td>
                <td><input type="text" class="form-control" name="kpi_dashboard_desc[]" id="kpi_dashboard_desc_${parseInt(row_id.split('_')[3])+1}" placeholder="KPI Description"></td>
                <td><a class="btn btn-outline-danger" onclick="removeKPIDashboardDetailsRow(${parseInt(row_id.split('_')[3])+1})">X</a></td>
            </tr>
        `;
		$("#kpi_dashboard_table").append(html);
	}

	function removeKPIDashboardDetailsRow(id) {
		$("#kpi_dashboard_row_" + id).remove();
	}

	function calculateTotal(id) {
		var hrs = parseInt($("#pthrs" + id).val()) + parseInt($("#ivthrs" + id).val())
		var mins = parseInt($("#ptmins" + id).val()) + parseInt($("#ivtmins" + id).val())
		var secs = parseInt($("#ptsecs" + id).val()) + parseInt($("#ivtsecs" + id).val())
		time = (hrs * 60 * 60) + (mins * 60) + secs;
		var hours = Math.floor(time / 3600);
		time = time - hours * 3600;
		var minutes = Math.floor(time / 60);
		var seconds = time - minutes * 60;
		$("#tthrs" + id).val(hours)
		$("#ttmins" + id).val(minutes)
		$("#ttsecs" + id).val(seconds)
	}

	function getBillCyclePeriods() {
		var opco = $("#opco_name").val()
		$.ajax({
			url: '<?php echo site_url('IndexController/getBillCyclePeriods') ?>',
			type: 'post',
			data: {
				'opco': opco
			},
			success: function(data) {
				var data = $.parseJSON(data);
				var html = '';
				for (var i = 0; i < data.length; i++) {
					html += `
                        <div class="jumbotron page" id="page${i+1}" style="padding:1rem 1rem;background-color:#fff;margin-bottom:0rem;">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="main_bill_cycle_period[]" id="main_bill_cycle_period_${i}" value="${data[i].main_bill_cycle_period}" readonly="">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label style="align-self:end;" class="col-sm-6 col-form-label">Main Bill Run Start Date</label>
                                        <div class="col-sm-6">
                                            <input type="text" autocomplete="off" class="form-control dateClass" id="startDate${i}" name="startDate[]">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label style="align-self:end;" class="col-sm-6 col-form-label">Main Bill Run Completion Date</label>
                                        <div class="col-sm-6">
                                            <input type="text" autocomplete="off" class="form-control dateClass" id="endDate${i}" name="endDate[]">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label style="align-self:end;" class="col-sm-6 col-form-label">Accounts Billed Count</label>
                                        <div class="col-sm-6">
                                            <input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" class="form-control" name="account_billed_count[]" id="account_billed_count${i}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label style="align-self:end;" class="col-sm-6 col-form-label">Service Billed Count</label>
                                        <div class="col-sm-6">
                                            <input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" class="form-control" name="service_billed_count[]" id="service_billed_count${i}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label style="align-self:end;" class="col-sm-6 col-form-label">Current Status</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="current_status[]" id="current_status${i}">
                                                <option value="">Select Status</option>
                                                                                                
												<option value="completed">Bill run started</option>
												<option value="completed">Bill run completed</option>
												<option value="completed">Bill run is in progress</option>
												<option value="completed">Not started</option>
												<option value="completed">Invoice rollback is in progress</option>
												<option value="completed">Account preparation is in progress</option>
												<option value="completed">Account preparation completed</option>
												<option value="completed">Error in account preparation</option>
												<option value="completed">DA rectification is in progress</option>
												<option value="completed">DA rectification completed</option>
												<option value="completed">Invoice verification is in progress</option>
												<option value="completed">Invoice verification completed</option>
												<option value="completed">Error in invoice verification</option>
												<option value="completed">Invoice generation is in progress</option>
												<option value="completed">Invoice generation completed</option>
												<option value="completed">Error in invoice generation</option>												
												<option value="completed">Bill generation is in progress</option>																								
												<option value="completed">Invoice confirmation is in progress</option>
												<option value="completed">Invoice confirmation completed</option>
												<option value="completed">E-print is in progress</option>
												<option value="completed">E-print completed</option>
												<option value="completed">Spooling process in progress</option>							
												<option value="completed">Spooling process completed</option>
												<option value="completed">Bill calculation is in progress</option>												
												<option value="completed">Bill calculation completed</option>																								
												<option value="completed">Spool call is in progress</option>												
												<option value="completed">PDF generation in progress</option>
												<option value="completed">PDF generation completed</option>
												<option value="completed">PDF sent for verification</option>
												<option value="completed">PS generation is in progress</option>
												<option value="completed">PS generation completed</option>															
												<option value="completed">Bill sent for verification</option>
												<option value="completed">On hold</option>
												<option value="completed">E-bill is in progress</option>
												<option value="completed">E-bill sending completed</option>												
												<option value="completed">Waiting for revert</option>
												<option value="completed">SDC posting is in progress</option>
												<option value="completed">EMM is re-processing</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label style="align-self:end;" class="col-sm-6 col-form-label">Processing Time</label>
                                        <div class="col-sm-6">
                                            <input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" class="form-control" style="width:3rem;" placeholder="HH" name="pthrs[]" value="00" min="0" onchange="calculateTotal(${i})" id="pthrs${i}"> : 
                                            <input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" class="form-control" style="width:3rem;" placeholder="MM" name="ptmins[]" value="00" min="0" max="59" onchange="calculateTotal(${i})" id="ptmins${i}"> : 
                                            <input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" class="form-control" style="width:3rem;" placeholder="SS" name="ptsecs[]" value="00" min="0" max="59" onchange="calculateTotal(${i})" id="ptsecs${i}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label style="align-self:end;" class="col-sm-6 col-form-label">Invoice Verification Time</label>
                                        <div class="col-sm-6">
                                            <input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" class="form-control" style="width:3rem;" placeholder="HH" name="ivthrs[]" value="00" min="0" onchange="calculateTotal(${i})" id="ivthrs${i}"> : 
                                            <input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" class="form-control" style="width:3rem;" placeholder="MM" name="ivtmins[]" value="00" min="0" max="59" onchange="calculateTotal(${i})" id="ivtmins${i}"> : 
                                            <input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" class="form-control" style="width:3rem;" placeholder="SS" name="ivtsecs[]" value="00" min="0" max="59" onchange="calculateTotal(${i})" id="ivtsecs${i}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label style="align-self:end;" class="col-sm-6 col-form-label">Total Time</label>
                                        <div class="col-sm-6">
                                            <input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" class="form-control" style="width:3rem;" placeholder="HH" name="tthrs[]" value="00" readonly id="tthrs${i}"> : 
                                            <input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" class="form-control" style="width:3rem;" placeholder="MM" name="ttmins[]" value="00" readonly id="ttmins${i}"> : 
                                            <input type="number" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" onwheel="return false;" class="form-control" style="width:3rem;" placeholder="SS" name="ttsecs[]" value="00" readonly id="ttsecs${i}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
				}
				if (data.length > 1) {
					html += '<ul id="pagination-demo" style="justify-content:center;" class="pagination-sm"></ul>';
				} else {
					html += '<ul id="pagination-demo" class="pagination-sm" style="display:none;"></ul>';
				}
				$("#bill_run_status_forms").html(html);
				pagination(data.length)
			}
		});
		getAvaibaleData();
	}

	function getAvaibaleData() {
		var opco = $("#opco_name").val()
		var year = $("#year").val()
		var month = $("#month").val()
		document.getElementById("dataForm").reset();
		$(".repeatTicketDetailsRow").remove()
		$(".reportSummaryRow").remove()
		$(".automationDashboardRow").remove()
		$(".kmDashboardRow").remove()
		$(".siDashboardRow").remove()
		$(".oiDashboardRow").remove()
		$(".kpiDashboardRow").remove()
		$("#opco_name").val(opco)
		$("#year").val(year)
		$("#month").val(month)
		$.ajax({
			url: '<?php echo site_url('IndexController/getAlreadyFilledData') ?>',
			type: 'post',
			data: {
				'opco': opco,
				'year': year,
				'month': month
			},
			success: function(data) {
				var data = $.parseJSON(data)
				// Incidents Summary Data Autofill
				var incidentsSummary = data.incidents_summary
				if (incidentsSummary && incidentsSummary != 'null' && incidentsSummary != 'undefined') {
					$("#s1_inc_count").val(incidentsSummary['s1_incidents_count']);
					$("#s1_inc_sla_met_count").val(incidentsSummary['s1_sla_met_count']);
					$("#s2_inc_count").val(incidentsSummary['s2_incidents_count']);
					$("#s2_inc_sla_met_count").val(incidentsSummary['s2_sla_met_count']);
					$("#s3_inc_count").val(incidentsSummary['s3_incidents_count']);
					$("#s3_inc_sla_met_count").val(incidentsSummary['s3_sla_met_count']);
					$("#s4_inc_count").val(incidentsSummary['s4_incidents_count']);
					$("#s4_inc_sla_met_count").val(incidentsSummary['s4_sla_met_count']);
					$("#mttr").val(incidentsSummary['mean_time_to_resolve']);
				}

				// Service Request Summary Data Autofill
				var serviceRequestSummary = data.service_request_summary
				if (serviceRequestSummary && serviceRequestSummary != 'null' && serviceRequestSummary != 'undefined') {
					$("#s1_sr_count").val(serviceRequestSummary['s1_sr_count']);
					$("#s1_sr_sla_met_count").val(serviceRequestSummary['s1_sr_sla_met_count']);
					$("#s2_sr_count").val(serviceRequestSummary['s2_sr_count']);
					$("#s2_sr_sla_met_count").val(serviceRequestSummary['s2_sr_sla_met_count']);
					$("#s3_sr_count").val(serviceRequestSummary['s3_sr_count']);
					$("#s3_sr_sla_met_count").val(serviceRequestSummary['s3_sr_sla_met_count']);
					$("#s4_sr_count").val(serviceRequestSummary['s4_sr_count']);
					$("#s4_sr_sla_met_count").val(serviceRequestSummary['s4_sr_sla_met_count']);
					$("#mttf").val(serviceRequestSummary['mean_time_to_fulfill']);
				}

				// Repeat Ticket Details Data Autofill
				var repeatTicketDetails = data.repeat_ticket_details
				if (repeatTicketDetails && repeatTicketDetails != 'null' && repeatTicketDetails != 'undefined') {
					for (var i = 0; i < repeatTicketDetails.length; i++) {
						if (i == 0) {
							$("#repeat_case_item_" + i).val(repeatTicketDetails[i]['incident_name'])
							$("#repeat_case_desc_" + i).val(repeatTicketDetails[i]['incident_desc'])
							$("#repeat_case_res_" + i).val(repeatTicketDetails[i]['incident_resolution'])
						} else {
							addRepeatTicketDetailsRow()
							$("#repeat_case_item_" + i).val(repeatTicketDetails[i]['incident_name'])
							$("#repeat_case_desc_" + i).val(repeatTicketDetails[i]['incident_desc'])
							$("#repeat_case_res_" + i).val(repeatTicketDetails[i]['incident_resolution'])
						}
					}
				}

				// Report Summary Data Autofill
				var reportSummary = data.report_summary
				if (reportSummary && reportSummary != 'null' && reportSummary != 'undefined') {
					for (var i = 0; i < reportSummary.length; i++) {
						if (i == 0) {
							$("#report_summary_type" + i).val(reportSummary[i]['summary_type'])
							$("#report_summary_desc" + i).val(reportSummary[i]['summary_desc'])
						} else {
							addReportSummaryRow()
							$("#report_summary_type" + i).val(reportSummary[i]['summary_type'])
							$("#report_summary_desc" + i).val(reportSummary[i]['summary_desc'])
						}
					}
				}

				// Automation Dashboard Data Autofill
				var automationDashboard = data.automation_dashboard
				if (automationDashboard && automationDashboard != 'null' && automationDashboard != 'undefined') {
					$("#automation_count").val(automationDashboard[0]["automation_count"])
					for (var i = 0; i < automationDashboard.length; i++) {
						if (i == 0) {
							$("#automations_name" + i).val(automationDashboard[i]['automation_name'])
							$("#automations_desc" + i).val(automationDashboard[i]['automation_desc'])
						} else {
							addAutomationDashboardRow()
							$("#automations_name" + i).val(automationDashboard[i]['automation_name'])
							$("#automations_desc" + i).val(automationDashboard[i]['automation_desc'])
						}
					}
				}

				// KM Dashboard Data Autofill
				var kMDashboard = data.km_dashboard
				if (kMDashboard && kMDashboard != 'null' && kMDashboard != 'undefined') {
					$("#km_count").val(kMDashboard[0]["km_count"])
					for (var i = 0; i < kMDashboard.length; i++) {
						if (i == 0) {
							$("#km_name" + i).val(kMDashboard[i]['km_name'])
							$("#km_desc" + i).val(kMDashboard[i]['km_desc'])
						} else {
							addkMDashboardRow()
							$("#km_name" + i).val(kMDashboard[i]['km_name'])
							$("#km_desc" + i).val(kMDashboard[i]['km_desc'])
						}
					}
				}

				// SI Dashboard Data Autofill
				var sIDashboard = data.si_dashboard
				if (sIDashboard && sIDashboard != 'null' && sIDashboard != 'undefined') {
					$("#si_count").val(sIDashboard[0]["si_count"])
					for (var i = 0; i < sIDashboard.length; i++) {
						if (i == 0) {
							$("#si_name" + i).val(sIDashboard[i]['si_name'])
							$("#si_desc" + i).val(sIDashboard[i]['si_desc'])
						} else {
							addSIDashboardRow()
							$("#si_name" + i).val(sIDashboard[i]['si_name'])
							$("#si_desc" + i).val(sIDashboard[i]['si_desc'])
						}
					}
				}

				// OI Dashboard Data Autofill
				var oIDashboard = data.oi_dashboard
				if (oIDashboard && oIDashboard != 'null' && oIDashboard != 'undefined') {
					$("#oi_count").val(oIDashboard[0]["oi_count"])
					for (var i = 0; i < oIDashboard.length; i++) {
						if (i == 0) {
							$("#oi_name" + i).val(oIDashboard[i]['oi_name'])
							$("#oi_desc" + i).val(oIDashboard[i]['oi_desc'])
						} else {
							addOIDashboardRow()
							$("#oi_name" + i).val(oIDashboard[i]['oi_name'])
							$("#oi_desc" + i).val(oIDashboard[i]['oi_desc'])
						}
					}
				}

				// Business KPI Dashboard Data Autofill
				var buisenessKpiDashboard = data.buiseness_kpi_dashboard
				if (buisenessKpiDashboard && buisenessKpiDashboard != 'null' && buisenessKpiDashboard != 'undefined') {
					for (var i = 0; i < buisenessKpiDashboard.length; i++) {
						if (i == 0) {
							$("#kpi_dashboard_name_" + i).val(buisenessKpiDashboard[i]['kpi_type'])
							$("#kpi_dashboard_desc_" + i).val(buisenessKpiDashboard[i]['kpi_value'])
						} else {
							addKPIDashboardDetailsRow()
							$("#kpi_dashboard_name_" + i).val(buisenessKpiDashboard[i]['kpi_type'])
							$("#kpi_dashboard_desc_" + i).val(buisenessKpiDashboard[i]['kpi_value'])
						}
					}
				}

				//Incident resolved counts by group
				var incident_count_by_group = data.incident_count_by_group
				if (incident_count_by_group && incident_count_by_group != 'null' && incident_count_by_group != 'undefined') {
					$("#inc_Service_desk").val(incident_count_by_group['Service_desk']);
					$("#inc_L1_MSO_count").val(incident_count_by_group['L1_MSO_count']);
					$("#inc_L2_count").val(incident_count_by_group['L2_count']);
					$("#inc_L3_count").val(incident_count_by_group['L3_count']);
					$("#inc_L4_count").val(incident_count_by_group['L4_count']);
					$("#inc_MSO_count").val(incident_count_by_group['MSO_count']);
				}

				//Workorder resolved counts by group
				var workorder_count_by_group = data.workorder_count_by_group
				if (workorder_count_by_group && workorder_count_by_group != 'null' && workorder_count_by_group != 'undefined') {
					$("#Service_desk").val(workorder_count_by_group['Service_desk']);
					$("#L1_MSO_count").val(workorder_count_by_group['L1_MSO_count']);
					$("#L2_count").val(workorder_count_by_group['L2_count']);
					$("#L3_count").val(workorder_count_by_group['L3_count']);
					$("#L4_count").val(workorder_count_by_group['L4_count']);
					$("#MSO_count").val(workorder_count_by_group['MSO_count']);
				}

				//incident summary

				var incidentReason = data.incidents_reason
				if (incidentReason && incidentReason != 'null' && incidentReason != 'undefined') {
					$("#app_issue_count").val(incidentReason['app_issue_count']);
					$("#fun_issue_count").val(incidentReason['fun_issue_count']);
					$("#data_issue_count").val(incidentReason['data_issue_count']);
					$("#plat_issue_count").val(incidentReason['plat_issue_count']);
					$("#NFR_issue_count").val(incidentReason['NFR_issue_count']);
					$("#tec_issue_count").val(incidentReason['tec_issue_count']);
					$("#3pp_issue_count").val(incidentReason['3pp_issue_count']);
					$("#clar_issue_count").val(incidentReason['clar_issue_count']);
					$("#no_fcr_count").val(incidentReason['no_fcr_count']);
					$("#process_gap_count").val(incidentReason['process_gap_count']);
					$("#know_gap_count").val(incidentReason['know_gap_count']);
				}

				//workorder summary

				var workoderSummary = data.work_order_summary
				if (workoderSummary && workoderSummary != 'null' && workoderSummary != 'undefined') {
					$("#app_issue_count").val(workoderSummary['app_issue_count']);
					$("#fun_issue_count").val(workoderSummary['fun_issue_count']);
					$("#data_issue_count").val(workoderSummary['data_issue_count']);
					$("#plat_issue_count").val(workoderSummary['plat_issue_count']);
					$("#NFR_issue_count").val(workoderSummary['NFR_issue_count']);
					$("#tec_issue_count").val(workoderSummary['tec_issue_count']);
					$("#3pp_issue_count").val(workoderSummary['3pp_issue_count']);
					$("#clar_issue_count").val(workoderSummary['clar_issue_count']);
					$("#no_fcr_count").val(workoderSummary['no_fcr_count']);
					$("#process_gap_count").val(workoderSummary['process_gap_count']);
					$("#know_gap_count").val(workoderSummary['know_gap_count']);
				}
			}
		});
	}

	function appendAutomationsList() {
		var count = $("#validations_count").val();
		var html = '';
		for (var i = 0; i < count; i++) {
			html += `<textarea type="text" name="automationsList[]" class="form-control" placeholder="Automation${i+1}"></textarea>`;
		}
		$("#automations_list").html(html);
	}

	function appendKMList() {
		var count = $("#km_count").val();
		var html = '';
		for (var i = 0; i < count; i++) {
			html += `<textarea type="text" name="kmList[]" class="form-control" placeholder="KM${i+1}"></textarea>`;
		}
		$("#km_list").html(html);
	}

	function appendSIList() {
		var count = $("#si_count").val();
		var html = '';
		for (var i = 0; i < count; i++) {
			html += `<textarea type="text" name="siList[]" class="form-control" placeholder="SI${i+1}"></textarea>`;
		}
		$("#si_list").html(html);
	}

	function appendOIList() {
		var count = $("#oi_count").val();
		var html = '';
		for (var i = 0; i < count; i++) {
			html += `<textarea type="text" name="oiList[]" class="form-control" placeholder="OI${i+1}"></textarea>`;
		}
		$("#oi_list").html(html);
	}
</script>
