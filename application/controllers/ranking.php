<?php

class Ranking extends CI_Controller {
    
    public function index()
    {
        $course = $this->input->get('course');
        $type = $this->input->get('type') ? $this->input->get('type') : 'day';
        
        $this->load->model('course');
        
        $view_data = array(
            'ranking' => $course ? $this->course->loadRanking($course, $type) : NULL,
            'course' => $this->course,
            'courseList' => $this->course->loadCollection(),
            'type' => $type
        );
        
        $this->load->view('wrapper',array(
            'content' => $this->load->view('ranking',$view_data,TRUE)
        ));
    }
    
    public function compare()
    {
        $courses = $this->input->get('courses');
        $type = $this->input->get('type') ? $this->input->get('type') : 'day';
        
        $this->load->model('course');
        $view_data = array(
            'courseList' => $this->course->loadCollection(),
            'type' => $type
        );
        
        if($courses)
            foreach($courses as $course)
            {
                $model = new Course();
                $view_data['overalls'][] = $model->loadOveralls($course, $type);
            }   
            
        $this->load->view('wrapper',array(
            'content' => $this->load->view('compare',$view_data,TRUE)
        ));
    }
}
