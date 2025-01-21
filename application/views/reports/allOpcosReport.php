<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


$mail = new PHPMailer(true);

try {
	//Server settings
	$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = '';                     //SMTP username
	$mail->Password   = '';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $data = json_decode(file_get_contents("php://input"));
    
	if($data) {
		$today = date("j, n, Y"); 
		$filename = 'MSO_MONTHLY_REPORT_'.$today.'pptx';
		$pptx_report =  str_replace(' ', '+', $data->document);
		//Recipients
		$mail->setFrom('noreply@tecnotree.com', 'MSO DASHBOARD');
		$mail->addAddress($data->mail, '');     //Add a recipient

		$mail->addStringAttachment(base64_decode($pptx_report), $filename, 'base64', 'application/vnd.openxmlformats-officedocument.presentationml.presentation');
		
		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'Here is the subject';
		$mail->Body    = "Dear team, please receive MSO Monthly Report.";
		$mail->AltBody = 'Dear team, please receive MSO Monthly Report. Only for non HTML clients';

		$mail->send();
		echo 'Message has been sent';
	}


} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



?>
<?php
    $this->load->view('./templates/header.php');
?>

<style>
.table td,
.table th {
  /* padding: 1.25rem 0.75rem; */
   padding: 0.25rem;
}
.table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
   background-color: #fcb6b6;
}
.table-striped > tbody > tr:nth-child(2n) > td, .table-striped > tbody > tr:nth-child(2n) > th {
   background-color:#fcecd4;
}

</style>

<div class="page-header-breadcrumb">
    <ul class="breadcrumb-title">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url();?>MsoMonthlyReview/indexController/dashboard"><i class="ti-home"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a>All Opcos Report</a>
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
                            <h5>DETAILS</h5>
                        </div>
                        <div id="opcodetails" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-block">
                                <div class="row form-group">
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
                                    <div class="col-md-2">
                                        <a style="color:white;" class="mr-5 btn btn-primary" onclick="doCapture()">Download Report</a>
                                    </div>
                                    <div class="col-md-2">
                                        <a style="color:white;" class="mr-5 btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" onclick="" >Send Mail</a>
                                        
                                    </div>

                                    <input type="hidden" name="SUMMARY_REPORTS_COUNT" id="SUMMARY_REPORTS_COUNT" value="0">
                                    <input type="hidden" name="UNIQUE_ID" id="UNIQUE_ID">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span id="all_opcos_report">
                
            </span>
        </div>
    </div>
</div>
</form>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Recipient list</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formulaire">
      <div class="modal-body">
  <div class="form-group">
    <label for="Emailaddresses">Email address</label>
    <input type="email" class="form-control" id="Emailaddresses" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">Please enter email adress list separated by comma(,).</small>
  </div> 
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" onclick="send_Capture_to_Email()" class="btn btn-primary">Send</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php
    $this->load->view('./templates/footer.php');
?>
<?php
    $this->load->view('./metaDataScript.php');
?>
<?php
    $this->load->view('./reports/allOpcosReportScript.php');
?>



<script>
    async function generateUniqueId() {
        var uniqueId = '';
        uniqueId = Date.now()
        $("#UNIQUE_ID").val(uniqueId);
    }
    async function doCapture(test=1) {
        await generateUniqueId();
        await setCssProperties();
        await storeImage("inc_summary_slide","inc_summary_image");
        await storeImage("repeat_tickets_slide","repeat_tickets_image");
        await storeImage("sla_summary_slide","sla_summary_image");
        await storeImage("report_summary_slide","report_summary_image");
        await storeImage("billRunStatus_do_slide","billRunStatus_do_image");
        await storeImage("billRunStatus_lom_slide","billRunStatus_lom_image");
        await storeImage("billRunStatus_lonm_slide","billRunStatus_lonm_image");
        await storeImage("ad_dashboard_slide","ad_dashboard_image");
        await storeImage("kmd_dashboard_slide","kmd_dashboard_image");
        await storeImage("sid_dashboard_slide","sid_dashboard_image");
        await storeImage("oid_dashboard_slide","oid_dashboard_image");
        for(var i=0;i<parseInt($("#SUMMARY_REPORTS_COUNT").val());i++) {
            await storeImage("summary_slide_"+i,"summary_slide_"+i);
        }
        await removeCssProperties();
       	return downloadPPT(test);
    }
    let form = document.getElementById('formulaire');
    form.addEventListener('submit', function(event) {
    event.preventDefault();

});

let send_Capture_to_Email = (test=2) => {
		doCapture(test)
			.then((value) => {
		        let email = document.getElementById('Emailaddresses').value;
                let data = JSON.stringify({document: value, mail: email});
				let xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						$('.modal').modal('hide');
					}
				};
				xhttp.open("POST", "", true);
				xhttp.setRequestHeader("Content-type", 'application/x-www-form-urlencoded');
				xhttp.send(data);

		})


	}

    async function setCssProperties() {
        $("#inc_summary_slide").css('min-height','30rem')
        $("#repeat_tickets_slide").css('min-height','30rem')
        $("#sla_summary_slide").css('min-height','30rem')
        $("#report_summary_slide").css('min-height','30rem')
        $("#billRunStatus_do_slide").css('min-height','30rem')
        $("#billRunStatus_lom_slide").css('min-height','30rem')
        $("#billRunStatus_lonm_slide").css('min-height','30rem')
        $("#ad_dashboard_slide").css('min-height','30rem')
        $("#kmd_dashboard_slide").css('min-height','30rem')
        $("#sid_dashboard_slide").css('min-height','30rem')
        $("#oid_dashboard_slide").css('min-height','30rem')
    }
    async function removeCssProperties() {
        $("#inc_summary_slide").css('min-height','')
        $("#repeat_tickets_slide").css('min-height','')
        $("#sla_summary_slide").css('min-height','')
        $("#report_summary_slide").css('min-height','')
        $("#billRunStatus_do_slide").css('min-height','')
        $("#billRunStatus_lom_slide").css('min-height','')
        $("#billRunStatus_lonm_slide").css('min-height','')
        $("#ad_dashboard_slide").css('min-height','')
        $("#kmd_dashboard_slide").css('min-height','')
        $("#sid_dashboard_slide").css('min-height','')
        $("#oid_dashboard_slide").css('min-height','')
    }

    async function storeImage(id,name) {
        window.scrollTo(0, 0);
        html2canvas(document.getElementById(id)).then(function (canvas) {
            // console.log(canvas.toDataURL("image/jpeg", 0.9));
            var ajax = new XMLHttpRequest();
            ajax.open("POST", "captureImage", true);
            ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajax.send("uniqueId="+($("#UNIQUE_ID").val())+"&name="+name+"&image=" + canvas.toDataURL("image/jpeg", 0.9));
            ajax.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);

                }
            };
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/gh/gitbrent/pptxgenjs@3.10.0/dist/pptxgen.bundle.js"></script>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script>
    async function downloadPPT(test=1) {
        var basePath = '<?php echo base_url(); ?>';
        var path0 = basePath + 'assets/images/'+$("#UNIQUE_ID").val()+'/inc_summary_image.jpeg';
        var path1 = basePath + 'assets/images/'+$("#UNIQUE_ID").val()+'/repeat_tickets_image.jpeg';
        var path2 = basePath + 'assets/images/'+$("#UNIQUE_ID").val()+'/sla_summary_image.jpeg';
        var path3 = basePath + 'assets/images/'+$("#UNIQUE_ID").val()+'/report_summary_image.jpeg';
        var path4 = basePath + 'assets/images/'+$("#UNIQUE_ID").val()+'/billRunStatus_do_image.jpeg';
        var path5 = basePath + 'assets/images/'+$("#UNIQUE_ID").val()+'/billRunStatus_lom_image.jpeg';
        var path6 = basePath + 'assets/images/'+$("#UNIQUE_ID").val()+'/billRunStatus_lonm_image.jpeg';
        var path7 = basePath + 'assets/images/'+$("#UNIQUE_ID").val()+'/ad_dashboard_image.jpeg';
        var path8 = basePath + 'assets/images/'+$("#UNIQUE_ID").val()+'/kmd_dashboard_image.jpeg';
        var path9 = basePath + 'assets/images/'+$("#UNIQUE_ID").val()+'/sid_dashboard_image.jpeg';
        var path10 = basePath + 'assets/images/'+$("#UNIQUE_ID").val()+'/oid_dashboard_image.jpeg';
        let pptx = new PptxGenJS();
        // let slide = pptx.addSlide();
        // slide.addImage({ path: "https://upload.wikimedia.org/wikipedia/en/a/a9/Example.jpg" });
        pptx.addSlide().addImage({path: path0,w:'100%',h:'100%'});
        pptx.addSlide().addImage({path: path1,w:'100%',h:'100%'});
        pptx.addSlide().addImage({path: path2,w:'100%',h:'100%'});
        pptx.addSlide().addImage({path: path3,w:'100%',h:'100%'});
        pptx.addSlide().addImage({path: path4,w:'100%',h:'100%'});
        pptx.addSlide().addImage({path: path5,w:'100%',h:'100%'});
        pptx.addSlide().addImage({path: path6,w:'100%',h:'100%'});
        pptx.addSlide().addImage({path: path7,w:'100%',h:'100%'});
        pptx.addSlide().addImage({path: path8,w:'100%',h:'100%'});
        pptx.addSlide().addImage({path: path9,w:'100%',h:'100%'});
        pptx.addSlide().addImage({path: path10,w:'100%',h:'100%'});

        for(var i=0;i<parseInt($("#SUMMARY_REPORTS_COUNT").val());i++) {
            pptx.addSlide().addImage(
                {
                    path: basePath + 'assets/images/'+$("#UNIQUE_ID").val()+'/summary_slide_'+i+'.jpeg',
                    w:'100%',
                    h:'100%'
                }
            );
        }

		if (test !==1 ) {
			return pptx.write("base64")
				.then((data) => {
					return data;
				})
				.catch((err) => {
					console.error(err);
				});
		}else {

			// Image by data (pre-encoded base64)
			pptx.writeFile({ fileName: "mso_monthly_report.pptx" });
		}


        

    }
</script>
<script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>
<script>
function Allowmutipleemail() {
  document.getElementById("Emailaddresses").multiple = true;
}
</script>


