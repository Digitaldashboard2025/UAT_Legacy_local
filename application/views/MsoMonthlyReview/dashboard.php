<?php
    $this->load->view('./templates/header.php');
?>

<!-- <div class="page-header-breadcrumb">
    <ul class="breadcrumb-title">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url();?>MsoMonthlyReview/indexController/dashboard"><i class="ti-home"></i> Dashboard</a>
        </li>
    </ul>
</div> -->

<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Entry</h4>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="<?php echo base_url();?>indexController/dataEntry">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-3 text-right">
                                                        <h3 class="text-muted m-b-0"><i class="ti-pencil"></i></h3>
                                                    </div>
                                                    <div class="col-9">
                                                        <h5 class="text-c-purple">Monthly Data</h5>
                                                        <label class="text-muted m-b-0">Enter monthly data here</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="<?php echo base_url();?>indexController/additionalDataEntry">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-3 text-right">
                                                        <h3 class="text-muted m-b-0"><i class="ti-pencil"></i></h3>
                                                    </div>
                                                    <div class="col-9">
                                                        <h5 class="text-c-purple">Additional Data</h5>
                                                        <label class="text-muted m-b-0">Enter Team Size, Efforts ...</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Reports</h4>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="<?php echo base_url();?>reportsController/singleOpcoReport">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-3 text-right">
                                                        <h3 class="text-muted m-b-0"><i class="ti-file"></i></h3>
                                                    </div>
                                                    <div class="col-9">
                                                        <h5 class="text-c-purple">Single Opco Report</h5>
                                                        <label class="text-muted m-b-0">Enter monthly data here</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="<?php echo base_url();?>reportsController/allOpcosReport">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-3 text-right">
                                                        <h3 class="text-muted m-b-0"><i class="ti-files"></i></h3>
                                                    </div>
                                                    <div class="col-9">
                                                        <h4 class="text-c-purple">All Opcos Report</h4>
                                                        <h6 class="text-muted m-b-0">Generate, Download, Mail</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

<?php
    $this->load->view('./templates/footer.php');
?>
