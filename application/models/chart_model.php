<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart_model extends CI_Model {

  public function getChartData() {
    $query = $this->db->query("
      SELECT opcos_list.opco_name, MONTH(date_of_outage) AS month, COUNT(description) AS count
      FROM incidents_outages
      INNER JOIN opcos_list ON incidents_outages.opcos_list_id = opcos_list.id
      WHERE date_of_outage >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
      GROUP BY opcos_list.opco_name, MONTH(date_of_outage)
      ORDER BY opcos_list.opco_name, MONTH(date_of_outage)
    ");

    return $query->result();
  }

}
