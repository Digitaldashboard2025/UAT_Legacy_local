<script>
    
    function getReportData() {
        var year = $("#year").val();
        var month_number = $("#month").val();
        var lastThreeMonths = getLastMonths(month_number)
        $.ajax({
            url:'<?php echo site_url('ReportsController/getAllOpcosReportData') ?>',
            type:'post',
            data: {'year':year,'month':month_number,'lastThreeYearsMonths':lastThreeMonths},
            success : function(data){
                var metaData = $.parseJSON(data);
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
                appendIncidentSummaryDetails('Incidents Summary',month_number,year,incidents_summary_digital,incidents_summary_legacy,0)

                // Repeat Ticket Details
                var repeat_ticket_details = metaData.repeat_ticket_details;
                appendRepeatTicketDetails('Repeat Tickets',repeat_ticket_details,0)

                //SLA Summary Details
                var sla_incidents_summary_digital = metaData.sla_incidents_summary_digital;
                var sla_incidents_summary_legacy = metaData.sla_incidents_summary_legacy;
                appendSLAIncidentSummaryDetails('SLA Summary',month_number,year,sla_incidents_summary_digital,sla_incidents_summary_legacy,0)

                //Report Summary
                var report_summary = metaData.report_summary;
                appendReportSummary('Summary: Improvements/ Initiatives / Critical Activities Performed',report_summary)

                // Bill Run Status Content
                appendBillRunStatus('do','Bill Run Status : Digital OpCo’s ',brs_digital_opcos,month_number,year,0)
                appendBillRunStatus('lom','Bill Run Status : Legacy OpCo’s (MTN)',brs_legacy_mtn_opcos,month_number,year,1)
                appendBillRunStatus('lonm','Bill Run Status : Legacy OpCo’s (Non-MTN)',brs_legacy_nonmtn_opcos,month_number,year,2)
                
                //Dashboards Content
                
                appendDashboardContent('ad','Automation Dashboard',automation_dashboard_data,year,0);
                appendDashboardContent('kmd','KM Dashboard',km_dashboard_data,year,1);
                appendDashboardContent('sid','Security Incidents Dashboard',oi_dashboard_data,year,2);
                appendDashboardContent('oid','Open Incident Dashboard',si_dashboard_data,year,3);

                $("#SUMMARY_REPORTS_COUNT").val(data.length);

                for(var ind=0;ind<data.length;ind++) {
                    var html = '';
                    var opco_details = data[ind].opco_details;
                    var teamSize = data[ind].team_size;
                    var eup = data[ind].eup;
                    var escalations = data[ind].escalations;
                    var comments = data[ind].comments;
                    var incidents_summary_data = data[ind].incidents_summary_data;
                    var sr_summary_data = data[ind].sr_summary_data;
                    var monthNames = getMonthNameAndShortCutName(month_number)
                    var escalations_body = '';
                    var comments_body = '';
                    var inc_summary = '';
                    var sr_summary = '';
                    var mean_time_to_resolve = ( incidents_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] && incidents_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] !== 'null' && incidents_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] !== 'undefined') ? incidents_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]]["mean_time_to_resolve"] : "NA"
                    var mean_time_to_fulfill = ( sr_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] && sr_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] !== 'null' && sr_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] !== 'undefined') ? sr_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]]["mean_time_to_fulfill"] : "NA"
                    var inc_sla_met_perc = ( incidents_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] && incidents_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] !== 'null' && incidents_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] !== 'undefined') ? incidents_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]]["sla_met_perc"] : "NA";
                    var sr_sla_met_perc = ( sr_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] && sr_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] !== 'null' && sr_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]] !== 'undefined') ? sr_summary_data[prevThreeYearsMonths[prevThreeYearsMonths.length-1]]["sla_met_perc"] : "NA";
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
                                ${( incidents_summary_data[prevThreeYearsMonths[j+1]] && incidents_summary_data[prevThreeYearsMonths[j+1]] !== 'null' && incidents_summary_data[prevThreeYearsMonths[j+1]] !== 'undefined') ? incidents_summary_data[prevThreeYearsMonths[j+1]]["s"+(i+1)+"_incidents_count"] : "NA"}
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
                    var overallHealth = '';
                    if(eup[0].overall_health == 'green') {
                        overallHealth = '#36FF51';
                    } else if(eup[0].overall_health == 'amber') {
                        overallHealth = '#ebeb2a'
                    } else {
                        overallHealth = '#f7260f';
                    }
                    html = `<div class="card" id="summary_slide_${ind}"><div class="card-block">
                        <div class="row" style="background-color: #1c00c8;color: white;font-size: 1rem;">
                            <div class="col-md-12">
                                <label>${opco_details[0].opco_name} - MSO Dashboard ${monthNames[1]} 2022</label>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12" style="background-color: ${overallHealth};color: white;font-size: 1rem;text-align: -webkit-center;">
                                <span>Overall Health</span>
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
                                <canvas id="incGraph${ind}"></canvas>
                            </div>
                            <div class="col-md-4">
                                <canvas id="srGraph${ind}"></canvas>
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
                        </div>
                    </div>`;
                    $("#all_opcos_report").append(html);
                    generateGraphs(prevThreeYearsMonths,inc_count,sr_count,ind);
                }
                // downloadPPT()
            }
        });
    }

    function appendIncidentSummaryDetails(heading,month,year,incidents_summary_digital,incidents_summary_legacy,unique) {
        var incidentSummary = '';
        incidentSummary += `
            <div class="card" id="inc_summary_slide">
                <div class="card-block">
                    <div class="row" >
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
        var monthNames = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]
        var labels = [];
        for(var i=0;i<=month;i++) {
            labels.push(monthNames[i]+" "+year)
        }
        console.log(labels)
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
                }
            }
        });
    }

    function appendSLAIncidentSummaryDetails(heading,month,year,incidents_summary_digital,incidents_summary_legacy,unique) {
        var incidentSummary = '';
        incidentSummary += `
            <div class="card" id="sla_summary_slide">
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
        var monthNames = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]
        var labels = [];
        for(var i=0;i<=month;i++) {
            labels.push(monthNames[i]+" "+year)
        }
        console.log(labels)
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

    function appendRepeatTicketDetails(heading,repeatTicketDetails,unique) {
        var repeatTicketTable = '';
        var repeatTicketRows = '';
        for(var index = 0; index<repeatTicketDetails.length; index++) {
            repeatTicketRows+= '<tr>';
            repeatTicketRows+= '<td style="white-space:normal;">'+repeatTicketDetails[index].opco_shortname+'</td>';
            repeatTicketRows+= '<td style="white-space:normal;">'+repeatTicketDetails[index].incident_name+'</td>';
            repeatTicketRows+= '<td style="white-space:normal;">'+repeatTicketDetails[index].incident_desc+'</td>';
            repeatTicketRows+= '<td style="white-space:normal;">'+repeatTicketDetails[index].incident_resolution+'</td>';
            repeatTicketRows+= '</tr>';
        }
        repeatTicketTable += `
            <div class="card" id="repeat_tickets_slide">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 style="color:#1c00c8;">${heading}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" id="repeatTicketTableId${unique}">
                                <tbody>
                                    <tr style="background-color:#1c00c8;color:white;">
                                        <td class="text-center" style="max-width:10%;white-space:normal;">CUSTOMER</td>
                                        <td class="text-center" style="max-width:20%;white-space:normal;">INCIDENT</td>
                                        <td class="text-center" style="max-width:35%;white-space:normal;">ISSUE DESC</td>
                                        <td class="text-center" style="max-width:35%;white-space:normal;">RESOLUTION</td>
                                    </tr>
                                    ${repeatTicketRows}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $("#all_opcos_report").append(repeatTicketTable);
    }

    function appendReportSummary(heading,reportSummaryData) {
        var reportSummary = '';
        var reportSummaryLists = '';
        for(var i=0;i<reportSummaryData.length;i++) {
            reportSummaryLists = reportSummaryLists + '<li style="list-style:outside;padding-top:0.7rem;">'+reportSummaryData[i].summary_desc+'</li>';
        }
        reportSummary += `
            <div class="card" id="report_summary_slide">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 style="color:#1c00c8;">${heading}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul style="padding:1.5rem;">
                                ${reportSummaryLists}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $("#all_opcos_report").append(reportSummary);
    }

    function appendBillRunStatus(id,billRunStatusName,billRunStatusData,month,year,unique){
        var billRunStatusTable = '';
        var billRunStatusRows = '';
        for(var index = 0; index<billRunStatusData.length; index++) {
            billRunStatusRows+= '<tr>';
            billRunStatusRows+= '<td>'+billRunStatusData[index].opco_name+'</td>';
            billRunStatusRows+= '<td>'+billRunStatusData[index].opco_contract_type+'</td>';
            billRunStatusRows+= '<td>'+billRunStatusData[index].main_bill_cycle_period+'</td>';
            billRunStatusRows+= '<td>'+billRunStatusData[index].main_bill_start_date+'</td>';
            billRunStatusRows+= '<td>'+billRunStatusData[index].current_status+'</td>';
            billRunStatusRows+= '<td>'+billRunStatusData[index].main_bill_completion_date+'</td>';
            billRunStatusRows+= '<td>'+billRunStatusData[index].accounts_billed_count+'</td>';
            billRunStatusRows+= '<td>'+billRunStatusData[index].service_billed_count+'</td>';
            billRunStatusRows+= '<td>'+billRunStatusData[index].processing_time+'</td>';
            billRunStatusRows+= '<td>'+billRunStatusData[index].invoice_verifcation_time+'</td>';
            billRunStatusRows+= '<td>'+billRunStatusData[index].total_time+'</td>';
            billRunStatusRows+= '</tr>';
        }
        var monthNames = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]
        billRunStatusTable += `
            <div class="card" id="billRunStatus_${id}_slide">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 style="color:#1c00c8;">${billRunStatusName} - ${monthNames[month]} ${year}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered" id="billRunStatusTableId${unique}">
                                <tbody>
                                    <tr style="background-color:#1c00c8;color:white;">
                                        <td class="text-center" style="max-width:5%;white-space:normal;">Customer</td>
                                        <td class="text-center" style="max-width:5%;white-space:normal;">Service Type</td>
                                        <td class="text-center" style="max-width:10%;white-space:normal;">Main Bill Cycle Period</td>
                                        <td class="text-center" style="max-width:10%;white-space:normal;">Main Bill Run Start Date</td>
                                        <td class="text-center" style="max-width:10%;white-space:normal;">Current Status</td>
                                        <td class="text-center" style="max-width:10%;white-space:normal;">Main Bill Run Completion Date</td>
                                        <td class="text-center" style="max-width:10%;white-space:normal;">Accounts Billed Count</td>
                                        <td class="text-center" style="max-width:10%;white-space:normal;">Service Billed Count</td>
                                        <td class="text-center" style="max-width:10%;white-space:normal;">Processing Time (H:M:S)</td>
                                        <td class="text-center" style="max-width:10%;white-space:normal;">Invoice Verification Time  (H:M:S)</td>
                                        <td class="text-center" style="max-width:10%;white-space:normal;">Total Time (H:M:S)</td>
                                    </tr>
                                    ${billRunStatusRows}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $("#all_opcos_report").append(billRunStatusTable);
    }

    function appendDashboardContent(id,dashboard_name,dashboard_data,year,unique) {
        var dashoboardTable = '';
        var dashoboardRows = '';
        for(var index = 0; index<dashboard_data.length; index++) {
            dashoboardRows+= '<tr>';
            dashoboardRows+= '<td>'+dashboard_data[index].opco_name+'</td>';
            for(var j=0;j<dashboard_data[index].counts.length;j++) {
                dashoboardRows+= '<td class="text-center">'+dashboard_data[index].counts[j]+'</td>';
            }
            dashoboardRows+= '</tr>';
        }
        dashoboardTable += `
            <div class="card" id="${id}_dashboard_slide">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 style="color:#1c00c8;">${dashboard_name} - ${year}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered" id="dashboardTableId${unique}">
                                <tbody>
                                    <tr style="background-color:#ffb042;color:white;">
                                        <th class="text-center">OPCO</th>
                                        <th class="text-center">Jan</th>
                                        <th class="text-center">Feb</th>
                                        <th class="text-center">Mar</th>
                                        <th class="text-center">Apr</th>
                                        <th class="text-center">May</th>
                                        <th class="text-center">Jun</th>
                                        <th class="text-center">Jul</th>
                                        <th class="text-center">Aug</th>
                                        <th class="text-center">Sep</th>
                                        <th class="text-center">Oct</th>
                                        <th class="text-center">Nov</th>
                                        <th class="text-center">Dec</th>
                                    </tr>
                                    ${dashoboardRows}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $("#all_opcos_report").append(dashoboardTable);
    }
</script>

<script src="https://cdn.jsdelivr.net/gh/gitbrent/pptxgenjs@3.10.0/dist/pptxgen.bundle.js"></script>
<script>
    function downloadPPT() {
        let pptx = new PptxGenJS();
        let slide = pptx.addSlide();
        pptx.addSection({ title: "Tables" });
        pptx.tableToSlides("billRunStatusTableId0");
        pptx.tableToSlides("billRunStatusTableId1");
        pptx.tableToSlides("billRunStatusTableId2");
        pptx.tableToSlides("dashboardTableId0");
        pptx.tableToSlides("dashboardTableId1");
        pptx.tableToSlides("dashboardTableId2");
        pptx.tableToSlides("dashboardTableId3");
        pptx.writeFile({ fileName: "dashboards.pptx" });
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script>
    function generateGraphs(prevThreeYearsMonths,inc_count,sr_count,index) {
        console.log(inc_count)
        var incGraph = document.getElementById("incGraph"+index).getContext("2d");
        var srGraph = document.getElementById("srGraph"+index).getContext("2d");
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
        return 0;
    }
</script>