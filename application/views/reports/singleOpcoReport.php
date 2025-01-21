<?php
    $this->load->view('./templates/header.php');
?>
<style>
.table td,
.table th {
  /* padding: 1.25rem 0.75rem; */
   padding: 0.25rem;
}
</style>

<div class="page-header-breadcrumb">
    <ul class="breadcrumb-title">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url();?>MsoMonthlyReview/indexController/dashboard"><i class="ti-home"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a>Single Opco Report</a>
        </li>
    </ul>
</div>


<form action="" class="form-material">
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"  data-toggle="collapse" data-target="#opcodetails" aria-expanded="true" aria-controls="opcodetails" style="cursor:pointer;">
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
                                    <div class="col-md-3">
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
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" name="year" id="year"/>
                                    </div>
                                    <div class="col-md-2">
                                        <a style="color:white;" class="mr-5 btn btn-primary" onclick="getReportData()">Generate Report</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div id="previewImg" style="display:none;">
                </div>
                <div class="card-block" id="single_opco_report">
                    
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
<script>

    function getReportData() {
        var opco = $("#opco_name").val();
        var year = $("#year").val();
        var month_number = $("#month").val();
        var lastThreeMonths = getLastMonths(month_number)
        $.ajax({
            url:'<?php echo site_url('ReportsController/getSingleOpcoReportData') ?>',
            type:'post',
            data: {'opco':opco,'year':year,'month':month_number,'lastThreeMonths':lastThreeMonths},
            success : function(data){
                var data = $.parseJSON(data);
                var opco_details = data.opco_details;
                var teamSize = data.team_size;
                var eup = data.eup;
                var escalations = data.escalations;
                var comments = data.comments;
                var incidents_summary_data = data.incidents_summary_data;
                var sr_summary_data = data.sr_summary_data;
                var monthNames = getMonthNameAndShortCutName(month_number)
                var escalations_body = '';
                var comments_body = '';
                var inc_summary = '';
                var sr_summary = '';
                var prevThreeYearsMonths = lastThreeMonths[0].reverse()
                var prevThreeYears = lastThreeMonths[1].reverse()
                var prevThreeMonths = lastThreeMonths[2].reverse()
                var mean_time_to_resolve = ( incidents_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] && incidents_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] !== 'null' && incidents_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] !== 'undefined') ? incidents_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]]["mean_time_to_resolve"] : "NA"
                var mean_time_to_fulfill = ( sr_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] && sr_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] !== 'null' && sr_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] !== 'undefined') ? sr_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]]["mean_time_to_fulfill"] : "NA"
                var inc_sla_met_perc = incidents_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]]["sla_met_perc"];
                var sr_sla_met_perc = sr_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]]["sla_met_perc"];
                for(var i=0;i<escalations.length;i++) {
                    escalations_body += `
                        <tr>
                            <td style="width:5%;" class="text-center">${escalations[i].escalation_value}</td>
                            <td style="max-width:90%;white-space:normal;">
                                    ${escalations[i].escalation_details}
                            </td>
                            <td style="width:5%;" class="text-center">${escalations[i].escalation_status}</td>
                        </tr>
                    `;
                }
                for(var i=0;i<comments.length;i++) {
                    comments_body += `
                        <tr>
                            <td style="white-space:normal;">
                                    ${comments[i].description}
                            </td>
                        </tr>
                    `;
                }
                for(var i=0;i<4;i++) {
                    var j=0;
                    inc_summary += `
                        <tr>
                            <th class="text-center">S${i+1}</th>
                            <td class="text-center">
                                ${( incidents_summary_data[prevThreeYearsMonths[j]] && incidents_summary_data[prevThreeYearsMonths[j]] !== 'null' && incidents_summary_data[prevThreeYearsMonths[j]] !== 'undefined') ? incidents_summary_data[prevThreeYearsMonths[j]]["s"+(i+1)+"_incidents_count"] : "NA"}
                            </td>
                            <td class="text-center">
                            ${( incidents_summary_data[prevThreeYearsMonths[j+1]] && incidents_summary_data[prevThreeYearsMonths[j+1]] !== 'null' && incidents_summary_data[prevThreeYearsMonths[j+1]] !== 'undefined') ? incidents_summary_data[prevThreeYearsMonths[j+2]]["s"+(i+1)+"_incidents_count"] : "NA"}
                            </td>
                            <td class="text-center">
                            ${( incidents_summary_data[prevThreeYearsMonths[j+2]] && incidents_summary_data[prevThreeYearsMonths[j+2]] !== 'null' && incidents_summary_data[prevThreeYearsMonths[j+2]] !== 'undefined') ? incidents_summary_data[prevThreeYearsMonths[j+2]]["s"+(i+1)+"_incidents_count"] : "NA"}
                            </td>
                        </tr>
                    `;
                }
                for(var i=0;i<4;i++) {
                    var j=0;
                    sr_summary += `
                        <tr>
                            <th class="text-center">S${i+1}</th>
                            <td class="text-center">
                                ${( sr_summary_data[prevThreeYearsMonths[j]] && sr_summary_data[prevThreeYearsMonths[j]] !== 'null' && sr_summary_data[prevThreeYearsMonths[j]] !== 'undefined') ? sr_summary_data[prevThreeYearsMonths[j]]["s"+(i+1)+"_sr_count"] : "NA"}
                            </td>
                            <td class="text-center">
                            ${( sr_summary_data[prevThreeYearsMonths[j+1]] && sr_summary_data[prevThreeYearsMonths[j+1]] !== 'null' && sr_summary_data[prevThreeYearsMonths[j+1]] !== 'undefined') ? sr_summary_data[prevThreeYearsMonths[j+2]]["s"+(i+1)+"_sr_count"] : "NA"}
                            </td>
                            <td class="text-center">
                            ${( sr_summary_data[prevThreeYearsMonths[j+2]] && sr_summary_data[prevThreeYearsMonths[j+2]] !== 'null' && sr_summary_data[prevThreeYearsMonths[j+2]] !== 'undefined') ? sr_summary_data[prevThreeYearsMonths[j+2]]["s"+(i+1)+"_sr_count"] : "NA"}
                            </td>
                        </tr>
                    `;
                }
                var inc_count = []
                for(var i=0;i<prevThreeYearsMonths.length;i++) {
                    if(incidents_summary_data[prevThreeYearsMonths[i]] && incidents_summary_data[prevThreeYearsMonths[i]]!='null' && incidents_summary_data[prevThreeYearsMonths[i]] !== 'undefined'){
                        inc_count.push(parseInt(incidents_summary_data[prevThreeYearsMonths[i]]['inc_count']))
                    } else {
                        inc_count.push(0)
                    }
                }
                var sr_count = []
                for(var i=0;i<prevThreeYearsMonths.length;i++) {
                    if(sr_summary_data[prevThreeYearsMonths[i]] && sr_summary_data[prevThreeYearsMonths[i]]!='null' && sr_summary_data[prevThreeYearsMonths[i]] !== 'undefined'){
                        sr_count.push(parseInt(sr_summary_data[prevThreeYearsMonths[i]]['sr_count']))
                    } else {
                        sr_count.push(0)
                    }
                }
                var html = `
                    <div class="row" style="background-color: #1c00c8;color: white;font-size: 1rem;">
                        <div class="col-md-12">
                            <label>${opco_details[0].opco_name} - MSO Dashboard ${monthNames[1]} 2022</label>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-3" style="background-color: #1c00c8;color: white;font-size: 1rem;text-align: -webkit-center;">
                            <span>Overall Health</span>
                        </div>
                        <div class="col-md-3" style="background-color: #36FF51;color: black;font-size: 1rem;text-align: -webkit-center;">
                            <label>Green</label>
                        </div>
                        <div class="col-md-3" style="background-color: #ebeb2a;color: black;font-size: 1rem;text-align: -webkit-center;">
                            <label>Amber</label>
                        </div>
                        <div class="col-md-3" style="background-color: #f7260f;color: black;font-size: 1rem;text-align: -webkit-center;">
                            <label>Red</label>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-4" style="padding:0px;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr style="background-color: #1c00c8;color: white;font-size: 0.75rem;">
                                        <th colspan="4" class="text-center">Incidents By Category </th>
                                    </tr>
                                    <tr style="background-color: #1c00c8;color: white;font-size: 0.75rem;">
                                        <th class="text-center">Category</th>
                                        <th class="text-center">${lastThreeMonths[0][0]}</th>
                                        <th class="text-center">${lastThreeMonths[0][1]}</th>
                                        <th class="text-center">${lastThreeMonths[0][2]}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${inc_summary}
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4" style="padding-left:1rem;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr style="background-color: #1c00c8;color: white;font-size: 0.75rem;">
                                        <th colspan="3" class="text-center">Billing SLA(Last 3 months) </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="background-color:#36FF51;color:black;">${lastThreeMonths[0][0]}</th>
                                        <th class="text-center" style="background-color:#36FF51;color:black;">${lastThreeMonths[0][1]}</th>
                                        <th class="text-center" style="background-color:#36FF51;color:black;">${lastThreeMonths[0][2]}</th>
                                    </tr>
                                </thead>
                            </table>
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr style="background-color: #1c00c8;color: white;font-size: 0.75rem;">
                                        <th colspan="2" class="text-center">SLA Met Percentage </th>
                                    </tr>
                                    <tr style="background-color: #1c00c8;color: white;font-size: 0.75rem;">
                                        <th class="text-center" style="width: 50%">Incidents</th>
                                        <th class="text-center" style="width: 50%">Service Requests</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">${inc_sla_met_perc}%</td>
                                        <td class="text-center">${sr_sla_met_perc}%</td>
                                    </tr>
                                </tbody>    
                            </table>
                        </div>
                        <div class="col-md-4" style="padding-left:1rem;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr style="background-color: #1c00c8;color: white;font-size: 0.75rem;">
                                        <th colspan="2">Mean Time to Resolve/Fullfill (MTTR/MTTF) </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row" style="width:50%;background-color: #1c00c8;color: white;font-size: 0.75rem;">Incidents (MTTR)</th>
                                        <td>${mean_time_to_resolve}</td>
                                    </tr>
                                    <tr>
                                    <th scope="row" style="width:50%;background-color: #1c00c8;color: white;font-size: 0.75rem;">Service Requests (MTTF)</th>
                                        <td>${mean_time_to_fulfill}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-4" style="padding:0px;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr style="background-color: #1c00c8;color: white;font-size: 0.75rem;">
                                        <th colspan="2" class="text-center">Team Size </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th style="width:50%;background-color: #1c00c8;color: white;font-size: 0.75rem;">Onsite</th>
                                        <td style="width:50%;" class="text-center">${teamSize[0].onsite_local_count}L, ${teamSize[0].onsite_expat_count}E</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;background-color: #1c00c8;color: white;font-size: 0.75rem;">offshore</th>
                                        <td style="width:50%;" class="text-center">${teamSize[0].offshore_local_count}L, ${teamSize[0].offshore_expat_count}E</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <canvas id="incGraph"></canvas>
                        </div>
                        <div class="col-md-4">
                            <canvas id="srGraph"></canvas>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-4" style="padding:0px;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr style="background-color: #1c00c8;color: white;font-size: 0.75rem;">
                                        <th colspan="2" class="text-center">Effort/Utilization/Profitability</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th style="width:50%;background-color: #1c00c8;color: white;font-size: 0.75rem;">Efforts</th>
                                        <td class="text-center">${eup[0].pms_efforts}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;background-color: #1c00c8;color: white;font-size: 0.75rem;">Utilization</th>
                                        <td class="text-center">${eup[0].utilization_perc}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;background-color: #1c00c8;color: white;font-size: 0.75rem;">Profitability</th>
                                        <td class="text-center">${eup[0].profitability_count}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr style="background-color: #1c00c8;color: white;font-size: 0.75rem;">
                                        <th colspan="3" class="text-center">Ongoing Escalations (If any) </th>
                                    </tr>
                                    <tr style="background-color: #1c00c8;color: white;font-size: 0.75rem;">
                                        <th class="text-center" style="width:5%;">Yes/No</th>
                                        <th class="text-center" style="width:90%;">Details</th>
                                        <th class="text-center" style="width:5%;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   ${escalations_body}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-12" style="padding:0px;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr style="background-color: #1c00c8;color: white;font-size: 0.75rem;">
                                        <th>Improvements Done / Challenges / Any Other Comments </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${comments_body}
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;
                $("#single_opco_report").html(html);
                generateGraphs(prevThreeYearsMonths,inc_count,sr_count);
                // downloadPPT();
            }
        });
    }

</script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/pptxgenjs@3.10.0/dist/pptxgen.bundle.js"></script>
<script>
    function downloadPPT() {
        var simple = '<?php echo base_url(); ?>';
        var pp = simple + 'assets/images/sample.jpg';
        let pptx = new PptxGenJS();
        // let slide = pptx.addSlide();
        // slide.addImage({ path: "https://upload.wikimedia.org/wikipedia/en/a/a9/Example.jpg" });
        pptx.addSlide().addImage(
            { 
                path: pp,
                w:'100%',
                h:'100%'
            }
        );
        pptx.addSlide().addImage(
            { 
                path: pp,
                w:'100%',
                h:'100%'
            }
        );

        // Image by data (pre-encoded base64)
        pptx.writeFile({ fileName: "html2pptx-demo.pptx" });
    }
</script>
<script>
    function copy() {
        html2canvas(document.getElementById("single_opco_report")).then(function (canvas) {			
                var anchorTag = document.createElement("a");
                document.body.appendChild(anchorTag);
                document.getElementById("previewImg").appendChild(canvas);
                anchorTag.download = "filename.jpg";
                anchorTag.href = canvas.toDataURL();
                anchorTag.target = '_blank';
                anchorTag.click();
            });
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script>
    function generateGraphs(prevThreeYearsMonths,inc_count,sr_count) {
        var incGraph = document.getElementById("incGraph").getContext("2d");
        var srGraph = document.getElementById("srGraph").getContext("2d");
        new Chart(incGraph, {
            type: 'horizontalBar',
            data: {
                labels: prevThreeYearsMonths,
                datasets: [{
                    // label: "TESTING 123",
                    data: inc_count,
                    backgroundColor: ["#669911", "#119966","#119966"],
                    hoverBackgroundColor: ["#66A2EB", "#FCCE56","#119966"]
                }]
            },
            options: {
                title: {
                    display: true,
                    position: "top",
                    text: "Incidents Trend",
                    fontSize: 12,
                    fontColor: "#111"
                },
                legend: {
                    display: false
                }
            }
        });
        new Chart(srGraph, {
            type: 'horizontalBar',
            data: {
                labels: prevThreeYearsMonths,
                datasets: [{
                    // label: "TESTING 123",
                    data: sr_count,
                    backgroundColor: ["#669911", "#119966","#119966"],
                    hoverBackgroundColor: ["#66A2EB", "#FCCE56","#119966"]
                }]
            },
            options: {
                title: {
                    display: true,
                    position: "top",
                    text: "Service Requests Trend",
                    fontSize: 12,
                    fontColor: "#111"
                },
                legend: {
                    display: false
                }                
            }
        });
    }
</script>
