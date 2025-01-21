<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class IndexController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->check_login(); // check if the user is logged in
		$this->load->model('IndexModel', 'ind_model');
		$this->load->model('ReportsModel', 'report');
		$this->load->library('form_validation');
	}

	private function check_login()
	{
		if (!isset($_SESSION['login'])) {
			redirect('login');
		}
	}

	public function allopcooutages()
	{
		// $opco_type = $this->input->post('opco');
		$selected_month = $this->input->post('month') ? $this->input->post('month') : date('n');
		// $selected_year = $this->input->post('year') ? $this->input->post('year') : date('Y');
		//Outages
		$query1 = $this->db->query("SELECT opcos_list.opco_name, month_number AS month, sum(description) AS count FROM incidents_outages join opcos_list ON opcos_list.id = incidents_outages.opcos_list_id WHERE date_of_outage >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) GROUP BY month_number, opcos_list.opco_name HAVING count > 0 ORDER BY opcos_list.opco_name, month_number");

		//incidents_summary_OWl
		$query21 = $this->db->query("SELECT o.opco_shortname, 
		i.month_number AS month,
		SUM(i.s1_incidents_count + i.s2_incidents_count + i.s3_incidents_count + i.s4_incidents_count) AS count 
 FROM incidents_summary i 
 JOIN opcos_list o ON o.id = i.opcos_list_id 
 WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m') 
   AND opco_type = 'LEGACY'
 GROUP BY o.opco_shortname, i.month_number HAVING count > 0
 ORDER BY o.opco_shortname, i.month_number");

		//incidents_summary_OWD
		$query22 = $this->db->query("SELECT o.opco_shortname, 
		i.month_number AS month, 
		SUM(i.s1_incidents_count + i.s2_incidents_count + i.s3_incidents_count + i.s4_incidents_count) AS count 
		FROM incidents_summary i 
		JOIN opcos_list o ON o.id = i.opcos_list_id 
		WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  
   AND opco_type = 'DIGITAL'
		GROUP BY o.opco_shortname, i.month_number, i.s1_incidents_count, i.s2_incidents_count, i.s3_incidents_count, i.s4_incidents_count HAVING count > 0
		ORDER BY o.opco_shortname, i.month_number");

		//incidents_summary_SWL
		$query31 = $this->db->query("SELECT  
i.month_number AS month,
'S1' AS Severity,
SUM(s1_incidents_count) AS count 
FROM 
incidents_summary i 
JOIN opcos_list o ON o.id = i.opcos_list_id 
WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m') AND opco_type = 'LEGACY'
GROUP BY 
i.month_number HAVING count > 0



UNION ALL



SELECT  
i.month_number AS month,
'S2' AS Severity,
SUM(s2_incidents_count) AS count 
FROM 
incidents_summary i 
JOIN opcos_list o ON o.id = i.opcos_list_id 
WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND opco_type = 'LEGACY'
GROUP BY 
i.month_number HAVING count > 0



UNION ALL



SELECT  
i.month_number AS month,
'S3' AS Severity,
SUM(s3_incidents_count) AS count 
FROM 
incidents_summary i 
JOIN opcos_list o ON o.id = i.opcos_list_id 
WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND opco_type = 'LEGACY'
GROUP BY 
i.month_number HAVING count > 0



UNION ALL



SELECT  
i.month_number AS month,
'S4' AS Severity,
SUM(s4_incidents_count) AS count 
FROM 
incidents_summary i 
JOIN opcos_list o ON o.id = i.opcos_list_id 
WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND opco_type = 'LEGACY'
GROUP BY  
i.month_number HAVING count > 0
ORDER BY 
month, Severity");

		// incidents_summary_SWD 
		$query32 = $this->db->query("SELECT  
		i.month_number AS month,
		'S1' AS Severity,
		SUM(s1_incidents_count) AS count 
		FROM 
		incidents_summary i 
		JOIN opcos_list o ON o.id = i.opcos_list_id 
		WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND opco_type = 'DIGITAL'
		GROUP BY 
		i.month_number HAVING count > 0
		
		
		
		UNION ALL
		
		
		
		SELECT  
		i.month_number AS month,
		'S2' AS Severity,
		SUM(s2_incidents_count) AS count 
		FROM 
		incidents_summary i 
		JOIN opcos_list o ON o.id = i.opcos_list_id 
		WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND opco_type = 'DIGITAL'
		GROUP BY 
		i.month_number HAVING count > 0
		
		
		
		UNION ALL
		
		
		
		SELECT  
		i.month_number AS month,
		'S3' AS Severity,
		SUM(s3_incidents_count) AS count 
		FROM 
		incidents_summary i 
		JOIN opcos_list o ON o.id = i.opcos_list_id 
		WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND opco_type = 'DIGITAL'
		GROUP BY 
		i.month_number HAVING count > 0
		
		
		
		UNION ALL
		
		
		
		SELECT  
		i.month_number AS month,
		'S4' AS Severity,
		SUM(s4_incidents_count) AS count 
		FROM 
		incidents_summary i 
		JOIN opcos_list o ON o.id = i.opcos_list_id 
		WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND opco_type = 'DIGITAL'
		GROUP BY 
		i.month_number HAVING count > 0
		ORDER BY 
		month, Severity");

		// incidents_sla_met_LEGACY 
		$query41 = $this->db->query("SELECT 
o.opco_shortname, 
i.month_number as month, 
SUM(i.s1_sla_met_count + i.s2_sla_met_count + i.s3_sla_met_count + i.s4_sla_met_count) / 
SUM(i.s1_incidents_count + i.s2_incidents_count + i.s3_incidents_count + i.s4_incidents_count) * 100 as count 
FROM 
opcos_list o 
INNER JOIN 
incidents_summary i ON o.id = i.opcos_list_id 
WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND opco_type = 'LEGACY'
GROUP BY o.opco_shortname, i.month_number HAVING count > 0
ORDER BY o.opco_shortname, i.month_number");

		// incidents_sla_met_DIGITAL
		$query42 = $this->db->query("SELECT 
		o.opco_shortname, 
		i.month_number as month, 
		SUM(i.s1_sla_met_count + i.s2_sla_met_count + i.s3_sla_met_count + i.s4_sla_met_count) / 
		SUM(i.s1_incidents_count + i.s2_incidents_count + i.s3_incidents_count + i.s4_incidents_count) * 100 as count 
		FROM 
		opcos_list o 
		INNER JOIN 
		incidents_summary i ON o.id = i.opcos_list_id 
		WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND opco_type = 'DIGITAL'
		GROUP BY o.opco_shortname, i.month_number HAVING count > 0
		ORDER BY o.opco_shortname, i.month_number");


		//Accounts_Billed_legacy
		$query51 = $this->db->query("select o.opco_shortname, b.month_number as month,b.accounts_billed_count count FROM 
		opcos_list o 
		INNER JOIN  
        bill_run_status b ON o.id = b.opcos_list_id 
         WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   		AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND opco_type = 'LEGACY'
		ORDER BY o.opco_shortname, b.month_number");


		//Accounts_Billed_digital
		$query52 = $this->db->query("select o.opco_shortname, b.month_number as month,b.accounts_billed_count count FROM 
		opcos_list o 
		INNER JOIN  
        bill_run_status b ON o.id = b.opcos_list_id 
         WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   		AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND opco_type = 'DIGITAL'
		ORDER BY o.opco_shortname, b.month_number");

		//Services_Billed_legacy
		$query61 = $this->db->query("select o.opco_shortname, b.month_number as month,b.service_billed_count count FROM 
		opcos_list o 
		INNER JOIN  
        bill_run_status b ON o.id = b.opcos_list_id 
         WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   		AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND opco_type = 'LEGACY'
		ORDER BY o.opco_shortname, b.month_number");

		//Services_Billed_Digital
		$query62 = $this->db->query("select o.opco_shortname, b.month_number as month,b.service_billed_count count FROM 
		opcos_list o 
		INNER JOIN  
        bill_run_status b ON o.id = b.opcos_list_id 
         WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   		AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND opco_type = 'DIGITAL'
		ORDER BY o.opco_shortname, b.month_number");

		//Total_Time_legacy
		$query71 = $this->db->query("select o.opco_shortname, b.month_number as month,TIME_TO_SEC(b.total_time) / 3600 count FROM 
		opcos_list o 
		INNER JOIN  
        bill_run_status b ON o.id = b.opcos_list_id 
         WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   		AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND opco_type = 'LEGACY'
		ORDER BY o.opco_shortname, b.month_number");

		//Total_Time_Digital
		$query72 = $this->db->query("select o.opco_shortname, b.month_number as month, TIME_TO_SEC(b.total_time) / 3600 count FROM 
		opcos_list o 
		INNER JOIN  
        bill_run_status b ON o.id = b.opcos_list_id 
         WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   		AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND opco_type = 'DIGITAL'
		ORDER BY o.opco_shortname, b.month_number");

		$query1 = $query1->result();
		$query21 = $query21->result();
		$query22 = $query22->result();
		$query31 = $query31->result();
		$query32 = $query32->result();
		$query41 = $query41->result();
		$query42 = $query42->result();
		$query51 = $query51->result();
		$query52 = $query52->result();
		$query61 = $query61->result();
		$query62 = $query62->result();
		$query71 = $query71->result();
		$query72 = $query72->result();
	

		$chart_data = array(
			'query1' => $query1,
			'query21' => $query21,
			'query22' => $query22,
			'query31' => $query31,
			'query32' => $query32,
			'query41' => $query41,
			'query42' => $query42,
			'query51' => $query51,
			'query52' => $query52,
			'query61' => $query61,
			'query62' => $query62,
			'query71' => $query71,
			'query72' => $query72,
		);
		echo json_encode($chart_data);
	}

	public function Singleopcooutages()
	{
		$opco_type = $this->input->post('opco');
		// $selected_month = $this->input->post('month') ? $this->input->post('month') : date('n');
		// $selected_year = $this->input->post('year') ? $this->input->post('year') : date('Y');
		$query1 = $this->db->query("SELECT opcos_list.opco_name, month_number AS month, sum(description) AS count FROM incidents_outages join opcos_list ON opcos_list.id = incidents_outages.opcos_list_id WHERE date_of_outage >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) and opcos_list.id=$opco_type GROUP BY month_number ORDER BY month_number");

		$query2 = $this->db->query("SELECT o.opco_shortname, i.month_number AS month, SUM(i.s1_incidents_count + i.s2_incidents_count + i.s3_incidents_count + i.s4_incidents_count) AS count FROM incidents_summary i JOIN opcos_list o ON o.id = i.opcos_list_id WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
		AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND o.id = $opco_type GROUP BY o.opco_shortname, i.month_number, i.s1_incidents_count, i.s2_incidents_count, i.s3_incidents_count, i.s4_incidents_count ORDER BY o.opco_shortname, i.month_number");

		$query3 = $this->db->query("SELECT  
	i.month_number AS month,
	'S1' AS Severity,
	SUM(s1_incidents_count) AS count 
	FROM 
	incidents_summary i 
	JOIN opcos_list o ON o.id = i.opcos_list_id  
	WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND o.id=$opco_type
	GROUP BY 
	i.month_number
	UNION ALL
	SELECT  
	i.month_number AS month,
	'S2' AS Severity,
	SUM(s2_incidents_count) AS count 
	FROM 
	incidents_summary i 
	JOIN opcos_list o ON o.id = i.opcos_list_id  
	WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND o.id=$opco_type
	GROUP BY 
	i.month_number
	UNION ALL	
	SELECT  
	i.month_number AS month,
	'S3' AS Severity,
	SUM(s3_incidents_count) AS count 
	FROM 
	incidents_summary i 
	JOIN opcos_list o ON o.id = i.opcos_list_id 
	WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND o.id=$opco_type
	GROUP BY 
	i.month_number
	UNION ALL
	SELECT  
	i.month_number AS month,
	'S4' AS Severity,
	SUM(s4_incidents_count) AS count 
	FROM 
	incidents_summary i 
	JOIN opcos_list o ON o.id = i.opcos_list_id 
	WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND o.id=$opco_type
	GROUP BY 
	i.month_number
	ORDER BY 
	month, Severity");

		$query4 = $this->db->query("SELECT 
	o.opco_shortname, 
	i.month_number as month, 
	SUM(i.s1_sla_met_count + i.s2_sla_met_count + i.s3_sla_met_count + i.s4_sla_met_count) / 
	SUM(i.s1_incidents_count + i.s2_incidents_count + i.s3_incidents_count + i.s4_incidents_count) * 100 as count 
	FROM 
	opcos_list o 
	INNER JOIN 
	incidents_summary i ON o.id = i.opcos_list_id 
	WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND o.id=$opco_type
	GROUP BY o.opco_shortname, i.month_number
	ORDER BY o.opco_shortname, i.month_number");

	//Accounts_Billed
	$query5 = $this->db->query("select o.opco_shortname, b.month_number as month,b.accounts_billed_count count FROM 
	opcos_list o 
	INNER JOIN  
	bill_run_status b ON o.id = b.opcos_list_id 
	 WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
	   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m') AND o.id=$opco_type
	ORDER BY o.opco_shortname, b.month_number");

	//Services_Billed
	$query6 = $this->db->query("select o.opco_shortname, b.month_number as month,b.service_billed_count count FROM 
	opcos_list o 
	INNER JOIN  
	bill_run_status b ON o.id = b.opcos_list_id 
	 WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
	   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND o.id=$opco_type
	ORDER BY o.opco_shortname, b.month_number");

	//Total_Time
	$query7 = $this->db->query("select o.opco_shortname, b.month_number as month, TIME_TO_SEC(b.total_time) / 3600 count FROM 
	opcos_list o 
	INNER JOIN  
	bill_run_status b ON o.id = b.opcos_list_id 
	 WHERE CONCAT(year, LPAD(month_number, 2, '0')) > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y%m') 
	   AND CONCAT(year, LPAD(month_number, 2, '0')) <= DATE_FORMAT(CURDATE(), '%Y%m')  AND o.id=$opco_type
	ORDER BY o.opco_shortname, b.month_number");


		$query1 = $query1->result();
		$query2 = $query2->result();
		$query3 = $query3->result();
		$query4 = $query4->result();
		$query5 = $query5->result();
		$query6 = $query6->result();
		$query7 = $query7->result();
		$chart_data = array(
			'query1' => $query1,
			'query2' => $query2,
			'query3' => $query3,
			'query4' => $query4,
			'query5' => $query5,
			'query6' => $query6,
			'query7' => $query7
		);
		echo json_encode($chart_data);
	}

	public function updateQueryTIL()
	{
		// Get the posted month and year values
		$selected_year = $this->input->post('year') ? $this->input->post('year') : date('Y');
		// $opco_type = $this->input->post('opco');
		// $user = $this->session->userdata('nova_id');
		// $user_role = $this->session->userdata('user_role');
		// if ($user_role == 'Admin' or $user_role == 'Director' or $user_role == 'BUH') {
		// 	if ($opco_type == 'ALLOPCOS' or is_numeric($opco_type)) {
		$query = $this->db->query("SELECT 'Total' AS Severity, SUM(s1_incidents_count+s2_incidents_count+s3_incidents_count+s4_incidents_count) AS count FROM incidents_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year UNION ALL SELECT 'S1' AS Severity, SUM(s1_incidents_count) AS count FROM incidents_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year UNION ALL SELECT 'S2' AS Severity, SUM(s2_incidents_count) AS count FROM incidents_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year UNION ALL SELECT 'S3' AS Severity, SUM(s3_incidents_count) AS count FROM incidents_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year UNION ALL SELECT 'S4' AS Severity, SUM(s4_incidents_count) AS count FROM incidents_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year");
		// 	} else {
		// 		$query = $this->db->query("SELECT 'S1' AS Severity, SUM(s1_incidents_count) AS count FROM incidents_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year and o.opco_type = '$opco_type' UNION ALL SELECT 'S2' AS Severity, SUM(s2_incidents_count) AS count FROM incidents_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year and o.opco_type = '$opco_type' UNION ALL SELECT 'S3' AS Severity, SUM(s3_incidents_count) AS count FROM incidents_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year and o.opco_type = '$opco_type' UNION ALL SELECT 'S4' AS Severity, SUM(s4_incidents_count) AS count FROM incidents_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year and o.opco_type = '$opco_type'");
		// 	}
		// } else {
		// 	$query = $this->db->query("SELECT 'S1' AS Severity, SUM(s1_incidents_count) AS count FROM incidents_summary i join opcos_list o on o.id = i.opcos_list_id join user_opco uo on uo.opco_name = o.opco_name where i.year = $selected_year and uo.nova_id = '$user' UNION ALL SELECT 'S2' AS Severity, SUM(s2_incidents_count) AS count FROM incidents_summary i join opcos_list o on o.id = i.opcos_list_id join user_opco uo on uo.opco_name = o.opco_name where i.year = $selected_year and uo.nova_id = '$user' UNION ALL SELECT 'S3' AS Severity, SUM(s3_incidents_count) AS count FROM incidents_summary i join opcos_list o on o.id = i.opcos_list_id join user_opco uo on uo.opco_name = o.opco_name where i.year = $selected_year and uo.nova_id = '$user' UNION ALL SELECT 'S4' AS Severity, SUM(s4_incidents_count) AS count FROM incidents_summary i join opcos_list o on o.id = i.opcos_list_id join user_opco uo on uo.opco_name = o.opco_name where i.year = $selected_year  and uo.nova_id = '$user'");
		// }
		$rows = $query->result_array();

		// Prepare the data array for the response
		$data = [];
		foreach ($rows as $row) {
			$data[] = [
				$row['Severity'],
				(int)$row['count'],
			];
		}

		// Return the updated query result as JSON
		echo json_encode($data);
	}

	public function updateQueryTWOL()
	{
		// Get the posted month and year values
		$selected_year = $this->input->post('year') ? $this->input->post('year') : date('Y');
		// $opco_type = $this->input->post('opco');
		// $user = $this->session->userdata('nova_id');
		// $user_role = $this->session->userdata('user_role');
		// if ($user_role == 'Admin' or $user_role == 'Director' or $user_role == 'BUH') {
		// 	if ($opco_type == 'ALLOPCOS' or is_numeric($opco_type)) {
		$query = $this->db->query("SELECT 'Total' AS Severity, SUM(s1_sr_count+s2_sr_count+s3_sr_count+s4_sr_count) AS count FROM service_request_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year UNION ALL SELECT 'S1' AS Severity, SUM(s1_sr_count) AS count FROM service_request_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year UNION ALL SELECT 'S2' AS Severity, SUM(s2_sr_count) AS count FROM service_request_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year UNION ALL SELECT 'S3' AS Severity, SUM(s3_sr_count) AS count FROM service_request_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year UNION ALL SELECT 'S4' AS Severity, SUM(s4_sr_count) AS count FROM service_request_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year");
		// 	} else {
		// 		$query = $this->db->query("SELECT 'S1' AS Severity, SUM(s1_sr_count) AS count FROM service_request_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year and o.opco_type = '$opco_type' UNION ALL SELECT 'S2' AS Severity, SUM(s2_sr_count) AS count FROM service_request_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year and o.opco_type = '$opco_type' UNION ALL SELECT 'S3' AS Severity, SUM(s3_sr_count) AS count FROM service_request_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year and o.opco_type = '$opco_type' UNION ALL SELECT 'S4' AS Severity, SUM(s4_sr_count) AS count FROM service_request_summary i join opcos_list o on o.id = i.opcos_list_id where i.year = $selected_year and o.opco_type = '$opco_type'");
		// 	}
		// } else {
		// 	$query = $this->db->query("SELECT 'S1' AS Severity, SUM(s1_sr_count) AS count FROM service_request_summary i join opcos_list o on o.id = i.opcos_list_id join user_opco uo on uo.opco_name = o.opco_name where i.year = $selected_year and uo.nova_id = '$user' UNION ALL SELECT 'S2' AS Severity, SUM(s2_sr_count) AS count FROM service_request_summary i join opcos_list o on o.id = i.opcos_list_id join user_opco uo on uo.opco_name = o.opco_name where i.year = $selected_year and uo.nova_id = '$user' UNION ALL SELECT 'S3' AS Severity, SUM(s3_sr_count) AS count FROM service_request_summary i join opcos_list o on o.id = i.opcos_list_id join user_opco uo on uo.opco_name = o.opco_name where i.year = $selected_year and uo.nova_id = '$user' UNION ALL SELECT 'S4' AS Severity, SUM(s4_sr_count) AS count FROM service_request_summary i join opcos_list o on o.id = i.opcos_list_id join user_opco uo on uo.opco_name = o.opco_name where i.year = $selected_year and uo.nova_id = '$user'");
		// }
		$rows = $query->result_array();

		// Prepare the data array for the response
		$data = [];
		foreach ($rows as $row) {
			$data[] = [
				$row['Severity'],
				(int)$row['count'],
			];
		}

		// Return the updated query result as JSON
		echo json_encode($data);
	}

	public function updateQueryISRe()
	{
		// Get the posted month and year values
		// $selected_month = $this->input->post('month') ? $this->input->post('month') : date('n');
		$selected_year = $this->input->post('year') ? $this->input->post('year') : date('Y');
		// $opco_type = $this->input->post('opco');
		// $user = $this->session->userdata('nova_id');
		// $user_role = $this->session->userdata('user_role');
		// if ($user_role == 'Admin' or $user_role == 'Director' or $user_role == 'BUH') {
		// 	if ($opco_type == 'ALLOPCOS') {
		$query = $this->db->query("SELECT 'Total' as category, sum(app_issue_count+fun_issue_count+data_issue_count+plat_issue_count+NFR_issue_count+tec_issue_count+3pp_issue_count+clar_issue_count+process_gap_count+no_fcr_count+know_gap_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE year = $selected_year UNION ALL SELECT 'Application issue' as category, sum(app_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'Functionality issue' as category, sum(fun_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'Data issue' as category, sum(data_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'Platform issue' as category, sum(plat_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'NFR issue' as category, sum(NFR_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'Techonolgy issue' as category, sum(tec_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select '3pp issue' as category, sum(3pp_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'Clarification issue' as category, sum(clar_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'No FCR training' as category, sum(no_fcr_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'Process_gap_count' as category, sum(process_gap_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'Knowledge gap' as category, sum(know_gap_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE year = $selected_year");
		// 	} else if (is_numeric($opco_type)) {
		// 		$query = $this->db->query("SELECT 'Application issue' as category, sum(app_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'Functionality issue' as category, sum(fun_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'Data issue' as category, sum(data_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'Platform issue' as category, sum(plat_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'NFR issue' as category, sum(NFR_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'Techonolgy issue' as category, sum(tec_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select '3pp issue' as category, sum(3pp_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'Clarification issue' as category, sum(clar_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'No FCR training' as category, sum(no_fcr_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'Process gap' as category, sum(process_gap_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'Knowledge gap' as category, sum(know_gap_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year");
		// 	} else {
		// 		$query = $this->db->query("SELECT 'Application issue' as category, sum(app_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'Functionality issue' as category, sum(fun_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'Data issue' as category, sum(data_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'Platform issue' as category, sum(plat_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'NFR issue' as category, sum(NFR_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'Techonolgy issue' as category, sum(tec_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select '3pp issue' as category, sum(3pp_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'Clarification issue' as category, sum(clar_issue_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'No FCR training' as category, sum(no_fcr_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'Process gap' as category, sum(process_gap_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'Knowledge gap' as category, sum(know_gap_count) as count from incidents_reason JOIN opcos_list ON incidents_reason.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type'");
		// 	}
		// } else {
		// 	$query = $this->db->query("SELECT 'Application issue' as category, sum(app_issue_count) as count from incidents_reason ir JOIN opcos_list o ON ir.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year union all select 'Functionality issue' as category, sum(fun_issue_count) as count from incidents_reason ir JOIN opcos_list o ON ir.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select 'Data issue' as category, sum(data_issue_count) as count from incidents_reason ir JOIN opcos_list o ON ir.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select 'Platform issue' as category, sum(plat_issue_count) as count from incidents_reason ir JOIN opcos_list o ON ir.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select 'NFR issue' as category, sum(NFR_issue_count) as count from incidents_reason ir JOIN opcos_list o ON ir.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select 'Techonolgy issue' as category, sum(tec_issue_count) as count from incidents_reason ir JOIN opcos_list o ON ir.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select '3pp issue' as category, sum(3pp_issue_count) as count from incidents_reason ir JOIN opcos_list o ON ir.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select 'Clarification issue' as category, sum(clar_issue_count) as count from incidents_reason ir JOIN opcos_list o ON ir.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select 'No FCR training' as category, sum(no_fcr_count) as count from incidents_reason ir JOIN opcos_list o ON ir.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select 'Process gap' as category, sum(process_gap_count) as count from incidents_reason ir JOIN opcos_list o ON ir.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select 'Knowledge gap' as category, sum(know_gap_count) as count from incidents_reason ir JOIN opcos_list o ON ir.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user'");
		// }

		$rows = $query->result_array();

		// Prepare the data array for the response
		$data = [];
		foreach ($rows as $row) {
			$data[] = [
				$row['category'],
				(int)$row['count'],
			];
		}

		// Return the updated query result as JSON
		echo json_encode($data);
	}

	public function updateQueryWORe()
	{
		// Get the posted month and year values
		// $selected_month = $this->input->post('month') ? $this->input->post('month') : date('n');
		$selected_year = $this->input->post('year') ? $this->input->post('year') : date('Y');
		// $opco_type = $this->input->post('opco');
		// $user = $this->session->userdata('nova_id');
		// $user_role = $this->session->userdata('user_role');
		// if ($user_role == 'Admin' or $user_role == 'Director' or $user_role == 'BUH') {
		// 	if ($opco_type == 'ALLOPCOS') {
		$query = $this->db->query("SELECT 'Total' as category, sum(app_issue_count+fun_issue_count+data_issue_count+plat_issue_count+NFR_issue_count+tec_issue_count+3pp_issue_count+clar_issue_count+process_gap_count+no_fcr_count+know_gap_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'Application issue' as category, sum(app_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'Functionality issue' as category, sum(fun_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'Data issue' as category, sum(data_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'Platform issue' as category, sum(plat_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'NFR issue' as category, sum(NFR_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'Techonolgy issue' as category, sum(tec_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select '3pp issue' as category, sum(3pp_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'Clarification issue' as category, sum(clar_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'No FCR training' as category, sum(no_fcr_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'Process gap' as category, sum(process_gap_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'Knowledge gap' as category, sum(know_gap_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE year = $selected_year union all select 'service_request_count' as category, sum(service_request_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE year = $selected_year");
		// 	} else if (is_numeric($opco_type)) {
		// 		$query = $this->db->query("select 'Application issue' as category, sum(app_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'Functionality issue' as category, sum(fun_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'Data issue' as category, sum(data_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'Platform issue' as category, sum(plat_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'NFR issue' as category, sum(NFR_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'Techonolgy issue' as category, sum(tec_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select '3pp issue' as category, sum(3pp_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'Clarification issue' as category, sum(clar_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'No FCR training' as category, sum(no_fcr_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'Process gap' as category, sum(process_gap_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'Knowledge gap' as category, sum(know_gap_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year union all select 'Service_request_count' as category, sum(service_request_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year");
		// 	} else {
		// 		$query = $this->db->query("select 'Application issue' as category, sum(app_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'Functionality issue' as category, sum(fun_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'Data issue' as category, sum(data_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'Platform issue' as category, sum(plat_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'NFR issue' as category, sum(NFR_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'Techonolgy issue' as category, sum(tec_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select '3pp issue' as category, sum(3pp_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'Clarification issue' as category, sum(clar_issue_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'No FCR training' as category, sum(no_fcr_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'Process gap' as category, sum(process_gap_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type' union all select 'Knowledge gap' as category, sum(know_gap_count) as count from work_order_summary JOIN opcos_list ON work_order_summary.opcos_list_id = opcos_list.id WHERE month_number = $selected_month AND year = $selected_year and opcos_list.opco_type = '$opco_type'");
		// 	}
		// } else {
		// 	$query = $this->db->query("select 'Application issue' as category, sum(app_issue_count) as count from work_order_summary wo JOIN opcos_list o ON wo.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select 'Functionality issue' as category, sum(fun_issue_count) as count from work_order_summary wo JOIN opcos_list o ON wo.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select 'Data issue' as category, sum(data_issue_count) as count from work_order_summary wo JOIN opcos_list o ON wo.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select 'Platform issue' as category, sum(plat_issue_count) as count from work_order_summary wo JOIN opcos_list o ON wo.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select 'NFR issue' as category, sum(NFR_issue_count) as count from work_order_summary wo JOIN opcos_list o ON wo.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select 'Techonolgy issue' as category, sum(tec_issue_count) as count from work_order_summary wo JOIN opcos_list o ON wo.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select '3pp issue' as category, sum(3pp_issue_count) as count from work_order_summary wo JOIN opcos_list o ON wo.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select 'Clarification issue' as category, sum(clar_issue_count) as count from work_order_summary wo JOIN opcos_list o ON wo.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select 'No FCR training' as category, sum(no_fcr_count) as count from work_order_summary wo JOIN opcos_list o ON wo.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select 'Process gap' as category, sum(process_gap_count) as count from work_order_summary wo JOIN opcos_list o ON wo.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user' union all select 'Knowledge gap' as category, sum(know_gap_count) as count from work_order_summary wo JOIN opcos_list o ON wo.opcos_list_id = o.id join user_opco uo on uo.opco_name = o.opco_name WHERE month_number = $selected_month AND year = $selected_year and uo.nova_id = '$user'");
		// }

		$rows = $query->result_array();

		// Prepare the data array for the response
		$data = [];
		foreach ($rows as $row) {
			$data[] = [
				$row['category'],
				(int)$row['count'],
			];
		}

		// Return the updated query result as JSON
		echo json_encode($data);
	}

	public function updateQueryISL()
	{
		// Get the posted month and year values
		$selected_month = $this->input->post('month') ? $this->input->post('month') : date('n');
		$selected_year = $this->input->post('year') ? $this->input->post('year') : date('Y');
		$opco_type = $this->input->post('opco');
		// $user = $this->session->userdata('nova_id');
		// $user_role = $this->session->userdata('user_role');
		// if ($user_role == 'Admin' or $user_role == 'Director' or $user_role == 'BUH') {
		if ($opco_type == 'ALLOPCOS') {
			$query = $this->db->query("SELECT o.opco_name, i.s1_incidents_count+i.s2_incidents_count+i.s3_incidents_count+i.s4_incidents_count as count, i.s1_incidents_count, i.s2_incidents_count, i.s3_incidents_count, i.s4_incidents_count FROM incidents_summary i INNER JOIN opcos_list o ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year");
		} else if (is_numeric($opco_type)) {
			$query = $this->db->query("SELECT o.opco_name, sum(i.s1_incidents_count + i.s2_incidents_count + i.s3_incidents_count + i.s4_incidents_count) as count, sum(i.s1_incidents_count) as s1_incidents_count, sum(i.s2_incidents_count)as s2_incidents_count, sum(i.s3_incidents_count)as s3_incidents_count, sum(i.s4_incidents_count)as s4_incidents_count FROM incidents_summary i INNER JOIN opcos_list o ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year and o.id = $opco_type");
		}
		// 	 else {
		// 		$query = $this->db->query("SELECT o.opco_name, s1_incidents_count + i.s2_incidents_count + i.s3_incidents_count + i.s4_incidents_count as count, i.s1_incidents_count, i.s2_incidents_count, i.s3_incidents_count, i.s4_incidents_count FROM incidents_summary i INNER JOIN opcos_list o ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year and o.opco_type = '$opco_type'");
		// 	}
		// } else {
		// 	$query = $this->db->query("SELECT o.opco_name, s1_incidents_count + i.s2_incidents_count + i.s3_incidents_count + i.s4_incidents_count as count, i.s1_incidents_count, i.s2_incidents_count, i.s3_incidents_count, i.s4_incidents_count FROM incidents_summary i JOIN opcos_list o ON o.id = i.opcos_list_id join user_opco uo on uo.opco_name = o.opco_name WHERE i.month_number = $selected_month AND i.year = $selected_year and uo.nova_id = '$user'");
		// }
		// Update the query with the new parameters

		$rows = $query->result_array();

		// Prepare the data array for the response
		$data = [];
		foreach ($rows as $row) {
			$data[] = [
				$row['opco_name'],
				(int)$row['count'],
				(int)$row['s1_incidents_count'],
				(int)$row['s2_incidents_count'],
				(int)$row['s3_incidents_count'],
				(int)$row['s4_incidents_count']
			];
		}

		// Return the updated query result as JSON
		echo json_encode($data);
	}

	public function updateQueryWOL()
	{
		// Get the posted month and year values
		$selected_month = $this->input->post('month') ? $this->input->post('month') : date('n');
		$selected_year = $this->input->post('year') ? $this->input->post('year') : date('Y');
		$opco_type = $this->input->post('opco');
		// $user = $this->session->userdata('nova_id');
		// $user_role = $this->session->userdata('user_role');
		// if ($user_role == 'Admin' or $user_role == 'Director' or $user_role == 'BUH') {
		if ($opco_type == 'ALLOPCOS') {
			$query = $this->db->query("SELECT o.opco_name, i.s1_sr_count+i.s2_sr_count+i.s3_sr_count+i.s4_sr_count as count, i.s1_sr_count, i.s2_sr_count, i.s3_sr_count, i.s4_sr_count FROM service_request_summary i INNER JOIN opcos_list o ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year");
		} else if (is_numeric($opco_type)) {
			$query = $this->db->query("SELECT o.opco_name, sum(i.s1_sr_count + i.s2_sr_count + i.s3_sr_count + i.s4_sr_count) as count, sum(i.s1_sr_count) as s1_sr_count, sum(i.s2_sr_count) as s2_sr_count, sum(i.s3_sr_count) as s3_sr_count, sum(i.s4_sr_count) as s4_sr_count FROM service_request_summary i INNER JOIN opcos_list o ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year and o.id = $opco_type");
		}
		// 	 else {
		// 		$query = $this->db->query("SELECT o.opco_name, s1_sr_count + i.s2_sr_count + i.s3_sr_count + i.s4_sr_count as count, i.s1_sr_count, i.s2_sr_count, i.s3_sr_count, i.s4_sr_count FROM service_request_summary i INNER JOIN opcos_list o ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year and o.opco_type = '$opco_type'");
		// 	}
		// } else {
		// 	$query = $this->db->query("SELECT o.opco_name, s1_sr_count + i.s2_sr_count + i.s3_sr_count + i.s4_sr_count as count, i.s1_sr_count, i.s2_sr_count, i.s3_sr_count, i.s4_sr_count FROM service_request_summary i INNER JOIN opcos_list o ON o.id = i.opcos_list_id join user_opco uo on uo.opco_name = o.opco_name WHERE i.month_number = $selected_month AND i.year = $selected_year and uo.nova_id = '$user'");
		// }

		$rows = $query->result_array();

		// Prepare the data array for the response
		$data = [];
		foreach ($rows as $row) {
			$data[] = [
				$row['opco_name'],
				(int)$row['count'],
				(int)$row['s1_sr_count'],
				(int)$row['s2_sr_count'],
				(int)$row['s3_sr_count'],
				(int)$row['s4_sr_count']
			];
		}

		// Return the updated query result as JSON
		echo json_encode($data);
	}

	public function updateQueryISR()
	{
		// Get the posted month and year values
		$selected_month = $this->input->post('month') ? $this->input->post('month') : date('n');
		$selected_year = $this->input->post('year') ? $this->input->post('year') : date('Y');
		$opco_type = $this->input->post('opco');
		// $user = $this->session->userdata('nova_id');
		// $user_role = $this->session->userdata('user_role');
		// if ($user_role == 'Admin' or $user_role == 'Director' or $user_role == 'BUH') {
		if ($opco_type == 'ALLOPCOS') {
			$query = $this->db->query("SELECT o.opco_name, (i.Service_desk + i.L1_MSO_count + i.L2_count + i.L3_count + i.L4_count) as count, i.Service_desk, i.L1_MSO_count, i.L2_count, i.L3_count, i.L4_count from opcos_list o inner join incident_count_by_group i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year");
		} else if (is_numeric($opco_type)) {
			$query = $this->db->query("SELECT o.opco_name, SUM(i.Service_desk + i.L1_MSO_count + i.L2_count + i.L3_count + i.L4_count) as count, SUM(i.Service_desk) AS Service_desk, SUM(i.L1_MSO_count) AS L1_MSO_count, SUM(i.L2_count) AS L2_count, SUM(i.L3_count)AS L3_count, SUM(i.L4_count) AS L4_count from opcos_list o inner join incident_count_by_group i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year and o.id = $opco_type");
		}
		// 	 else {
		// 		$query = $this->db->query("SELECT o.opco_name, (i.Service_desk + i.L1_MSO_count + i.L2_count + i.L3_count + i.L4_count) as count, i.Service_desk, i.L1_MSO_count, i.L2_count, i.L3_count, i.L4_count from opcos_list o inner join incident_count_by_group i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year and o.opco_type = '$opco_type'");
		// 	}
		// } else {
		// 	$query = $this->db->query("SELECT o.opco_name, (i.Service_desk + i.L1_MSO_count + i.L2_count + i.L3_count + i.L4_count) as count, i.Service_desk, i.L1_MSO_count, i.L2_count, i.L3_count, i.L4_count from opcos_list o inner join incident_count_by_group i ON o.id = i.opcos_list_id join user_opco uo on uo.opco_name = o.opco_name WHERE i.month_number = $selected_month AND i.year = $selected_year and uo.nova_id = '$user'");
		// }

		$rows = $query->result_array();

		// Prepare the data array for the response
		$data = [];
		foreach ($rows as $row) {
			$data[] = [
				$row['opco_name'],
				(int)$row['count'],
				(int)$row['Service_desk'],
				(int)$row['L1_MSO_count'],
				(int)$row['L2_count'],
				(int)$row['L3_count'],
				(int)$row['L4_count'],
			];
		}

		// Return the updated query result as JSON
		echo json_encode($data);
	}

	public function updateQueryWOR()
	{
		// Get the posted month and year values
		$selected_month = $this->input->post('month') ? $this->input->post('month') : date('n');
		$selected_year = $this->input->post('year') ? $this->input->post('year') : date('Y');
		$opco_type = $this->input->post('opco');
		// $user = $this->session->userdata('nova_id');
		// $user_role = $this->session->userdata('user_role');
		// if ($user_role == 'Admin' or $user_role == 'Director' or $user_role == 'BUH') {
		if ($opco_type == 'ALLOPCOS') {
			$query = $this->db->query("SELECT o.opco_name, (i.Service_desk + i.L1_MSO_count + i.L2_count + i.L3_count + i.L4_count) as count, i.Service_desk, i.L1_MSO_count, i.L2_count, i.L3_count, i.L4_count from opcos_list o inner join workorder_count_by_group i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year");
		} else if (is_numeric($opco_type)) {
			$query = $this->db->query("SELECT o.opco_name, SUM(i.Service_desk + i.L1_MSO_count + i.L2_count + i.L3_count + i.L4_count) as count, SUM(i.Service_desk)AS Service_desk, SUM(i.L1_MSO_count)AS L1_MSO_count, SUM(i.L2_count)AS L2_count, SUM(i.L3_count)AS L3_count, SUM(i.L4_count)AS L4_count from opcos_list o inner join workorder_count_by_group i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year and o.id = $opco_type");
		}
		// 	 else {
		// 		$query = $this->db->query("SELECT o.opco_name, (i.Service_desk + i.L1_MSO_count + i.L2_count + i.L3_count + i.L4_count) as count, i.Service_desk, i.L1_MSO_count, i.L2_count, i.L3_count, i.L4_count from opcos_list o inner join workorder_count_by_group i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year and o.opco_type = '$opco_type'");
		// 	}
		// } else {
		// 	$query = $this->db->query("SELECT o.opco_name, (i.Service_desk + i.L1_MSO_count + i.L2_count + i.L3_count + i.L4_count) as count, i.Service_desk, i.L1_MSO_count, i.L2_count, i.L3_count, i.L4_count from opcos_list o inner join workorder_count_by_group i ON o.id = i.opcos_list_id join user_opco uo on uo.opco_name = o.opco_name WHERE i.month_number = $selected_month AND i.year = $selected_year and uo.nova_id = '$user'");
		// }

		$rows = $query->result_array();

		// Prepare the data array for the response
		$data = [];
		foreach ($rows as $row) {
			$data[] = [
				$row['opco_name'],
				(int)$row['count'],
				(int)$row['Service_desk'],
				(int)$row['L1_MSO_count'],
				(int)$row['L2_count'],
				(int)$row['L3_count'],
				(int)$row['L4_count'],
			];
		}

		// Return the updated query result as JSON
		echo json_encode($data);
	}

	public function updateQueryISLA()
	{
		// Get the posted month and year values
		$selected_month = $this->input->post('month') ? $this->input->post('month') : date('n');
		$selected_year = $this->input->post('year') ? $this->input->post('year') : date('Y');
		$opco_type = $this->input->post('opco');
		// $user = $this->session->userdata('nova_id');
		// $user_role = $this->session->userdata('user_role');
		// if ($user_role == 'Admin' or $user_role == 'Director' or $user_role == 'BUH') {
		if ($opco_type == 'ALLOPCOS') {
			$query = $this->db->query("SELECT o.opco_name, s1_incidents_count, s2_incidents_count, s3_incidents_count, s4_incidents_count, ((i.s1_sla_met_count + i.s2_sla_met_count + i.s3_sla_met_count + i.s4_sla_met_count)/(s1_incidents_count + s2_incidents_count+s3_incidents_count+s4_incidents_count))* 100 as count, (i.s1_sla_met_count/s1_incidents_count)*100 as s1, (i.s2_sla_met_count/s2_incidents_count)*100 as s2, (i.s3_sla_met_count/s3_incidents_count)*100 as s3, (i.s4_sla_met_count/s4_incidents_count)*100 as s4 FROM opcos_list o inner JOIN incidents_summary i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year");
		} else if (is_numeric($opco_type)) {
			$query = $this->db->query("SELECT o.opco_name, sum(s1_incidents_count)as s1_incidents_count, sum(s2_incidents_count) as s2_incidents_count, sum(s3_incidents_count) as s3_incidents_count, sum(s4_incidents_count) as s4_incidents_count, (sum(i.s1_sla_met_count + i.s2_sla_met_count + i.s3_sla_met_count + i.s4_sla_met_count)/sum(s1_incidents_count + s2_incidents_count+s3_incidents_count+s4_incidents_count))* 100 as count, sum(i.s1_sla_met_count/s1_incidents_count)*100 as s1, sum(i.s2_sla_met_count/s2_incidents_count)*100 as s2, sum(i.s3_sla_met_count/s3_incidents_count)*100 as s3, sum(i.s4_sla_met_count/s4_incidents_count)*100 as s4 FROM opcos_list o inner JOIN incidents_summary i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year and o.id = $opco_type");
		}
		// 	 else {
		// 		$query = $this->db->query("SELECT o.opco_name, s1_incidents_count, s2_incidents_count, s3_incidents_count, s4_incidents_count, ((i.s1_sla_met_count + i.s2_sla_met_count + i.s3_sla_met_count + i.s4_sla_met_count)/(s1_incidents_count + s2_incidents_count+s3_incidents_count+s4_incidents_count))* 100 as count, (i.s1_sla_met_count/s1_incidents_count)*100 as s1, (i.s2_sla_met_count/s2_incidents_count)*100 as s2, (i.s3_sla_met_count/s3_incidents_count)*100 as s3, (i.s4_sla_met_count/s4_incidents_count)*100 as s4 FROM opcos_list o inner JOIN incidents_summary i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year and o.opco_type = '$opco_type'");
		// 	}
		// } else {
		// 	$query = $this->db->query("SELECT o.opco_name, s1_incidents_count, s2_incidents_count, s3_incidents_count, s4_incidents_count, ((i.s1_sla_met_count + i.s2_sla_met_count + i.s3_sla_met_count + i.s4_sla_met_count)/(s1_incidents_count + s2_incidents_count+s3_incidents_count+s4_incidents_count))* 100 as count, (i.s1_sla_met_count/s1_incidents_count)*100 as s1, (i.s2_sla_met_count/s2_incidents_count)*100 as s2, (i.s3_sla_met_count/s3_incidents_count)*100 as s3, (i.s4_sla_met_count/s4_incidents_count)*100 as s4 FROM opcos_list o inner JOIN incidents_summary i ON o.id = i.opcos_list_id join user_opco uo on uo.opco_name = o.opco_name WHERE i.month_number = $selected_month AND i.year = $selected_year and uo.nova_id = '$user'");
		// }

		$rows = $query->result_array();

		// Prepare the data array for the response
		$data = [];
		foreach ($rows as $row) {
			$data[] = [
				$row['opco_name'],
				(int)$row['count'],
				(int)$row['s1'],
				(int)$row['s2'],
				(int)$row['s3'],
				(int)$row['s4'],
			];
		}

		// Return the updated query result as JSON
		echo json_encode($data);
	}

	public function updateQueryWOSLA()
	{
		// Get the posted month and year values
		$selected_month = $this->input->post('month') ? $this->input->post('month') : date('n');
		$selected_year = $this->input->post('year') ? $this->input->post('year') : date('Y');
		$opco_type = $this->input->post('opco');
		// $user = $this->session->userdata('nova_id');
		// $user_role = $this->session->userdata('user_role');
		// if ($user_role == 'Admin' or $user_role == 'Director' or $user_role == 'BUH') {
		if ($opco_type == 'ALLOPCOS') {
			$query = $this->db->query("SELECT o.opco_name, ((i.s1_sr_sla_met_count + i.s2_sr_sla_met_count + i.s3_sr_sla_met_count + i.s4_sr_sla_met_count)/(s1_sr_count + s2_sr_count+s3_sr_count+s4_sr_count))* 100 as count,  (i.s1_sr_sla_met_count/s1_sr_count)*100 as s1, (i.s2_sr_sla_met_count/s2_sr_count)*100 as s2, (i.s3_sr_sla_met_count/s3_sr_count)*100 as s3, (i.s4_sr_sla_met_count/s4_sr_count)*100 as s4 FROM opcos_list o inner JOIN service_request_summary i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year");
		} else if (is_numeric($opco_type)) {
			$query = $this->db->query("SELECT o.opco_name, (SUM(i.s1_sr_sla_met_count + i.s2_sr_sla_met_count + i.s3_sr_sla_met_count + i.s4_sr_sla_met_count)/SUM(s1_sr_count + s2_sr_count+s3_sr_count+s4_sr_count))* 100 as count, SUM(i.s1_sr_sla_met_count/s1_sr_count)*100 as s1, SUM(i.s2_sr_sla_met_count/s2_sr_count)*100 as s2, SUM(i.s3_sr_sla_met_count/s3_sr_count)*100 as s3, SUM(i.s4_sr_sla_met_count/s4_sr_count)*100 as s4 FROM opcos_list o inner JOIN service_request_summary i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year and o.id = $opco_type");
		}
		// 	 else {
		// 		$query = $this->db->query("SELECT o.opco_name, ((i.s1_sr_sla_met_count + i.s2_sr_sla_met_count + i.s3_sr_sla_met_count + i.s4_sr_sla_met_count)/(s1_sr_count + s2_sr_count+s3_sr_count+s4_sr_count))* 100 as count,  (i.s1_sr_sla_met_count/s1_sr_count)*100 as s1, (i.s2_sr_sla_met_count/s2_sr_count)*100 as s2, (i.s3_sr_sla_met_count/s3_sr_count)*100 as s3, (i.s4_sr_sla_met_count/s4_sr_count)*100 as s4 FROM opcos_list o inner JOIN service_request_summary i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year and o.opco_type = '$opco_type'");
		// 	}
		// } else {
		// 	$query = $this->db->query("SELECT o.opco_name, ((i.s1_sr_sla_met_count + i.s2_sr_sla_met_count + i.s3_sr_sla_met_count + i.s4_sr_sla_met_count)/(s1_sr_count + s2_sr_count+s3_sr_count+s4_sr_count))* 100 as count,  (i.s1_sr_sla_met_count/s1_sr_count)*100 as s1, (i.s2_sr_sla_met_count/s2_sr_count)*100 as s2, (i.s3_sr_sla_met_count/s3_sr_count)*100 as s3, (i.s4_sr_sla_met_count/s4_sr_count)*100 as s4 FROM opcos_list o inner JOIN service_request_summary i ON o.id = i.opcos_list_id join user_opco uo on uo.opco_name = o.opco_name WHERE i.month_number = $selected_month AND i.year = $selected_year and uo.nova_id = '$user'");
		// }

		$rows = $query->result_array();

		// Prepare the data array for the response
		$data = [];
		foreach ($rows as $row) {
			$data[] = [
				$row['opco_name'],
				(int)$row['count'],
				(int)$row['s1'],
				(int)$row['s2'],
				(int)$row['s3'],
				(int)$row['s4']
			];
		}

		// Return the updated query result as JSON
		echo json_encode($data);
	}

	public function updateQueryISReO()
	{
		// Get the posted month and year values
		$selected_month = $this->input->post('month') ? $this->input->post('month') : date('n');
		$selected_year = $this->input->post('year') ? $this->input->post('year') : date('Y');
		$opco_type = $this->input->post('opco');
		// $user = $this->session->userdata('nova_id');
		// $user_role = $this->session->userdata('user_role');
		// if ($user_role == 'Admin' or $user_role == 'Director' or $user_role == 'BUH') {
		if ($opco_type == 'ALLOPCOS') {
			$query = $this->db->query("SELECT o.opco_name, (i.app_issue_count + i.fun_issue_count + i.data_issue_count + i.plat_issue_count + i.NFR_issue_count + i.tec_issue_count + i.3pp_issue_count + i.clar_issue_count + i.no_fcr_count + i.process_gap_count + i.know_gap_count) as count, i.app_issue_count, i.fun_issue_count, i.data_issue_count, i.plat_issue_count, i.NFR_issue_count, i.tec_issue_count, i.3pp_issue_count, i.clar_issue_count, i.no_fcr_count, i.process_gap_count, i.know_gap_count FROM opcos_list o INNER JOIN incidents_reason i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year");
		} else if (is_numeric($opco_type)) {
			$query = $this->db->query("SELECT o.opco_name, SUM(i.app_issue_count + i.fun_issue_count + i.data_issue_count + i.plat_issue_count + i.NFR_issue_count + i.tec_issue_count + i.3pp_issue_count + i.clar_issue_count + i.no_fcr_count + i.process_gap_count + i.know_gap_count) as count, SUM(i.app_issue_count)AS app_issue_count, SUM(i.fun_issue_count)AS fun_issue_count, SUM(i.data_issue_count)AS data_issue_count, SUM(i.plat_issue_count)AS plat_issue_count, SUM(i.NFR_issue_count)AS NFR_issue_count, SUM(i.tec_issue_count)AS tec_issue_count, SUM(i.3pp_issue_count)AS 3pp_issue_count, SUM(i.clar_issue_count)AS clar_issue_count, SUM(i.no_fcr_count)AS no_fcr_count, SUM(i.process_gap_count)AS process_gap_count, SUM(i.know_gap_count)AS know_gap_count FROM opcos_list o INNER JOIN incidents_reason i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year and o.id = $opco_type");
		}
		// 	 else {
		// 		$query = $this->db->query("SELECT o.opco_name, (i.app_issue_count + i.fun_issue_count + i.data_issue_count + i.plat_issue_count + i.NFR_issue_count + i.tec_issue_count + i.3pp_issue_count + i.clar_issue_count + i.no_fcr_count + i.process_gap_count + i.know_gap_count) as count, i.app_issue_count, i.fun_issue_count, i.data_issue_count, i.plat_issue_count, i.NFR_issue_count, i.tec_issue_count, i.3pp_issue_count, i.clar_issue_count, i.no_fcr_count, i.process_gap_count, i.know_gap_count FROM opcos_list o INNER JOIN incidents_reason i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year and o.opco_type = '$opco_type'");
		// 	}
		// } else {
		// 	$query = $this->db->query("SELECT o.opco_name, (i.app_issue_count + i.fun_issue_count + i.data_issue_count + i.plat_issue_count + i.NFR_issue_count + i.tec_issue_count + i.3pp_issue_count + i.clar_issue_count + i.no_fcr_count + i.process_gap_count + i.know_gap_count) as count, i.app_issue_count, i.fun_issue_count, i.data_issue_count, i.plat_issue_count, i.NFR_issue_count, i.tec_issue_count, i.3pp_issue_count, i.clar_issue_count, i.no_fcr_count, i.process_gap_count, i.know_gap_count FROM opcos_list o INNER JOIN incidents_reason i ON o.id = i.opcos_list_id join user_opco uo on uo.opco_name = o.opco_name WHERE i.month_number = $selected_month AND i.year = $selected_year and uo.nova_id = '$user'");
		// }

		$rows = $query->result_array();

		// Prepare the data array for the response
		$data = [];
		foreach ($rows as $row) {
			$data[] = [
				$row['opco_name'],
				(int)$row['count'],
				(int)$row['app_issue_count'],
				(int)$row['fun_issue_count'],
				(int)$row['data_issue_count'],
				(int)$row['plat_issue_count'],
				(int)$row['NFR_issue_count'],
				(int)$row['tec_issue_count'],
				(int)$row['3pp_issue_count'],
				(int)$row['clar_issue_count'],
				(int)$row['no_fcr_count'],
				(int)$row['process_gap_count'],
				(int)$row['know_gap_count'],
			];
		}

		// Return the updated query result as JSON
		echo json_encode($data);
	}

	public function updateQueryWOReO()
	{
		// Get the posted month and year values
		$selected_month = $this->input->post('month') ? $this->input->post('month') : date('n');
		$selected_year = $this->input->post('year') ? $this->input->post('year') : date('Y');
		$opco_type = $this->input->post('opco');
		// $user = $this->session->userdata('nova_id');
		// $user_role = $this->session->userdata('user_role');
		// if ($user_role == 'Admin' or $user_role == 'Director' or $user_role == 'BUH') {
		if ($opco_type == 'ALLOPCOS') {
			$query = $this->db->query("SELECT o.opco_name, (i.app_issue_count + i.fun_issue_count + i.data_issue_count + i.plat_issue_count + i.NFR_issue_count + i.tec_issue_count + i.3pp_issue_count + i.clar_issue_count + i.no_fcr_count + i.process_gap_count + i.know_gap_count + i.service_request_count) as count, i.app_issue_count, i.fun_issue_count, i.data_issue_count, i.plat_issue_count, i.NFR_issue_count, i.tec_issue_count, i.3pp_issue_count, i.clar_issue_count, i.no_fcr_count, i.process_gap_count, i.know_gap_count, i.service_request_count FROM opcos_list o INNER JOIN work_order_summary i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year");
		} else if (is_numeric($opco_type)) {
			$query = $this->db->query("SELECT o.opco_name, SUM(i.app_issue_count + i.fun_issue_count + i.data_issue_count + i.plat_issue_count + i.NFR_issue_count + i.tec_issue_count + i.3pp_issue_count + i.clar_issue_count + i.no_fcr_count + i.process_gap_count + i.know_gap_count + i.service_request_count) as count, SUM(i.app_issue_count)AS app_issue_count, SUM(i.fun_issue_count)AS fun_issue_count, SUM(i.data_issue_count)AS data_issue_count, SUM(i.plat_issue_count)AS plat_issue_count, SUM(i.NFR_issue_count)AS NFR_issue_count, SUM(i.tec_issue_count)AS tec_issue_count, SUM(i.3pp_issue_count)AS 3pp_issue_count, SUM(i.clar_issue_count)AS clar_issue_count, SUM(i.no_fcr_count)AS no_fcr_count, SUM(i.process_gap_count)AS process_gap_count, SUM(i.know_gap_count)AS know_gap_count, SUM(i.service_request_count)AS service_request_count FROM opcos_list o INNER JOIN work_order_summary i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year and o.id = $opco_type");
		}
		// 	 else {
		// 		$query = $this->db->query("SELECT o.opco_name, (i.app_issue_count + i.fun_issue_count + i.data_issue_count + i.plat_issue_count + i.NFR_issue_count + i.tec_issue_count + i.3pp_issue_count + i.clar_issue_count + i.no_fcr_count + i.process_gap_count + i.know_gap_count + i.service_request_count) as count, i.app_issue_count, i.fun_issue_count, i.data_issue_count, i.plat_issue_count, i.NFR_issue_count, i.tec_issue_count, i.3pp_issue_count, i.clar_issue_count, i.no_fcr_count, i.process_gap_count, i.know_gap_count, i.service_request_count FROM opcos_list o INNER JOIN work_order_summary i ON o.id = i.opcos_list_id WHERE i.month_number = $selected_month AND i.year = $selected_year and o.opco_type = $opco_type");
		// 	}
		// } else {
		// 	$query = $this->db->query("SELECT o.opco_name, (i.app_issue_count + i.fun_issue_count + i.data_issue_count + i.plat_issue_count + i.NFR_issue_count + i.tec_issue_count + i.3pp_issue_count + i.clar_issue_count + i.no_fcr_count + i.process_gap_count + i.know_gap_count + i.service_request_count) as count, i.app_issue_count, i.fun_issue_count, i.data_issue_count, i.plat_issue_count, i.NFR_issue_count, i.tec_issue_count, i.3pp_issue_count, i.clar_issue_count, i.no_fcr_count, i.process_gap_count, i.know_gap_count, i.service_request_count FROM opcos_list o INNER JOIN work_order_summary i ON o.id = i.opcos_list_id join user_opco uo on uo.opco_name = o.opco_name WHERE i.month_number = $selected_month AND i.year = $selected_year and uo.nova_id = '$user'");
		// }

		$rows = $query->result_array();

		// Prepare the data array for the response
		$data = [];
		foreach ($rows as $row) {
			$data[] = [
				$row['opco_name'],
				(int)$row['count'],
				(int)$row['app_issue_count'],
				(int)$row['fun_issue_count'],
				(int)$row['data_issue_count'],
				(int)$row['plat_issue_count'],
				(int)$row['NFR_issue_count'],
				(int)$row['tec_issue_count'],
				(int)$row['3pp_issue_count'],
				(int)$row['clar_issue_count'],
				(int)$row['no_fcr_count'],
				(int)$row['process_gap_count'],
				(int)$row['know_gap_count'],
				(int)$row['service_request_count'],
			];
		}

		// Return the updated query result as JSON
		echo json_encode($data);
	}




	// Drop Dwon data for single opco

	// public function updateQueryISLid()
	// {
	// 	// Get the posted month and year values
	// 	$selected_month = $this->input->post('month') ? $this->input->post('month') : date('n');
	// 	$selected_year = $this->input->post('year') ? $this->input->post('year') : date('Y');
	// 	//$opco_type = $this->input->post('opco') ? $this->input->post('opco'): date('') ;	

	// 	// Update the query with the new parameters
	// 	$query = $this->db->query("SELECT o.opco_name, s1_incidents_count + i.s2_incidents_count + i.s3_incidents_count + i.s4_incidents_count 
	// 			as count, i.s1_incidents_count, i.s2_incidents_count, i.s3_incidents_count, i.s4_incidents_count 
	// 			FROM incidents_summary i JOIN opcos_list o ON o.id = i.opcos_list_id 
	// 			WHERE i.month_number = $selected_month AND i.year = $selected_year and o.id = 77;");
	// 	$rows = $query->result_array();

	// 	// Prepare the data array for the response
	// 	$data = [];
	// 	foreach ($rows as $row) {
	// 		$data[] = [
	// 			$row['opco_name'],
	// 			(int)$row['count'],
	// 			(int)$row['s1_incidents_count'],
	// 			(int)$row['s2_incidents_count'],
	// 			(int)$row['s3_incidents_count'],
	// 			(int)$row['s4_incidents_count']
	// 		];
	// 	}

	// 	// Return the updated query result as JSON
	// 	echo json_encode($data);
	// }



	public function get_chart_data()
	{
		$this->load->model('chart_model');
		$chart_data = $this->chart_model->getChartData();

		echo json_encode(array('chart_data' => $chart_data));
	}

	public function index()
	{
		$data = array();
		$data['ticketsCount'] = $this->ind_model->getIncidentsTicketsCount(date("Y"));
		$this->load->view('index', $data);
	}

	public function index2()
	{
		$data2 = array();
		$data2['woTicketsCount'] = $this->ind_model->getWorkordersTicketsCount(date("Y"));
		$this->load->view('index', $data2);
	}

	public function getIncidentsCount()
	{
		$opco = $_POST['opco'];
		if ($opco == -1) {
			$all_opcos = $this->report->getAllOpcosDetails();
		} else {
			$all_opcos = $this->report->getSingleOpcosDetails('opco');
		}
		$data = $this->ind_model->getIncidentsCount();
		// echo "<pre>";print_r($data);die();
		$monthsArray = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
		$temp = 0;
		for ($i = 0; $i < sizeof($all_opcos); $i++) {
			for ($j = 0; $j < sizeof($monthsArray); $j++) {
				for ($k = 0; $k < sizeof($data); $k++) {
					if ($data[$k]['opcos_list_id'] == $all_opcos[$i]['id'] && $data[$k]['month_number'] == $monthsArray[$j]) {
						$temp = $data[$k][$_POST['columnName']];
					}
				}
				$incidentsCount[$j] = $temp;
				$temp = 0;
			}
			$incidentsCountFinal[$i] = array(
				'opco_name' => $all_opcos[$i]['opco_shortname'],
				'counts' => $incidentsCount
			);
		}
		echo json_encode($incidentsCountFinal);
	}

	public function getServiceRequestCount()
	{
		$all_opcos = $this->report->getAllOpcosDetails();
		$data = $this->ind_model->getServiceRequestCount();
		// echo "<pre>";print_r($data);die();
		$monthsArray = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
		$temp = 0;
		for ($i = 0; $i < sizeof($all_opcos); $i++) {
			for ($j = 0; $j < sizeof($monthsArray); $j++) {
				for ($k = 0; $k < sizeof($data); $k++) {
					if ($data[$k]['opcos_list_id'] == $all_opcos[$i]['id'] && $data[$k]['month_number'] == $monthsArray[$j]) {
						$temp = $data[$k][$_POST['columnName']];
					}
				}
				$serviceRequestCount[$j] = $temp;
				$temp = 0;
			}
			$serviceRequestCountFinal[$i] = array(
				'opco_name' => $all_opcos[$i]['opco_shortname'],
				'counts' => $serviceRequestCount
			);
		}
		echo json_encode($serviceRequestCountFinal);
	}

	public function billingDetails()
	{
		$data = array();
		$this->load->view('billingDetails');
	}

	public function dataEntry()
	{
		$data = array();
		$this->load->view('dataentry', $data);
	}

	public function additionalDataEntry()
	{
		$data = array();
		$this->load->view('additionalDataEntry', $data);
	}

	public function getOpcoDetails()
	{
		$data = $this->ind_model->getOpcoDetails();
		echo json_encode($data);
	}

	public function submitData()
	{
		$data = $this->ind_model->submitData();
		// echo "<pre>";print_r($_POST);die();
		redirect('indexController/dataEntry');
	}

	public function autoDBdeleteData()
	{
		$data = $this->ind_model->deleteData();
		redirect('indexController/');
	}

	public function submitAdditionalData()
	{
		$data = $this->ind_model->submitAdditionalData();
		redirect('indexController/additionalDataEntry');
	}

	public function getBillCyclePeriods()
	{
		$data = $this->ind_model->getBillCyclePeriods();
		echo json_encode($data);
	}

	public function getDashboardsGraphsData()
	{
		$data['automation'] = $this->ind_model->getDashboardsGraphsData('automation_count', 'automation_dashboard_master');
		$data['km'] = $this->ind_model->getDashboardsGraphsData('km_count', 'km_dashboard_master');
		$data['oi'] = $this->ind_model->getDashboardsGraphsData('oi_count', 'oi_dashboard_master');
		$data['si'] = $this->ind_model->getDashboardsGraphsData('si_count', 'si_dashboard_master');
		// echo '<pre>';print_r($data);die();
		echo json_encode($data);
	}

	//public function getAlreadyFilledData()
	//{
	//	$data['incidents_summary'] = $this->ind_model->getIncidentSummaryTableData();
	//	$data['service_request_summary'] = $this->ind_model->getServiceRequestSummaryTableData();
	//	$data['repeat_ticket_details'] = $this->ind_model->getrepeatTicketDetailsTableData();
	//	$data['report_summary'] = $this->ind_model->getReportSummaryTableData();
	//	$data['automation_dashboard'] = $this->ind_model->getAutomationDashboardTableData();
	//	$data['km_dashboard'] = $this->ind_model->getKMDashboardTableData();
	//	$data['si_dashboard'] = $this->ind_model->getSIDashboardTableData();
	//	$data['oi_dashboard'] = $this->ind_model->getOIDashboardTableData();
	//	$data['buiseness_kpi_dashboard'] = $this->ind_model->getKPIDashboardTableData();
	//	$data['incident_count_by_group'] = $this->ind_model->getIncResolvedByGroupTableData();
	//	$data['workorder_count_by_group'] = $this->ind_model->getWoResolvedByGroupTableData();
	//	$data['work_order_summary'] = $this->ind_model->getWorkorderSummaryTableData();
	//	$data['incidents_reason'] = $this->ind_model->getincidentReasonTableData();
	//	echo json_encode($data);
	//}

	public function addNewOpco()
	{
		$data = $this->ind_model->insertNewOpcoData();
		$opcoCode = $data['opco_code'];
		echo json_encode($opcoCode);
		echo $data;
	}

	public function addNewUser()
	{
		$data = $this->ind_model->insertNewUserData();
	}



	public function searchUser()
	{
		$search_query = $this->input->post('search_query');
		$data['user_details'] = $this->ind_model->search_user_details($search_query);

		// Load the view with data (without rendering the whole page, just return the view content)
		$content = $this->load->view('UserDetails', $data, true);

		// Return the content as JSON response
		$this->output->set_content_type('application/json')->set_output(json_encode(['content' => $content]));
	}


	public function loadDynamicContent()
	{
		// Load the model
		$this->load->model('ind_model');

		// Get data from the database
		$data['user_details'] = $this->ind_model->get_user_details();

		// Load the view with data (without rendering the whole page, just return the view content)
		$content = $this->load->view('UserDetails', $data, true);

		// Return the content as JSON response
		$this->output->set_content_type('application/json')->set_output(json_encode(['content' => $content]));
	}
}
