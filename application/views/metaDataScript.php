<div class="modal fade" id="addNewOpcoModal" tabindex="-1" role="dialog" aria-labelledby="addNewOpcoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addNewOpcoModalLabel">Add New Opco</h5>
		
        <button type="button" class="close" data-dismOpcoFormiss="modal" aria-label="Close">
          <span data-dismiss="modal" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-material" id="newOpcoForm" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label style="align-self:end;" class="col-sm-6 col-form-label">Opco Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="new_opco_name" name="new_opco_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label style="align-self:end;" class="col-sm-6 col-form-label">Country Code</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="new_opco_code" id="new_opco_code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label style="align-self:end;" class="col-sm-6 col-form-label">Opco Type</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="new_opco_type" id="new_opco_type">
                                <option value="">Select Opco Type</option>
                                <option value="LEGACY">Legacy</option>
                                <option value="DIGITAL">Digital</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label style="align-self:end;" class="col-sm-6 col-form-label">Opco Region</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="new_opco_region" id="new_opco_region">
                                <option value="">Select Opco Region</option>
								
                                <option value="SEA">SEA</option>
                                <option value="Middle East and North Africa">MENA</option>
                                <option value="West and Central Africa">WECA</option>
                                <option value="Asia Pacific">APAC</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label style="align-self:end;" class="col-sm-6 col-form-label">Opco Short Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="new_opco_shortName" name="new_opco_shortName">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label style="align-self:end;" class="col-sm-6 col-form-label">Opco Group</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="new_opco_group" id="new_opco_group">
                                <option value="">Select Opco Group</option>
                                <option value="MTN">MTN</option>
                                <option value="NON-MTN">NON-MTN</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label style="align-self:end;" class="col-sm-6 col-form-label">Contract Type</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="new_opco_contractType" id="new_opco_contractType">
                                <option value="">Opco Contract Type</option>
                                <option value="MSO">MSO</option>
                                <option value="AMC">AMC</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label style="align-self:end;" class="col-sm-6 col-form-label">Bill Cycle Peroid</label>
                        <div class="col-sm-6">
                            <input type="text" placeholder="Eg: 1st to 31st" class="form-control" id="new_opco_bcp" name="new_opco_bcp">
                        </div>
                    </div>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
	  <h6>Please refresh the page after adding!</h6>
        <a type="button" class="btn btn-secondary" data-dismiss="modal" style="color:white">Close</a>
        <a type="button" class="btn btn-primary" data-dismiss="modal" onclick="addNewOpco()" style="color:white">Save changes</a>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        $('#year').datepicker({
            minViewMode: 2,
            format: 'yyyy',
            autoclose:true
        });
        var currentDate = new Date();
        $("#year").val(currentDate.getFullYear());
        $("#month").val(currentDate.getMonth()-1);
        // alert($("#month").val())
        getOpcoDetails()
    })

    function getOpcoDetails() {
        $.ajax({
            url:'<?php echo site_url('IndexController/getOpcoDetails') ?>',
            type:'post',
            data: {},
            success : function(data){
                var data = $.parseJSON(data);
                var options = '<option value="-1">All OpCo</option>';
                for(var i=0;i<data.length;i++){
                    options += '<option value="'+data[i].id+'">'+data[i].opco_name+'</option>';
                }
                $("#opco_name").html(options)
            }
        });
    }

    function getMonthNameAndShortCutName(monthNumber) {
        let month_number = parseInt(monthNumber)
        const month = [];
        switch (month_number) {
            case 0:
                month[0] = "January";
                month[1] = "Jan";
                break;
            case 1:
                month[0] = "February";
                month[1] = "Feb";
                break;
            case 2:
                month[0] = "March";
                month[1] = "Mar";
                break;
            case 3:
                month[0] = "April";
                month[1] = "Apr";
                break;
            case 4:
                month[0] = "May";
                month[1] = "May";
                break;
            case 5:
                month[0] = "June";
                month[1] = "Jun";
                break;
            case 6:
                month[0] = "July";
                month[1] = "Jul";
                break;
            case 7:
                month[0] = "August";
                month[1] = "Aug";
                break;
            case 8:
                month[0] = "September";
                month[1] = "Sep";
                break;
            case 9:
                month[0] = "October";
                month[1] = "Oct";
                break;
            case 10:
                month[0] = "November";
                month[1] = "Nov";
                break;
            case 11:
                month[0] = "December";
                month[1] = "Dec";
                break;
        }
        return month;
    }

    function getLastMonths(month_number) {
        var m =['','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        var lastMonths = new Array();
        var months = new Array();
        var months_years = new Array();
        var years = new Array();
        var today = new Date();
        var year = today.getFullYear();
        var month = parseInt(month_number)+1;
        var i = 0;
        do {
            months_years.push( m[parseInt((month > 9 ? "" : "0") + month)]+' - '+year);
            months.push(parseInt((month > 9 ? "" : "0") + month)-1);
            years.push(year);
            if (month == 1) {
                month = 12;
                year--;
            } else {
                month--;
            }
            i++;
        } while (i < 3);
        lastMonths.push(months_years);
        lastMonths.push(years);
        lastMonths.push(months);
        return lastMonths;
    }

    function addNewOpco() {
            $.ajax({
                type: "POST",
                url:'<?php echo site_url('IndexController/addNewOpco') ?>',
                data: $("#newOpcoForm").serialize(),
                success: function(data){
                    var option = ''
                    option = option + '<option value="'+opcoCode+'" selected>'+($("#new_opco_name").val())+'</option>';
                    $("#opco_name").append(option)
                    document.getElementById("#newOpcoForm").reset();
                    $('#addNewOpcoModal').modal('hide');
                }
            });
    }
</script>
