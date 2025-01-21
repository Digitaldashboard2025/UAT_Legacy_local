<?php
$this->load->view('./templates/header.php');
?>

<div class="main-body">
	<div class="page-wrapper">
		<div class="page-body">
			<div class="row">
				<div class="col-xl-3 col-md-6">
					<div class="card">
						<div class="card-block">
							<div class="row align-items-center">
								<div class="col-8">
									<h4 class="text-c-purple"><?php echo $ticketsCount->s1_inc_count ?></h4>
									<h6 class="text-muted m-b-0">Tickets</h6>
								</div>
								<div class="col-4 text-right">
									<h3 class="text-muted m-b-0">S1</h3>
								</div>
							</div>
						</div>
						<a style="cursor:pointer;" onclick="getIncidentsCount('s1_incidents_count')" data-toggle="modal" data-target="#ticketDetailsModal">
							<div class="card-footer bg-c-purple">
								<div class="row align-items-center">
									<div class="col-9">
										<p class="text-white m-b-0">Details</p>
									</div>
									<div class="col-3 text-right">
										<i class="ti-arrow-top-right text-white f-16"></i>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-md-6">
					<div class="card">
						<div class="card-block">
							<div class="row align-items-center">
								<div class="col-8">
									<h4 class="text-c-green"><?php echo $ticketsCount->s2_inc_count ?></h4>
									<h6 class="text-muted m-b-0">Tickets</h6>
								</div>
								<div class="col-4 text-right">
									<h3 class="text-muted m-b-0">S2</h3>
								</div>
							</div>
						</div>
						<a style="cursor:pointer;" onclick="getIncidentsCount('s2_incidents_count')" data-toggle="modal" data-target="#ticketDetailsModal">
							<div class="card-footer bg-c-purple">
								<div class="row align-items-center">
									<div class="col-9">
										<p class="text-white m-b-0">Details</p>
									</div>
									<div class="col-3 text-right">
										<i class="ti-arrow-top-right text-white f-16"></i>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-md-6">
					<div class="card">
						<div class="card-block">
							<div class="row align-items-center">
								<div class="col-8">
									<h4 class="text-c-red"><?php echo $ticketsCount->s3_inc_count ?></h4>
									<h6 class="text-muted m-b-0">Tickets</h6>
								</div>
								<div class="col-4 text-right">
									<h3 class="text-muted m-b-0">S3</h3>
								</div>
							</div>
						</div>
						<a style="cursor:pointer;" onclick="getIncidentsCount('s3_incidents_count')" data-toggle="modal" data-target="#ticketDetailsModal">
							<div class="card-footer bg-c-purple">
								<div class="row align-items-center">
									<div class="col-9">
										<p class="text-white m-b-0">Details</p>
									</div>
									<div class="col-3 text-right">
										<i class="ti-arrow-top-right text-white f-16"></i>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-md-6">
					<div class="card">
						<div class="card-block">
							<div class="row align-items-center">
								<div class="col-8">
									<h4 class="text-c-blue"><?php echo $ticketsCount->s4_inc_count ?></h4>
									<h6 class="text-muted m-b-0">Tickets</h6>
								</div>
								<div class="col-4 text-right">
									<h3 class="text-muted m-b-0">S4</h3>
								</div>
							</div>
						</div>
						<a style="cursor:pointer;" onclick="getIncidentsCount('s4_incidents_count')" data-toggle="modal" data-target="#ticketDetailsModal">
							<div class="card-footer bg-c-purple">
								<div class="row align-items-center">
									<div class="col-9">
										<p class="text-white m-b-0">Details</p>
									</div>
									<div class="col-3 text-right">
										<i class="ti-arrow-top-right text-white f-16"></i>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>


			<!-- Pie chart -->

			<?php
			$months = array(
				1 => 'January',
				2 => 'February',
				3 => 'March',
				4 => 'April',
				5 => 'May',
				6 => 'June',
				7 => 'July',
				8 => 'August',
				9 => 'September',
				10 => 'October',
				11 => 'November',
				12 => 'December'
			);

			$selected_month = isset($_POST['month']) ? $_POST['month'] : date('n') - 2; // -2 selects previous month by default
			if ($selected_month < 1) {
				$selected_month = 12; // Set to December if previous month is less than 1
			}
			$selected_year = isset($_POST['year']) ? $_POST['year'] : date('Y');
			// Set to previous year if previous month is december or november
			if ($selected_month == 11 or $selected_month == 12) {
				$selected_year = $selected_year - 1;
			}
			?>

			<div class="row" class="text-left">
				<div class="col col-md-3 text-centert">
					<form action="" method="post">
						<select class="form-control" name="opco_name" onchange="validateOpco()" id="opco_name">
							<option>All OpCo</option>
						</select>
					</form>
				</div>


				<div class="col-md-3	">
					<form method="post" style="margin: 0 0 10px;">
						<select class="form-control" name="month" id="chooseMonth" onchange="return validateOpco();">
							<?php foreach ($months as $month_number => $month_name) : ?>
								<option value="<?php echo $month_number ?>" <?php echo $selected_month == $month_number ? ' selected' : '' ?>><?php echo $month_name ?></option>
							<?php endforeach; ?>
						</select>
					</form>
				</div>

				<div class="col-md-3">
					<form method="post" style="margin: 0 0 10px;">
						<select class="form-control" name="year" id="chooseYear" onchange="return validateOpco();">
							<?php for ($year = 2023; $year <= 2024; $year++) : ?>
								<option value="<?php echo $year ?>" <?php echo $selected_year == $year ? ' selected' : '' ?>><?php echo $year ?></option>
							<?php endfor; ?>
						</select>
					</form>
				</div>
				<div class="col col-md-3 text-center">
					<button class="form-control" id="generate-pdf" style="background-color: blue; color: white;font-size:20px"> Export PDF<i style="font-size:18px" class="fa">&#xf019; </i></button>
				</div>

				<!-- <div class="col-md-2 text-left">
					<?php if ($this->session->userdata('user_role') === 'Admin') : ?>
						<button class="btn btn-primary ms-e" id="legacy" name="LEGACY" onclick="updateQueryLegacy()">Legacy</button>
					<?php else : ?>
						<a class="disabled btn btn-primary ms-e" href="#" id="legacy" name="LEGACY">Legacy</a>
					<?php endif; ?>
				</div> -->
				<!-- <div class="col-md-2 text-center">
					<?php if ($this->session->userdata('user_role') === 'Admin') : ?>
						<button class="btn btn-primary ms-e" id="digital" name="DIGITAL" onclick="updateQueryDigital()">Digital</button>
					<?php else : ?>
						<a class="disabled btn btn-primary ms-e" href="#" id="digital" name="DIGITAL" onclick="updateQueryDigital()">Digital</a>
					<?php endif; ?>
				</div> -->

				<!-- <div class="col-md-2 text-left">
					<?php if ($this->session->userdata('user_role') === 'Admin') : ?>
						<button class="btn btn-primary ms-e" id="all-opcos" name="ALLOPCOS" onclick="updateQueryAll()">All Opcos</button>
					<?php else : ?>
						<button class="btn btn-primary ms-e" id="all-opcos" name="ALLOPCOS" onclick="updateQueryAll()">Update</button>
					<?php endif; ?>
				</div> -->


				<!-- <div class="col col-md-2 text-left">
					<button class="btn btn-primary ms-e" id="select-opcos" onclick="updateQueryid()">&nbsp&nbsp Submit &nbsp&nbsp</button>
				</div> -->

				<!-- <div class="col col-md-3 text-center"> -->
				<!-- <?php if ($this->session->userdata('user_role') === 'Admin') : ?>
						<button class="btn btn-primary ms-e" id="all-opcos" name="ALLOPCOS" onclick="updateQueryAll()">All OpCo</button>
					<?php else : ?>
						<button class="btn btn-primary ms-e" id="all-opcos" name="ALLOPCOS" onclick="updateQueryAll()">All OpCo</button>
					<?php endif; ?> -->
				<!-- </div> -->



			</div>


			<script>
				// function updateQueryDigital() {
				// 	var month = parseInt(document.getElementById('chooseMonth').value);
				// 	var year = document.getElementById('chooseYear').value;
				// 	var monthName = document.getElementById('chooseMonth').options[document.getElementById('chooseMonth').selectedIndex].text;
				// 	var yearName = document.getElementById('chooseYear').options[document.getElementById('chooseYear').selectedIndex].text;
				// 	var opco = document.getElementById('digital').name;

				// 	updateTotalIncidentsLogged(year, yearName, opco);
				// 	updateTotalWorkordersLogged(year, yearName, opco);
				// 	updateIncidentsLogged(month, year, monthName, yearName, opco);
				// 	updateWorkordersLogged(month, year, monthName, yearName, opco);
				// 	updateIncidentsResolved(month, year, monthName, yearName, opco);
				// 	updateWorkordersResolved(month, year, monthName, yearName, opco);
				// 	updateIncidentsWithinSLA(month, year, monthName, yearName, opco);
				// 	updateWorkordersWithinSLA(month, year, monthName, yearName, opco);
				// 	updateIncidentsReason(month, year, monthName, yearName, opco);
				// 	updateWorkordersReason(month, year, monthName, yearName, opco);
				// 	updateIncidentsReasonOpco(month, year, monthName, yearName, opco);
				// 	updateWorkordersReasonOpco(month, year, monthName, yearName, opco);

				// }

				// function updateQueryLegacy() {
				// 	var month = parseInt(document.getElementById('chooseMonth').value);
				// 	var year = document.getElementById('chooseYear').value;
				// 	var monthName = document.getElementById('chooseMonth').options[document.getElementById('chooseMonth').selectedIndex].text;
				// 	var yearName = document.getElementById('chooseYear').options[document.getElementById('chooseYear').selectedIndex].text;
				// 	var opco = document.getElementById('legacy').name;

				// 	updateTotalIncidentsLogged(year, yearName, opco);
				// 	updateTotalWorkordersLogged(year, yearName, opco);
				// 	updateIncidentsLogged(month, year, monthName, yearName, opco);
				// 	updateWorkordersLogged(month, year, monthName, yearName, opco);
				// 	updateIncidentsResolved(month, year, monthName, yearName, opco);
				// 	updateWorkordersResolved(month, year, monthName, yearName, opco);
				// 	updateIncidentsWithinSLA(month, year, monthName, yearName, opco);
				// 	updateWorkordersWithinSLA(month, year, monthName, yearName, opco);
				// 	updateIncidentsReason(month, year, monthName, yearName, opco);
				// 	updateWorkordersReason(month, year, monthName, yearName, opco);
				// 	updateIncidentsReasonOpco(month, year, monthName, yearName, opco);
				// 	updateWorkordersReasonOpco(month, year, monthName, yearName, opco);

				// }

				// Creating Function for drop Down data

				window.onload = function() { //function to display charts on page load
					updateQueryAll();
				}


				function validateOpco() {

					var opco_name = document.getElementById('opco_name').options[document.getElementById('opco_name').selectedIndex].text;
					if (opco_name === 'All OpCo') {
						updateQueryAll();
						return true
					} else {
						updateQueryid();
						return true
					} // Allow form submission
				}

				function updateQueryAll() {
					var month = parseInt(document.getElementById('chooseMonth').value);
					var year = document.getElementById('chooseYear').value;
					var opco = "ALLOPCOS";
					var monthName = document.getElementById('chooseMonth').options[document.getElementById('chooseMonth').selectedIndex].text;
					var yearName = document.getElementById('chooseYear').options[document.getElementById('chooseYear').selectedIndex].text;
					document.getElementById("PDF-Title").textContent = ' MSO Dashboard - ' + monthName + ' ' + yearName;

					updateTotalIncidentsLogged(year, yearName, opco);
					updateTotalWorkordersLogged(year, yearName, opco);
					updateIncidentsReason(month, year, monthName, yearName, opco);
					updateWorkordersReason(month, year, monthName, yearName, opco);
					updateIncidentsLogged(month, year, monthName, yearName, opco);
					updateWorkordersLogged(month, year, monthName, yearName, opco);
					updateIncidentsResolved(month, year, monthName, yearName, opco);
					updateWorkordersResolved(month, year, monthName, yearName, opco);
					updateIncidentsWithinSLA(month, year, monthName, yearName, opco);
					updateWorkordersWithinSLA(month, year, monthName, yearName, opco);
					updateIncidentsReasonOpco(month, year, monthName, yearName, opco);
					updateWorkordersReasonOpco(month, year, monthName, yearName, opco);
					AllOpCooutages(opco, month, year);

				}

				function updateQueryid() {
					var month = parseInt(document.getElementById('chooseMonth').value);
					var year = document.getElementById('chooseYear').value;
					var opco = document.getElementById('opco_name').value;
					var monthName = document.getElementById('chooseMonth').options[document.getElementById('chooseMonth').selectedIndex].text;
					var yearName = document.getElementById('chooseYear').options[document.getElementById('chooseYear').selectedIndex].text;
					var opco_name = document.getElementById('opco_name').options[document.getElementById('opco_name').selectedIndex].text;
					document.getElementById("PDF-Title").textContent = opco_name + ' Dashboard - ' + monthName + ' ' + yearName;
					opco = parseInt(opco, 10);

					updateTotalIncidentsLogged(year, yearName, opco);
					updateTotalWorkordersLogged(year, yearName, opco);
					updateIncidentsReason(month, year, monthName, yearName, opco);
					updateWorkordersReason(month, year, monthName, yearName, opco);
					updateIncidentsLogged(month, year, monthName, yearName, opco);
					updateWorkordersLogged(month, year, monthName, yearName, opco);
					updateIncidentsResolved(month, year, monthName, yearName, opco);
					updateWorkordersResolved(month, year, monthName, yearName, opco);
					updateIncidentsWithinSLA(month, year, monthName, yearName, opco);
					updateWorkordersWithinSLA(month, year, monthName, yearName, opco);
					updateIncidentsReasonOpco(month, year, monthName, yearName, opco);
					updateWorkordersReasonOpco(month, year, monthName, yearName, opco);
					SingleOpCooutages(opco, month, year);
				}

				function updateTotalIncidentsLogged(year, yearName, opco) {
					var xhrTILD = new XMLHttpRequest();
					xhrTILD.onreadystatechange = function() {
						if (xhrTILD.readyState === XMLHttpRequest.DONE) {
							if (xhrTILD.status === 200) {
								// Handle the response from the server
								var response = xhrTILD.responseText;
								var updatedDataTILD = JSON.parse(response);
								drawChartTILD(updatedDataTILD, yearName);
							} else {
								// Handle the error case
								console.error('Request failed for incidents logged chart.');
							}
						}
					};

					// Send an asynchronous POST request to update the query
					xhrTILD.open('POST', '<?php echo base_url(); ?>IndexController/updateQueryTIL', true);

					xhrTILD.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhrTILD.send('&year=' + year + '&opco=' + opco);
				}

				function updateTotalWorkordersLogged(year, yearName, opco) {
					var xhrTWOLD = new XMLHttpRequest();
					xhrTWOLD.onreadystatechange = function() {
						if (xhrTWOLD.readyState === XMLHttpRequest.DONE) {
							if (xhrTWOLD.status === 200) {
								// Handle the response from the server
								var response = xhrTWOLD.responseText;
								var updatedDataTWOLD = JSON.parse(response);
								drawChartTWOLD(updatedDataTWOLD, yearName);
							} else {
								// Handle the error case
								console.error('Request failed for incidents logged chart.');
							}
						}
					};

					// Send an asynchronous POST request to update the query
					xhrTWOLD.open('POST', '<?php echo base_url(); ?>IndexController/updateQueryTWOL', true);

					xhrTWOLD.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhrTWOLD.send('&year=' + year + '&opco=' + opco);
				}

				function updateIncidentsWithinSLA(month, year, monthName, yearName, opco) {
					var xhrISLA = new XMLHttpRequest();
					xhrISLA.onreadystatechange = function() {
						if (xhrISLA.readyState === XMLHttpRequest.DONE) {
							if (xhrISLA.status === 200) {
								// Handle the response from the server
								var response = xhrISLA.responseText;
								var updatedDataISLA = JSON.parse(response);
								drawChartISLA(updatedDataISLA, monthName, yearName);
							} else {
								// Handle the error case
								console.error('Request failed for incidents logged chart.');
							}
						}
					};

					// Send an asynchronous POST request to update the query
					xhrISLA.open('POST', '<?php echo base_url(); ?>IndexController/updateQueryISLA', true);

					xhrISLA.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhrISLA.send('month=' + month + '&year=' + year + '&opco=' + opco);
				}

				function updateWorkordersWithinSLA(month, year, monthName, yearName, opco) {
					var xhrWOSLA = new XMLHttpRequest();
					xhrWOSLA.onreadystatechange = function() {
						if (xhrWOSLA.readyState === XMLHttpRequest.DONE) {
							if (xhrWOSLA.status === 200) {
								// Handle the response from the server
								var response = xhrWOSLA.responseText;
								var updatedDataWOSLA = JSON.parse(response);
								drawChartWOSLA(updatedDataWOSLA, monthName, yearName);
							} else {
								// Handle the error case
								console.error('Request failed for incidents logged chart.');
							}
						}
					};

					// Send an asynchronous POST request to update the query
					xhrWOSLA.open('POST', '<?php echo base_url(); ?>IndexController/updateQueryWOSLA', true);

					xhrWOSLA.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhrWOSLA.send('month=' + month + '&year=' + year + '&opco=' + opco);
				}

				// IS in xhrIS => Incident Summary
				function updateIncidentsLogged(month, year, monthName, yearName, opco) {
					var xhrIS = new XMLHttpRequest();
					xhrIS.onreadystatechange = function() {
						if (xhrIS.readyState === XMLHttpRequest.DONE) {
							if (xhrIS.status === 200) {
								// Handle the response from the server
								var response = xhrIS.responseText;
								var updatedDataIS = JSON.parse(response);
								drawChartIR(updatedDataIS, monthName, yearName);
							} else {
								// Handle the error cases4_incidents_count
								console.error('Request failed for incidents logged chart.');
							}
						}
					};

					// Send an asynchronous POST request to update the query
					xhrIS.open('POST', '<?php echo base_url(); ?>IndexController/updateQueryISL', true);

					xhrIS.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhrIS.send('month=' + month + '&year=' + year + '&opco=' + opco);
				}

				function updateWorkordersLogged(month, year, monthName, yearName, opco) {
					var xhrWO = new XMLHttpRequest();
					xhrWO.onreadystatechange = function() {
						if (xhrWO.readyState === XMLHttpRequest.DONE) {
							if (xhrWO.status === 200) {
								// Handle the response from the server
								var response = xhrWO.responseText;
								var updatedDataWO = JSON.parse(response);
								drawChartWO(updatedDataWO, monthName, yearName);
							} else {
								// Handle the error case
								console.error('Request failed for workorders logged.');
							}
						}
					};

					// Send an asynchronous POST request to update the query
					xhrWO.open('POST', '<?php echo base_url(); ?>IndexController/updateQueryWOL', true);

					xhrWO.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhrWO.send('month=' + month + '&year=' + year + '&opco=' + opco);

				}

				function updateIncidentsResolved(month, year, monthName, yearName, opco) {
					var xhrISR = new XMLHttpRequest();
					xhrISR.onreadystatechange = function() {
						if (xhrISR.readyState === XMLHttpRequest.DONE) {
							if (xhrISR.status === 200) {
								// Handle the response from the server
								var response = xhrISR.responseText;
								var updatedDataISR = JSON.parse(response);
								drawChartISR(updatedDataISR, monthName, yearName);
							} else {
								// Handle the error case
								console.error('Request failed for incidents logged chart.');
							}
						}
					};

					// Send an asynchronous POST request to update the query
					xhrISR.open('POST', '<?php echo base_url(); ?>IndexController/updateQueryISR', true);

					xhrISR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhrISR.send('month=' + month + '&year=' + year + '&opco=' + opco);
				}

				function updateWorkordersResolved(month, year, monthName, yearName, opco) {
					var xhrWOR = new XMLHttpRequest();
					xhrWOR.onreadystatechange = function() {
						if (xhrWOR.readyState === XMLHttpRequest.DONE) {
							if (xhrWOR.status === 200) {
								// Handle the response from the server
								var response = xhrWOR.responseText;
								var updatedDataWOR = JSON.parse(response);
								drawChartWOR(updatedDataWOR, monthName, yearName);
							} else {
								// Handle the error case
								console.error('Request failed for workorders logged.');
							}
						}
					};

					// Send an asynchronous POST request to update the query
					xhrWOR.open('POST', '<?php echo base_url(); ?>IndexController/updateQueryWOR', true);

					xhrWOR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhrWOR.send('month=' + month + '&year=' + year + '&opco=' + opco);

				}

				function updateIncidentsReason(month, year, monthName, yearName, opco) {
					var xhrISRe = new XMLHttpRequest();
					xhrISRe.onreadystatechange = function() {
						if (xhrISRe.readyState === XMLHttpRequest.DONE) {
							if (xhrISRe.status === 200) {
								// Handle the response from the server
								var response = xhrISRe.responseText;
								var updatedDataISRe = JSON.parse(response);
								drawChartISRe(updatedDataISRe, monthName, yearName);
							} else {
								// Handle the error case
								console.error('Request failed for incidents logged chart.');
							}
						}
					};

					// Send an asynchronous POST request to update the query
					xhrISRe.open('POST', '<?php echo base_url(); ?>IndexController/updateQueryISRe', true);

					xhrISRe.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhrISRe.send('month=' + month + '&year=' + year + '&opco=' + opco);
				}

				function updateWorkordersReason(month, year, monthName, yearName, opco) {
					var xhrWORe = new XMLHttpRequest();
					xhrWORe.onreadystatechange = function() {
						if (xhrWORe.readyState === XMLHttpRequest.DONE) {
							if (xhrWORe.status === 200) {
								// Handle the response from the server
								var response = xhrWORe.responseText;
								var updatedDataWORe = JSON.parse(response);
								drawChartWORe(updatedDataWORe, monthName, yearName);
							} else {
								// Handle the error case
								console.error('Request failed for incidents logged chart.');
							}
						}
					};

					// Send an asynchronous POST request to update the query
					xhrWORe.open('POST', '<?php echo base_url(); ?>IndexController/updateQueryWORe', true);

					xhrWORe.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhrWORe.send('month=' + month + '&year=' + year + '&opco=' + opco);
				}

				function updateIncidentsReasonOpco(month, year, monthName, yearName, opco) {
					var xhrISRe = new XMLHttpRequest();
					xhrISRe.onreadystatechange = function() {
						if (xhrISRe.readyState === XMLHttpRequest.DONE) {
							if (xhrISRe.status === 200) {
								// Handle the response from the server
								var response = xhrISRe.responseText;
								var updatedDataISReO = JSON.parse(response);
								drawChartISReO(updatedDataISReO, monthName, yearName); //O in ISReO is Opco
							} else {
								// Handle the error case
								console.error('Request failed for incidents logged chart.');
							}
						}
					};

					// Send an asynchronous POST request to update the query
					xhrISRe.open('POST', '<?php echo base_url(); ?>IndexController/updateQueryISReO', true);

					xhrISRe.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhrISRe.send('month=' + month + '&year=' + year + '&opco=' + opco);
				}

				function updateWorkordersReasonOpco(month, year, monthName, yearName, opco) {
					var xhrWORe = new XMLHttpRequest();
					xhrWORe.onreadystatechange = function() {
						if (xhrWORe.readyState === XMLHttpRequest.DONE) {
							if (xhrWORe.status === 200) {
								// Handle the response from the server
								var response = xhrWORe.responseText;
								var updatedDataWOReO = JSON.parse(response);
								drawChartWOReO(updatedDataWOReO, monthName, yearName);
							} else {
								// Handle the error case
								console.error('Request failed for incidents logged chart.');
							}
						}
					};

					// Send an asynchronous POST request to update the query
					xhrWORe.open('POST', '<?php echo base_url(); ?>IndexController/updateQueryWOReO', true);

					xhrWORe.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhrWORe.send('month=' + month + '&year=' + year + '&opco=' + opco);
				}





				// Script Function for Drop Down 

				// function updateIncidentsLoggedid(month, year, monthName, yearName, opco) {
				// 	var xhrIS = new XMLHttpRequest();
				// 	xhrIS.onreadystatechange = function() {
				// 		if (xhrIS.readyState === XMLHttpRequest.DONE) {
				// 			if (xhrIS.status === 200) {
				// 				// Handle the response from the server
				// 				var response = xhrIS.responseText;
				// 				var updatedDataIS = JSON.parse(response);
				// 				drawChartIR(updatedDataIS, monthName, yearName);
				// 			} else {
				// 				// Handle the error cases4_incidents_count
				// 				console.error('Request failed for incidents logged chart.');
				// 			}
				// 		}
				// 	};

				// 	// Send an asynchronous POST request to update the query
				// 	xhrIS.open('POST', '<?php echo base_url(); ?>index.php/IndexController/updateQueryISLid', true);
				// 	xhrIS.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// 	xhrIS.send('month=' + month + '&year=' + year + '&opco=' + opco);
				// }
			</script>


			<!-- Test pie chart -->
			<div id="pdf">

				<br /><br />
				<div style="display: flex; align-items: center;">
					<h4 id="PDF-Title" style="margin: 0; flex: 1;  text-Align: left; font-size: 30px">MSO Dashboard</h4>
				</div> <br /><br />



				<!-- Logged -->

				<div class="row">

					<!-- Incidents logged -->
					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="incidents_logged" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>

					<!-- Workorders logged -->
					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="workorders_logged" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>
				</div></br><br /><!-- Row end -->

				<!-- Resolved -->
				<div class="row">
					<!-- Incidents Resolved -->
					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="incidents_resolved" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>

					<!-- Workorders Resolved -->
					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="workorders_resolved" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>
				</div> <br /><br /><!-- Row end -->

				<!-- SLA -->

				<div class="row">
					<!-- Incidents SLA -->

					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="IR-SLA" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>

					<!-- WORKORDERS SLA-->

					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="WO-SLA" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>
				</div><br /><br />

				<!-- Reasons with Opco -->
				<div class="row">

					<!-- Incidents reason -->

					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="incidents_reason_opco" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>

					<!-- Workorders reason -->

					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="workorders_reason_opco" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>
				</div>
				<br /><br />
				<div class="card" style="border: 5px solid blue; border-radius: 5px; margin-top: 10px ">
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-block">
									<div id="total_incidents_logged" style="width: 100%; height: 100%;"></div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="card">
								<div class="card-block">
									<div id="total_workorders_logged" style="width: 100%; height: 100%;"></div>
								</div>
							</div>
						</div>
					</div><br />
					<!-- Reasons -->
					<div class="row">

						<!-- Incidents reason -->

						<div class="col-md-6">
							<div class="card">
								<div class="card-block">
									<div id="incidents_reason" style="width: 100%; height: 100%;"></div>
								</div>
							</div>
						</div>

						<!-- Workorders reason -->

						<div class="col-md-6">
							<div class="card">
								<div class="card-block">
									<div id="workorders_reason" style="width: 100%; height: 100%;"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br /><br />


				<!-- Outages -->

				<div class="row">
					<div class="col-md-12 justify-content-center">
						<div class="card">
							<div class="card-block">
								<div id="incidents_outages" style="width: 100%; height: 100%; padding-left: 50px;"></div>
							</div>
						</div>
					</div>
				</div><br /><br /><br />


				<!-- incidents_summary_OW LEGACY -->

				<div class="row" id="incidents_summary_OWS">
					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="incidents_summary_OWl" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>

					<!-- Incidents_summary_OW Digital -->

					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="incidents_summary_OWd" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>

				</div><br /><br /><br />



				<!-- Incidents_summary_Severity wise -->
				<div class="row" id="incidents_summary_SWS">
					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="incidents_summary_SWl" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>

					<!-- Incidents_summary_OW Digital -->

					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="incidents_summary_SWd" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>

				</div><br /><br /><br />


				<!-- Incidents_SLA_Met_Legacy -->

				<div class="row" id="incidents_sla_S">
					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="incidents_sla_l" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>

					<!-- Incidents_SLA_Met_Digital -->

					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="incidents_sla_d" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>

				</div>
				<br /><br /><br /><br /><br />

				<!-- Accounts_Biled_Legacy -->

				<div class="row" id="Accounts">
					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="accounts_billed_l" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>

					<!-- Accounts_Biled_Legacy -->

					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="accounts_billed_d" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>

				</div>

				<br /><br /><br /><br />

				<!-- Services_Biled_Legacy -->

				<div class="row" id="Services">
					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="services_billed_l" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>

					<!-- Services_Biled_Digital -->

					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="services_billed_d" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>

				</div><br /><br /><br /><br />

				<!-- Total_Time_Legacy -->

				<div class="row" id="Totaltime">
					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="total_time_l" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>

					<!-- Total_Time_Digital -->

					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
								<div id="total_time_d" style="width: 100%; height: 100%;"></div>
							</div>
						</div>
					</div>

				</div>
			</div>

			<!-- pdf file div ends here -->


			<!-- Dashboards
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-block">
							<div id="automationDashboard"></div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-block">
							<div id="kmDashboard"></div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-block">
							<div id="oiDashboard"></div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-block">
							<div id="siDashboard"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<span id="all_opcos_report">

					</span>
				</div>
			</div> -->
		</div>
	</div>
</div>


<!-- Dashboard Ticket Details Modal -->
<style>
	.table td,
	.table th {
		padding: 0px;
	}
</style>
<div class="modal fade" id="ticketDetailsModal" tabindex="-1" role="dialog" aria-labelledby="ticketDetailsModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ticketDetailsModalLabel">Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped table-bordered">
							<thead>
								<tr style="background-color:#1c00c8;color:white;">
									<th class="text-center">OPCO</th>
									<!-- Display the previous months dynamically -->
									<script>
										var currentDate = new Date();
										// var currentMonth = currentDate.getMonth();
										var currentYear = currentDate.getFullYear();
										var month = parseInt(document.getElementById('chooseMonth').value);
										var year = document.getElementById('chooseYear').value;
										// if (currentYear == year) {

										// } else if (year < currentYear) {
										currentMonth = 12;

										// }
										// } else {
										// 	currentMonth = 0;
										// }

										for (var i = 0; i < currentMonth; i++) {
											var monthName = new Date(year, i, 1).toLocaleString('default', {
												month: 'short'
											});
											document.write('<th class="text-center">' + monthName + '</th>');
										}
									</script>
								</tr>
							</thead>
							<tbody id="modal_content">

							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<a type="button" class="btn btn-primary" data-dismiss="modal" style="color:white">Close</a>
			</div>
		</div>
	</div>
</div>

<?php
$this->load->view('./templates/footer.php');
?>
<?php
$this->load->view('./metaDataScript.php');
?>
<!--  <script>
	$(document).ready(function() {
		//getReportData()
		getDashboardsGraphsData()
	})

	function getReportData() {
		// var currentDate = new Date();
		// var year = currentDate.getFullYear();
		// var month_number = currentDate.getMonth() - 1;
		var month_number = parseInt(document.getElementById('chooseMonth').value);
		var year = document.getElementById('chooseYear').value;
		var lastThreeMonths = getLastMonths(month_number);
		console.log(lastThreeMonths)
		$.ajax({
			url: '<?php echo site_url('ReportsController/getAllOpcosReportData') ?>',
			type: 'post',
			data: {
				'year': year,
				'month': month_number,
				'lastThreeYearsMonths': lastThreeMonths
			},
			success: function(data) {
				var metaData = $.parseJSON(data)
				var data = metaData.opcos_meta_data;
				var automation_dashboard_data = metaData.automation_dashboard_data;
				var km_dashboard_data = metaData.km_dashboard_data;
				var oi_dashboard_data = metaData.oi_dashboard_data;
				var si_dashboard_data = metaData.si_dashboard_data;
				var brs_digital_opcos = metaData.brs_digital_opcos
				var brs_legacy_mtn_opcos = metaData.brs_legacy_mtn_opcos
				var brs_legacy_nonmtn_opcos = metaData.brs_legacy_nonmtn_opcos
				var html = ``;
				var prevThreeYearsMonths = lastThreeMonths[0].reverse()
				var prevThreeYears = lastThreeMonths[1].reverse()
				var prevThreeMonths = lastThreeMonths[2].reverse()

				//Incident Summary Details
				var incidents_summary_digital = metaData.incidents_summary_digital;
				var incidents_summary_legacy = metaData.incidents_summary_legacy;
				appendIncidentSummaryDetails('Incidents Summary', month_number, year, incidents_summary_digital, incidents_summary_legacy, 0)

				//SLA Summary Details
				var sla_incidents_summary_digital = metaData.sla_incidents_summary_digital;
				var sla_incidents_summary_legacy = metaData.sla_incidents_summary_legacy;
				appendSLAIncidentSummaryDetails('SLA Summary', month_number, year, sla_incidents_summary_digital, sla_incidents_summary_legacy, 0)

				for (var ind = 0; ind < data.length; ind++) {
					var html = '';
					var opco_details = data[ind].opco_details;
					var incidents_summary_data = data[ind].incidents_summary_data;
					var sr_summary_data = data[ind].sr_summary_data;
					var monthNames = getMonthNameAndShortCutName(month_number)
					var inc_count = []
					for (var i = 0; i < prevThreeYearsMonths.length; i++) {
						if (incidents_summary_data[prevThreeYearsMonths[i]] && incidents_summary_data[prevThreeYearsMonths[i]] != 'null' && incidents_summary_data[prevThreeYearsMonths[i]] !== 'undefined') {
							inc_count.push(parseInt(incidents_summary_data[prevThreeYearsMonths[i]]['inc_count']))
						} else {
							inc_count.push(0)
						}
					}
					var sr_count = []
					for (var i = 0; i < prevThreeYearsMonths.length; i++) {
						if (sr_summary_data[prevThreeYearsMonths[i]] && sr_summary_data[prevThreeYearsMonths[i]] != 'null' && sr_summary_data[prevThreeYearsMonths[i]] !== 'undefined') {
							sr_count.push(parseInt(sr_summary_data[prevThreeYearsMonths[i]]['sr_count']))
						} else {
							sr_count.push(0)
						}
					}
					$("#all_opcos_report").append(html);
					generateLineGraph(prevThreeYearsMonths, inc_count, sr_count, ind);
				}
				// downloadPPT()
			}
		});
	}

	function appendIncidentSummaryDetails(heading, month, year, incidents_summary_digital, incidents_summary_legacy, unique) {
		var incidentSummary = '';
		incidentSummary += `
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 style="color:#1c00c8;">${heading} - ${year}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="legacyOpcosGraph"></canvas>
                        </div>
                        <div class="col-md-6">
                            <canvas id="digitalOpcosGraph"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        `;
		$("#all_opcos_report").append(incidentSummary);
		var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
		var labels = [];
		for (var i = 0; i <= month; i++) {
			labels.push(monthNames[i] + " " + year)
		}
		console.log(incidents_summary_legacy)
		var xValues = labels;
		new Chart("legacyOpcosGraph", {
			type: "line",
			data: {
				labels: labels,
				datasets: incidents_summary_legacy
			},
			options: {
				responsive: true,
				title: {
					display: true,
					position: "top",
					text: "Legacy OpCo's",
					fontSize: 18,
					fontColor: "#111"
				},
				legend: {
					display: true,
					position: "bottom",
					labels: {
						fontColor: "#333",
						fontSize: 8,
						usePointStyle: true,
						pointStyle: "line"
					}
				},
				scales: {
					yAxes: [{
						ticks: {
							reverse: false,
							stepSize: 50
						},
					}]
				}
			}
		});
		new Chart("digitalOpcosGraph", {
			type: "line",
			data: {
				labels: labels,
				datasets: incidents_summary_digital
			},
			options: {
				responsive: true,
				title: {
					display: true,
					position: "top",
					text: "Digital OpCo's",
					fontSize: 18,
					fontColor: "#111"
				},
				legend: {
					display: true,
					position: "bottom",
					labels: {
						fontColor: "#333",
						fontSize: 8,
						usePointStyle: true,
						pointStyle: "line"
					}
				},
				scales: {
					yAxes: [{
						ticks: {
							reverse: false,
							stepSize: 80
						},
					}]
				}
			}
		});
	}

	function appendSLAIncidentSummaryDetails(heading, month, year, incidents_summary_digital, incidents_summary_legacy, unique) {
		var incidentSummary = '';
		incidentSummary += `
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 style="color:#1c00c8;">${heading} - ${year}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="slalegacyOpcosGraph"></canvas>
                        </div>
                        <div class="col-md-6">
                            <canvas id="sladigitalOpcosGraph"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        `;
		$("#all_opcos_report").append(incidentSummary);
		var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
		var labels = [];
		for (var i = 0; i <= month; i++) {
			labels.push(monthNames[i] + " " + year)
		}
		var xValues = labels;
		new Chart("slalegacyOpcosGraph", {
			type: "line",
			data: {
				labels: labels,
				datasets: incidents_summary_legacy
			},
			options: {
				responsive: true,
				title: {
					display: true,
					position: "top",
					text: "Legacy OpCo's",
					fontSize: 18,
					fontColor: "#111"
				},
				legend: {
					display: true,
					position: "bottom",
					labels: {
						fontColor: "#333",
						fontSize: 8,
						usePointStyle: true,
						pointStyle: "line"
					}
				}
			}
		});
		new Chart("sladigitalOpcosGraph", {
			type: "line",
			data: {
				labels: labels,
				datasets: incidents_summary_digital
			},
			options: {
				responsive: true,
				title: {
					display: true,
					position: "top",
					text: "Digital OpCo's",
					fontSize: 18,
					fontColor: "#111"
				},
				legend: {
					display: true,
					position: "bottom",
					labels: {
						fontColor: "#333",
						fontSize: 8,
						usePointStyle: true,
						pointStyle: "line"
					}
				}
			}
		});
	}
</script>

<script src="https://cdn.jsdelivr.net/gh/gitbrent/pptxgenjs@3.10.0/dist/pptxgen.bundle.js"></script>
<script>
	function downloadPPT() {
		let pptx = new PptxGenJS();
		let slide = pptx.addSlide();
		pptx.addSection({
			title: "Tables"
		});
		pptx.tableToSlides("billRunStatusTableId0");
		pptx.tableToSlides("billRunStatusTableId1");
		pptx.tableToSlides("billRunStatusTableId2");
		pptx.tableToSlides("dashboardTableId0");
		pptx.tableToSlides("dashboardTableId1");
		pptx.tableToSlides("dashboardTableId2");
		pptx.tableToSlides("dashboardTableId3");
		pptx.writeFile({
			fileName: "dashboards.pptx"
		});
	}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
	function generateLineGraph(prevThreeYearsMonths, inc_count, sr_count, index) { -->
<!-- // var options = {
		//     series: [
		//     {
		//         name: "High - 2013",
		//         data: [28, 29, 33, 36, 32, 32, 33]
		//     },
		//     {
		//         name: "Low - 2013",
		//         data: [12, 11, 14, 18, 17, 13, 13]
		//     }
		//     ],
		//     chart: {
		//         height: 350,
		//         type: 'line',
		//         dropShadow: {
		//             enabled: true,
		//             color: '#000',
		//             top: 18,
		//             left: 7,
		//             blur: 10,
		//             opacity: 0.2
		//         },
		//         toolbar: {
		//             show: false
		//         }
		//     },
		//     colors: ['#77B6EA', '#545454'],
		//     dataLabels: {
		//         enabled: true,
		//     },
		//     stroke: {
		//         curve: 'smooth'
		//     },
		//     title: {
		//         text: 'Average High & Low Temperature',
		//         align: 'left'
		//     },
		//     grid: {
		//         borderColor: '#e7e7e7',
		//         row: {
		//             colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
		//             opacity: 0.5
		//         },
		//     },
		//     markers: {
		//         size: 1
		//     },
		//     xaxis: {
		//         categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		//         title: {
		//             text: 'Month'
		//         }
		//     },
		//     yaxis: {
		//         title: {
		//             text: 'Temperature'
		//         },
		//         min: 5,
		//         max: 40
		//     },
		//     legend: {
		//         display: false,
		//         position: 'top',
		//         horizontalAlign: 'right',
		//         floating: true,
		//         offsetY: -25,
		//         offsetX: -5
		//     }
		// };

		// var chart = new ApexCharts(document.querySelector("#legacyOpcosGraph"), options);
		// chart.render();
	} 
</script>  -->
<!-- 
<script>
	function getDashboardsGraphsData() {
		var currentDate = new Date();
		var year = document.getElementById('chooseYear').value;
		$.ajax({
			url: '<?php echo site_url('IndexController/getDashboardsGraphsData') ?>',
			type: 'post',
			data: {
				'year': year
			},
			success: function(data) {
				var metaData = $.parseJSON(data)
				var automation = metaData.automation;
				var km = metaData.km;
				var oi = metaData.oi;
				var si = metaData.si;
				var automationData = []
				var kmData = []
				var oiData = []
				var siData = []
				var months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
				var temp = 0
				for (var i = 0; i < months.length; i++) {
					for (var j = 0; j < automation.length; j++) {
						if (automation[j]['month_number'] == months[i]) {
							temp = parseInt(automation[j]['total_count'])
						}
					}
					automationData.push(temp)
					temp = 0
					for (var j = 0; j < km.length; j++) {
						if (km[j]['month_number'] == months[i]) {
							temp = parseInt(km[j]['total_count'])
						}
					}
					kmData.push(temp)
					temp = 0
					for (var j = 0; j < oi.length; j++) {
						if (oi[j]['month_number'] == months[i]) {
							temp = parseInt(oi[j]['total_count'])
						}
					}
					oiData.push(temp)
					temp = 0
					for (var j = 0; j < si.length; j++) {
						if (si[j]['month_number'] == months[i]) {
							temp = parseInt(si[j]['total_count'])
						}
					}
					siData.push(temp)
					temp = 0
				}
				// renderBarGraph();
				renderBarGraph('automationDashboard', 'Automation - ' + year, automationData)
				renderBarGraph('kmDashboard', 'Knowledge Management - ' + year, kmData)
				renderBarGraph('oiDashboard', 'Open Incidents - ' + year, oiData)
				renderBarGraph('siDashboard', 'Security Incidents - ' + year, siData)
			}
		});
	}

	function renderGraph(id, title, data) {
		var options = {
			title: {
				text: title,
				align: 'center'
			},
			series: [{
				name: 'Count',
				data: data
			}],
			chart: {
				height: 250,
				type: 'bar',
				events: {
					click: function(chart, w, e) {
						// console.log(chart, w, e)
					}
				}
			},
			// colors: colors,
			plotOptions: {
				bar: {
					columnWidth: '45%',
					distributed: true,
					dataLabels: {
						position: 'top',
						offsetY : 30 // Display labels on top of the bars
					}
				}
			},
			legend: {
				show: false
			},
			labels: [
				'Jan',
				'Feb',
				'Mar',
				'Apr',
				'May',
				'Jun',
				'Jul',
				'Aug',
				'Sep',
				'Oct',
				'Nov',
				'Dec'
			],
			dataLabels: {
				formatter: function(val, opts) {
					return opts.w.config.series[opts.seriesIndex]
				}
			},
			legend: {
				position: 'bottom'
			},
			responsive: [{
				breakpoint: 480,
				options: {
					chart: {
						width: 200
					}
				},
				legend: {
					position: 'bottom',
					floating: true
				}
			}]
		};
		var chart = new ApexCharts(document.querySelector("#" + id), options).render();
		//chart.render();

	}

	function renderBarGraph() {
		// var options = {
		//     series: [{
		//         name: 'Count',
		//         data: [44, 55, 41, 67, 22, 43, 21, 33, 45, 31, 87, 65]
		//     }],
		//     chart: {
		//         height: 350,
		//         type: 'bar',
		//     },
		//     plotOptions: {
		//         bar: {
		//             borderRadius: 10,
		//             columnWidth: '50%',
		//         }
		//     },
		//     dataLabels: {
		//         enabled: false
		//     },
		//     stroke: {
		//         width: 2
		//     },
		//     grid: {
		//         row: {
		//             colors: ['#fff', '#f2f2f2']
		//         }
		//     },
		//     xaxis: {
		//         labels: {
		//             rotate: -45
		//         },
		//         categories: [
		//             'January',
		//             'February',
		//             'March',
		//             'April',
		//             'May',
		//             'June',
		//             'July',
		//             'August',
		//             'September',
		//             'October',
		//             'November',
		//             'December'
		//         ],
		//         tickPlacement: 'on'
		//     },
		//     yaxis: {
		//         title: {
		//             text: 'Servings',
		//         },
		//     },
		//     fill: {
		//         type: 'gradient',
		//         gradient: {
		//             shade: 'light',
		//             type: "horizontal",
		//             shadeIntensity: 0.25,
		//             gradientToColors: undefined,
		//             inverseColors: true,
		//             opacityFrom: 0.85,
		//             opacityTo: 0.85,
		//             stops: [50, 0, 100]
		//         },
		//     }
		// };

		// var chart = new ApexCharts(document.querySelector("#automationDashboard"), options);
		// chart.render();
	}

	function renderBarGraph(id, title, data) {
		var options = {
			title: {
				text: title,
				align: 'center'
			},
			series: [{
				name: 'Count',
				data: data,
			}],
			chart: {
				height: 250,
				type: 'bar',
				events: {
					click: function(chart, w, e) {
						// console.log(chart, w, e)
					}
				}
			},
			// colors: colors,
			plotOptions: {
				bar: {
					columnWidth: '45%',
					distributed: true,
					dataLabels: {
						position : 'top',
						offsetY : 11,
						offsetX : 0
					}	
				},
			},
			legend: {
				show: false
			},
			xaxis: {
				categories: [
					'Jan',
					'Feb',
					'Mar',
					'Apr',
					'May',
					'Jun',
					'Jul',
					'Aug',
					'Sep',
					'Oct',
					'Nov',
					'Dec'
				],
				labels: {
					style: {
						fontSize: '12px'
					}
				},
			},
		};

		var chart = new ApexCharts(document.querySelector("#" + id), options);
		chart.render();
		document.querySelector("#" + id + ' .apexcharts-data-labels').style.top = '30px';
	}
</script> -->

<!--<script>
	function getIncidentsCount(columnName) {
		var currentDate = new Date();
		var year = currentDate.getFullYear();
		$.ajax({
			url: '<?php echo site_url('IndexController/getIncidentsCount') ?>',
			type: 'post',
			data: {
				'year': year,
				'columnName': columnName
			},
			success: function(data) {
				var dashboard_data = $.parseJSON(data);
				var dashoboardRows = '';
				for (var index = 0; index < dashboard_data.length; index++) {
					dashoboardRows += '<tr>';
					dashoboardRows += '<td>' + dashboard_data[index].opco_name + '</td>';
					for (var j = 0; j < dashboard_data[index].counts.length; j++) {
						dashoboardRows += '<td class="text-center">' + dashboard_data[index].counts[j] + '</td>';
					}
					dashoboardRows += '</tr>';
				}
				$("#modal_content").html(dashoboardRows)
			}
		})
	}
</script>-->

<script>
	function getIncidentsCount(columnName) {
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();
		var opco = document.getElementById('opco_name').value;
		var month = parseInt(document.getElementById('chooseMonth').value);
		var year = document.getElementById('chooseYear').value;
		if (currentYear == year) {

		} else if (year < currentYear) {
			// if (currentMonth = 1) {
			// 	currentMonth = 11;
			// } else {
			currentMonth = 12;

			// }
		} else {
			currentMonth = 0;
		}


		$.ajax({
			url: '<?php echo site_url('IndexController/getIncidentsCount') ?>',
			type: 'post',
			data: {
				'year': year,
				'columnName': columnName,
				'opco': opco
			},
			success: function(data) {
				var dashboard_data = $.parseJSON(data);
				var dashoboardRows = '';
				for (var index = 0; index < dashboard_data.length; index++) {
					dashoboardRows += '<tr>';
					dashoboardRows += '<td>' + dashboard_data[index].opco_name + '</td>';

					for (var month = 1; month <= currentMonth; month++) {
						// var count = dashboard_data[index].counts[month - 1] || 0; 
						var count = dashboard_data[index].counts[month - 1];
						count = count !== undefined && count !== null && count !== '0' && count !== 0 ? count : '-';
						// Get count or default to 0 if undefined
						dashoboardRows += '<td class="text-center">' + count + '</td>';
					}

					dashoboardRows += '</tr>';
				}
				$("#modal_content").html(dashoboardRows);
			}
		});
	}
</script>

<!-- Google pie chart script -->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- Test chart script -->


<script type="text/javascript">
	google.charts.load('current', {
		'packages': ['corechart']
	});

	function drawChartTILD(updatedDataTILD, yearName) {
		// Create the data table
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Severity');
		data.addColumn('number', 'count');
		var firstRow = updatedDataTILD.shift();
		var Total = firstRow[1];
		// data.addRows(updatedDataTILD);
		// Modify the data to include a new column for legend entries
		var formattedData = updatedDataTILD.map(function(row) {
			return [row[0] + ' - ' + row[1], row[1]];
		});

		data.addRows(formattedData);

		// Set chart options
		var options = {
			'title': 'All OpCo Total Incidents Logged for the Year ' + yearName + ' - ' + Total,
			'titleTextStyle': {
				'color': 'black', // Set the color of the title text
				'fontSize': 12, // Set the font size of the title text
				'bold': true // Make the title text bold
				// You can include other text styling options as needed
			},
			'pieSliceText': 'none',
			is3D: 'true',
			'tooltip': {
				isHtml: true,
				text: 'none'
			},
			'legend': {
				position: 'right',
				alignment: 'center',
				textStyle: {
					fontSize: 11 // Adjust the font size of legend items
				}
			},
			sliceVisibilityThreshold: 0.00001,
			threshold: 0,
			chartArea: {
				width: '100%',
				height: '80%',
			}
		};

		// Instantiate and draw the chart
		var chartContainer = document.getElementById('total_incidents_logged');
		var chart = new google.visualization.PieChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		// Center the chart and title using CSS
		chartContainer.style.width = '450px';
		chartContainer.style.height = '300px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'flex-start'; // Align the content to the left
		chartContainer.style.justifyContent = 'left'; // Center the content vertically
		chartContainer.style.marginLeft = '-20px'; // Adjust value as needed
		chart.draw(data, options);

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

	}
</script>

<script type="text/javascript">
	google.charts.load('current', {
		'packages': ['corechart']
	});

	function drawChartTWOLD(updatedDataTWOLD, yearName) {
		// Create the data table
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Severity');
		data.addColumn('number', 'count');
		var firstRow = updatedDataTWOLD.shift();
		var Total = firstRow[1];
		// data.addRows(updatedDataTWOLD);
		// Modify the data to include a new column for legend entries
		var formattedData = updatedDataTWOLD.map(function(row) {
			return [row[0] + ' - ' + row[1], row[1]];
		});

		data.addRows(formattedData);

		// Set chart options
		var options = {
			'title': 'All OpCo Total Workorders Logged for the Year ' + yearName + ' - ' + Total,
			'titleTextStyle': {
				'color': 'black', // Set the color of the title text
				'fontSize': 12, // Set the font size of the title text
				'bold': true // Make the title text bold
				// You can include other text styling options as needed
			},
			'pieSliceText': 'none',
			is3D: 'true',
			'tooltip': {
				isHtml: true,
				text: 'none'
			},
			'legend': {
				position: 'right',
				alignment: 'center',
				textStyle: {
					fontSize: 11 // Adjust the font size of legend items
				}
			},
			sliceVisibilityThreshold: 0.00001,
			threshold: 0,
			chartArea: {
				width: '100%',
				height: '80%',
			}
		};

		// Instantiate and draw the chart
		var chartContainer = document.getElementById('total_workorders_logged');
		var chart = new google.visualization.PieChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		// Center the chart and title using CSS
		chartContainer.style.width = '450px';
		chartContainer.style.height = '300px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'flex-start'; // Align the content to the left
		chartContainer.style.justifyContent = 'left'; // Center the content vertically
		chartContainer.style.marginLeft = '-20px'; // Adjust value as needed
		chart.draw(data, options);

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

	}
</script>

<!-- Incidents reason -->

<script type="text/javascript">
	google.charts.load('current', {
		'packages': ['corechart']
	});

	function drawChartISRe(updatedDataISRe, monthName, yearName) {
		// Create the data table
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'category');
		data.addColumn('number', 'count');
		// data.addRows(updatedDataISRe);
		var firstRow = updatedDataISRe.shift();
		var Total = firstRow[1];
		// Modify the data to include a new column for legend entries
		var formattedData = updatedDataISRe.map(function(row) {
			return [row[0] + ' - ' + row[1], row[1]];
		});

		data.addRows(formattedData);

		// Set chart options
		var options = {
			'title': 'All OpCo Category Wise Breakup for Incidents for the Year ' + yearName + ' - ' + Total,
			'titleTextStyle': {
				'color': 'black', // Set the color of the title text
				'fontSize': 12, // Set the font size of the title text
				'bold': true // Make the title text bold
				// You can include other text styling options as needed
			},
			'pieSliceText': 'none',
			is3D: 'true',
			'tooltip': {
				isHtml: true,
				text: 'none'
			},
			'legend': {
				position: 'right',
				alignment: 'center',
				textStyle: {
					fontSize: 10 // Adjust the font size of legend items
				}
			},
			sliceVisibilityThreshold: 0.00001,
			chartArea: {
				width: '100%',
				height: '80%',
			}
		};

		// Instantiate and draw the chart
		var chartContainer = document.getElementById('incidents_reason');
		var chart = new google.visualization.PieChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		// Center the chart and title using CSS
		chartContainer.style.width = '450px';
		chartContainer.style.height = '300px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'flex-start'; // Align the content to the left
		chartContainer.style.justifyContent = 'left'; // Center the content vertically
		chartContainer.style.marginLeft = '-20px'; // Adjust value as needed
		chart.draw(data, options);

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}
	}
</script>


<!-- Workorders reason -->
<script type="text/javascript">
	google.charts.load('current', {
		'packages': ['corechart']
	});

	function drawChartWORe(updatedDataWORe, monthName, yearName) {
		// Create the data table
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'category');
		data.addColumn('number', 'count');
		// data.addRows(updatedDataWORe);
		var firstRow = updatedDataWORe.shift();
		var Total = firstRow[1];
		// Modify the data to include a new column for legend entries
		var formattedData = updatedDataWORe.map(function(row) {
			return [row[0] + ' - ' + row[1], row[1]];
		});

		data.addRows(formattedData);

		// Set chart options
		var options = {
			'title': 'All OpCo Category Wise Breakup for Workorders for the Year ' + yearName + ' - ' + Total,
			'titleTextStyle': {
				'color': 'black', // Set the color of the title text
				'fontSize': 12, // Set the font size of the title text
				'bold': true // Make the title text bold
				// You can include other text styling options as needed
			},
			'pieSliceText': 'none',
			is3D: 'true',
			'tooltip': {
				isHtml: true,
				text: 'none'
			},
			'legend': {
				position: 'right',
				alignment: 'center',
				textStyle: {
					fontSize: 10 // Adjust the font size of legend items
				}
			},
			sliceVisibilityThreshold: 0.00001,
			chartArea: {
				width: '100%',
				height: '80%',
			}
		};

		// Instantiate and draw the chart
		var chartContainer = document.getElementById('workorders_reason');
		var chart = new google.visualization.PieChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		// Center the chart and title using CSS
		chartContainer.style.width = '450px';
		chartContainer.style.height = '300px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'flex-start'; // Align the content to the left
		chartContainer.style.justifyContent = 'left'; // Center the content vertically
		chartContainer.style.marginLeft = '-20px'; // Adjust value as needed
		chart.draw(data, options);

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}
	}
</script>


<!-- Incidents logged script -->

<script type="text/javascript">
	google.charts.load('current', {
		'packages': ['corechart']
	});

	function drawChartIR(updatedDataIS, monthName, yearName) {
		// Create the data table
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'opco_name');
		data.addColumn('number', 'count');
		data.addColumn('number', 's1_incidents_count');
		data.addColumn('number', 's2_incidents_count');
		data.addColumn('number', 's3_incidents_count');
		data.addColumn('number', 's4_incidents_count');
		// data.addRows(updatedDataIS);
		// Modify the data to include a new column for legend entries
		var formattedData = updatedDataIS.map(function(row) {
			return [row[0] + ' - ' + row[1], row[1], row[2], row[3], row[4], row[5]];
		});

		data.addRows(formattedData);

		// Set chart options1
		var options = {
			'title': 'OpCo Wise Incidents Logged',
			'titleTextStyle': {
				'color': 'black', // Set the color of the title text
				'fontSize': 12, // Set the font size of the title text
				'bold': true // Make the title text bold
				// You can include other text styling options as needed
			},
			'pieSliceText': 'none',
			is3D: 'true',
			'tooltip': {
				trigger: 'none'
			},
			'legend': {
				position: 'right',
				alignment: 'center',
				textStyle: {
					fontSize: 10 // Adjust the font size of legend items
				}
			},
			sliceVisibilityThreshold: 0.00001,
			threshold: 0,
			chartArea: {
				width: '100%',
				height: '80%',
			}
		};

		// Instantiate and draw the chart
		var chartContainer = document.getElementById('incidents_logged');
		var chart = new google.visualization.PieChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		// Center the chart and title using CSS
		chartContainer.style.width = '450px';
		chartContainer.style.height = '300px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'flex-start'; // Align the content to the left
		chartContainer.style.justifyContent = 'left'; // Center the content vertically
		chartContainer.style.marginLeft = '-20px'; // Adjust value as needed
		chart.draw(data, options);

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

		if (data.getNumberOfRows() === 1) {
			// Set selection to the first row
			chart.setSelection([{
				row: 0,
				column: null
			}]);
			// Get and log the selection
			var selection = chart.getSelection()[0];
			var sliceName = data.getValue(selection.row, 0);
			var sliceCount = data.getValue(selection.row, 1);
			var sliceS1 = data.getValue(selection.row, 2);
			var sliceS2 = data.getValue(selection.row, 3);
			var sliceS3 = data.getValue(selection.row, 4);
			var sliceS4 = data.getValue(selection.row, 5);

			// Create data table for selected slice
			var sliceData = new google.visualization.DataTable();
			sliceData.addColumn('string', 'Severity');
			sliceData.addColumn('number', 'Incident Count');
			sliceData.addRow(['S1 - ' + sliceS1, sliceS1]);
			sliceData.addRow(['S2 - ' + sliceS2, sliceS2]);
			sliceData.addRow(['S3 - ' + sliceS3, sliceS3]);
			sliceData.addRow(['S4 - ' + sliceS4, sliceS4]);

			// Set chart options for selected slice
			var sliceOptions = {
				'title': 'Severity Wise Incidents Logged (' + sliceName + ')',
				'titleTextStyle': {
					'color': 'black', // Set the color of the title text
					'fontSize': 12, // Set the font size of the title text
					'bold': true // Make the title text bold
					// You can include other text styling options as needed
				},
				'pieSliceText': 'none',
				is3D: 'true',
				'tooltip': {
					trigger: 'value'
				},
				'legend': {
					position: 'right',
					alignment: 'center'
				},
				sliceVisibilityThreshold: 0.00001,
				threshold: 0,
				chartArea: {
					width: '100%',
					height: '75%',
				}

			};
			// Instantiate and draw the chart
			var chartContainer = document.getElementById('incidents_logged');
			var sliceChart = new google.visualization.PieChart(chartContainer);
			sliceChart.draw(sliceData, sliceOptions);

			// Center the chart and title using CSS
			chartContainer.style.display = 'flex';
			chartContainer.style.flexDirection = 'column';
			chartContainer.style.alignItems = 'center';

			// Adjust the title position
			var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
			if (chartTitle) {
				chartTitle.setAttribute('text-anchor', 'middle');
				chartTitle.setAttribute('x', '100%');
				chartTitle.style.transform = 'translateX(-50%)';
			}
		}

		// Add event listener for slice selection
		google.visualization.events.addListener(chart, 'select', selectHandler);

		// Slice selection handler
		function selectHandler() {
			// Get selected slice data
			var selection = chart.getSelection()[0];
			if (selection) {
				var sliceName = data.getValue(selection.row, 0);
				var sliceCount = data.getValue(selection.row, 1);
				var sliceS1 = data.getValue(selection.row, 2);
				var sliceS2 = data.getValue(selection.row, 3);
				var sliceS3 = data.getValue(selection.row, 4);
				var sliceS4 = data.getValue(selection.row, 5);

				// Create data table for selected slice
				var sliceData = new google.visualization.DataTable();
				sliceData.addColumn('string', 'Severity');
				sliceData.addColumn('number', 'Incident Count');
				sliceData.addRow(['S1 - ' + sliceS1, sliceS1]);
				sliceData.addRow(['S2 - ' + sliceS2, sliceS2]);
				sliceData.addRow(['S3 - ' + sliceS3, sliceS3]);
				sliceData.addRow(['S4 - ' + sliceS4, sliceS4]);

				// Set chart options for selected slice
				var sliceOptions = {
					'title': 'Severity Wise Incidents Logged (' + sliceName + ')',
					'titleTextStyle': {
						'color': 'black', // Set the color of the title text
						'fontSize': 12, // Set the font size of the title text
						'bold': true // Make the title text bold
						// You can include other text styling options as needed
					},
					pieSliceText: 'none',
					'width': 500,
					'height': 300,
					is3D: 'true',
					'tooltip': {
						'text': 'value'
					},
					sliceVisibilityThreshold: 0.00001,
					threshold: 0,
					chartArea: {
						left: '0',
						width: '100%',
						height: '75%',
					}

				};
				// Function to load Google Visualization API
				function loadGoogleVisualizationAPI(callback) {
					// Check if the API is already loaded
					if (typeof google !== 'undefined' && google.visualization) {
						callback();
					} else {
						// Load the Google Visualization API
						var script = document.createElement('script');
						script.type = 'text/javascript';
						script.src = 'https: //www.gstatic.com/charts/loader.js';
						script.onload = callback;
						document.head.appendChild(script);
					}
				}
				var popupContent = document.createElement('div');
				popupContent.style.margin = 'auto';
				popupContent.id = 'slice_chart_div';
				var popupContainer = document.createElement('div');
				popupContainer.appendChild(popupContent);
				popupContainer.style.position = 'fixed';
				popupContainer.style.top = '50%';
				popupContainer.style.left = '50%';
				popupContainer.style.transform = 'translate(-50%, -50%)';
				popupContainer.style.width = '700px';
				popupContainer.style.height = '300px';
				popupContainer.style.backgroundColor = 'white';
				popupContainer.style.border = '1px solid #ccc';
				document.body.appendChild(popupContainer);
				// Load Google Visualization API and create the chart
				loadGoogleVisualizationAPI(function() {
					var chartContainer = document.getElementById('slice_chart_div');
					var chart = new google.visualization.PieChart(chartContainer);
					chart.draw(sliceData, sliceOptions);

					// Center the chart and title using CSS
					chartContainer.style.display = 'flex';
					chartContainer.style.flexDirection = 'column';
					chartContainer.style.alignItems = 'center';

					// Adjust the title position
					var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
					if (chartTitle) {
						chartTitle.setAttribute('text-anchor', 'middle');
						chartTitle.setAttribute('x', '100%');
						chartTitle.style.transform = 'translateX(-50%)';
					}
				});
				// Close the popup when clicking outside of it
				document.addEventListener('click', function(event) {
					// Check if the click target is outside the popupContainer
					if (!popupContainer.contains(event.target)) {
						// Close the popup
						popupContainer.style.display = 'none';
						popupContainer.innerHTML = '';
					}
				});

				// // Open popup window with slice data
				// var popup = window.open('', 'myPopup', 'width=600,height=400');
				// popup.document.write('<div style="margin:auto" id="slice_chart_div"></div>');
				// centerPopup(popup);

				// // Instantiate and draw the chart for selected slice
				// var sliceChart = new google.visualization.PieChart(popup.document.getElementById('slice_chart_div'));
				// sliceChart.draw(sliceData, sliceOptions);


			}
		}

		// 	function centerPopup(popup) {
		// 		var left = (screen.width - popup.outerWidth) / 2;
		// 		var top = (screen.height - popup.outerHeight) / 2;
		// 		popup.moveTo(left, top);
		// 	}
	}
</script>



<!-- Workorders logged script -->


<script type="text/javascript">
	google.charts.load('current', {
		'packages': ['corechart']
	});

	function drawChartWO(updatedDataWO, monthName, yearName) {
		// Create the data table
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'opco_name');
		data.addColumn('number', 'count');
		data.addColumn('number', 's1_sr_count');
		data.addColumn('number', 's2_sr_count');
		data.addColumn('number', 's3_sr_count');
		data.addColumn('number', 's4_sr_count');
		// data.addRows(updatedDataWO);
		// Modify the data to include a new column for legend entries
		var formattedData = updatedDataWO.map(function(row) {
			return [row[0] + ' - ' + row[1], row[1], row[2], row[3], row[4], row[5]];
		});

		data.addRows(formattedData);

		// Set chart options
		var options = {
			'title': 'OpCo Wise Workorders Logged',
			'titleTextStyle': {
				'color': 'black', // Set the color of the title text
				'fontSize': 12, // Set the font size of the title text
				'bold': true // Make the title text bold
				// You can include other text styling options as needed
			},
			'pieSliceText': 'none',
			is3D: 'true',
			'tooltip': {
				trigger: 'none'
			},
			'legend': {
				position: 'right',
				alignment: 'center',
				textStyle: {
					fontSize: 10 // Adjust the font size of legend items
				}
			},
			sliceVisibilityThreshold: 0.00001,
			threshold: 0,
			chartArea: {
				width: '100%',
				height: '80%',
			}
		};

		// Instantiate and draw the chart
		var chartContainer = document.getElementById('workorders_logged');
		var chart = new google.visualization.PieChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		// Center the chart and title using CSS
		chartContainer.style.width = '450px';
		chartContainer.style.height = '300px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'flex-start'; // Align the content to the left
		chartContainer.style.justifyContent = 'left'; // Center the content vertically
		chartContainer.style.marginLeft = '-20px'; // Adjust value as needed
		chart.draw(data, options);

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

		if (data.getNumberOfRows() === 1) {
			// Set selection to the first row
			chart.setSelection([{
				row: 0,
				column: null
			}]);
			// Get and log the selection
			var selection = chart.getSelection()[0];
			var sliceName = data.getValue(selection.row, 0);
			var sliceCount = data.getValue(selection.row, 1);
			var sliceS1 = data.getValue(selection.row, 2);
			var sliceS2 = data.getValue(selection.row, 3);
			var sliceS3 = data.getValue(selection.row, 4);
			var sliceS4 = data.getValue(selection.row, 5);

			// Create data table for selected slice
			var sliceData = new google.visualization.DataTable();
			sliceData.addColumn('string', 'Severity');
			sliceData.addColumn('number', 'Incident Count');
			sliceData.addRow(['S1 - ' + sliceS1, sliceS1]);
			sliceData.addRow(['S2 - ' + sliceS2, sliceS2]);
			sliceData.addRow(['S3 - ' + sliceS3, sliceS3]);
			sliceData.addRow(['S4 - ' + sliceS4, sliceS4]);

			// Set chart options for selected slice
			var sliceOptions = {
				'title': ' Severity Wise Workorders logged (' + sliceName + ')',
				'titleTextStyle': {
					'color': 'black', // Set the color of the title text
					'fontSize': 12, // Set the font size of the title text
					'bold': true // Make the title text bold
					// You can include other text styling options as needed
				},
				'pieSliceText': 'none',
				is3D: 'true',
				'tooltip': {
					trigger: 'value'
				},
				'legend': {
					position: 'right',
					alignment: 'center'
				},
				sliceVisibilityThreshold: 0.00001,
				threshold: 0,
				chartArea: {
					width: '100%',
					height: '75%',
				}

			};
			// Instantiate and draw the chart
			var chartContainer = document.getElementById('workorders_logged');
			var sliceChart = new google.visualization.PieChart(chartContainer);
			sliceChart.draw(sliceData, sliceOptions);

			// Center the chart and title using CSS
			chartContainer.style.display = 'flex';
			chartContainer.style.flexDirection = 'column';
			chartContainer.style.alignItems = 'center';

			// Adjust the title position
			var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
			if (chartTitle) {
				chartTitle.setAttribute('text-anchor', 'middle');
				chartTitle.setAttribute('x', '100%');
				chartTitle.style.transform = 'translateX(-50%)';
			}
		}

		// Add event listener for slice selection
		google.visualization.events.addListener(chart, 'select', selectHandler);

		// Slice selection handler
		function selectHandler() {
			// Get selected slice data
			var selection = chart.getSelection()[0];
			if (selection) {
				var sliceName = data.getValue(selection.row, 0);
				var sliceCount = data.getValue(selection.row, 1);
				var sliceS1 = data.getValue(selection.row, 2);
				var sliceS2 = data.getValue(selection.row, 3);
				var sliceS3 = data.getValue(selection.row, 4);
				var sliceS4 = data.getValue(selection.row, 5);

				// Create data table for selected slice
				var sliceData = new google.visualization.DataTable();
				sliceData.addColumn('string', 'Severity');
				sliceData.addColumn('number', 'Incident Count');
				sliceData.addRow(['S1 - ' + sliceS1, sliceS1]);
				sliceData.addRow(['S2 - ' + sliceS2, sliceS2]);
				sliceData.addRow(['S3 - ' + sliceS3, sliceS3]);
				sliceData.addRow(['S4 - ' + sliceS4, sliceS4]);

				// Set chart options for selected slice
				var sliceOptions = {
					'title': 'Severity-Wise Workorders logged (' + sliceName + ')',
					'titleTextStyle': {
						'color': 'black', // Set the color of the title text
						'fontSize': 12, // Set the font size of the title text
						'bold': true // Make the title text bold
						// You can include other text styling options as needed
					},
					pieSliceText: 'none',
					'width': 500,
					'height': 300,
					is3D: 'true',
					'tooltip': {
						'text': 'value'
					},
					sliceVisibilityThreshold: 0.00001,
					threshold: 0,
					chartArea: {
						left: '0',
						width: '100%',
						height: '75%',
					}

				};
				// Function to load Google Visualization API
				function loadGoogleVisualizationAPI(callback) {
					// Check if the API is already loaded
					if (typeof google !== 'undefined' && google.visualization) {
						callback();
					} else {
						// Load the Google Visualization API
						var script = document.createElement('script');
						script.type = 'text/javascript';
						script.src = 'https: //www.gstatic.com/charts/loader.js';
						script.onload = callback;
						document.head.appendChild(script);
					}
				}
				var popupContent = document.createElement('div');
				popupContent.style.margin = 'auto';
				popupContent.id = 'slice_chart_div';
				var popupContainer = document.createElement('div');
				popupContainer.appendChild(popupContent);
				popupContainer.style.position = 'fixed';
				popupContainer.style.top = '50%';
				popupContainer.style.left = '50%';
				popupContainer.style.transform = 'translate(-50%, -50%)';
				popupContainer.style.width = '700px';
				popupContainer.style.height = '300px';
				popupContainer.style.backgroundColor = 'white';
				popupContainer.style.border = '1px solid #ccc';
				document.body.appendChild(popupContainer);
				// Load Google Visualization API and create the chart
				loadGoogleVisualizationAPI(function() {
					var chartContainer = document.getElementById('slice_chart_div');
					var chart = new google.visualization.PieChart(chartContainer);
					chart.draw(sliceData, sliceOptions);

					// Center the chart and title using CSS
					chartContainer.style.display = 'flex';
					chartContainer.style.flexDirection = 'column';
					chartContainer.style.alignItems = 'center';

					// Adjust the title position
					var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
					if (chartTitle) {
						chartTitle.setAttribute('text-anchor', 'middle');
						chartTitle.setAttribute('x', '100%');
						chartTitle.style.transform = 'translateX(-50%)';
					}
				});
				// Close the popup when clicking outside of it
				document.addEventListener('click', function(event) {
					// Check if the click target is outside the popupContainer
					if (!popupContainer.contains(event.target)) {
						// Close the popup
						popupContainer.style.display = 'none';
						popupContainer.innerHTML = '';
					}
				});


				// // Open popup window with slice data
				// var popup = window.open('', 'myPopup', 'width=600,height=400');
				// popup.document.write('<div style="margin:auto" id="slice_chart_div"></div>');
				// centerPopup(popup);

				// // Instantiate and draw the chart for selected slice
				// var sliceChart = new google.visualization.PieChart(popup.document.getElementById('slice_chart_div'));
				// sliceChart.draw(sliceData, sliceOptions);


			}
		}

		// function centerPopup(popup) {
		// 	var left = (screen.width - popup.outerWidth) / 2;
		// 	var top = (screen.height - popup.outerHeight) / 2;
		// 	popup.moveTo(left, top);
		// }
	}
</script>

<!-- Incidents resolved script -->

<script type="text/javascript">
	google.charts.load('current', {
		'packages': ['corechart']
	});

	function drawChartISR(updatedDataISR, monthName, yearName) {
		// Create the data table
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'opco_name');
		data.addColumn('number', 'count');
		data.addColumn('number', 'Service_desk');
		data.addColumn('number', 'L1_MSO_count');
		data.addColumn('number', 'L2_count');
		data.addColumn('number', 'L3_count');
		data.addColumn('number', 'L4_count');
		// data.addRows(updatedDataISR);
		// Modify the data to include a new column for legend entries
		var formattedData = updatedDataISR.map(function(row) {
			return [row[0] + ' - ' + row[1], row[1], row[2], row[3], row[4], row[5], row[6]];
		});

		data.addRows(formattedData);

		// Set chart options
		var options = {
			'title': 'OpCo Wise Incidents Resolved',
			'titleTextStyle': {
				'color': 'black', // Set the color of the title text
				'fontSize': 12, // Set the font size of the title text
				'bold': true // Make the title text bold
				// You can include other text styling options as needed
			},
			'pieSliceText': 'none',
			is3D: 'true',
			'tooltip': {
				trigger: 'none'
			},
			'legend': {
				position: 'right',
				alignment: 'center',
				textStyle: {
					fontSize: 10 // Adjust the font size of legend items
				}
			},
			sliceVisibilityThreshold: 0.00001,
			threshold: 0,
			chartArea: {
				width: '100%',
				height: '80%',
			}
		};

		// Instantiate and draw the chart
		var chartContainer = document.getElementById('incidents_resolved');
		var chart = new google.visualization.PieChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		// Center the chart and title using CSS
		chartContainer.style.width = '450px';
		chartContainer.style.height = '300px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'flex-start'; // Align the content to the left
		chartContainer.style.justifyContent = 'left'; // Center the content vertically
		chartContainer.style.marginLeft = '-20px'; // Adjust value as needed
		chart.draw(data, options);

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}
		if (data.getNumberOfRows() === 1) {
			// Set selection to the first row
			chart.setSelection([{
				row: 0,
				column: null
			}]);
			// Get and log the selection
			var selection = chart.getSelection()[0];
			var sliceName = data.getValue(selection.row, 0);
			var sliceCount = data.getValue(selection.row, 1);
			var sliceSD = data.getValue(selection.row, 2);
			var sliceL1 = data.getValue(selection.row, 3);
			var sliceL2 = data.getValue(selection.row, 4);
			var sliceL3 = data.getValue(selection.row, 5);
			var sliceL4 = data.getValue(selection.row, 6);

			// Create data table for selected slice
			var sliceData = new google.visualization.DataTable();
			sliceData.addColumn('string', 'Severity');
			sliceData.addColumn('number', 'Incident Count');
			sliceData.addRow(['Service Desk - ' + sliceSD, sliceSD]);
			sliceData.addRow(['L1/MSO - ' + sliceL1, sliceL1]);
			sliceData.addRow(['L2 - ' + sliceL2, sliceL2]);
			sliceData.addRow(['L3 - ' + sliceL3, sliceL3]);
			sliceData.addRow(['L4 - ' + sliceL4, sliceL4]);
			// Set chart options for selected slice
			var sliceOptions = {
				'title': 'Group Wise Incidents Resolved (' + sliceName + ')',
				'titleTextStyle': {
					'color': 'black', // Set the color of the title text
					'fontSize': 12, // Set the font size of the title text
					'bold': true // Make the title text bold
					// You can include other text styling options as needed
				},
				'pieSliceText': 'none',
				is3D: 'true',
				'tooltip': {
					trigger: 'value'
				},
				'legend': {
					position: 'right',
					alignment: 'center'
				},
				sliceVisibilityThreshold: 0.00001,
				threshold: 0,
				chartArea: {
					width: '100%',
					height: '75%',
				}
			};
			// Instantiate and draw the chart
			var chartContainer = document.getElementById('incidents_resolved');
			var sliceChart = new google.visualization.PieChart(chartContainer);
			sliceChart.draw(sliceData, sliceOptions);

			// Center the chart and title using CSS
			chartContainer.style.display = 'flex';
			chartContainer.style.flexDirection = 'column';
			chartContainer.style.alignItems = 'center';

			// Adjust the title position
			var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
			if (chartTitle) {
				chartTitle.setAttribute('text-anchor', 'middle');
				chartTitle.setAttribute('x', '100%');
				chartTitle.style.transform = 'translateX(-50%)';
			}

		}


		// Add event listener for slice selection
		google.visualization.events.addListener(chart, 'select', selectHandler);

		// Slice selection handler
		function selectHandler() {
			// Get selected slice data
			var selection = chart.getSelection()[0];
			if (selection) {
				var sliceName = data.getValue(selection.row, 0);
				var sliceCount = data.getValue(selection.row, 1);
				var sliceSD = data.getValue(selection.row, 2);
				var sliceL1 = data.getValue(selection.row, 3);
				var sliceL2 = data.getValue(selection.row, 4);
				var sliceL3 = data.getValue(selection.row, 5);
				var sliceL4 = data.getValue(selection.row, 6);

				// Create data table for selected slice
				var sliceData = new google.visualization.DataTable();
				sliceData.addColumn('string', 'Severity');
				sliceData.addColumn('number', 'Incident Count');
				sliceData.addRow(['Service Desk - ' + sliceSD, sliceSD]);
				sliceData.addRow(['L1/MSO - ' + sliceL1, sliceL1]);
				sliceData.addRow(['L2 - ' + sliceL2, sliceL2]);
				sliceData.addRow(['L3 - ' + sliceL3, sliceL3]);
				sliceData.addRow(['L4 - ' + sliceL4, sliceL4]);
				// Set chart options for selected slice
				var sliceOptions = {
					'title': 'Group Wise Incidents Resolved (' + sliceName + ')',
					'titleTextStyle': {
						'color': 'black', // Set the color of the title text
						'fontSize': 12, // Set the font size of the title text
						'bold': true // Make the title text bold
						// You can include other text styling options as needed
					},
					pieSliceText: 'none',
					'width': 700,
					'height': 300,
					is3D: 'true',
					'tooltip': {
						'text': 'value'
					},
					sliceVisibilityThreshold: 0.00001,
					threshold: 0,
					chartArea: {
						left: '0',
						width: '100%',
						height: '75%',
					}

				};
				// Function to load Google Visualization API
				function loadGoogleVisualizationAPI(callback) {
					// Check if the API is already loaded
					if (typeof google !== 'undefined' && google.visualization) {
						callback();
					} else {
						// Load the Google Visualization API
						var script = document.createElement('script');
						script.type = 'text/javascript';
						script.src = 'https: //www.gstatic.com/charts/loader.js';
						script.onload = callback;
						document.head.appendChild(script);
					}
				}
				var popupContent = document.createElement('div');
				popupContent.style.margin = 'auto';
				popupContent.id = 'slice_chart_div';
				var popupContainer = document.createElement('div');
				popupContainer.appendChild(popupContent);
				popupContainer.style.position = 'fixed';
				popupContainer.style.top = '50%';
				popupContainer.style.left = '50%';
				popupContainer.style.transform = 'translate(-50%, -50%)';
				popupContainer.style.width = '700px';
				popupContainer.style.height = '300px';
				popupContainer.style.backgroundColor = 'white';
				popupContainer.style.border = '1px solid #ccc';
				document.body.appendChild(popupContainer);
				// Load Google Visualization API and create the chart
				loadGoogleVisualizationAPI(function() {
					var chartContainer = document.getElementById('slice_chart_div');
					var chart = new google.visualization.PieChart(chartContainer);
					chart.draw(sliceData, sliceOptions);

					// Center the chart and title using CSS
					chartContainer.style.display = 'flex';
					chartContainer.style.flexDirection = 'column';
					chartContainer.style.alignItems = 'center';

					// Adjust the title position
					var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
					if (chartTitle) {
						chartTitle.setAttribute('text-anchor', 'middle');
						chartTitle.setAttribute('x', '100%');
						chartTitle.style.transform = 'translateX(-50%)';
					}
				});
				// Close the popup when clicking outside of it
				document.addEventListener('click', function(event) {
					// Check if the click target is outside the popupContainer
					if (!popupContainer.contains(event.target)) {
						// Close the popup
						popupContainer.style.display = 'none';
						popupContainer.innerHTML = '';
					}
				});
			}
		}
	}
</script>

<!-- Workorders resolved chart -->

<script type="text/javascript">
	google.charts.load('current', {
		'packages': ['corechart']
	});

	function drawChartWOR(updatedDataWOR, monthName, yearName) {
		// Create the data table
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'opco_name');
		data.addColumn('number', 'count');
		data.addColumn('number', 'Service_desk');
		data.addColumn('number', 'L1_MSO_count');
		data.addColumn('number', 'L2_count');
		data.addColumn('number', 'L3_count');
		data.addColumn('number', 'L4_count');
		// data.addRows(updatedDataWOR);
		// Modify the data to include a new column for legend entries
		var formattedData = updatedDataWOR.map(function(row) {
			return [row[0] + ' - ' + row[1], row[1], row[2], row[3], row[4], row[5], row[6]];
		});

		data.addRows(formattedData);

		// Set chart options
		var options = {
			'title': 'OpCo Wise Workorders Resolved',
			'titleTextStyle': {
				'color': 'black', // Set the color of the title text
				'fontSize': 12, // Set the font size of the title text
				'bold': true // Make the title text bold
				// You can include other text styling options as needed
			},
			'pieSliceText': 'none',
			is3D: 'true',
			'tooltip': {
				trigger: 'none'
			},
			'legend': {
				position: 'right',
				alignment: 'center',
				textStyle: {
					fontSize: 10 // Adjust the font size of legend items
				}
			},
			sliceVisibilityThreshold: 0.00001,
			threshold: 0,
			chartArea: {
				width: '100%',
				height: '80%',
			}
		};

		// Instantiate and draw the chart
		var chartContainer = document.getElementById('workorders_resolved');
		var chart = new google.visualization.PieChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		// Center the chart and title using CSS
		chartContainer.style.width = '450px';
		chartContainer.style.height = '300px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'flex-start'; // Align the content to the left
		chartContainer.style.justifyContent = 'left'; // Center the content vertically
		chartContainer.style.marginLeft = '-20px'; // Adjust value as needed
		chart.draw(data, options);

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

		//Single opco chart 
		if (data.getNumberOfRows() === 1) {
			// Set selection to the first row
			chart.setSelection([{
				row: 0,
				column: null
			}]);
			var selection = chart.getSelection()[0];
			var sliceName = data.getValue(selection.row, 0);
			var sliceCount = data.getValue(selection.row, 1);
			var sliceSD = data.getValue(selection.row, 2);
			var sliceL1 = data.getValue(selection.row, 3);
			var sliceL2 = data.getValue(selection.row, 4);
			var sliceL3 = data.getValue(selection.row, 5);
			var sliceL4 = data.getValue(selection.row, 6);

			// Create data table for selected slice
			var sliceData = new google.visualization.DataTable();
			sliceData.addColumn('string', 'Severity');
			sliceData.addColumn('number', 'Incident Count');
			sliceData.addRow(['Service Desk - ' + sliceSD, sliceSD]);
			sliceData.addRow(['L1/MSO - ' + sliceL1, sliceL1]);
			sliceData.addRow(['L2 - ' + sliceL2, sliceL2]);
			sliceData.addRow(['L3 - ' + sliceL3, sliceL3]);
			sliceData.addRow(['L4 - ' + sliceL4, sliceL4]);
			// Set chart options for selected slice
			var sliceOptions = {
				'title': 'Group Wise Workorders Resolved (' + sliceName + ')',
				'titleTextStyle': {
					'color': 'black', // Set the color of the title text
					'fontSize': 12, // Set the font size of the title text
					'bold': true // Make the title text bold
					// You can include other text styling options as needed
				},
				'pieSliceText': 'none',
				is3D: 'true',
				'tooltip': {
					trigger: 'value'
				},
				'legend': {
					position: 'right',
					alignment: 'center'
				},
				sliceVisibilityThreshold: 0.00001,
				threshold: 0,
				chartArea: {
					width: '100%',
					height: '75%',
				}
			};
			var chartContainer = document.getElementById('workorders_resolved');
			var sliceChart = new google.visualization.PieChart(chartContainer);
			sliceChart.draw(sliceData, sliceOptions);
			// Center the chart and title using CSS
			chartContainer.style.display = 'flex';
			chartContainer.style.flexDirection = 'column';
			chartContainer.style.alignItems = 'center';

			// Adjust the title position
			var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
			if (chartTitle) {
				chartTitle.setAttribute('text-anchor', 'middle');
				chartTitle.setAttribute('x', '100%');
				chartTitle.style.transform = 'translateX(-50%)';
			}
		}

		// Add event listener for slice selection
		google.visualization.events.addListener(chart, 'select', selectHandler);

		// Slice selection handler
		function selectHandler() {
			// Get selected slice data
			var selection = chart.getSelection()[0];
			if (selection) {
				var sliceName = data.getValue(selection.row, 0);
				var sliceCount = data.getValue(selection.row, 1);
				var sliceSD = data.getValue(selection.row, 2);
				var sliceL1 = data.getValue(selection.row, 3);
				var sliceL2 = data.getValue(selection.row, 4);
				var sliceL3 = data.getValue(selection.row, 5);
				var sliceL4 = data.getValue(selection.row, 6);

				// Create data table for selected slice
				var sliceData = new google.visualization.DataTable();
				sliceData.addColumn('string', 'Severity');
				sliceData.addColumn('number', 'Incident Count');
				sliceData.addRow(['Service Desk - ' + sliceSD, sliceSD]);
				sliceData.addRow(['L1/MSO - ' + sliceL1, sliceL1]);
				sliceData.addRow(['L2 - ' + sliceL2, sliceL2]);
				sliceData.addRow(['L3 - ' + sliceL3, sliceL3]);
				sliceData.addRow(['L4 - ' + sliceL4, sliceL4]);
				// Set chart options for selected slice
				var sliceOptions = {
					'title': 'Group Wise Workorders Resolved (' + sliceName + ')',
					'titleTextStyle': {
						'color': 'black', // Set the color of the title text
						'fontSize': 12, // Set the font size of the title text
						'bold': true // Make the title text bold
						// You can include other text styling options as needed
					},
					pieSliceText: 'none',
					'width': 500,
					'height': 300,
					is3D: 'true',
					'tooltip': {
						'text': 'value'
					},
					sliceVisibilityThreshold: 0.00001,
					threshold: 0,
					chartArea: {
						left: '0',
						width: '100%',
						height: '75%',
					}

				};
				// Function to load Google Visualization API
				function loadGoogleVisualizationAPI(callback) {
					// Check if the API is already loaded
					if (typeof google !== 'undefined' && google.visualization) {
						callback();
					} else {
						// Load the Google Visualization API
						var script = document.createElement('script');
						script.type = 'text/javascript';
						script.src = 'https: //www.gstatic.com/charts/loader.js';
						script.onload = callback;
						document.head.appendChild(script);
					}
				}
				var popupContent = document.createElement('div');
				popupContent.style.margin = 'auto';
				popupContent.id = 'slice_chart_div';
				var popupContainer = document.createElement('div');
				popupContainer.appendChild(popupContent);
				popupContainer.style.position = 'fixed';
				popupContainer.style.top = '50%';
				popupContainer.style.left = '50%';
				popupContainer.style.transform = 'translate(-50%, -50%)';
				popupContainer.style.width = '700px';
				popupContainer.style.height = '300px';
				popupContainer.style.backgroundColor = 'white';
				popupContainer.style.border = '1px solid #ccc';
				document.body.appendChild(popupContainer);
				// Load Google Visualization API and create the chart
				loadGoogleVisualizationAPI(function() {
					var chartContainer = document.getElementById('slice_chart_div');
					var chart = new google.visualization.PieChart(chartContainer);
					chart.draw(sliceData, sliceOptions);

					// Center the chart and title using CSS
					chartContainer.style.display = 'flex';
					chartContainer.style.flexDirection = 'column';
					chartContainer.style.alignItems = 'center';

					// Adjust the title position
					var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
					if (chartTitle) {
						chartTitle.setAttribute('text-anchor', 'middle');
						chartTitle.setAttribute('x', '100%');
						chartTitle.style.transform = 'translateX(-50%)';
					}
				});
				// Close the popup when clicking outside of it
				document.addEventListener('click', function(event) {
					// Check if the click target is outside the popupContainer
					if (!popupContainer.contains(event.target)) {
						// Close the popup
						popupContainer.style.display = 'none';
						popupContainer.innerHTML = '';
					}
				});


				// // Open popup window with slice data
				// var popup = window.open('', 'myPopup', 'width=600,height=400');
				// popup.document.write('<div style="margin:auto" id="slice_chart_div"></div>');
				// centerPopup(popup);

				// // Instantiate and draw the chart for selected slice
				// var sliceChart = new google.visualization.PieChart(popup.document.getElementById('slice_chart_div'));
				// sliceChart.draw(sliceData, sliceOptions);


			}
		}

		// function centerPopup(popup) {
		// 	var left = (screen.width - popup.outerWidth) / 2;
		// 	var top = (screen.height - popup.outerHeight) / 2;
		// 	popup.moveTo(left, top);
		// }
	}
</script>

<!-- SLA Pie charts script -->

<!-- Incidents SLA -->

<script type="text/javascript">
	google.charts.load('current', {
		'packages': ['corechart']
	});

	function drawChartISLA(updatedDataISLA, monthName, yearName) {
		// Create the data table
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'opco_name');
		data.addColumn('number', 'count');
		data.addColumn('number', 's1_sla_met_count');
		data.addColumn('number', 's2_sla_met_count');
		data.addColumn('number', 's3_sla_met_count');
		data.addColumn('number', 's4_sla_met_count');
		// data.addRows(updatedDataISLA);
		// Modify the data to include a new column for legend entries
		var formattedData = updatedDataISLA.map(function(row) {
			return [row[0] + ' - ' + row[1] + '%', row[1], row[2], row[3], row[4], row[5]];
		});

		data.addRows(formattedData);

		for (var i = 0; i < data.getNumberOfRows(); i++) {
			var countValue = data.getValue(i, 1);
			var formattedValue = countValue + '%';
			data.setFormattedValue(i, 1, formattedValue);
		}

		// Set chart options
		var options = {
			'title': 'OpCo Wise SLA% - Incidents',
			'titleTextStyle': {
				'color': 'black', // Set the color of the title text
				'fontSize': 12, // Set the font size of the title text
				'bold': true // Make the title text bold
				// You can include other text styling options as needed
			},
			'pieSliceText': 'none',
			is3D: 'true',
			'tooltip': {
				trigger: 'none'
			},
			'legend': {
				position: 'right',
				alignment: 'center',
				textStyle: {
					fontSize: 10 // Adjust the font size of legend items
				}
			},
			sliceVisibilityThreshold: 0.00001,
			threshold: 0,
			chartArea: {
				width: '100%',
				height: '80%',
			}
		};

		// Instantiate and draw the chart
		var chartContainer = document.getElementById('IR-SLA');
		var chart = new google.visualization.PieChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		// Center the chart and title using CSS
		chartContainer.style.width = '450px';
		chartContainer.style.height = '300px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'flex-start'; // Align the content to the left
		chartContainer.style.justifyContent = 'left'; // Center the content vertically
		chartContainer.style.marginLeft = '-20px'; // Adjust value as needed
		chart.draw(data, options);

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}
		if (data.getNumberOfRows() === 1) {
			// Set selection to the first row
			chart.setSelection([{
				row: 0,
				column: null
			}]);
			var selection = chart.getSelection()[0];
			var sliceName = data.getValue(selection.row, 0);
			var sliceCount = data.getValue(selection.row, 1);
			var sliceS1 = data.getValue(selection.row, 2);
			var sliceS2 = data.getValue(selection.row, 3);
			var sliceS3 = data.getValue(selection.row, 4);
			var sliceS4 = data.getValue(selection.row, 5);

			// Create data table for selected slice
			var sliceData = new google.visualization.DataTable();
			sliceData.addColumn('string', 'Severity');
			sliceData.addColumn('number', 'Incident Count');
			sliceData.addRow(['S1 - ' + sliceS1 + '%', sliceS1]);
			sliceData.addRow(['S2 - ' + sliceS2 + '%', sliceS2]);
			sliceData.addRow(['S3 - ' + sliceS3 + '%', sliceS3]);
			sliceData.addRow(['S4 - ' + sliceS4 + '%', sliceS4]);
			for (var i = 0; i < sliceData.getNumberOfRows(); i++) {
				var countValue = sliceData.getValue(i, 1);
				var formattedValue = countValue + '%';
				sliceData.setFormattedValue(i, 1, formattedValue);
			}
			// Set chart options for selected slice
			var sliceOptions = {
				'title': 'Severity Wise Incidents SLA% (' + sliceName + ')',
				'titleTextStyle': {
					'color': 'black', // Set the color of the title text
					'fontSize': 12, // Set the font size of the title text
					'bold': true // Make the title text bold
					// You can include other text styling options as needed
				},
				'tooltip': {
					trigger: 'value'
				},
				pieSliceText: 'none',
				is3D: 'true',
				'legend': {
					position: 'right',
					alignment: 'center'
				},
				sliceVisibilityThreshold: 0.00001,
				threshold: 0,
				chartArea: {
					width: '100%',
					height: '75%',
				}

			};
			var chartContainer = document.getElementById('IR-SLA');
			var sliceChart = new google.visualization.PieChart(chartContainer);
			sliceChart.draw(sliceData, sliceOptions);

			// Center the chart and title using CSS
			chartContainer.style.display = 'flex';
			chartContainer.style.flexDirection = 'column';
			chartContainer.style.alignItems = 'center';

			// Adjust the title position
			var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
			if (chartTitle) {
				chartTitle.setAttribute('text-anchor', 'middle');
				chartTitle.setAttribute('x', '100%');
				chartTitle.style.transform = 'translateX(-50%)';
			}
		}


		// Add event listener for slice selection
		google.visualization.events.addListener(chart, 'select', selectHandler);

		// Slice selection handler
		function selectHandler() {
			// Get selected slice data
			var selection = chart.getSelection()[0];
			if (selection) {
				var sliceName = data.getValue(selection.row, 0);
				var sliceCount = data.getValue(selection.row, 1);
				var sliceS1 = data.getValue(selection.row, 2);
				var sliceS2 = data.getValue(selection.row, 3);
				var sliceS3 = data.getValue(selection.row, 4);
				var sliceS4 = data.getValue(selection.row, 5);

				// Create data table for selected slice
				var sliceData = new google.visualization.DataTable();
				sliceData.addColumn('string', 'Severity');
				sliceData.addColumn('number', 'Incident Count');
				sliceData.addRow(['S1 - ' + sliceS1 + '%', sliceS1]);
				sliceData.addRow(['S2 - ' + sliceS2 + '%', sliceS2]);
				sliceData.addRow(['S3 - ' + sliceS3 + '%', sliceS3]);
				sliceData.addRow(['S4 - ' + sliceS4 + '%', sliceS4]);

				for (var i = 0; i < sliceData.getNumberOfRows(); i++) {
					var countValue = sliceData.getValue(i, 1);
					var formattedValue = countValue + '%';
					sliceData.setFormattedValue(i, 1, formattedValue);
				}

				// Set chart options for selected slice
				var sliceOptions = {
					'title': 'Severity Wise Incidents SLA% (' + sliceName + ')',
					'titleTextStyle': {
						'color': 'black', // Set the color of the title text
						'fontSize': 12, // Set the font size of the title text
						'bold': true // Make the title text bold
						// You can include other text styling options as needed
					},
					pieSliceText: 'none',
					'width': 500,
					'height': 300,
					is3D: 'true',
					'tooltip': {
						'text': 'value'
					},
					sliceVisibilityThreshold: 0.00001,
					threshold: 0,
					chartArea: {
						left: '0',
						width: '100%',
						height: '75%',
					}

				};
				// Function to load Google Visualization API
				function loadGoogleVisualizationAPI(callback) {
					// Check if the API is already loaded
					if (typeof google !== 'undefined' && google.visualization) {
						callback();
					} else {
						// Load the Google Visualization API
						var script = document.createElement('script');
						script.type = 'text/javascript';
						script.src = 'https: //www.gstatic.com/charts/loader.js';
						script.onload = callback;
						document.head.appendChild(script);
					}
				}
				var popupContent = document.createElement('div');
				popupContent.style.margin = 'auto';
				popupContent.id = 'slice_chart_div';
				var popupContainer = document.createElement('div');
				popupContainer.appendChild(popupContent);
				popupContainer.style.position = 'fixed';
				popupContainer.style.top = '50%';
				popupContainer.style.left = '50%';
				popupContainer.style.transform = 'translate(-50%, -50%)';
				popupContainer.style.width = '700px';
				popupContainer.style.height = '300px';
				popupContainer.style.backgroundColor = 'white';
				popupContainer.style.border = '1px solid #ccc';
				document.body.appendChild(popupContainer);
				// Load Google Visualization API and create the chart
				loadGoogleVisualizationAPI(function() {
					var chartContainer = document.getElementById('slice_chart_div');
					var chart = new google.visualization.PieChart(chartContainer);
					chart.draw(sliceData, sliceOptions);

					// Center the chart and title using CSS
					chartContainer.style.display = 'flex';
					chartContainer.style.flexDirection = 'column';
					chartContainer.style.alignItems = 'center';

					// Adjust the title position
					var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
					if (chartTitle) {
						chartTitle.setAttribute('text-anchor', 'middle');
						chartTitle.setAttribute('x', '100%');
						chartTitle.style.transform = 'translateX(-50%)';
					}
				});
				// Close the popup when clicking outside of it
				document.addEventListener('click', function(event) {
					// Check if the click target is outside the popupContainer
					if (!popupContainer.contains(event.target)) {
						// Close the popup
						popupContainer.style.display = 'none';
						popupContainer.innerHTML = '';
					}
				});
			}
		}
	}
</script>

<!-- Workorders SLA -->

<script type="text/javascript">
	google.charts.load('current', {
		'packages': ['corechart']
	});

	function drawChartWOSLA(updatedDataWOSLA, monthName, yearName) {
		// Create the data table
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'opco_name');
		data.addColumn('number', 'count');
		data.addColumn('number', 's1_sr_sla_met_count');
		data.addColumn('number', 's2_sr_sla_met_count');
		data.addColumn('number', 's3_sr_sla_met_count');
		data.addColumn('number', 's4_sr_sla_met_count');
		// data.addRows(updatedDataWOSLA);
		// Modify the data to include a new column for legend entries
		var formattedData = updatedDataWOSLA.map(function(row) {
			return [row[0] + ' - ' + row[1] + '%', row[1], row[2], row[3], row[4], row[5]];
		});

		data.addRows(formattedData);

		for (var i = 0; i < data.getNumberOfRows(); i++) {
			var countValue = data.getValue(i, 1);
			var formattedValue = countValue + '%';
			data.setFormattedValue(i, 1, formattedValue);
		}

		// Set chart options
		var options = {
			'title': 'Opco Wise SLA% - Workorders',
			'titleTextStyle': {
				'color': 'black', // Set the color of the title text
				'fontSize': 12, // Set the font size of the title text
				'bold': true // Make the title text bold
				// You can include other text styling options as needed
			},
			'pieSliceText': 'none',
			is3D: 'true',
			'tooltip': {
				trigger: 'none'
			},
			'legend': {
				position: 'right',
				alignment: 'center',
				textStyle: {
					fontSize: 10 // Adjust the font size of legend items
				}
			},
			sliceVisibilityThreshold: 0.00001,
			threshold: 0,
			chartArea: {
				width: '100%',
				height: '80%',
			}
		};

		// Instantiate and draw the chart
		var chartContainer = document.getElementById('WO-SLA');
		var chart = new google.visualization.PieChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		// Center the chart and title using CSS
		chartContainer.style.width = '450px';
		chartContainer.style.height = '300px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'flex-start'; // Align the content to the left
		chartContainer.style.justifyContent = 'left'; // Center the content vertically
		chartContainer.style.marginLeft = '-20px'; // Adjust value as needed
		chart.draw(data, options);

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

		if (data.getNumberOfRows() === 1) {
			// Set selection to the first row
			chart.setSelection([{
				row: 0,
				column: null
			}]);
			var selection = chart.getSelection()[0];

			var sliceName = data.getValue(selection.row, 0);
			var sliceCount = data.getValue(selection.row, 1);
			var sliceS1 = data.getValue(selection.row, 2);
			var sliceS2 = data.getValue(selection.row, 3);
			var sliceS3 = data.getValue(selection.row, 4);
			var sliceS4 = data.getValue(selection.row, 5);
			// Create data table for selected slice
			var sliceData = new google.visualization.DataTable();
			sliceData.addColumn('string', 'Severity');
			sliceData.addColumn('number', 'Workorders Count');
			sliceData.addRow(['S1 - ' + sliceS1 + '%', sliceS1]);
			sliceData.addRow(['S2 - ' + sliceS2 + '%', sliceS2]);
			sliceData.addRow(['S3 - ' + sliceS3 + '%', sliceS3]);
			sliceData.addRow(['S4 - ' + sliceS4 + '%', sliceS4]);

			for (var i = 0; i < sliceData.getNumberOfRows(); i++) {
				var countValue = sliceData.getValue(i, 1);
				var formattedValue = countValue + '%';
				sliceData.setFormattedValue(i, 1, formattedValue);
			}


			// Set chart options for selected slice
			var sliceOptions = {
				'title': 'Severity Wise Workorders SLA% (' + sliceName + ')',
				'titleTextStyle': {
					'color': 'black', // Set the color of the title text
					'fontSize': 12, // Set the font size of the title text
					'bold': true // Make the title text bold
					// You can include other text styling options as needed
				},
				'pieSliceText': 'none',
				is3D: 'true',
				'tooltip': {
					trigger: 'value'
				},
				'legend': {
					position: 'right',
					alignment: 'center'
				},
				sliceVisibilityThreshold: 0.00001,
				threshold: 0,
				chartArea: {
					width: '100%',
					height: '75%',
				}
			};
			// Instantiate and draw the chart
			var chartContainer = document.getElementById('WO-SLA');
			var sliceChart = new google.visualization.PieChart(chartContainer);
			sliceChart.draw(sliceData, sliceOptions);

			// Center the chart and title using CSS
			chartContainer.style.display = 'flex';
			chartContainer.style.flexDirection = 'column';
			chartContainer.style.alignItems = 'center';

			// Adjust the title position
			var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
			if (chartTitle) {
				chartTitle.setAttribute('text-anchor', 'middle');
				chartTitle.setAttribute('x', '100%');
				chartTitle.style.transform = 'translateX(-50%)';
			}
		}

		// Add event listener for slice selection
		google.visualization.events.addListener(chart, 'select', selectHandler);

		// Slice selection handler
		function selectHandler() {
			// Get selected slice data
			var selection = chart.getSelection()[0];
			if (selection) {
				var sliceName = data.getValue(selection.row, 0);
				var sliceCount = data.getValue(selection.row, 1);
				var sliceS1 = data.getValue(selection.row, 2);
				var sliceS2 = data.getValue(selection.row, 3);
				var sliceS3 = data.getValue(selection.row, 4);
				var sliceS4 = data.getValue(selection.row, 5);

				// Create data table for selected slice
				var sliceData = new google.visualization.DataTable();
				sliceData.addColumn('string', 'Severity');
				sliceData.addColumn('number', 'Workorders Count');
				sliceData.addRow(['S1 - ' + sliceS1 + '%', sliceS1]);
				sliceData.addRow(['S2 - ' + sliceS2 + '%', sliceS2]);
				sliceData.addRow(['S3 - ' + sliceS3 + '%', sliceS3]);
				sliceData.addRow(['S4 - ' + sliceS4 + '%', sliceS4]);

				for (var i = 0; i < sliceData.getNumberOfRows(); i++) {
					var countValue = sliceData.getValue(i, 1);
					var formattedValue = countValue;
					sliceData.setFormattedValue(i, 1, formattedValue);
				}


				// Set chart options for selected slice
				var sliceOptions = {
					'title': 'Severity Wise Workorders SLA% (' + sliceName + ')',
					'titleTextStyle': {
						'color': 'black', // Set the color of the title text
						'fontSize': 12, // Set the font size of the title text
						'bold': true // Make the title text bold
						// You can include other text styling options as needed
					},
					pieSliceText: 'none',
					'width': 500,
					'height': 300,
					is3D: 'true',
					'tooltip': {
						'text': 'value'
					},
					sliceVisibilityThreshold: 0.00001,
					chartArea: {
						left: '0',
						width: '100%',
						height: '75%',
					}

				};
				// Function to load Google Visualization API
				function loadGoogleVisualizationAPI(callback) {
					// Check if the API is already loaded
					if (typeof google !== 'undefined' && google.visualization) {
						callback();
					} else {
						// Load the Google Visualization API
						var script = document.createElement('script');
						script.type = 'text/javascript';
						script.src = 'https: //www.gstatic.com/charts/loader.js';
						script.onload = callback;
						document.head.appendChild(script);
					}
				}
				var popupContent = document.createElement('div');
				popupContent.style.margin = 'auto';
				popupContent.id = 'slice_chart_div';
				var popupContainer = document.createElement('div');
				popupContainer.appendChild(popupContent);
				popupContainer.style.position = 'fixed';
				popupContainer.style.top = '50%';
				popupContainer.style.left = '50%';
				popupContainer.style.transform = 'translate(-50%, -50%)';
				popupContainer.style.width = '700px';
				popupContainer.style.height = '300px';
				popupContainer.style.backgroundColor = 'white';
				popupContainer.style.border = '1px solid #ccc';
				document.body.appendChild(popupContainer);
				// Load Google Visualization API and create the chart
				loadGoogleVisualizationAPI(function() {
					var chartContainer = document.getElementById('slice_chart_div');
					var chart = new google.visualization.PieChart(chartContainer);
					chart.draw(sliceData, sliceOptions);

					// Center the chart and title using CSS
					chartContainer.style.display = 'flex';
					chartContainer.style.flexDirection = 'column';
					chartContainer.style.alignItems = 'center';

					// Adjust the title position
					var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
					if (chartTitle) {
						chartTitle.setAttribute('text-anchor', 'middle');
						chartTitle.setAttribute('x', '100%');
						chartTitle.style.transform = 'translateX(-50%)';
					}
				});
				// Close the popup when clicking outside of it
				document.addEventListener('click', function(event) {
					// Check if the click target is outside the popupContainer
					if (!popupContainer.contains(event.target)) {
						// Close the popup
						popupContainer.style.display = 'none';
						popupContainer.innerHTML = '';
					}
				});


				// // Open popup window with slice data
				// var popup = window.open('', 'myPopup', 'width=600,height=400');
				// popup.document.write('<div style="margin:auto" id="slice_chart_div"></div>');
				// centerPopup(popup);

				// // Instantiate and draw the chart for selected slice
				// var sliceChart = new google.visualization.PieChart(popup.document.getElementById('slice_chart_div'));
				// sliceChart.draw(sliceData, sliceOptions);


			}
		}

		// function centerPopup(popup) {
		// 	var left = (screen.width - popup.outerWidth) / 2;
		// 	var top = (screen.height - popup.outerHeight) / 2;
		// 	popup.moveTo(left, top);
		// }
	}
</script>

<!-- Incidents reason script with opco-->

<script type="text/javascript">
	google.charts.load('current', {
		'packages': ['corechart']
	});

	function drawChartISReO(updatedDataISReO, monthName, yearName) {
		// Create the data table
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'opco_name');
		data.addColumn('number', 'count');
		data.addColumn('number', 'app_issue_count');
		data.addColumn('number', 'fun_issue_count');
		data.addColumn('number', 'data_issue_count');
		data.addColumn('number', 'plat_issue_count');
		data.addColumn('number', 'NFR_issue_count');
		data.addColumn('number', 'tec_issue_count');
		data.addColumn('number', '3pp_issue_count');
		data.addColumn('number', 'clar_issue_count');
		data.addColumn('number', 'no_fcr_count');
		data.addColumn('number', 'process_gap_count');
		data.addColumn('number', 'know_gap_count');
		// data.addRows(updatedDataISReO);
		// Modify the data to include a new column for legend entries
		var formattedData = updatedDataISReO.map(function(row) {
			return [row[0] + ' - ' + row[1], row[1], row[2], row[3], row[4], row[5], row[6], row[7], row[8], row[9], row[10], row[11], row[12]];
		});

		data.addRows(formattedData);

		// Set chart options
		var options = {
			'title': 'OpCo Wise Components Breakup - Incidents',
			'titleTextStyle': {
				'color': 'black', // Set the color of the title text
				'fontSize': 12, // Set the font size of the title text
				'bold': true // Make the title text bold
				// You can include other text styling options as needed
			},
			'pieSliceText': 'none',
			is3D: 'true',
			'tooltip': {
				trigger: 'none'
			},
			'legend': {
				position: 'right',
				alignment: 'center',
				textStyle: {
					fontSize: 10 // Adjust the font size of legend items
				}
			},
			sliceVisibilityThreshold: 0.00001,
			chartArea: {
				width: '100%',
				height: '80%',
			}
		};

		// Instantiate and draw the chart
		var chartContainer = document.getElementById('incidents_reason_opco');
		var chart = new google.visualization.PieChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		// Center the chart and title using CSS
		chartContainer.style.width = '450px';
		chartContainer.style.height = '300px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'flex-start'; // Align the content to the left
		chartContainer.style.justifyContent = 'left'; // Center the content vertically
		chartContainer.style.marginLeft = '-20px'; // Adjust value as needed
		chart.draw(data, options);

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}


		if (data.getNumberOfRows() === 1) {
			// Set selection to the first row
			chart.setSelection([{
				row: 0,
				column: null
			}]);
			var selection = chart.getSelection()[0];
			var sliceName = data.getValue(selection.row, 0);
			var sliceCount = data.getValue(selection.row, 1);
			var sliceApi = data.getValue(selection.row, 2);
			var sliceFni = data.getValue(selection.row, 3);
			var sliceDi = data.getValue(selection.row, 4);
			var slicePi = data.getValue(selection.row, 5);
			var sliceNfr = data.getValue(selection.row, 6);
			var sliceTec = data.getValue(selection.row, 7);
			var slice3pp = data.getValue(selection.row, 8);
			var sliceClar = data.getValue(selection.row, 9);
			var sliceNoFcr = data.getValue(selection.row, 10);
			var slicePgap = data.getValue(selection.row, 11);
			var sliceKgap = data.getValue(selection.row, 12);

			// Create data table for selected slice
			var sliceData = new google.visualization.DataTable();
			sliceData.addColumn('string', 'Severity');
			sliceData.addColumn('number', 'Incident Count');
			sliceData.addRow(['Application issue - ' + sliceApi, sliceApi]);
			sliceData.addRow(['Functionality issue - ' + sliceFni, sliceFni]);
			sliceData.addRow(['Data issue - ' + sliceDi, sliceDi]);
			sliceData.addRow(['Platform issue - ' + slicePi, slicePi]);
			sliceData.addRow(['NFR issue - ' + sliceNfr, sliceNfr]);
			sliceData.addRow(['Tecnology issue - ' + sliceTec, sliceTec]);
			sliceData.addRow(['3PP issue - ' + slice3pp, slice3pp]);
			sliceData.addRow(['Clarification issue - ' + sliceClar, sliceClar]);
			sliceData.addRow(['No FCR training - ' + sliceNoFcr, sliceNoFcr]);
			sliceData.addRow(['Process gap - ' + slicePgap, slicePgap]);
			sliceData.addRow(['Knowledge gap - ' + sliceKgap, sliceKgap]);
			// Set chart options for selected slice
			var sliceOptions = {
				'title': 'Component Wise Incidents Breakup (' + sliceName + ')',
				'titleTextStyle': {
					'color': 'black', // Set the color of the title text
					'fontSize': 12, // Set the font size of the title text
					'bold': true // Make the title text bold
					// You can include other text styling options as needed
				},
				'pieSliceText': 'none',
				is3D: 'true',
				'tooltip': {
					trigger: 'value'
				},
				'legend': {
					position: 'right',
					alignment: 'center'
				},
				sliceVisibilityThreshold: 0.00001,
				chartArea: {
					width: '100%',
					height: '75%',
				}

			};
			// Instantiate and draw the chart
			var chartContainer = document.getElementById('incidents_reason_opco');
			var sliceChart = new google.visualization.PieChart(chartContainer);
			sliceChart.draw(sliceData, sliceOptions);

			// Center the chart and title using CSS
			chartContainer.style.display = 'flex';
			chartContainer.style.flexDirection = 'column';
			chartContainer.style.alignItems = 'center';

			// Adjust the title position
			var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
			if (chartTitle) {
				chartTitle.setAttribute('text-anchor', 'middle');
				chartTitle.setAttribute('x', '100%');
				chartTitle.style.transform = 'translateX(-50%)';
			}


		}

		// Add event listener for slice selection
		google.visualization.events.addListener(chart, 'select', selectHandler);

		// Slice selection handler
		function selectHandler() {
			// Get selected slice data
			var selection = chart.getSelection()[0];
			if (selection) {
				var sliceName = data.getValue(selection.row, 0);
				var sliceCount = data.getValue(selection.row, 1);
				var sliceApi = data.getValue(selection.row, 2);
				var sliceFni = data.getValue(selection.row, 3);
				var sliceDi = data.getValue(selection.row, 4);
				var slicePi = data.getValue(selection.row, 5);
				var sliceNfr = data.getValue(selection.row, 6);
				var sliceTec = data.getValue(selection.row, 7);
				var slice3pp = data.getValue(selection.row, 8);
				var sliceClar = data.getValue(selection.row, 9);
				var sliceNoFcr = data.getValue(selection.row, 10);
				var slicePgap = data.getValue(selection.row, 11);
				var sliceKgap = data.getValue(selection.row, 12);

				// Create data table for selected slice
				var sliceData = new google.visualization.DataTable();
				sliceData.addColumn('string', 'Severity');
				sliceData.addColumn('number', 'Incident Count');
				sliceData.addRow(['Application issue - ' + sliceApi, sliceApi]);
				sliceData.addRow(['Functionality issue - ' + sliceFni, sliceFni]);
				sliceData.addRow(['Data issue - ' + sliceDi, sliceDi]);
				sliceData.addRow(['Platform issue - ' + slicePi, slicePi]);
				sliceData.addRow(['NFR issue - ' + sliceNfr, sliceNfr]);
				sliceData.addRow(['Tecnology issue - ' + sliceTec, sliceTec]);
				sliceData.addRow(['3PP issue - ' + slice3pp, slice3pp]);
				sliceData.addRow(['Clarification issue - ' + sliceClar, sliceClar]);
				sliceData.addRow(['No FCR training - ' + sliceNoFcr, sliceNoFcr]);
				sliceData.addRow(['Process gap - ' + slicePgap, slicePgap]);
				sliceData.addRow(['Knowledge gap - ' + sliceKgap, sliceKgap]);
				// Set chart options for selected slice
				var sliceOptions = {
					'title': 'Component Wise Incidents Breakup (' + sliceName + ')',
					'titleTextStyle': {
						'color': 'black', // Set the color of the title text
						'fontSize': 12, // Set the font size of the title text
						'bold': true // Make the title text bold
						// You can include other text styling options as needed
					},
					pieSliceText: 'none',
					'width': 550,
					'height': 300,
					is3D: 'true',
					'tooltip': {
						'text': 'value'
					},
					sliceVisibilityThreshold: 0.00001,
					chartArea: {
						left: '0',
						width: '100%',
						height: '75%',
					}

				};
				// Function to load Google Visualization API
				function loadGoogleVisualizationAPI(callback) {
					// Check if the API is already loaded
					if (typeof google !== 'undefined' && google.visualization) {
						callback();
					} else {
						// Load the Google Visualization API
						var script = document.createElement('script');
						script.type = 'text/javascript';
						script.src = 'https: //www.gstatic.com/charts/loader.js';
						script.onload = callback;
						document.head.appendChild(script);
					}
				}
				var popupContent = document.createElement('div');
				popupContent.style.margin = 'auto';
				popupContent.id = 'slice_chart_div';
				var popupContainer = document.createElement('div');
				popupContainer.appendChild(popupContent);
				popupContainer.style.position = 'fixed';
				popupContainer.style.top = '50%';
				popupContainer.style.left = '50%';
				popupContainer.style.transform = 'translate(-50%, -50%)';
				popupContainer.style.width = '700px';
				popupContainer.style.height = '300px';
				popupContainer.style.backgroundColor = 'white';
				popupContainer.style.border = '1px solid #ccc';
				document.body.appendChild(popupContainer);
				// Load Google Visualization API and create the chart
				loadGoogleVisualizationAPI(function() {
					var chartContainer = document.getElementById('slice_chart_div');
					var chart = new google.visualization.PieChart(chartContainer);
					chart.draw(sliceData, sliceOptions);

					// Center the chart and title using CSS
					chartContainer.style.display = 'flex';
					chartContainer.style.flexDirection = 'column';
					chartContainer.style.alignItems = 'center';

					// Adjust the title position
					var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
					if (chartTitle) {
						chartTitle.setAttribute('text-anchor', 'middle');
						chartTitle.setAttribute('x', '100%');
						chartTitle.style.transform = 'translateX(-50%)';
					}
				});
				// Close the popup when clicking outside of it
				document.addEventListener('click', function(event) {
					// Check if the click target is outside the popupContainer
					if (!popupContainer.contains(event.target)) {
						// Close the popup
						popupContainer.style.display = 'none';
						popupContainer.innerHTML = '';
					}
				});


				// // Open popup window with slice data
				// var popup = window.open('', 'myPopup', 'width=600,height=350');
				// popup.document.write('<div style="margin:auto" id="slice_chart_div"></div>');
				// centerPopup(popup);

				// // Instantiate and draw the chart for selected slice
				// var sliceChart = new google.visualization.PieChart(popup.document.getElementById('slice_chart_div'));
				// sliceChart.draw(sliceData, sliceOptions);


			}
		}

		// function centerPopup(popup) {
		// 	var left = (screen.width - popup.outerWidth) / 2;
		// 	var top = (screen.height - popup.outerHeight) / 1;
		// 	popup.moveTo(left, top);
		// }
	}
</script>

<!-- Workorders reason chart with opco-->

<script type="text/javascript">
	google.charts.load('current', {
		'packages': ['corechart']
	});

	function drawChartWOReO(updatedDataWOReO, monthName, yearName) {
		// Create the data table
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'opco_name');
		data.addColumn('number', 'count');
		data.addColumn('number', 'app_issue_count');
		data.addColumn('number', 'fun_issue_count');
		data.addColumn('number', 'data_issue_count');
		data.addColumn('number', 'plat_issue_count');
		data.addColumn('number', 'NFR_issue_count');
		data.addColumn('number', 'tec_issue_count');
		data.addColumn('number', '3pp_issue_count');
		data.addColumn('number', 'clar_issue_count');
		data.addColumn('number', 'no_fcr_count');
		data.addColumn('number', 'process_gap_count');
		data.addColumn('number', 'know_gap_count');
		data.addColumn('number', 'service_request_count');
		// data.addRows(updatedDataWOReO);
		// Modify the data to include a new column for legend entries
		var formattedData = updatedDataWOReO.map(function(row) {
			return [row[0] + ' - ' + row[1], row[1], row[2], row[3], row[4], row[5], row[6], row[7], row[8], row[9], row[10], row[11], row[12], row[13]];
		});

		data.addRows(formattedData);

		// Set chart options
		var options = {
			'title': 'OpCo Wise Components Breakup - Workorders ',
			'titleTextStyle': {
				'color': 'black', // Set the color of the title text
				'fontSize': 12, // Set the font size of the title text
				'bold': true // Make the title text bold
				// You can include other text styling options as needed
			},
			'pieSliceText': 'none',
			is3D: 'true',
			'tooltip': {
				trigger: 'none'
			},
			'legend': {
				position: 'right',
				alignment: 'center',
				textStyle: {
					fontSize: 10 // Adjust the font size of legend items
				}
			},
			sliceVisibilityThreshold: 0.00001,
			chartArea: {
				width: '100%',
				height: '80%',
			}
		};

		// Instantiate and draw the chart
		var chartContainer = document.getElementById('workorders_reason_opco');
		var chart = new google.visualization.PieChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		// Center the chart and title using CSS
		chartContainer.style.width = '450px';
		chartContainer.style.height = '300px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'flex-start'; // Align the content to the left
		chartContainer.style.justifyContent = 'left'; // Center the content vertically
		chartContainer.style.marginLeft = '-20px'; // Adjust value as needed
		chart.draw(data, options);

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

		if (data.getNumberOfRows() === 1) {
			// Set selection to the first row
			chart.setSelection([{
				row: 0,
				column: null
			}]);
			var selection = chart.getSelection()[0];
			var sliceName = data.getValue(selection.row, 0);
			var sliceCount = data.getValue(selection.row, 1);
			var sliceApi = data.getValue(selection.row, 2);
			var sliceFni = data.getValue(selection.row, 3);
			var sliceDi = data.getValue(selection.row, 4);
			var slicePi = data.getValue(selection.row, 5);
			var sliceNfr = data.getValue(selection.row, 6);
			var sliceTec = data.getValue(selection.row, 7);
			var slice3pp = data.getValue(selection.row, 8);
			var sliceClar = data.getValue(selection.row, 9);
			var sliceNoFcr = data.getValue(selection.row, 10);
			var slicePgap = data.getValue(selection.row, 11);
			var sliceKgap = data.getValue(selection.row, 12);
			var sliceSreq = data.getValue(selection.row, 13);

			// Create data table for selected slice
			var sliceData = new google.visualization.DataTable();
			sliceData.addColumn('string', 'Severity');
			sliceData.addColumn('number', 'Incident Count');
			sliceData.addRow(['Application issue - ' + sliceApi, sliceApi]);
			sliceData.addRow(['Functionality issue - ' + sliceFni, sliceFni]);
			sliceData.addRow(['Data issue - ' + sliceDi, sliceDi]);
			sliceData.addRow(['Platform issue - ' + slicePi, slicePi]);
			sliceData.addRow(['NFR issue - ' + sliceNfr, sliceNfr]);
			sliceData.addRow(['Tecnology issue - ' + sliceTec, sliceTec]);
			sliceData.addRow(['3PP issue - ' + slice3pp, slice3pp]);
			sliceData.addRow(['Clarification issue - ' + sliceClar, sliceClar]);
			sliceData.addRow(['No FCR training - ' + sliceNoFcr, sliceNoFcr]);
			sliceData.addRow(['Process gap - ' + slicePgap, slicePgap]);
			sliceData.addRow(['Knowledge gap - ' + sliceKgap, sliceKgap]);
			sliceData.addRow(['Service_request_count - ' + sliceSreq, sliceSreq]);
			// Set chart options for selected slice
			var sliceOptions = {
				'title': 'Component Wise Workorders Breakup (' + sliceName + ')',
				'titleTextStyle': {
					'color': 'black', // Set the color of the title text
					'fontSize': 12, // Set the font size of the title text
					'bold': true // Make the title text bold
					// You can include other text styling options as needed
				},
				'pieSliceText': 'none',
				is3D: 'true',
				'tooltip': {
					trigger: 'value'
				},
				'legend': {
					position: 'right',
					alignment: 'center'
				},
				sliceVisibilityThreshold: 0.00001,
				chartArea: {
					width: '100%',
					height: '75%',
				}

			};
			// Instantiate and draw the chart
			var chartContainer = document.getElementById('workorders_reason_opco');
			var sliceChart = new google.visualization.PieChart(chartContainer);
			sliceChart.draw(sliceData, sliceOptions);

			// Center the chart and title using CSS
			chartContainer.style.display = 'flex';
			chartContainer.style.flexDirection = 'column';
			chartContainer.style.alignItems = 'center';

			// Adjust the title position
			var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
			if (chartTitle) {
				chartTitle.setAttribute('text-anchor', 'middle');
				chartTitle.setAttribute('x', '100%');
				chartTitle.style.transform = 'translateX(-50%)';
			}
		}

		// Add event listener for slice selection
		google.visualization.events.addListener(chart, 'select', selectHandler);

		// Slice selection handler
		function selectHandler() {
			// Get selected slice data
			var selection = chart.getSelection()[0];
			if (selection) {
				var sliceName = data.getValue(selection.row, 0);
				var sliceCount = data.getValue(selection.row, 1);
				var sliceApi = data.getValue(selection.row, 2);
				var sliceFni = data.getValue(selection.row, 3);
				var sliceDi = data.getValue(selection.row, 4);
				var slicePi = data.getValue(selection.row, 5);
				var sliceNfr = data.getValue(selection.row, 6);
				var sliceTec = data.getValue(selection.row, 7);
				var slice3pp = data.getValue(selection.row, 8);
				var sliceClar = data.getValue(selection.row, 9);
				var sliceNoFcr = data.getValue(selection.row, 10);
				var slicePgap = data.getValue(selection.row, 11);
				var sliceKgap = data.getValue(selection.row, 12);
				var sliceSreq = data.getValue(selection.row, 13);

				// Create data table for selected slice
				var sliceData = new google.visualization.DataTable();
				sliceData.addColumn('string', 'Severity');
				sliceData.addColumn('number', 'Incident Count');
				sliceData.addRow(['Application issue - ' + sliceApi, sliceApi]);
				sliceData.addRow(['Functionality issue - ' + sliceFni, sliceFni]);
				sliceData.addRow(['Data issue - ' + sliceDi, sliceDi]);
				sliceData.addRow(['Platform issue - ' + slicePi, slicePi]);
				sliceData.addRow(['NFR issue - ' + sliceNfr, sliceNfr]);
				sliceData.addRow(['Tecnology issue - ' + sliceTec, sliceTec]);
				sliceData.addRow(['3PP issue - ' + slice3pp, slice3pp]);
				sliceData.addRow(['Clarification issue - ' + sliceClar, sliceClar]);
				sliceData.addRow(['No FCR training - ' + sliceNoFcr, sliceNoFcr]);
				sliceData.addRow(['Process gap - ' + slicePgap, slicePgap]);
				sliceData.addRow(['Knowledge gap - ' + sliceKgap, sliceKgap]);
				sliceData.addRow(['Service_request_count - ' + sliceSreq, sliceSreq]);
				// Set chart options for selected slice
				var sliceOptions = {
					'title': 'Component Wise Workorders Breakup (' + sliceName + ')',
					'titleTextStyle': {
						'color': 'black', // Set the color of the title text
						'fontSize': 12, // Set the font size of the title text
						'bold': true // Make the title text bold
						// You can include other text styling options as needed
					},
					pieSliceText: 'none',
					'width': 550,
					'height': 300,
					is3D: 'true',
					'tooltip': {
						'text': 'value'
					},
					sliceVisibilityThreshold: 0.00001,
					chartArea: {
						left: '0',
						width: '100%',
						height: '75%',
					}

				};
				// Function to load Google Visualization API
				function loadGoogleVisualizationAPI(callback) {
					// Check if the API is already loaded
					if (typeof google !== 'undefined' && google.visualization) {
						callback();
					} else {
						// Load the Google Visualization API
						var script = document.createElement('script');
						script.type = 'text/javascript';
						script.src = 'https: //www.gstatic.com/charts/loader.js';
						script.onload = callback;
						document.head.appendChild(script);
					}
				}
				var popupContent = document.createElement('div');
				popupContent.style.margin = 'auto';
				popupContent.id = 'slice_chart_div';
				var popupContainer = document.createElement('div');
				popupContainer.appendChild(popupContent);
				popupContainer.style.position = 'fixed';
				popupContainer.style.top = '50%';
				popupContainer.style.left = '50%';
				popupContainer.style.transform = 'translate(-50%, -50%)';
				popupContainer.style.width = '700px';
				popupContainer.style.height = '300px';
				popupContainer.style.backgroundColor = 'white';
				popupContainer.style.border = '1px solid #ccc';
				document.body.appendChild(popupContainer);
				// Load Google Visualization API and create the chart
				loadGoogleVisualizationAPI(function() {
					var chartContainer = document.getElementById('slice_chart_div');
					var chart = new google.visualization.PieChart(chartContainer);
					chart.draw(sliceData, sliceOptions);

					// Center the chart and title using CSS
					chartContainer.style.display = 'flex';
					chartContainer.style.flexDirection = 'column';
					chartContainer.style.alignItems = 'center';

					// Adjust the title position
					var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
					if (chartTitle) {
						chartTitle.setAttribute('text-anchor', 'middle');
						chartTitle.setAttribute('x', '100%');
						chartTitle.style.transform = 'translateX(-50%)';
					}
				});
				// Close the popup when clicking outside of it
				document.addEventListener('click', function(event) {
					// Check if the click target is outside the popupContainer
					if (!popupContainer.contains(event.target)) {
						// Close the popup
						popupContainer.style.display = 'none';
						popupContainer.innerHTML = '';
					}
				});


				// // Open popup window with slice data
				// var popup = window.open('', 'myPopup', 'width=700,height=400');
				// popup.document.write('<div style="margin:auto" id="slice_chart_div"></div>');
				// centerPopup(popup);

				// // Instantiate and draw the chart for selected slice
				// var sliceChart = new google.visualization.PieChart(popup.document.getElementById('slice_chart_div'));
				// sliceChart.draw(sliceData, sliceOptions);


			}
		}

		// function centerPopup(popup) {
		// 	var left = (screen.width - popup.outerWidth) / 5.5;
		// 	var top = (screen.height - popup.outerHeight) / 2.5;
		// 	popup.moveTo(left, top);
		// }
	}
</script>


<!-- Outages -->

<script type="text/javascript">
	google.charts.load('current', {
		'packages': ['corechart']
	});

	function AllOpCooutages(opco, month, year) {
		var xhrIS = new XMLHttpRequest();
		xhrIS.onreadystatechange = function() {
			if (xhrIS.readyState === XMLHttpRequest.DONE) {
				if (xhrIS.status === 200) {
					// Handle the response from the server
					var response = xhrIS.responseText;
					var parsedData = JSON.parse(response);
					var updatedDataSO = parsedData.query1;
					var dataQuery21 = parsedData.query21;
					var dataQuery22 = parsedData.query22;
					var dataQuery31 = parsedData.query31;
					var dataQuery32 = parsedData.query32;
					var dataQuery41 = parsedData.query41;
					var dataQuery42 = parsedData.query42;
					var dataQuery51 = parsedData.query51;
					var dataQuery52 = parsedData.query52;
					var dataQuery61 = parsedData.query61;
					var dataQuery62 = parsedData.query62;
					var dataQuery71 = parsedData.query71;
					var dataQuery72 = parsedData.query72;

					google.charts.setOnLoadCallback(function() {
						drawChartAllOutages(updatedDataSO);
						drawChartAllOWISL(dataQuery21);
						drawChartAllOWISD(dataQuery22);
						drawChartAllSWISL(dataQuery31);
						drawChartAllSWISD(dataQuery32);
						drawChartAllOWISLAL(dataQuery41);
						drawChartAllOWISLAD(dataQuery42);
						drawChartAllOWABL(dataQuery51);
						drawChartAllOWABD(dataQuery52);
						drawChartAllOWSBL(dataQuery61);
						drawChartAllOWSBD(dataQuery62);
						drawChartAllOWTTL(dataQuery71);
						drawChartAllOWTTD(dataQuery72);
					});
				} else {
					// Handle the error cases4_incidents_count
					console.error('Request failed for incidents logged chart.');
				}
			}
		};
		// Send an asynchronous POST request to update the query
		xhrIS.open('POST', '<?php echo base_url(); ?>IndexController/allopcooutages', true);

		xhrIS.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhrIS.send('month=' + month + '&year=' + year + '&opco=' + opco);
	}

	function drawChartAllOutages(updatedDataSO) {
		// Define the chartData directly in the view
		var chartData = updatedDataSO;
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');

		var opcos = {};
		var rows = [];

		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.opco_name]) {
				opcos[data.opco_name] = [];
			}
			if (!opcos[data.opco_name][data.month - 1]) {
				opcos[data.opco_name][data.month - 1] = 0;
			}
			opcos[data.opco_name][data.month - 1] += parseInt(data.count);
		});
		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}
		console.log(data);
		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(opco) {
				var count = opco[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(opcoName) {
			data.addColumn('number', opcoName);
		});

		data.addRows(rows);

		var options = {
			title: 'OPCO Wise Outages',
			vAxis: {
				format: '#'
			},
			'legend': {
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 11 // Adjust the font size of legend items
				}
			},
			chartArea: {
				left: 50,
				width: '70%',
				height: '80%',
			}
		};

		var chartContainer = document.getElementById('incidents_outages');
		var chart = new google.visualization.ColumnChart(chartContainer);
		console.log(data);
		// Center the chart and title using CSS
		// chartContainer.style.width='450px';
		chartContainer.style.height = '300px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center'; // Align the content to the left
		// chartContainer.style.justifyContent = 'left'; // Center the content vertically
		// chartContainer.style.marginLeft = '-20px'; // Adjust value as needed
		chart.draw(data, options);

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%'); // Set x to 50% for centering
			chartTitle.style.transform = 'translateX(-50%)'; // Center the title horizontally
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}


	}

	//incidents_summary_OWl

	function drawChartAllOWISL(dataQuery21) {
		// Define the chartData directly in the view

		var chartData = dataQuery21;
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');

		var opcos = {};
		var rows = [];

		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.opco_shortname]) {
				opcos[data.opco_shortname] = [];
			}
			if (!opcos[data.opco_shortname][data.month - 1]) {
				opcos[data.opco_shortname][data.month - 1] = 0;
			}
			opcos[data.opco_shortname][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(opco) {
				var count = opco[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(opcoName) {
			data.addColumn('number', opcoName);
		});
		data.addRows(rows);


		var options = {
			title: 'Opco Wise Incidents Summary - Legacy',
			legend: {
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 11 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#'
			},
			chartArea: {
				left: 35,
				width: '70%',
				height: '70%'
			},
		};
		var chartContainer = document.getElementById('incidents_summary_OWl');
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center'; // Align the content to the center

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}
	}

	//incidents_summary_OWD

	function drawChartAllOWISD(dataQuery22) {
		// Define the chartData directly in the view
		var chartData = dataQuery22;
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');

		var opcos = {};
		var rows = [];

		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.opco_shortname]) {
				opcos[data.opco_shortname] = [];
			}
			if (!opcos[data.opco_shortname][data.month - 1]) {
				opcos[data.opco_shortname][data.month - 1] = 0;
			}
			opcos[data.opco_shortname][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(opco) {
				var count = opco[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(opcoName) {
			data.addColumn('number', opcoName);
		});

		data.addRows(rows);

		var options = {
			title: 'Opco Wise Incidents Summary - Digital',
			legend: {
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 11 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#'
			},
			chartArea: {
				left: 32,
				width: '70%',
				height: '70%'
			},
		};

		var chartContainer = document.getElementById('incidents_summary_OWd');
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center'; // Align the content to the center

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}
	}



	//incidents_summary_SWL

	function drawChartAllSWISL(dataQuery31) {
		// Define the chartData directly in the view
		var chartData = dataQuery31;

		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');

		var opcos = {};
		var rows = [];

		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.Severity]) {
				opcos[data.Severity] = [];
			}
			if (!opcos[data.Severity][data.month - 1]) {
				opcos[data.Severity][data.month - 1] = 0;
			}
			opcos[data.Severity][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(Severity) {
				var count = Severity[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(Severity) {
			data.addColumn('number', Severity);
		});

		data.addRows(rows);

		var options = {
			title: 'Severity Wise Incidents Summary - Legacy',
			legend: {
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 11 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#'
			},
			chartArea: {
				left: 35,
				width: '70%',
				height: '70%',
			}
		};
		var chartContainer = document.getElementById('incidents_summary_SWl');
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center';

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}
	}



	// incidents_summary_SWD 

	function drawChartAllSWISD(dataQuery32) {
		// Define the chartData directly in the view
		var chartData = dataQuery32;

		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');

		var opcos = {};
		var rows = [];

		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.Severity]) {
				opcos[data.Severity] = [];
			}
			if (!opcos[data.Severity][data.month - 1]) {
				opcos[data.Severity][data.month - 1] = 0;
			}
			opcos[data.Severity][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(Severity) {
				var count = Severity[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(Severity) {
			data.addColumn('number', Severity);
		});

		data.addRows(rows);

		var options = {
			title: 'Severity Wise Incidents Summary - Digital',
			legend: {
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 11 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#'
			}
		};


		var chartContainer = document.getElementById('incidents_summary_SWd');
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center';

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}
	}


	// incidents_sla_met_LEGACY 
	function drawChartAllOWISLAL(dataQuery41) {
		// Define the chartData directly in the view
		var chartData = dataQuery41;

		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');

		var opcos = {};
		var rows = [];

		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.opco_shortname]) {
				opcos[data.opco_shortname] = [];
			}
			if (!opcos[data.opco_shortname][data.month - 1]) {
				opcos[data.opco_shortname][data.month - 1] = 0;
			}
			opcos[data.opco_shortname][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(opco) {
				var count = opco[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(opcoName) {
			data.addColumn('number', opcoName);
		});

		data.addRows(rows);

		var options = {
			title: 'Opco Wise Incidents SLA% - Legacy',
			legend: {
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 11 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#\'%\''
			},
			chartArea: {
				left: 35,
				width: '70%',
				height: '70%'
			},
		};

		var chartContainer = document.getElementById('incidents_sla_l');
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center'; // Align the content to the center

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}
	}



	// incidents_sla_met_DIGITAL

	function drawChartAllOWISLAD(dataQuery42) {

		// Define the chartData directly in the view
		var chartData = dataQuery42;

		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');

		var opcos = {};
		var rows = [];

		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.opco_shortname]) {
				opcos[data.opco_shortname] = [];
			}
			if (!opcos[data.opco_shortname][data.month - 1]) {
				opcos[data.opco_shortname][data.month - 1] = 0;
			}
			opcos[data.opco_shortname][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(opco) {
				var count = opco[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(opcoName) {
			data.addColumn('number', opcoName);
		});

		data.addRows(rows);

		var options = {
			title: 'Opco Wise incidents SLA% - Digital',
			legend: {
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 10 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#\'%\''
			},
			chartArea: {
				left: 32,
			},
		};

		var chartContainer = document.getElementById('incidents_sla_d');
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center';

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}
	}

	//// Account_billed_Legacy
	function drawChartAllOWABL(dataQuery51) {

		// Define the chartData directly in the view
		var chartData = dataQuery51;
		console.log(chartData)
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');

		var opcos = {};
		var rows = [];

		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.opco_shortname]) {
				opcos[data.opco_shortname] = [];
			}
			if (!opcos[data.opco_shortname][data.month - 1]) {
				opcos[data.opco_shortname][data.month - 1] = 0;
			}
			opcos[data.opco_shortname][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(opco) {
				var count = opco[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(opcoName) {
			data.addColumn('number', opcoName);
		});

		data.addRows(rows);

		var options = {
			title: 'Opco Wise Accounts Billed - Legacy',
			legend: {
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 10 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#'
			},
			chartArea: {
				left: 35,
			},
		};

		var chartContainer = document.getElementById('accounts_billed_l');
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center';

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}
	}

	//ACCOUNTS BILLED DIGITAL

	function drawChartAllOWABD(dataQuery52) {

		// Define the chartData directly in the view
		var chartData = dataQuery52;
		console.log(chartData)
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');

		var opcos = {};
		var rows = [];

		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.opco_shortname]) {
				opcos[data.opco_shortname] = [];
			}
			if (!opcos[data.opco_shortname][data.month - 1]) {
				opcos[data.opco_shortname][data.month - 1] = 0;
			}
			opcos[data.opco_shortname][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(opco) {
				var count = opco[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(opcoName) {
			data.addColumn('number', opcoName);
		});

		data.addRows(rows);

		var options = {
			title: 'Opco Wise Accounts Billed - Digital',
			legend: {
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 10 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#'
			},
			chartArea: {
				left:35,
			},
		};

		var chartContainer = document.getElementById('accounts_billed_d');
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center';

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}
	}

	//Services Billed Legacy

	function drawChartAllOWSBL(dataQuery61) {

		// Define the chartData directly in the view
		var chartData = dataQuery61;
		console.log(chartData)
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');

		var opcos = {};
		var rows = [];

		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.opco_shortname]) {
				opcos[data.opco_shortname] = [];
			}
			if (!opcos[data.opco_shortname][data.month - 1]) {
				opcos[data.opco_shortname][data.month - 1] = 0;
			}
			opcos[data.opco_shortname][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(opco) {
				var count = opco[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(opcoName) {
			data.addColumn('number', opcoName);
		});

		data.addRows(rows);

		var options = {
			title: 'Opco Wise Services Billed - Legacy',
			legend: {
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 10 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#'
			},
			chartArea: {
				left: 35,
			},
		};

		var chartContainer = document.getElementById('services_billed_l');
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center';

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}
	}

	//Sevices Billed Digital

	function drawChartAllOWSBD(dataQuery62) {

		// Define the chartData directly in the view
		var chartData = dataQuery62;
		console.log(chartData)
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');

		var opcos = {};
		var rows = [];

		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.opco_shortname]) {
				opcos[data.opco_shortname] = [];
			}
			if (!opcos[data.opco_shortname][data.month - 1]) {
				opcos[data.opco_shortname][data.month - 1] = 0;
			}
			opcos[data.opco_shortname][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(opco) {
				var count = opco[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(opcoName) {
			data.addColumn('number', opcoName);
		});

		data.addRows(rows);

		var options = {
			title: 'Opco Wise Services Billed - Digital',
			legend: {
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 10 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#'
			},
			chartArea: {
				left: 35,
			},
		};

		var chartContainer = document.getElementById('services_billed_d');
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center';

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}
	}

	//Total Time Legacy

	function drawChartAllOWTTL(dataQuery71) {

		// Define the chartData directly in the view
		var chartData = dataQuery71;
		console.log(chartData)
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');

		var opcos = {};
		var rows = [];

		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.opco_shortname]) {
				opcos[data.opco_shortname] = [];
			}
			if (!opcos[data.opco_shortname][data.month - 1]) {
				opcos[data.opco_shortname][data.month - 1] = 0;
			}
			opcos[data.opco_shortname][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(opco) {
				var count = opco[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(opcoName) {
			data.addColumn('number', opcoName);
		});

		data.addRows(rows);

		var options = {
			title: 'Opco Wise Total Time - Legacy',
			legend: {
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 10 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#\'H\''
			},
			chartArea: {
				left: 32,
			},
		};

		var chartContainer = document.getElementById('total_time_l');
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center';

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}
	}

	//Total Time Digital

	function drawChartAllOWTTD(dataQuery72) {

		// Define the chartData directly in the view
		var chartData = dataQuery72;
		console.log(chartData)
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');

		var opcos = {};
		var rows = [];

		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.opco_shortname]) {
				opcos[data.opco_shortname] = [];
			}
			if (!opcos[data.opco_shortname][data.month - 1]) {
				opcos[data.opco_shortname][data.month - 1] = 0;
			}
			opcos[data.opco_shortname][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(opco) {
				var count = opco[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(opcoName) {
			data.addColumn('number', opcoName);
		});

		data.addRows(rows);

		var options = {
			title: 'Opco Wise Total Time - Digital',
			legend: {
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 10 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#\'H\''
			},
			chartArea: {
				left: 32,
			},
		};

		var chartContainer = document.getElementById('total_time_d');
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center';

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%');
			chartTitle.style.transform = 'translateX(-50%)';
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}
	}
</script>

<!-- Outages for Single OpCo -->
<script type="text/javascript">
	google.charts.load('current', {
		'packages': ['corechart']
	});

	function SingleOpCooutages(opco, month, year) {
		var xhrIS = new XMLHttpRequest();
		xhrIS.onreadystatechange = function() {
			if (xhrIS.readyState === XMLHttpRequest.DONE) {
				if (xhrIS.status === 200) {
					// Handle the response from the server
					var response = xhrIS.responseText;
					var parsedData = JSON.parse(response);
					var updatedDataSO = parsedData.query1;
					var dataQuery2 = parsedData.query2;
					var dataQuery3 = parsedData.query3;
					var dataQuery4 = parsedData.query4;
					var dataQuery5 = parsedData.query5;
					var dataQuery6 = parsedData.query6;
					var dataQuery7 = parsedData.query7;
					google.charts.setOnLoadCallback(function() {
						drawChartSingleOutages(updatedDataSO);
						drawChartSingleOWIS(dataQuery2);
						drawChartSingleSWIS(dataQuery3);
						drawChartSingleOWISLA(dataQuery4);
						drawChartSingleAB(dataQuery5);
						drawChartSingleSB(dataQuery6);
						drawChartSingleTT(dataQuery7);

					});
				} else {
					// Handle the error cases4_incidents_count
					console.error('Request failed for incidents logged chart.');
				}
			}
		};
		// Send an asynchronous POST request to update the query
		xhrIS.open('POST', '<?php echo base_url(); ?>IndexController/Singleopcooutages', true);

		xhrIS.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhrIS.send('month=' + month + '&year=' + year + '&opco=' + opco);
	}

	function drawChartSingleOutages(updatedDataSO) {
		var opco_name = document.getElementById('opco_name').options[document.getElementById('opco_name').selectedIndex].text;
		var chartData = updatedDataSO;
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');

		// Assuming chartData contains data for a single OPCO
		var singleOpcoData = chartData;

		// Initialize an object to store counts for each month
		var opcos = {};
		var rows = [];

		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.opco_name]) {
				opcos[data.opco_name] = [];
			}
			if (!opcos[data.opco_name][data.month - 1]) {
				opcos[data.opco_name][data.month - 1] = 0;
			}
			opcos[data.opco_name][data.month - 1] += parseInt(data.count);
		});
		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(opco) {
				var count = opco[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(opcoName) {
			data.addColumn('number', opcoName);
		});

		data.addRows(rows);

		var options = {
			title: opco_name + ' - Outages',
			'titleTextStyle': {
				'color': 'black', // Set the color of the title text
				'fontSize': 12, // Set the font size of the title text
				'bold': true
			},
			vAxis: {
				format: '#'
			},
			'legend': {
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 11 // Adjust the font size of legend items
				}
			},
			chartArea: {
				left: 50,
				width: '70%',
				height: '70%',
			}
		};


		// List of element IDs to check and hide
		const elementIds = [
			'services_billed_l',
			'accounts_billed_l',
			'accounts_billed_d',
			'services_billed_d',
			'total_time_l',
			'total_time_d',
		];
		// elementIds.forEach((id) => {
		// 	const element = document.getElementById(id);
		// 	if (element) {
		// 		element.remove(); // Completely remove the element from the DOM
		// 	}
		// });

		elementIds.forEach((id) => {
			const element = document.getElementById(id);
			if (element) {
				element.innerHTML = ''; // Clear the content
				element.style.display = 'none'; // Hide the element completely
				element.style.padding = '0'; // Reset padding
				element.style.margin = '0'; // Reset margin
				element.style.border = 'none'; // Reset border
				element.style.width = '0'; // Ensure no width
				element.style.height = '0'; // Ensure no height
				element.remove();
			}
		});


		var chartContainer = document.getElementById('incidents_outages');
		var chart = new google.visualization.ColumnChart(chartContainer);
		// Center the chart and title using CSS
		// chartContainer.style.width='450px';
		chartContainer.style.height = '300px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center'; // Align the content to the left
		// chartContainer.style.justifyContent = 'left'; // Center the content vertically
		// chartContainer.style.marginLeft = '-20px'; // Adjust value as needed
		chart.draw(data, options);

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%'); // Set x to 50% for centering
			chartTitle.style.transform = 'translateX(-50%)'; // Center the title horizontally
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}

	}


	function drawChartSingleOWIS(chart_data) {
		var opco_name = document.getElementById('opco_name').options[document.getElementById('opco_name').selectedIndex].text;
		// Define the chartData directly in the view
		var chartData = chart_data;
		console.log(chartData)
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');

		var opcos = {};
		var rows = [];

		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.opco_shortname]) {
				opcos[data.opco_shortname] = [];
			}
			if (!opcos[data.opco_shortname][data.month - 1]) {
				opcos[data.opco_shortname][data.month - 1] = 0;
			}
			opcos[data.opco_shortname][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(opco) {
				var count = opco[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(opcoName) {
			data.addColumn('number', opcoName);
		});

		data.addRows(rows);

		var options = {
			title: opco_name + ' - Incidents Summary',
			legend: {
				display: false,
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 11 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#'
			},
			chartArea: {
				left: 35,
				width: '70%',
				height: '70%',
			}
		};
		var chartContainer = document.getElementById('incidents_summary_OWl'); // Replace 'parentContainer' with the actual ID or selector of the parent container
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center'; // Align the content to the center

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%'); // Set x to 50% for centering
			chartTitle.style.transform = 'translateX(-50%)'; // Center the title horizontally
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}


	}


	function drawChartSingleSWIS(chart_data) {
		var opco_name = document.getElementById('opco_name').options[document.getElementById('opco_name').selectedIndex].text;
		// Define the chartData directly in the view
		var chartData = chart_data;
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');
		var opcos = {};
		var rows = [];
		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.Severity]) {
				opcos[data.Severity] = [];
			}
			if (!opcos[data.Severity][data.month - 1]) {
				opcos[data.Severity][data.month - 1] = 0;
			}
			opcos[data.Severity][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(Severity) {
				var count = Severity[month.month] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(Severity) {
			data.addColumn('number', Severity);
		});

		data.addRows(rows);

		var options = {
			title: opco_name + ' - Severity Wise Incidents',
			legend: {
				display: false,
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 11 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#'
			},
			chartArea: {
				left: 35,
				width: '70%',
				height: '70%',
			}
		};

		var chartContainer = document.getElementById('incidents_summary_OWd');
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center'; // Align the content to the center

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%'); // Set x to 50% for centering
			chartTitle.style.transform = 'translateX(-50%)'; // Center the title horizontally
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}
	}


	function drawChartSingleOWISLA(chart_data) {
		var opco_name = document.getElementById('opco_name').options[document.getElementById('opco_name').selectedIndex].text;
		// Define the chartData directly in the view
		var chartData = chart_data;
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');
		var opcos = {};
		var rows = [];
		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.opco_shortname]) {
				opcos[data.opco_shortname] = [];
			}
			if (!opcos[data.opco_shortname][data.month - 1]) {
				opcos[data.opco_shortname][data.month - 1] = 0;
			}
			opcos[data.opco_shortname][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(opco) {
				var count = opco[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(opcoName) {
			data.addColumn('number', opcoName);
		});

		data.addRows(rows);

		var options = {
			title: opco_name + ' - Incidents SLA%',
			legend: {
				display: false,
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 11 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#\'%\''
			},
			chartArea: {
				left: 35,
				width: '70%',
				height: '70%'
			},
		};

		var chartContainer = document.getElementById('incidents_summary_SWl');
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);


		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center'; // Align the content to the center

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%'); // Set x to 50% for centering
			chartTitle.style.transform = 'translateX(-50%)'; // Center the title horizontally
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}
	}


	//Single OPCO Accounts Billed

	function drawChartSingleAB(chart_data) {
		var opco_name = document.getElementById('opco_name').options[document.getElementById('opco_name').selectedIndex].text;
		// Define the chartData directly in the view
		var chartData = chart_data;
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');
		var opcos = {};
		var rows = [];
		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.opco_shortname]) {
				opcos[data.opco_shortname] = [];
			}
			if (!opcos[data.opco_shortname][data.month - 1]) {
				opcos[data.opco_shortname][data.month - 1] = 0;
			}
			opcos[data.opco_shortname][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(opco) {
				var count = opco[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(opcoName) {
			data.addColumn('number', opcoName);
		});

		data.addRows(rows);

		var options = {
			title: opco_name + ' - Accounts Billed',
			legend: {
				display: false,
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 11 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#'
			},
			chartArea: {
				left: 35,
				width: '70%',
				height: '70%'
			},
		};

		var chartContainer = document.getElementById('incidents_summary_SWd');
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center'; // Align the content to the center

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%'); // Set x to 50% for centering
			chartTitle.style.transform = 'translateX(-50%)'; // Center the title horizontally
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}
	}


	//Single OPCO Services Blled 

	function drawChartSingleSB(chart_data) {
		var opco_name = document.getElementById('opco_name').options[document.getElementById('opco_name').selectedIndex].text;
		// Define the chartData directly in the view
		var chartData = chart_data;
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');
		var opcos = {};
		var rows = [];
		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.opco_shortname]) {
				opcos[data.opco_shortname] = [];
			}
			if (!opcos[data.opco_shortname][data.month - 1]) {
				opcos[data.opco_shortname][data.month - 1] = 0;
			}
			opcos[data.opco_shortname][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(opco) {
				var count = opco[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(opcoName) {
			data.addColumn('number', opcoName);
		});

		data.addRows(rows);

		var options = {
			title: opco_name + ' - Services Billed',
			legend: {
				display: false,
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 11 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#'
			},
			chartArea: {
				left: 35,
				width: '70%',
				height: '70%'
			},
		};

		var chartContainer = document.getElementById('incidents_sla_l');
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center'; // Align the content to the center

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%'); // Set x to 50% for centering
			chartTitle.style.transform = 'translateX(-50%)'; // Center the title horizontally
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}
	}


	//Single OPCO Total Time

	function drawChartSingleTT(chart_data) {
		var opco_name = document.getElementById('opco_name').options[document.getElementById('opco_name').selectedIndex].text;
		// Define the chartData directly in the view
		var chartData = chart_data;
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');
		var opcos = {};
		var rows = [];
		// Fill the opcos object with the counts for each OPCO
		chartData.forEach(function(data) {
			if (!opcos[data.opco_shortname]) {
				opcos[data.opco_shortname] = [];
			}
			if (!opcos[data.opco_shortname][data.month - 1]) {
				opcos[data.opco_shortname][data.month - 1] = 0;
			}
			opcos[data.opco_shortname][data.month - 1] += parseInt(data.count);
		});

		// Get the current month and year
		var currentDate = new Date();
		var currentMonth = currentDate.getMonth();
		var currentYear = currentDate.getFullYear();

		// Calculate the past six months from the current month
		var months = [];
		for (var i = 6; i >= 1; i--) {
			var month = currentMonth - i;
			var year = currentYear;
			if (month <= 0) {
				month += 12;
				year -= 1;
			}
			months.push({
				month: month,
				year: year
			});
		}

		// Create the rows using the opcos object and the calculated months
		months.forEach(function(month) {
			var row = [getMonthLabel(month.month, month.year)];
			Object.values(opcos).forEach(function(opco) {
				var count = opco[month.month - 1] || 0;
				row.push(count);
			});
			rows.push(row);
		});

		// Add the columns for each unique OPCO name
		Object.keys(opcos).forEach(function(opcoName) {
			data.addColumn('number', opcoName);
		});

		data.addRows(rows);

		var options = {
			title: opco_name + ' - Total Time(Hours)',
			legend: {
				display: false,
				position: 'right',
				maxLines: 0,
				alignment: 'center',
				textStyle: {
					fontSize: 11 // Adjust the font size of legend items
				}
			},
			vAxis: {
				format: '#'
			},
			chartArea: {
				left: 35,
				width: '70%',
				height: '70%'
			},
		};

		var chartContainer = document.getElementById('incidents_sla_d');
		var chart = new google.visualization.ColumnChart(chartContainer);
		chart.draw(data, options);

		// Center the chart and title using CSS
		chartContainer.style.height = '270px';
		chartContainer.style.display = 'flex';
		chartContainer.style.flexDirection = 'column';
		chartContainer.style.alignItems = 'center'; // Align the content to the center

		// Adjust the title position
		var chartTitle = chartContainer.querySelector('text[font-weight="bold"]');
		if (chartTitle) {
			chartTitle.setAttribute('text-anchor', 'middle');
			chartTitle.setAttribute('x', '100%'); // Set x to 50% for centering
			chartTitle.style.transform = 'translateX(-50%)'; // Center the title horizontally
		}

		function getMonthLabel(month, year) {
			var monthNames = [
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			];
			return monthNames[month - 1] + ' ' + year;
		}
	}
</script>


<!-- generate an pdf file  -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

<script>
	window.onload = function() {
		updateQueryAll();

		document.getElementById("generate-pdf")
			.addEventListener("click", () => {

				const pdf = this.document.getElementById("pdf");
				// Center-align the text
				const h4Element = pdf.querySelector("#PDF-Title");
				var monthName = document.getElementById('chooseMonth').options[document.getElementById('chooseMonth').selectedIndex].text;
				var yearName = document.getElementById('chooseYear').options[document.getElementById('chooseYear').selectedIndex].text;
				var opco_name = document.getElementById('opco_name').options[document.getElementById('opco_name').selectedIndex].text;
				if (opco_name === 'All OpCo') {
					document.getElementById("PDF-Title").textContent = ' MSO Report - ' + monthName + ' ' + yearName;
				}
				h4Element.style.textAlign = "center";
				console.log(pdf);
				console.log(window);
				// var opt = {
				//     // margin: 1,
				// 	margin: { top: 10, right: 20, bottom: 10, left: 20 },
				//     filename: 'MSO_Dashboard.pdf',
				//     image: { type: 'jpeg', quality: 0.98 },
				//     html2canvas: { scale: 2 },
				// 	jsPDF: { unit: 'in', format: 'legal', orientation: 'landscape' }
				// };


				var opt = {
					margin: 1,
					filename: 'MSO_Dashboard.pdf',
					image: {
						type: 'jpeg',
						quality: 0.99
					},
					html2canvas: {
						scale: 2
					},
					jsPDF: {
						unit: 'in',
						format: 'ledger',
						orientation: 'landscape'
					},
					pagebreak: {
						before: '.second-page'
					} // Add this pagebreak option
				};

				// Add a class 'second-page' to the HTML element that starts on the second page			
				html2pdf().from(pdf).set(opt).save().then(() => {
					// Reset text alignment to "left" after PDF generation
					h4Element.style.textAlign = "left";
					if (opco_name === 'All OpCo') {
						document.getElementById("PDF-Title").textContent = ' MSO Dashboard - ' + monthName + ' ' + yearName;
					}
				});
			})
	}
</script>