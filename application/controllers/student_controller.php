<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_Controller extends My_Controller {
        
    public function edit($id = NULL) {
        
        $this->load->model('course');
        $this->view_data['courses'] = $this->course->loadCollection();
        
        parent::edit($id);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */