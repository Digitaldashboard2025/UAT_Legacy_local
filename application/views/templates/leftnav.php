<nav class="pcoded-navbar">
	<div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
	<div class="pcoded-inner-navbar main-menu" style="margin-top:10px;">
		<!-- <div class="pcoded-navigation-label">Layout</div> -->
		<ul class="pcoded-item pcoded-left-item">
		<li>
					<a href="<?php echo base_url(); ?>indexController/" class="waves-effect waves-dark">
						<span class="pcoded-micon"><i class="ti-bar-chart"></i><b>D</b></span>
						<span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
						<span class="pcoded-mcaret"></span>
					</a>
				</li>

				<li>
				<a href="<?php echo base_url(); ?>indexController/dataEntry" class="waves-effect waves-dark">
						<span class="pcoded-micon"><i class="ti-layers"></i><b>D</b></span>
						<span class="pcoded-mtext" data-i18n="nav.dash.main">Opco Details</span>
						<span class="pcoded-mcaret"></span>
					</a>
				</li>
				<li>
				<a href="<?php echo base_url(); ?>MsoMonthlyReview/indexController/About_us" class=" waves-effect waves-dark">
					<!--<a href="#" class="disabled waves-effect waves-dark">-->
					<span class="pcoded-micon"><i class="ti-info-alt"></i><b>D</b></span>
					<!-- <span class="pcoded-micon"><i class="ti-user"></i><b>D</b></span> -->
					<span class="pcoded-mtext" data-i18n="nav.dash.main">About</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>

			<!-- <?php if ($this->session->userdata('read_permission') === 'YES') : ?> 
				<li>
					<a href="<?php echo base_url(); ?>indexController/" class="waves-effect waves-dark">
						<span class="pcoded-micon"><i class="ti-bar-chart"></i><b>D</b></span>
						<span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
						<span class="pcoded-mcaret"></span>
					</a>
				</li>
			 <?php endif; ?> -->

			<!-- <?php if ($this->session->userdata('write_permission') === 'YES') : ?> -->
				<!-- <li>
					<a href="<?php echo base_url(); ?>MsoMonthlyReview/indexController/dashboard" class="waves-effect waves-dark">
						<span class="pcoded-micon"><i class="ti-layers"></i><b>D</b></span>
						<span class="pcoded-mtext" data-i18n="nav.dash.main">Opco Details</span>
						<span class="pcoded-mcaret"></span>
					</a>
				</li> -->

			<!-- <?php else : ?> 
				<li>
					<a href="#" class=" disabled waves-effect waves-dark">
						<span class="pcoded-micon"><i class="ti-details"></i><b>D</b></span>
						<span class="pcoded-mtext" data-i18n="nav.dash.main">Opco Details</span>
						<span class="pcoded-mcaret"></span>
					</a>
				</li>
			<?php endif; ?>-->


			<!-- <?php if ($this->session->userdata('user_role') === 'Admin') : ?>
			<li>
				<a href="<?php echo base_url(); ?>MsoMonthlyReview/indexController/AdminView" class=" waves-effect waves-dark">
					<a href="#" class="disabled waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-user"></i><b>D</b></span>
					<span class="pcoded-mtext" data-i18n="nav.dash.main">Admin</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
			<?php endif; ?> -->
		</ul>
	</div>
</nav>