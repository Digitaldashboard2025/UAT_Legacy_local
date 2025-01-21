<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}

	public function index()
	{
		$this->load->view('login_view');
	}

	public function do_login()
	{
		
		// // Load the database library
		// $this->load->database();

		// // Get the user input
		// $username = $this->input->post('username');
		// $password = $this->input->post('password');

		// // Query the database for the user
		// $query = $this->db->get_where('user_details', array('nova_id' => $username, 'user_password' => $password));

		// // Check if the user exists
		// if ($query->num_rows() > 0) {
		// 	// Set session data for the logged-in user
		// 	$user = $query->row();
		// 	$user_data = array(
		// 		'emp_id' => $user->emp_id,
		// 		'nova_id' => $user->nova_id,
		// 		'user_role' => $user->user_role,
		// 		'read_permission' => $user->read_permission,
		// 		'write_permission' => $user->write_permission,
		// 		'logged_in' => TRUE
		// 	);
		// 	$this->session->set_userdata($user_data);
		// 	// Login success, redirect to the index page

		// 	redirect('IndexController');
		// } else {
		// 	// Login failed, show an error message
		// 	//$this->session->unset_userdata('error');
		// 	$this->session->set_flashdata('error', 'Invalid username or password');
		// 	redirect('login');
		// }
		//*************************************************************************************************8
		// Get the user input
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$ldap_url = "ldap://esdc7.NOVA.LOCAL";
		$ldap_user_dn = "tt.customersmtool@tecnotree.com";
		$ldap_password = "Password@2023!@";
		$ldap_port = "636";
		$ldap_version = 3; // Change this to your LDAP server version

		$ldap_conn = ldap_connect($ldap_url, $ldap_port);

		if (!$ldap_conn) {
			exit("Could not connect to LDAP server.");
		}

		ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, $ldap_version);

		$bind_result = ldap_bind($ldap_conn, $ldap_user_dn, $ldap_password);

		if ($bind_result) {

			$login = ldap_bind($ldap_conn, "$username@NOVA.LOCAL", $password);

			if ($login) {
				session_start();
				$_SESSION['login'] = $login;
				redirect('IndexController');
			} else {

				// Login failed, show an error message
				//$this->session->unset_userdata('error');
				$this->session->set_flashdata('error', 'Invalid username or password');
				redirect('login');
				// echo "Unable to bind to server: " . ldap_error($ldap_conn);
			}

			ldap_close($ldap_conn);
		}
	}

	public function logout()
	{
		//$this->session->unset_userdata('error');
		$this->session->sess_destroy();
		redirect('login');
	}
}
