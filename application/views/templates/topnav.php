<nav class="navbar header-navbar pcoded-header">
	<div class="navbar-wrapper">
		<div class="navbar-logo">
			<a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
				<i class="ti-menu"></i>
			</a>
			<a href="#">
				<img class="img-fluid" src="<?php print HTTP_ASSETS_PATH; ?>images/tt_logo.jpg" style="height:3rem;" alt="Theme-Logo" />
			</a>
			<!-- <a class="mobile-options waves-effect waves-light">
				<i class="ti-more"></i>
			</a> -->
		</div>

		<div class="navbar-container container-fluid">
			<ul class="nav-left">
				<li>
					<div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
				</li>
				<li>
					<a href="#!" onclick="javascript:toggleFullScreen()" style="display:inline;" class="waves-effect waves-light">
						
					</a>
						<a style="display: inline; color: #fff; padding: 0 1rem;">Digital Dashboard</a>
				</li>
			</ul>

			

			<ul class="nav-right">
			</li>
				<li>
					<a href="#!" onclick="javascript:toggleFullScreen()" style="display:inline;" class="waves-effect waves-light">
						<i class="ti-fullscreen"></i>
					</a>
				</li>
				<!--<li class="user-profile header-notification">
					 <a href="#!" class="waves-effect waves-light">
                        <span>User</span>
                        <i class="ti-angle-down"></i>
                    </a> -->
					<!-- <ul class="show-notification profile-notification">
                        <li class="waves-effect waves-light">
                            <a href="#">
                                <i class="ti-user"></i> Profile
                            </a>
                        </li>
                        <li class="waves-effect waves-light">
                            <a href="#">
                                <i class="ti-lock"></i> Permissions
                            </a>
                        </li>
                        <li class="waves-effect waves-light">
						<form class="form-material" id="dataForm" method="post" action="<?php echo base_url('login/do_login'); ?>">
							<button class="btn btn-light">
                                <i class="ti-layout-sidebar-left"></i> Logout
							</button>
							</form>
                            
                        </li>
                    </ul>-->
					<li>
					<form class="form-material" id="dataForm" method="post" action="<?php echo base_url('login/logout'); ?>">
						<button class="btn btn-outline-light">
							<i class="ti-layout-sidebar-left"></i> Logout
						</button>
					</form> 
				</li>
			</ul>
		</div>
	</div>
</nav>
