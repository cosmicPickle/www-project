<?php

class History extends My_Model {
    
    
    public function loadLast($type = 'day')
    {
        $this->addFilters(array(
            'date>' => $this->time->startOf($type)
        ));
        $this->addOrder('date','desc');
        return $this->loadCollection();
    }
    
    public function loadSince($date)
    {
        $this->addFilters(array(
            'date>' => $date
        ));
        $this->addOrder('date','desc');
        return $this->loadCollection();
    }
    
    public function loadLastSum($type = 'day')
    {
        $this->db->select('*, SUM((SELECT reward FROM task WHERE task.id = history.task_id)) as points');
        $this->db->group_by('student_id');
        $this->addFilters(array(
            'date>' => $this->time->startOf($type)
        ));
        $this->addOrder('points', 'desc');
        return $this->loadCollection();
    }
    
    public function loadSinceSum($date)
    {
        $this->db->select('*, SUM((SELECT reward FROM task WHERE task.id = history.task_id)) as points');
        $this->db->group_by('student_id');
        $this->addFilters(array(
            'date>' => $date
        ));
        $this->addOrder('points', 'desc');
        return $this->loadCollection();
    }
}
