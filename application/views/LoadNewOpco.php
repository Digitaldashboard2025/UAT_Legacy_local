<script>
	$(document).ready(function() {
		
		getOpcoDetails()
	})

	function getOpcoDetails() {
		$.ajax({
			url: '<?php echo site_url('IndexController/getOpcoDetails') ?>',
			type: 'post',
			data: {},
			success: function(data) {
				var data = $.parseJSON(data);
				var options = '<option value="">Select Opco</option>';
				for (var i = 0; i < data.length; i++) {
					options += '<option value="' + data[i].id + '">' + data[i].opco_name + '</option>';
				}
				$("#new_opco_name").html(options)
			}
		});
	}
	</script>

