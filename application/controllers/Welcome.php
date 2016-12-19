<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($page = 'GeneralDetails')
	{
        $data['title'] = ucfirst($page);
        
        $this->load->view('Login/Login', $data);
        
        /*$this->load->view('Constants/header', $data);
        $this->load->view('Forms/Training Agreement/Navigation', $data);
		$this->load->view('Forms/Training Agreement/GeneralDetails');
        $this->load->view('Forms/Training Agreement/Ethnicity', $data);
        $this->load->view('Forms/Training Agreement/ContactDetails', $data);
        $this->load->view('Forms/Training Agreement/EmployerInformation', $data);
        $this->load->view('Forms/Training Agreement/Education', $data);
        $this->load->view('Forms/Training Agreement/LearningSkills', $data);
        $this->load->view('Forms/Training Agreement/Identity', $data);
        $this->load->view('Forms/Training Agreement/Terms', $data);
        $this->load->view('Constants/footer', $data);
        
        /*$this->load->view('Constants/header', $data);
        $this->load->view('Forms/Real Estate/navigation', $data);
        $this->load->view('Forms/Real Estate/QualificationSelection', $data);
        $this->load->view('Forms/Real Estate/QualificationRecognition', $data);
        $this->load->view('Constants/footer', $data);*/
	}
}
