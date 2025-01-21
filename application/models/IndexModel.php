<?php


if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class IndexModel extends CI_Model
{


	public function getOpcoDetails()
	{
		$this->db->select('*');
		$this->db->from('opcos_list');
		$this->db->where('id <', 500);
		return $this->db->get()->result();
	}


	public function autoDBdeleteData()
	{
		//DB refers to dashboard in autoDBdelete and auto refers to automation.
		$this->db->query('DELETE FROM automation_dashboard_master WHERE year = 2023');
	}

	public function getIncidentsCount()
	{
		$this->db->select('*');
		$this->db->from('incidents_summary inc');
		$this->db->join('opcos_list ol','ol.id=inc.opcos_list_id');
		$this->db->where('inc.year',$_POST['year']);

		// $this->db->select('*');
		// $this->db->from('incidents_summary inc');
		// $this->db->join('opcos_list ol', 'ol.id=inc.opcos_list_id');
		// $this->db->where('inc.year',$_POST['year']);
		// $this->db->join('service_request_summary sr', 'sr.opcos_list_id = inc.opcos_list_id AND sr.year = inc.year', 'left');
		
		return $this->db->get()->result_array();
		// console.log(result_array);
	}

	public function submitData()
	{

		// $opcos_list_id = $_POST['opco_name'];
		// $month_number = $_POST['month'];
		// $year = $_POST['year'];

		$incident_count_by_group = array(
			'opcos_list_id' => $_POST['opco_name'],
			'month_number' => $_POST['month'],
			'year' => $_POST['year'],
			'Service_desk' => $_POST['inc_Service_desk'],
			'L1_MSO_count' => $_POST['inc_L1_MSO_count'],
			'L2_count' => $_POST['inc_L2_count'],
			'L3_count' => $_POST['inc_L3_count'],
			'L4_count' => $_POST['inc_L4_count']
		);

		// $this->db->where('opcos_list_id', $opcos_list_id);
		// $this->db->where('year', $year);
		// $this->db->where('month_number', $month_number);
		// $query = $this->db->get('incident_count_by_group');

		// if ($query->num_rows() > 0) {
		// 	$this->db->where('opcos_list_id', $opcos_list_id);
		// 	$this->db->set($incident_count_by_group);
		// 	$this->db->update('incident_count_by_group');
		// } else {

			$this->db->insert('incident_count_by_group', $incident_count_by_group);
		// }


		$workorder_count_by_group = array(
			'opcos_list_id' => $_POST['opco_name'],
			'month_number' => $_POST['month'],
			'year' => $_POST['year'],
			'Service_desk' => $_POST['Service_desk'],
			'L1_MSO_count' => $_POST['L1_MSO_count'],
			'L2_count' => $_POST['L2_count'],
			'L3_count' => $_POST['L3_count'],
			'L4_count' => $_POST['L4_count']
		);

		// $this->db->where('opcos_list_id', $opcos_list_id);
		// $this->db->where('year', $year);
		// $this->db->where('month_number', $month_number);
		// $query = $this->db->get('workorder_count_by_group');

		// if ($query->num_rows() > 0) {
		// 	$this->db->where('opcos_list_id', $opcos_list_id);
		// 	$this->db->set($workorder_count_by_group);
		// 	$this->db->update('workorder_count_by_group');
		// } else {

			$this->db->insert('workorder_count_by_group', $workorder_count_by_group);
		// }

		$data_incidents_summary = array(
			'opcos_list_id' => $_POST['opco_name'],
			'month_number' => $_POST['month'],
			'year' => $_POST['year'],
			's1_incidents_count' => $_POST['s1_inc_count'],
			's1_sla_met_count' => $_POST['s1_inc_sla_met_count'],
			's2_incidents_count' => $_POST['s2_inc_count'],
			's2_sla_met_count' => $_POST['s2_inc_sla_met_count'],
			's3_incidents_count' => $_POST['s3_inc_count'],
			's3_sla_met_count' => $_POST['s3_inc_sla_met_count'],
			's4_incidents_count' => $_POST['s4_inc_count'],
			's4_sla_met_count' => $_POST['s4_inc_sla_met_count'],
			'summary_key_findings' => '',
			'sla_key_findings' => '',
			'mean_time_to_resolve' => $_POST['mttr']
		);

		// $this->db->where('opcos_list_id', $opcos_list_id);
		// $this->db->where('year', $year);
		// $this->db->where('month_number', $month_number);
		// $query = $this->db->get('incidents_summary');

		// if ($query->num_rows() > 0) {
		// 	$this->db->where('opcos_list_id', $opcos_list_id);
		// 	$this->db->where('year', $year);
		// 	$this->db->where('month_number', $month_number);
		// 	$this->db->set($data_incidents_summary);
		// 	$this->db->update('incidents_summary');
		// } else {

			$this->db->insert('incidents_summary', $data_incidents_summary);
		// }

		$data_service_request_summary = array(
			'opcos_list_id' => $_POST['opco_name'],
			'month_number' => $_POST['month'],
			'year' => $_POST['year'],
			's1_sr_count' => $_POST['s1_sr_count'],
			's1_sr_sla_met_count' => $_POST['s1_sr_sla_met_count'],
			's2_sr_count' => $_POST['s2_sr_count'],
			's2_sr_sla_met_count' => $_POST['s2_sr_sla_met_count'],
			's3_sr_count' => $_POST['s3_sr_count'],
			's3_sr_sla_met_count' => $_POST['s3_sr_sla_met_count'],
			's4_sr_count' => $_POST['s4_sr_count'],
			's4_sr_sla_met_count' => $_POST['s4_sr_sla_met_count'],
			'summary_key_findings' => '',
			'sla_key_findings' => '',
			'mean_time_to_fulfill' => $_POST['mttf']
		);

		// $this->db->where('opcos_list_id', $opcos_list_id);
		// $this->db->where('year', $year);
		// $this->db->where('month_number', $month_number);
		// $query = $this->db->get('service_request_summary');

		// if ($query->num_rows() > 0) {
		// 	$this->db->where('opcos_list_id', $opcos_list_id);
		// 	$this->db->where('year', $year);
		// 	$this->db->where('month_number', $month_number);
		// 	$this->db->set($data_service_request_summary);
		// 	$this->db->update('service_request_summary');
		// } else {
// // }


		$this->db->insert('service_request_summary', $data_service_request_summary);
		


		// for ($i = 0; $i < sizeof($_POST['repeat_case_item']); $i++) {
		// 	$data_repeat_ticket_details[] = array(
		// 		'opcos_list_id' => $_POST['opco_name'],
		// 		'month_number' => $_POST['month'],
		// 		'year' => $_POST['year'],
		// 		'incident_name' => $_POST['repeat_case_item'][$i],
		// 		'incident_desc' => $_POST['repeat_case_desc'][$i],
		// 		'incident_resolution' => $_POST['repeat_case_resolution'][$i]
		// 	);
		// }


		// $this->db->insert_batch('repeat_ticket_details', $data_repeat_ticket_details);

		// for ($i = 0; $i < sizeof($_POST['report_summary_type']); $i++) {
		// 	$data_report_summary[] = array(
		// 		'month_number' => $_POST['month'],
		// 		'year' => $_POST['year'],
		// 		'summary_type' => $_POST['report_summary_type'][$i],
		// 		'summary_desc' => $_POST['report_summary_desc'][$i]
		// 	);
		// }





		// $this->db->insert_batch('report_summary', $data_report_summary);

		$data_incidents_reason = array(
			'opcos_list_id' => $_POST['opco_name'],
			'month_number' => $_POST['month'],
			'year' => $_POST['year'],
			'app_issue_count' => $_POST['inc_app_issue_count'],
			'fun_issue_count' => $_POST['inc_fun_issue_count'],
			'data_issue_count' => $_POST['inc_data_issue_count'],
			'plat_issue_count' => $_POST['inc_plat_issue_count'],
			'NFR_issue_count' => $_POST['inc_NFR_issue_count'],
			'tec_issue_count' => $_POST['inc_tec_issue_count'],
			'3pp_issue_count' => $_POST['inc_3pp_issue_count'],
			'clar_issue_count' => $_POST['inc_clar_issue_count'],
			'no_fcr_count' => $_POST['inc_no_fcr_count'],
			'process_gap_count' => $_POST['inc_process_gap_count'],
			'know_gap_count' => $_POST['inc_know_gap_count']
		);

		// $this->db->where('opcos_list_id', $opcos_list_id);
		// $this->db->where('year', $year);
		// $this->db->where('month_number', $month_number);
		// $query = $this->db->get('incidents_reason');

		// if ($query->num_rows() > 0) {
		// 	$this->db->where('opcos_list_id', $opcos_list_id);
		// 	$this->db->where('year', $year);
		// 	$this->db->where('month_number', $month_number);
		// 	$this->db->set($data_incidents_reason);
		// 	$this->db->update('incidents_reason');
		// } else {
	// }
			$this->db->insert('incidents_reason', $data_incidents_reason);
	

		$data_work_order_summary = array(
			'opcos_list_id' => $_POST['opco_name'],
			'month_number' => $_POST['month'],
			'year' => $_POST['year'],
			'app_issue_count' => $_POST['app_issue_count'],
			'fun_issue_count' => $_POST['fun_issue_count'],
			'data_issue_count' => $_POST['data_issue_count'],
			'plat_issue_count' => $_POST['plat_issue_count'],
			'NFR_issue_count' => $_POST['NFR_issue_count'],
			'tec_issue_count' => $_POST['tec_issue_count'],
			'3pp_issue_count' => $_POST['3pp_issue_count'],
			'clar_issue_count' => $_POST['clar_issue_count'],
			'no_fcr_count' => $_POST['no_fcr_count'],
			'process_gap_count' => $_POST['process_gap_count'],
			'know_gap_count' => $_POST['know_gap_count'],
			'service_request_count' => $_POST['service_request_count']
		);

		// $this->db->where('opcos_list_id', $opcos_list_id);
		// $this->db->where('year', $year);
		// $this->db->where('month_number', $month_number);
		// $query = $this->db->get('work_order_summary');

		// if ($query->num_rows() > 0) {
		// 	$this->db->where('opcos_list_id', $opcos_list_id);
		// 	$this->db->where('year', $year);
		// 	$this->db->where('month_number', $month_number);
		// 	$this->db->set($data_work_order_summary);
		// 	$this->db->update('work_order_summary');
		// } else {
// }
			$this->db->insert('work_order_summary', $data_work_order_summary);
		


		$incidents_outage = array(
			'opcos_list_id' => $_POST['opco_name'],
			'month_number' => $_POST['month'],
			'year' => $_POST['year'],
			'date_of_outage' => date("Y-m-d", strtotime($_POST['outage-date'])), //outage-date
			'duration' => $_POST['outage-duration'],
			'description' => $_POST['outage-description'],
			'cause' => $_POST['outage-cause'],
			'resolution' => $_POST['outage-resolution']
		);

		// $this->db->where('opcos_list_id', $opcos_list_id);
		// $this->db->where('year', $year);
		// $this->db->where('month_number', $month_number);
		// $query = $this->db->get('incidents_outages');

		// if ($query->num_rows() > 0) {
		// 	$this->db->where('opcos_list_id', $opcos_list_id);
		// 	$this->db->where('year', $year);
		// 	$this->db->where('month_number', $month_number);
		// 	$this->db->set($incidents_outage);
		// 	$this->db->update('incidents_outages');
		// } else {
			$this->db->insert('incidents_outages', $incidents_outage);
// }
		// 	
		

		// $this->db->insert_batch('buiseness_kpi_dashboard', $data_buiseness_kpi_dashboard);

		#Automation Dashboard
		// $data_automation_dashboard_master = array(
		// 	'opcos_list_id' => $_POST['opco_name'],
		// 	'month_number' => $_POST['month'],
		// 	'year' => $_POST['year'],
		// 	'automation_count' => $_POST['automation_count']
		// );

		// $this->db->insert('automation_dashboard_master', $data_automation_dashboard_master);
		// $insert_id = $this->db->insert_id();
		// for ($i = 0; $i < sizeof($_POST['automations_name']); $i++) {
		// 	$data_automation_dashboard_child[] = array(
		// 		'automation_dashboard_id' => $insert_id,
		// 		'automation_name' => $_POST['automations_name'][$i],
		// 		'automation_desc' => $_POST['automations_desc'][$i]
		// 	);
		// }
		// $this->db->insert_batch('automation_dashboard_child', $data_automation_dashboard_child);

		#OI Dashboard
		// $data_oi_dashboard_master = array(
		// 	'opcos_list_id' => $_POST['opco_name'],
		// 	'month_number' => $_POST['month'],
		// 	'year' => $_POST['year'],
		// 	'oi_count' => $_POST['oi_count']
		// );
		// $this->db->insert('oi_dashboard_master', $data_oi_dashboard_master);
		// $insert_id = $this->db->insert_id();
		// for ($i = 0; $i < sizeof($_POST['oi_name']); $i++) {
		// 	$data_oi_dashboard_child[] = array(
		// 		'oi_dashboard_id' => $insert_id,
		// 		'oi_name' => $_POST['oi_name'][$i],
		// 		'oi_desc' => $_POST['oi_desc'][$i]
		// 	);
		// }
		// $this->db->insert_batch('oi_dashboard_child', $data_oi_dashboard_child);

		#SI Dashboard
		// $data_si_dashboard_master = array(
		// 	'opcos_list_id' => $_POST['opco_name'],
		// 	'month_number' => $_POST['month'],
		// 	'year' => $_POST['year'],
		// 	'si_count' => $_POST['si_count']
		// );
		// $this->db->insert('si_dashboard_master', $data_si_dashboard_master);
		// $insert_id = $this->db->insert_id();
		// for ($i = 0; $i < sizeof($_POST['si_name']); $i++) {
		// 	$data_si_dashboard_child[] = array(
		// 		'si_dashboard_id' => $insert_id,
		// 		'si_name' => $_POST['si_name'][$i],
		// 		'si_desc' => $_POST['si_desc'][$i]
		// 	);
		// }
		// $this->db->insert_batch('si_dashboard_child', $data_si_dashboard_child);

		#KM Dashboard
		// $data_km_dashboard_master = array(
		// 	'opcos_list_id' => $_POST['opco_name'],
		// 	'month_number' => $_POST['month'],
		// 	'year' => $_POST['year'],
		// 	'km_count' => $_POST['km_count']
		// );
		// $this->db->insert('km_dashboard_master', $data_km_dashboard_master);
		// $insert_id = $this->db->insert_id();
		// for ($i = 0; $i < sizeof($_POST['km_name']); $i++) {
		// 	$data_km_dashboard_child[] = array(
		// 		'km_dashboard_id' => $insert_id,
		// 		'km_name' => $_POST['km_name'][$i],
		// 		'km_desc' => $_POST['km_desc'][$i]
		// 	);
		// }
		// $this->db->insert_batch('km_dashboard_child', $data_km_dashboard_child);

		#Bill Run Status
		for ($i = 0; $i < sizeof($_POST['main_bill_cycle_period']); $i++) {
			$data_bill_run_status[] = array(
				'opcos_list_id' => $_POST['opco_name'],
				'month_number' => $_POST['month'],
				'year' => $_POST['year'],
				'main_bill_cycle_period' => $_POST['main_bill_cycle_period'][$i],
				'main_bill_start_date' => date("Y-m-d", strtotime($_POST['startDate'][$i])),
				'main_bill_completion_date' => date("Y-m-d", strtotime($_POST['endDate'][$i])),
				'current_status' => $_POST['current_status'][$i],
				'accounts_billed_count' => $_POST['account_billed_count'][$i],
				'service_billed_count' => $_POST['service_billed_count'][$i],
				'processing_time' => $_POST['pthrs'][$i] . ":" . $_POST['ptmins'][$i] . ":" . $_POST['ptsecs'][$i],
				'invoice_verifcation_time' => $_POST['ivthrs'][$i] . ":" . $_POST['ivtmins'][$i] . ":" . $_POST['ivtsecs'][$i],
				'total_time' => $_POST['tthrs'][$i] . ":" . $_POST['ttmins'][$i] . ":" . $_POST['ttmins'][$i]
			);
		}

		// $this->db->where('opcos_list_id', $opcos_list_id);
		// $this->db->where('year', $year);
		// $this->db->where('month_number', $month_number);
		// $query = $this->db->get('bill_run_status');

		// if ($query->num_rows() > 0) {
		// 	$this->db->where('opcos_list_id', $opcos_list_id);
		// 	$this->db->where('year', $year);
		// 	$this->db->where('month_number', $month_number);
		// 	$this->db->set($data_bill_run_status);
		// 	$this->db->update('bill_run_status');
		// } else {

			return $this->db->insert_batch('bill_run_status', $data_bill_run_status);
		// }
	}

	public function submitAdditionalData()
	{

		$data_team_size = array(
			'opcos_list_id' => $_POST['opco_name'],
			'month_number' => $_POST['month'],
			'year' => $_POST['year'],
			'onsite_local_count' => $_POST['onsite_local_count'],
			'onsite_expat_count' => $_POST['onsite_expat_count'],
			'offshore_local_count' => $_POST['offshore_local_count'],
			'offshore_expat_count' => $_POST['offshore_expat_count']
		);
		$this->db->insert('team_size', $data_team_size);

		$data_eup = array(
			'opcos_list_id' => $_POST['opco_name'],
			'month_number' => $_POST['month'],
			'year' => $_POST['year'],
			'overall_health' => $_POST['overall_health'],
			'pms_efforts' => $_POST['efforts'],
			'utilization_perc' => $_POST['utilization'],
			'profitability_count' => $_POST['profitability']
		);
		$this->db->insert('eup_details', $data_eup);

		for ($i = 0; $i < sizeof($_POST['ongoing_escalations_status']); $i++) {
			$escalations_data[] = array(
				'opcos_list_id' => $_POST['opco_name'],
				'month_number' => $_POST['month'],
				'year' => $_POST['year'],
				'escalation_value' => $_POST['ongoing_escalations_details'][$i],
				'escalation_details' => $_POST['ongoing_escalations_desc'][$i],
				'escalation_status' => $_POST['ongoing_escalations_status'][$i]
			);
		}
		$this->db->insert_batch('ongoing_escalations', $escalations_data);

		for ($i = 0; $i < sizeof($_POST['id_ch_co_type']); $i++) {
			$comments_data[] = array(
				'opcos_list_id' => $_POST['opco_name'],
				'month_number' => $_POST['month'],
				'year' => $_POST['year'],
				'description_type' => $_POST['id_ch_co_type'][$i],
				'description' => $_POST['id_ch_co_desc'][$i]
			);
		}
		return $this->db->insert_batch('comments_details', $comments_data);
	}

	public function getIncidentsTicketsCount($year)
	{
		$this->db->select('sum(s1_incidents_count) as s1_inc_count ,sum(s2_incidents_count) as s2_inc_count,sum(s3_incidents_count) as s3_inc_count,sum(s4_incidents_count) as s4_inc_count');
		$this->db->from('incidents_summary');
		$this->db->where('year', $year);
		return $this->db->get()->row();
	}

	public function getBillCyclePeriods()
	{
		$this->db->select('*');
		$this->db->from('bill_cycle_period');
		$this->db->where('opcos_list_id', $_POST['opco']);
		return $this->db->get()->result();
	}

	public function getSingleOpcoDetails($opco_id)
	{
		$this->db->select('*');
		$this->db->from('opcos_list');
		$this->db->where('id', $opco_id);
		return $this->db->get()->result();
	}

	public function getDashboardsGraphsData($columnName, $table)
	{
		$select = "month_number, SUM(" . $columnName . ") AS total_count";
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where('year', $_POST['year']);
		$this->db->group_by('month_number');
		$this->db->order_by('month_number');
		return $this->db->get()->result_array();
	}

	public function getIncidentSummaryTableData()
	{
		$this->db->select('*');
		$this->db->from('incidents_summary');
		$this->db->where('opcos_list_id', $_POST['opco']);
		$this->db->where('year', $_POST['year']);
		$this->db->where('month_number', $_POST['month']);
		return $this->db->get()->row();
	}

	public function getServiceRequestSummaryTableData()
	{
		$this->db->select('*');
		$this->db->from('service_request_summary');
		$this->db->where('opcos_list_id', $_POST['opco']);
		$this->db->where('year', $_POST['year']);
		$this->db->where('month_number', $_POST['month']);
		return $this->db->get()->row();
	}

	public function getrepeatTicketDetailsTableData()
	{
		$this->db->select('*');
		$this->db->from('repeat_ticket_details');
		$this->db->where('opcos_list_id', $_POST['opco']);
		$this->db->where('year', $_POST['year']);
		$this->db->where('month_number', $_POST['month']);
		return $this->db->get()->result_array();
	}

	public function getReportSummaryTableData()
	{
		$this->db->select('*');
		$this->db->from('report_summary');
		$this->db->where('year', $_POST['year']);
		$this->db->where('month_number', $_POST['month']);
		return $this->db->get()->result_array();
	}

	public function getAutomationDashboardTableData()
	{
		$this->db->select('*');
		$this->db->from('automation_dashboard_master adm');
		$this->db->join('automation_dashboard_child adc', 'adc.automation_dashboard_id = adm.id');
		$this->db->where('adm.opcos_list_id', $_POST['opco']);
		$this->db->where('adm.year', $_POST['year']);
		$this->db->where('adm.month_number', $_POST['month']);
		return $this->db->get()->result_array();
	}

	public function getKMDashboardTableData()
	{
		$this->db->select('*');
		$this->db->from('km_dashboard_master adm');
		$this->db->join('km_dashboard_child adc', 'adc.km_dashboard_id = adm.id');
		$this->db->where('adm.opcos_list_id', $_POST['opco']);
		$this->db->where('adm.year', $_POST['year']);
		$this->db->where('adm.month_number', $_POST['month']);
		return $this->db->get()->result_array();
	}

	public function getSIDashboardTableData()
	{
		$this->db->select('*');
		$this->db->from('si_dashboard_master adm');
		$this->db->join('si_dashboard_child adc', 'adc.si_dashboard_id = adm.id');
		$this->db->where('adm.opcos_list_id', $_POST['opco']);
		$this->db->where('adm.year', $_POST['year']);
		$this->db->where('adm.month_number', $_POST['month']);
		return $this->db->get()->result_array();
	}

	public function getOIDashboardTableData()
	{
		$this->db->select('*');
		$this->db->from('oi_dashboard_master adm');
		$this->db->join('oi_dashboard_child adc', 'adc.oi_dashboard_id = adm.id');
		$this->db->where('adm.opcos_list_id', $_POST['opco']);
		$this->db->where('adm.year', $_POST['year']);
		$this->db->where('adm.month_number', $_POST['month']);
		return $this->db->get()->result_array();
	}

	public function getKPIDashboardTableData()
	{
		$this->db->select('*');
		$this->db->from('buiseness_kpi_dashboard');
		$this->db->where('opcos_list_id', $_POST['opco']);
		$this->db->where('year', $_POST['year']);
		$this->db->where('month_number', $_POST['month']);
		return $this->db->get()->result_array();
	}

	public function getIncResolvedByGroupTableData()
	{
		$this->db->select('*');
		$this->db->from('incident_count_by_group');
		$this->db->where('opcos_list_id', $_POST['opco']);
		$this->db->where('year', $_POST['year']);
		$this->db->where('month_number', $_POST['month']);
		return $this->db->get()->result_array();
	}

	public function getWoResolvedByGroupTableData()
	{
		$this->db->select('*');
		$this->db->from('workorder_count_by_group');
		$this->db->where('opcos_list_id', $_POST['opco']);
		$this->db->where('year', $_POST['year']);
		$this->db->where('month_number', $_POST['month']);
		return $this->db->get()->result_array();
	}

	public function getincidentReasonTableData()
	{
		$this->db->select('*');
		$this->db->from('incidents_reason');
		$this->db->where('opcos_list_id', $_POST['opco']);
		$this->db->where('year', $_POST['year']);
		$this->db->where('month_number', $_POST['month']);
		return $this->db->get()->result_array();
	}

	public function getWorkorderSummaryTableData()
	{
		$this->db->select('*');
		$this->db->from('work_order_summary');
		$this->db->where('opcos_list_id', $_POST['opco']);
		$this->db->where('year', $_POST['year']);
		$this->db->where('month_number', $_POST['month']);
		return $this->db->get()->result_array();
	}

	public function insertNewOpcoData()
	{
		$data = array(
			'opco_name' => $_POST['new_opco_name'],
			'opco_shortname' => $_POST['new_opco_shortName'],
			'opco_code' => $_POST['new_opco_code'],
			'opco_type' => $_POST['new_opco_type'],
			'opco_contract_type' => $_POST['new_opco_contractType'],
			'region' => $_POST['new_opco_region'],
			'opco_group' => $_POST['new_opco_group']
		);
		$this->db->insert('opcos_list', $data);
		$insert_id = $this->db->insert_id();

		$data2 = array(
			'opcos_list_id' => $insert_id,
			'main_bill_cycle_period' => $_POST['new_opco_bcp']
		);
		$this->db->insert('bill_cycle_period', $data2);
	}

	// public function removeopco($opco){
	// 	$data =array(
	// 		$this->db->where('opcos_list_id', $opco),
	// 			$this->db->set($incident_count_by_group),
	// 			$this->db->update('incident_count_by_group')
	// 	);
	// }

	public function insertNewUserData()
	{
		$data = array(
			'emp_id' => $_POST['new_empid'],
			'first_name' => $_POST['new_user_firstname'],
			'last_name' => $_POST['new_user_lastname'],
			'email' => $_POST['new_user_email'],
			'designation' => $_POST['new_user_designation'],
			'manager' => $_POST['new_user_manager'],
			'user_role' => $_POST['new_user_role'],
			'user_password' => 'password',
			'nova_id' => $_POST['new_user_nova'],
			'opco_name' => $_POST['new_user_OpCo'],
			'read_permission' => $_POST['read_permission'],
			'write_permission' => $_POST['write_permission'],
		);
		$this->db->insert('user_details', $data);
		$insert_id = $this->db->insert_id();
	}

	public function get_user_details()
	{
		$query = $this->db->get('user_details');
		return $query->result_array();
	}

	public function search_user_details($search_query)
	{
		$this->db->like('first_name', $search_query); // Modify 'full_name' to the appropriate column in your 'user_details' table
		$query = $this->db->get('user_details');
		return $query->result_array();
	}

	public function getAllUsers()
	{
		$query = $this->db->get('user_details');
		return $query->result_array();
	}
}
