<?php

class History_Controller extends My_Controller {
    
    public function listing($studentId = NULL) {
        
        if($studentId)
            $_GET['filter']['student_id'] = $studentId;
        
        $this->load->model('task');
        $this->view_data['tasks'] = $this->task->loadCollection();
        
        $this->load->model('student');
        
        if(!$studentId)
            $this->view_data['students'] = $this->student->loadCollection();
        else
            $this->view_data['students'] = array($this->student->load($studentId));
        
        parent::listing();
    }
    
    public function edit($id = NULL, $studentId = NULL) {
        
        $this->load->model('task');
        $this->view_data['tasks'] = $this->task->loadCollection();
        
        $this->load->model('student');
        
        if(!$studentId)
            $this->view_data['students'] = $this->student->loadCollection();
        else
            $this->view_data['students'] = array($this->student->load($studentId));
        
        parent::edit($id);
        
        if($this->input->{$this->method}())
        {
            //Updating the student points
            $curStudent = new Student();
            $curStudent->load($this->input->{$this->method}('studentId'));
            
            $curTask = new Task();
            $curTask->load($this->input->{$this->method}('taskId'));
            
            $curStudent->setPoints($curStudent->getPoints() + $curTask->getReward());
            $curStudent->save();
        }
    }
}