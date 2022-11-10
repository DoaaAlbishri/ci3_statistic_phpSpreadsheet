<?php
class Pages extends CI_Controller {
// method view to set title and load page to view.
        public function view($page = 'home')
        {
            $data['title'] = $page;
            $this->load->view('tamplates/header.php',$data);
            $this->load->view('pages/'. $page,$data);
            $this->load->view('tamplates/footer.php',$data);
        }
}