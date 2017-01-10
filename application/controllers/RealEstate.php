<?php
class RealEstate extends CI_Controller {

    public function index($page = 'QualificationSelection')
    {
        if ( ! file_exists(APPPATH.'views/Forms/Real Estate/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('Constants/header', $data);
        $this->load->view('Forms/Real Estate/navigation', $data);
        $this->load->view('Forms/Real Estate/QualificationSelection', $data);
        $this->load->view('Forms/Real Estate/QualificationRecognition', $data);
        $this->load->view('Constants/footer', $data);
    }

}
