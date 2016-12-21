<?php
class Forms extends CI_Controller {

    public function view($page = 'ContactDetails')
    {
        /*if ( ! file_exists(APPPATH.'views/Forms/Training Agreement/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }*/

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('welcome_message');

        $this->load->view('Constants/header', $data);
        $this->load->view('Forms/Navigation', $data);
        $this->load->view('Forms/Training Agreement/ContactDetails', $data);
        $this->load->view('Forms/Training Agreement/ProofIdentity', $data);
        $this->load->view('Forms/Training Agreement/Terms', $data);
        $this->load->view('Forms/Training Agreement/TraineeInformation', $data);
        $this->load->view('Constants/footer', $data);
    }

}
