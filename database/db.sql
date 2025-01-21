CREATE TABLE `incidents_outages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `opcos_list_id` int DEFAULT NULL,
  `month_number` int DEFAULT NULL,
  `year` int DEFAULT NULL,
  `date_of_outage` date DEFAULT NULL,
  `duration` varchar(20) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `cause` varchar(500) DEFAULT NULL,
  `resolution` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `automation_dashboard_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcos_list_id` int(11) NOT NULL,
  `month_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `automation_count` int(11) NOT NULL,
  `add1` varchar(45) DEFAULT NULL,
  `add2` varchar(45) DEFAULT NULL,
  `add3` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `automation_dashboard_child` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `automation_dashboard_id` int(11) NOT NULL,
  `automation_name` varchar(255) DEFAULT NULL,
  `automation_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

CREATE TABLE `automation_dashboard_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcos_list_id` int(11) NOT NULL,
  `month_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `automation_count` int(11) NOT NULL,
  `add1` varchar(45) DEFAULT NULL,
  `add2` varchar(45) DEFAULT NULL,
  `add3` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `bill_cycle_period` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcos_list_id` int(11) NOT NULL,
  `main_bill_cycle_period` varchar(100) NOT NULL,
  `add1` varchar(45) DEFAULT NULL,
  `add3` varchar(45) DEFAULT NULL,
  `add4` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `bill_run_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcos_list_id` int(11) NOT NULL,
  `month_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `main_bill_cycle_period` varchar(45) NOT NULL,
  `main_bill_start_date` date NOT NULL,
  `main_bill_completion_date` date NOT NULL,
  `current_status` varchar(45) NOT NULL,
  `accounts_billed_count` int(11) DEFAULT NULL,
  `service_billed_count` int(11) DEFAULT NULL,
  `processing_time` varchar(45) NOT NULL,
  `invoice_verifcation_time` varchar(45) NOT NULL,
  `total_time` varchar(45) NOT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `add1` varchar(45) DEFAULT NULL,
  `add2` varchar(45) DEFAULT NULL,
  `add4` varchar(45) DEFAULT NULL,
  `add5` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `buiseness_kpi_dashboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcos_list_id` int(11) NOT NULL,
  `month_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `kpi_type` varchar(255) NOT NULL,
  `kpi_value` varchar(45) NOT NULL,
  `add1` varchar(45) DEFAULT NULL,
  `add2` varchar(45) DEFAULT NULL,
  `add3` varchar(45) DEFAULT NULL,
  `add4` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `comments_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcos_list_id` int(11) NOT NULL,
  `month_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `description_type` varchar(45) NOT NULL,
  `add1` varchar(45) NOT NULL,
  `add2` varchar(45) DEFAULT NULL,
  `add3` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `eup_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcos_list_id` int(11) NOT NULL,
  `month_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `overall_health` varchar(45) NOT NULL,
  `pms_efforts` varchar(99) NOT NULL,
  `utilization_perc` varchar(99) NOT NULL,
  `profitability_count` varchar(99) NOT NULL,
  `add2` varchar(45) NOT NULL,
  `add3` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `incidents_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcos_list_id` int(11) NOT NULL,
  `month_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `s1_incidents_count` int(11) NOT NULL,
  `s1_sla_met_count` int(11) NOT NULL,
  `s2_incidents_count` int(11) NOT NULL,
  `s2_sla_met_count` int(11) NOT NULL,
  `s3_incidents_count` int(11) NOT NULL,
  `s3_sla_met_count` int(11) NOT NULL,
  `s4_incidents_count` int(11) NOT NULL,
  `s4_sla_met_count` int(11) NOT NULL,
  `summary_key_findings` varchar(255) DEFAULT NULL,
  `sla_key_findings` varchar(255) DEFAULT NULL,
  `mean_time_to_resolve` varchar(45) NOT NULL,
  `add2` varchar(45) DEFAULT NULL,
  `add3` varchar(45) DEFAULT NULL,
  `add5` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `km_dashboard_child` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `km_dashboard_id` int(11) DEFAULT NULL,
  `km_name` varchar(255) DEFAULT NULL,
  `km_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `km_dashboard_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcos_list_id` int(11) NOT NULL,
  `month_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `km_count` int(11) NOT NULL,
  `add1` varchar(45) DEFAULT NULL,
  `add2` varchar(45) DEFAULT NULL,
  `add3` varchar(45) DEFAULT NULL,
  `add4` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `oi_dashboard_child` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oi_dashboard_id` int(11) DEFAULT NULL,
  `oi_name` varchar(255) DEFAULT NULL,
  `oi_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `oi_dashboard_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcos_list_id` varchar(45) NOT NULL,
  `month_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `oi_count` int(11) NOT NULL,
  `add1` varchar(45) DEFAULT NULL,
  `add2` varchar(45) DEFAULT NULL,
  `add3` varchar(45) DEFAULT NULL,
  `add4` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `ongoing_escalations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcos_list_id` int(11) NOT NULL,
  `month_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `escalation_value` varchar(45) NOT NULL,
  `escalation_details` varchar(255) NOT NULL,
  `escalation_status` varchar(45) NOT NULL,
  `add1` varchar(45) DEFAULT NULL,
  `add2` varchar(45) DEFAULT NULL,
  `add3` varchar(45) DEFAULT NULL,
  `add4` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

CREATE TABLE `opcos_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opco_name` varchar(255) DEFAULT NULL,
  `opco_shortname` varchar(255) DEFAULT NULL,
  `opco_code` varchar(255) DEFAULT NULL,
  `opco_type` varchar(55) DEFAULT NULL,
  `opco_contract_type` varchar(45) DEFAULT NULL,
  `region` varchar(45) DEFAULT NULL,
  `opco_group` varchar(45) DEFAULT NULL,
  `color_code` varchar(45) DEFAULT NULL,
  `add3` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

CREATE TABLE `repeat_ticket_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcos_list_id` varchar(45) NOT NULL,
  `month_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `incident_name` varchar(255) DEFAULT NULL,
  `incident_desc` varchar(255) DEFAULT NULL,
  `incident_resolution` varchar(255) DEFAULT NULL,
  `add1` varchar(45) DEFAULT NULL,
  `add2` varchar(45) DEFAULT NULL,
  `add3` varchar(45) DEFAULT NULL,
  `add4` varchar(45) DEFAULT NULL,
  `add5` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `report_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `summary_desc` varchar(255) NOT NULL,
  `summary_type` varchar(255) NOT NULL,
  `add1` varchar(45) DEFAULT NULL,
  `add3` varchar(45) DEFAULT NULL,
  `add5` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `service_request_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcos_list_id` int(11) NOT NULL,
  `month_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `s1_sr_count` int(11) NOT NULL,
  `s1_sr_sla_met_count` int(11) NOT NULL,
  `s2_sr_count` int(11) NOT NULL,
  `s2_sr_sla_met_count` int(11) NOT NULL,
  `s3_sr_count` int(11) NOT NULL,
  `s3_sr_sla_met_count` int(11) NOT NULL,
  `s4_sr_count` int(11) NOT NULL,
  `s4_sr_sla_met_count` int(11) NOT NULL,
  `summary_key_findings` varchar(255) DEFAULT NULL,
  `sla_key_findings` varchar(255) DEFAULT NULL,
  `mean_time_to_fulfill` varchar(45) NOT NULL,
  `add2` varchar(45) DEFAULT NULL,
  `add3` varchar(45) DEFAULT NULL,
  `add5` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `si_dashboard_child` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `si_dashboard_id` int(11) DEFAULT NULL,
  `si_name` varchar(255) DEFAULT NULL,
  `si_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `si_dashboard_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcos_list_id` varchar(45) NOT NULL,
  `month_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `si_count` int(11) NOT NULL,
  `add1` varchar(45) DEFAULT NULL,
  `add2` varchar(45) DEFAULT NULL,
  `add3` varchar(45) DEFAULT NULL,
  `add4` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `team_size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcos_list_id` int(11) NOT NULL,
  `month_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `onsite_local_count` int(11) NOT NULL,
  `onsite_expat_count` int(11) NOT NULL,
  `offshore_local_count` int(11) NOT NULL,
  `offshore_expat_count` int(11) NOT NULL,
  `add1` varchar(45) DEFAULT NULL,
  `add2` varchar(45) DEFAULT NULL,
  `add3` varchar(45) DEFAULT NULL,
  `add4` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
