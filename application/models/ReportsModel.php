<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ReportsModel extends CI_Model {

    public function getAllOpcosTypeBased($opco_type) {
        $this->db->select('*');
        $this->db->from('opcos_list');
        $this->db->where('opco_type',$opco_type);
        return $this->db->get()->result_array();
    }

    public function getSingleOpcoTeamSizeDetails($opco_id,$year,$month){
        $this->db->select('*');
        $this->db->from('team_size');
        $this->db->where('opcos_list_id',$opco_id);
        $this->db->where('month_number',$month);
        $this->db->where('year',$year);
        return $this->db->get()->result();
    }

    public function getSingleOpcoEUPDetails($opco_id,$year,$month){
        $this->db->select('*');
        $this->db->from('eup_details');
        $this->db->where('opcos_list_id',$opco_id);
        $this->db->where('month_number',$month);
        $this->db->where('year',$year);
        return $this->db->get()->result();
    }

    public function getSingleOpcoEscalationsDetails($opco_id,$year,$month){
        $this->db->select('*');
        $this->db->from('ongoing_escalations');
        $this->db->where('opcos_list_id',$opco_id);
        $this->db->where('month_number',$month);
        $this->db->where('year',$year);
        return $this->db->get()->result();
    }

    public function getSingleOpcoCommentsDetails($opco_id,$year,$month){
        $this->db->select('*');
        $this->db->from('comments_details');
        $this->db->where('opcos_list_id',$opco_id);
        $this->db->where('month_number',$month);
        $this->db->where('year',$year);
        return $this->db->get()->result();
    }

    public function getTicketsSummaryData($tableName,$select_items,$opcoId,$lastThreeMonths) {
        $prevThreeYearsMonths = array_reverse($lastThreeMonths[0]);
        $prevThreeYears = array_reverse($lastThreeMonths[1]);
        $prevThreeMonths = array_reverse($lastThreeMonths[2]);
        for($i=0;$i<sizeof($prevThreeMonths);$i++) {
            $this->db->select($select_items);
            $this->db->from($tableName);
            $this->db->where('opcos_list_id',$opcoId);
            $this->db->where('month_number',$prevThreeMonths[$i]);
            $this->db->where('year',$prevThreeYears[$i]);
            $summary_data[$prevThreeYearsMonths[$i]] = $this->db->get()->row();
        }
        return $summary_data;
    }

    public function getAllOpcosDetails() {
        $this->db->select('*');
        $this->db->from('opcos_list');
        $this->db->where('id <', 500);
        return $this->db->get()->result_array();
    }
    public function getSingleOpcosDetails() {
        $this->db->select('*');
        $this->db->from('opcos_list');
        $this->db->where('id',$_POST['opco']);
        return $this->db->get()->result_array();
    }

    public function getDashboardsData($table,$year) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('opcos_list ol','ol.id=obj.opcos_list_id');
        $this->db->where('obj.year',$year);
        return $this->db->get()->result_array();
    }

    public function getBillRunStatusDigitalOpcos($month,$year) {
        $this->db->select('*');
        $this->db->from('bill_run_status brs');
        $this->db->join("opcos_list ol","ol.id=brs.opcos_list_id and ol.opco_type='DIGITAL'");
        $this->db->where('brs.year',$year);
        $this->db->where('brs.month_number',$month);
        return $this->db->get()->result_array();
        // echo "<pre>";print_r($this->db->last_query());die();
    }

    public function getBillRunStatusLegacyMTNlOpcos($month,$year) {
        $this->db->select('*');
        $this->db->from('bill_run_status brs');
        $this->db->join("opcos_list ol","ol.id=brs.opcos_list_id and ol.opco_type='LEGACY' and ol.opco_group='MTN'");
        $this->db->where('brs.year',$year);
        $this->db->where('brs.month_number',$month);
        return $this->db->get()->result_array();
        // $this->db->get()->result_array();
        // echo "<pre>";print_r($this->db->last_query());die();
    }

    public function getBillRunStatusLegacyNonMTNDigitalOpcos($month,$year) {
        $this->db->select('*');
        $this->db->from('bill_run_status brs');
        $this->db->join("opcos_list ol","ol.id=brs.opcos_list_id and ol.opco_type='LEGACY' and ol.opco_group='NON-MTN'");
        $this->db->where('brs.year',$year);
        $this->db->where('brs.month_number',$month);
        return $this->db->get()->result_array();
    }

    public function getReportSummaryDetails($month,$year) {
        $this->db->select('*');
        $this->db->from('report_summary');
        $this->db->where('month_number',$month);
        $this->db->where('year',$year);
        return $this->db->get()->result();
    }

    public function getRepeatTicketDetails($month,$year) {
        $this->db->select('rtd.*,ol.opco_shortname');
        $this->db->from('repeat_ticket_details rtd');
        $this->db->join('opcos_list ol','ol.id=rtd.opcos_list_id');
        $this->db->where('rtd.month_number',$month);
        $this->db->where('rtd.year',$year);
        return $this->db->get()->result();
    }

    public function getIncidentSummaryDetails($year,$opco_type) {
        $this->db->select('*,(is.s1_incidents_count+is.s2_incidents_count+is.s3_incidents_count+is.s4_incidents_count) as inc_count,ROUND(((is.s1_sla_met_count+is.s2_sla_met_count+is.s3_sla_met_count+is.s4_sla_met_count)/(is.s1_incidents_count+is.s2_incidents_count+is.s3_incidents_count+is.s4_incidents_count)*100),2) as sla_met_perc');
        $this->db->from('incidents_summary is');
        $this->db->join('opcos_list ol','ol.id=is.opcos_list_id and ol.opco_type="'.$opco_type.'"','right');
        $this->db->where('is.year',$year);
        $this->db->order_by("is.opcos_list_id", "dsc");
        $this->db->order_by("is.month_number", "dsc");
        return $this->db->get()->result_array();
        // echo "<pre>";print_r($this->db->last_query());die();
    }
}
