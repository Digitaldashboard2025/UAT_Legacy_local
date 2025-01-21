<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
	<link rel="icon" type="image/x-icon" href="https://www3.tecnotree.com/wp-content/uploads/2019/05/favicon.ico">
	<link rel="stylesheet" type="text/css" href="<?php print HTTP_ASSETS_PATH; ?>css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php print HTTP_ASSETS_PATH; ?>pages/waves/css/waves.min.css" type="text/css" media="all">
	<link rel="stylesheet" type="text/css" href="<?php print HTTP_ASSETS_PATH; ?>icon/themify-icons/themify-icons.css">
	<link rel="stylesheet" type="text/css" href="<?php print HTTP_ASSETS_PATH; ?>icon/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php print HTTP_ASSETS_PATH; ?>css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
	<link rel="stylesheet" type="text/css" href="<?php print HTTP_ASSETS_PATH; ?>css/style.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">

	<style>
		div.google-visualization-tooltip {
			width: 200px;
			font-weight: bold;
			line-height: 2;
			padding: 10px;
		}
	</style>



	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
	<!-- <script type="text/javascript" src="https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.js" integrity="sha512-sn/GHTj+FCxK5wam7k9w4gPPm6zss4Zwl/X9wgrvGMFbnedR8lTUSLdsolDRBRzsX6N+YgG6OWyvn9qaFVXH9w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
	<!-- Pre-loader start -->
	<div class="theme-loader">
		<div class="loader-track">
			<div class="preloader-wrapper">
				<div class="spinner-layer spinner-blue">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
				<div class="spinner-layer spinner-red">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>

				<div class="spinner-layer spinner-yellow">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>

				<div class="spinner-layer spinner-green">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Pre-loader end -->
	<div id="pcoded" class="pcoded">
		<div class="pcoded-overlay-box"></div>
		<div class="pcoded-container navbar-wrapper">
			<?php
			$this->load->view('./templates/topnav.php');
			?>
			<div class="pcoded-main-container">
				<div class="pcoded-wrapper">
					<?php
					$this->load->view('./templates/leftnav.php');
					?>
					<div class="pcoded-content">
						<div class="pcoded-inner-content">
