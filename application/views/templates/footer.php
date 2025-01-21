								<!-- </div>
							</div> 
						</div> -->
								</div>
								</div>
								</div>
								</div>
								</div>
								</div>

								<script type="text/javascript" src="<?php print HTTP_ASSETS_PATH; ?>js/jquery/jquery.min.js"></script>
								<script type="text/javascript" src="<?php print HTTP_ASSETS_PATH; ?>js/jquery-ui/jquery-ui.min.js "></script>
								<script type="text/javascript" src="<?php print HTTP_ASSETS_PATH; ?>js/popper.js/popper.min.js"></script>
								<script type="text/javascript" src="<?php print HTTP_ASSETS_PATH; ?>js/bootstrap/js/bootstrap.min.js "></script>
								<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
								<script type="text/javascript" src="<?php print HTTP_ASSETS_PATH; ?>pages/widget/excanvas.js "></script>
								<!-- waves js -->
								<script src="<?php print HTTP_ASSETS_PATH; ?>pages/waves/js/waves.min.js"></script>
								<!-- jquery slimscroll js -->
								<script type="text/javascript" src="<?php print HTTP_ASSETS_PATH; ?>js/jquery-slimscroll/jquery.slimscroll.js "></script>
								<!-- modernizr js -->
								<script type="text/javascript" src="<?php print HTTP_ASSETS_PATH; ?>js/modernizr/modernizr.js "></script>
								<!-- slimscroll js -->
								<script type="text/javascript" src="<?php print HTTP_ASSETS_PATH; ?>js/SmoothScroll.js"></script>
								<script src="<?php print HTTP_ASSETS_PATH; ?>js/jquery.mCustomScrollbar.concat.min.js "></script>
								<!-- Chart js -->
								<script type="text/javascript" src="<?php print HTTP_ASSETS_PATH; ?>js/chart.js/Chart.js"></script>
								<!-- amchart js -->
								<!-- <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="<?php print HTTP_ASSETS_PATH; ?>pages/widget/amchart/gauge.js"></script>
<script src="<?php print HTTP_ASSETS_PATH; ?>pages/widget/amchart/serial.js"></script>
<script src="<?php print HTTP_ASSETS_PATH; ?>pages/widget/amchart/light.js"></script>
<script src="<?php print HTTP_ASSETS_PATH; ?>pages/widget/amchart/pie.min.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script> -->
								<!-- menu js -->
								<script src="<?php print HTTP_ASSETS_PATH; ?>js/pcoded.min.js"></script>
								<script src="<?php print HTTP_ASSETS_PATH; ?>js/vertical-layout.min.js "></script>
								<!-- custom js -->
								<!-- <script type="text/javascript" src="<?php print HTTP_ASSETS_PATH; ?>pages/dashboard/custom-dashboard.js"></script> -->
								<script type="text/javascript" src="<?php print HTTP_ASSETS_PATH; ?>js/script.js "></script>
								<script type="text/javascript" src="<?php print HTTP_ASSETS_PATH; ?>js/html2canvas.js"></script>

								<script>
									$(function() {
										$('a').each(function() {
											if ($(this).prop('href') == window.location.href) {
												// $(this).addClass('active'); 
												$(this).parents('li').addClass('active');
											}
										});
									});
									
								</script>
								
								</body>
								<footer class="text-center">
									<div class="container">
										<div class="row">
											<div class="col-md-12">
												
												<p> Tecnotree Digital Dashboard &copy; <span id="currentYear"></span> All Rights Reserved </p>
												<div class="text-center">
													<!-- <a href="#" class="">Terms of Use</a> -->
													<!-- <span class="text-muted mx-2">|</span> -->
													<!-- <a href="https://www.tecnotree.com/privacy" class="">Privacy Policy</a> -->
												</div>
											</div>
										</div>
									</div>
								</footer>
								<script>
									// Set the current year dynamically
									document.getElementById('currentYear').textContent = new Date().getFullYear();
								</script>

								</html>