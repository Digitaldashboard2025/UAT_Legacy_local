<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class IndexController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('IndexModel', 'ind_model');
        $this->load->model('ReportsModel', 'report');
        $this->load->library('form_validation');
    }

    public function dashboard() {
        $data = array();
        $this->load->view('MsoMonthlyReview/dashboard',$data);
    }

    public function draggableDashboard() {
        $data = array();
        $this->load->view('draggableDashboard', $data);
    }
    public function Testing() {
        $data = array();
        $this->load->view('Testing', $data);
    }

public function AdminView() {
        $data = array();
        $this->load->view('AdminView', $data);
    }
    public function About_us() {
        $data = array();
        $this->load->view('About_us', $data);
    }


}

