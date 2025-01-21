<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class ReportsController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('IndexModel', 'ind_model');
		$this->load->model('ReportsModel', 'report');
		$this->load->library('form_validation');
	}

	public function singleOpcoReport()
	{
		$data = array();
		$this->load->view('reports/singleOpcoReport', $data);
	}

	public function getSingleOpcoReportData()
	{
		$opcoId = $_POST['opco'];
		$year = $_POST['year'];
		$month = $_POST['month'];
		$lastThreeMonths = $_POST['lastThreeMonths'];
		$data['opco_details'] = $this->ind_model->getSingleOpcoDetails($opcoId);
		$data['team_size'] = $this->report->getSingleOpcoTeamSizeDetails($opcoId, $year, $month);
		$data['eup'] = $this->report->getSingleOpcoEUPDetails($opcoId, $year, $month);
		$data['escalations'] = $this->report->getSingleOpcoEscalationsDetails($opcoId, $year, $month);
		$data['comments'] = $this->report->getSingleOpcoCommentsDetails($opcoId, $year, $month);
		$inc_select_items = "*,ROUND(((s1_sla_met_count+s2_sla_met_count+s3_sla_met_count+s4_sla_met_count)/(s1_incidents_count+s2_incidents_count+s3_incidents_count+s4_incidents_count)*100),2) as sla_met_perc,(s1_incidents_count+s2_incidents_count+s3_incidents_count+s4_incidents_count) as inc_count";
		$data['incidents_summary_data'] = $this->report->getTicketsSummaryData('incidents_summary', $inc_select_items, $opcoId, $lastThreeMonths);
		$sr_select_items = "*,ROUND(((s1_sr_sla_met_count+s2_sr_sla_met_count+s3_sr_sla_met_count+s4_sr_sla_met_count)/(s1_sr_count+s2_sr_count+s3_sr_count+s4_sr_count)*100),2) as sla_met_perc,(s1_sr_count+s2_sr_count+s3_sr_count+s4_sr_count) as sr_count";
		$data['sr_summary_data'] = $this->report->getTicketsSummaryData('service_request_summary', $sr_select_items, $opcoId, $lastThreeMonths);
		echo json_encode($data);
	}

	public function allOpcosReport()
	{
		$data = array();
		$this->load->view('reports/allOpcosReport', $data);
	}

	public function getAllOpcosReportData()
	{
		$all_opcos = $this->report->getAllOpcosDetails();
		$year = $_POST['year'];
		$month = $_POST['month'];
		$lastThreeMonths = $_POST['lastThreeYearsMonths'];
		$data = $this->getDashboardsData($year, $all_opcos);

		for ($i = 0; $i < sizeof($all_opcos); $i++) {
			$opcos_meta_data[] = $this->getSingleOpcoMetaData($all_opcos[$i]['id'], $year, $month, $lastThreeMonths);
		}

		$data['brs_digital_opcos'] = $this->report->getBillRunStatusDigitalOpcos($month, $year);
		$data['brs_legacy_mtn_opcos'] = $this->report->getBillRunStatusLegacyMTNlOpcos($month, $year);
		$data['brs_legacy_nonmtn_opcos'] = $this->report->getBillRunStatusLegacyNonMTNDigitalOpcos($month, $year);
		$data['opcos_meta_data'] = $opcos_meta_data;

		$data['report_summary'] = $this->report->getReportSummaryDetails($month, $year);
		$data['repeat_ticket_details'] = $this->report->getRepeatTicketDetails($month, $year);
		$data['incidents_summary_digital'] = $this->getIncidentSummaryData($month, $year, 'DIGITAL', 'inc_count');
		$data['incidents_summary_legacy'] = $this->getIncidentSummaryData($month, $year, 'LEGACY', 'inc_count');
		$data['sla_incidents_summary_digital'] = $this->getIncidentSummaryData($month, $year, 'DIGITAL', 'sla_met_perc');
		$data['sla_incidents_summary_legacy'] = $this->getIncidentSummaryData($month, $year, 'LEGACY', 'sla_met_perc');
		// echo "<pre>";print_r($data);die();
		echo json_encode($data);
	}

	public function getIncidentSummaryData($month, $year, $opco_type, $columnName)
	{
		$monthsArray = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
		$all_opcos = $this->report->getAllOpcosTypeBased($opco_type);
		$data = $this->report->getIncidentSummaryDetails($year, $opco_type);
		$temp = 0;
		// $dataSets[] = [];
		for ($i = 0; $i < sizeof($all_opcos); $i++) {
			for ($j = 0; $j < sizeof($monthsArray) && $j <= $month; $j++) {
				for ($k = 0; $k < sizeof($data); $k++) {
					if ($data[$k]['opcos_list_id'] == $all_opcos[$i]['id'] && $data[$k]['month_number'] == $monthsArray[$j]) {
						$temp = $data[$k][$columnName];
					}
				}
				$graphData[$j] = (float)$temp;
				$temp = 0;
			}
			$singleDataSet = array(
				'label' => $all_opcos[$i]['opco_name'],
				'data' => $graphData,
				'borderColor' => $all_opcos[$i]['color_code'],
				'fill' => false
			);
			$dataSets[] = $singleDataSet;
		}
		return $dataSets;
	}

	public function getBillRunStatusData($month, $year)
	{
		$data['brs_digital_opcos'] = $this->report->getBillRunStatusDigitalOpcos($month, $year);
		$data['brs_legacy_mtn_opcos'] = $this->report->getBillRunStatusLegacyMTNlOpcos($month, $year);
		$data['brs_legacy_nonmtn_opcos'] = $this->report->getBillRunStatusLegacyNonMTNDigitalOpcos($month, $year);
		return $data;
	}

	public function getDashboardsData($year, $all_opcos)
	{
		$automation_dashboard_data = $this->report->getDashboardsData('automation_dashboard_master obj', $year);
		$km_dashboard_data = $this->report->getDashboardsData('km_dashboard_master obj', $year);
		$oi_dashboard_data = $this->report->getDashboardsData('oi_dashboard_master obj', $year);
		$si_dashboard_data = $this->report->getDashboardsData('si_dashboard_master obj', $year);
		$monthsArray = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
		$temp = 0;
		for ($i = 0; $i < sizeof($all_opcos); $i++) {
			for ($j = 0; $j < sizeof($monthsArray); $j++) {
				for ($k = 0; $k < sizeof($automation_dashboard_data); $k++) {
					if ($automation_dashboard_data[$k]['opcos_list_id'] == $all_opcos[$i]['id'] && $automation_dashboard_data[$k]['month_number'] == $monthsArray[$j]) {
						$temp = $automation_dashboard_data[$k]['automation_count'];
					}
				}
				$automation_dashboard[$j] = $temp;
				$temp = 0;
				for ($k = 0; $k < sizeof($km_dashboard_data); $k++) {
					if ($km_dashboard_data[$k]['opcos_list_id'] == $all_opcos[$i]['id'] && $km_dashboard_data[$k]['month_number'] == $monthsArray[$j]) {
						$temp = $km_dashboard_data[$k]['km_count'];
					}
				}
				$km_dashboard[$j] = $temp;
				$temp = 0;
				for ($k = 0; $k < sizeof($oi_dashboard_data); $k++) {
					if ($oi_dashboard_data[$k]['opcos_list_id'] == $all_opcos[$i]['id'] && $oi_dashboard_data[$k]['month_number'] == $monthsArray[$j]) {
						$temp = $oi_dashboard_data[$k]['oi_count'];
					}
				}
				$oi_dashboard[$j] = $temp;
				$temp = 0;
				for ($k = 0; $k < sizeof($si_dashboard_data); $k++) {
					if ($si_dashboard_data[$k]['opcos_list_id'] == $all_opcos[$i]['id'] && $si_dashboard_data[$k]['month_number'] == $monthsArray[$j]) {
						$temp = $si_dashboard_data[$k]['si_count'];
					}
				}
				$si_dashboard[$j] = $temp;
				$temp = 0;
			}
			$automation_dashboard_final[$i] = array(
				'opco_name' => $all_opcos[$i]['opco_shortname'],
				'counts' => $automation_dashboard
			);
			$km_dashboard_final[$i] = array(
				'opco_name' => $all_opcos[$i]['opco_shortname'],
				'counts' => $km_dashboard
			);
			$oi_dashboard_final[$i] = array(
				'opco_name' => $all_opcos[$i]['opco_shortname'],
				'counts' => $oi_dashboard
			);
			$si_dashboard_final[$i] = array(
				'opco_name' => $all_opcos[$i]['opco_shortname'],
				'counts' => $si_dashboard
			);
		}
		$data['automation_dashboard_data'] = $automation_dashboard_final;
		$data['km_dashboard_data'] = $km_dashboard_final;
		$data['oi_dashboard_data'] = $oi_dashboard_final;
		$data['si_dashboard_data'] = $si_dashboard_final;
		return $data;
	}


	public function getSingleOpcoMetaData($opcoId, $year, $month, $lastThreeMonths)
	{
		$data['opco_details'] = $this->ind_model->getSingleOpcoDetails($opcoId);
		$data['team_size'] = $this->report->getSingleOpcoTeamSizeDetails($opcoId, $year, $month);
		$data['eup'] = $this->report->getSingleOpcoEUPDetails($opcoId, $year, $month);
		$data['escalations'] = $this->report->getSingleOpcoEscalationsDetails($opcoId, $year, $month);
		$data['comments'] = $this->report->getSingleOpcoCommentsDetails($opcoId, $year, $month);
		$inc_select_items = "*,ROUND(((s1_sla_met_count+s2_sla_met_count+s3_sla_met_count+s4_sla_met_count)/(s1_incidents_count+s2_incidents_count+s3_incidents_count+s4_incidents_count)*100),2) as sla_met_perc,(s1_incidents_count+s2_incidents_count+s3_incidents_count+s4_incidents_count) as inc_count";
		$data['incidents_summary_data'] = $this->report->getTicketsSummaryData('incidents_summary', $inc_select_items, $opcoId, $lastThreeMonths);
		$sr_select_items = "*,ROUND(((s1_sr_sla_met_count+s2_sr_sla_met_count+s3_sr_sla_met_count+s4_sr_sla_met_count)/(s1_sr_count+s2_sr_count+s3_sr_count+s4_sr_count)*100),2) as sla_met_perc,(s1_sr_count+s2_sr_count+s3_sr_count+s4_sr_count) as sr_count";
		$data['sr_summary_data'] = $this->report->getTicketsSummaryData('service_request_summary', $sr_select_items, $opcoId, $lastThreeMonths);
		return $data;
	}

	public function captureImage()
	{
		$uniqueId = $_POST['uniqueId'];

		if (!is_dir('././assets/images/' . $uniqueId)) {
			mkdir('././assets/images/' . $uniqueId, 0777, TRUE);
		}
		$image = $_POST["image"];
		$name = $_POST['name'];

		// Remove image/jpeg from left side of image data
		// and get the remaining part
		$image = explode(";", $image)[1];

		// Remove base64 from left side of image data
		// and get the remaining part
		$image = explode(",", $image)[1];

		// Replace all spaces with plus sign (helpful for larger images)
		$image = str_replace(" ", "+", $image);

		// Convert back from base64
		$image = base64_decode($image);

		// Save the image as filename.jpeg
		file_put_contents("assets/images/" . $uniqueId . "/" . $name . ".jpeg", $image);

		// Sending response back to client
		echo base_url();
	}
}
