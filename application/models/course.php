<?php

class Course extends My_Model {
    
    
    public function loadRanking($id, $type = 'day')
    {
        $this->load->model('student');
        $this->load->model('history');
        
        $this->load($id);
        
        $student = new Student();
        $student->addFilters(array(
            'course_id' => $id
        ));
        $student->loadCollection();
        
        $history = new History();
        if($type == 'course')
            $history->loadSinceSum($this->getStartDate());
        else
            $history->loadLastSum($type);

        $ranking = array();
        foreach($history->getCollection() as $rank)
        {
            $ranking[$rank->getStudentId()] = new Student();
            $ranking[$rank->getStudentId()]->setPoints($rank->getPoints());
        }

        foreach($student->getCollection() as $st)
        {
            if(isset($ranking[$st->getId()]))
                $ranking[$st->getId()]->setData(array(
                    'id' => $st->getId(),
                    'num' => $st->getNum(),
                    'name' => $st->getName(),
                    'specialty' => $st->getSpecialty(),
                    'group' => $st->getGroup()
                ));
            else
            {
                $ranking[$st->getId()] = new Student();
                $ranking[$st->getId()]->setData(array(
                    'id' => $st->getId(),
                    'num' => $st->getNum(),
                    'name' => $st->getName(),
                    'specialty' => $st->getSpecialty(),
                    'group' => $st->getGroup(),
                    'points' => 0,
                ));
            }
        }
        
        foreach($ranking as $key => $rank)
            if(!$rank->getId())
                unset($ranking[$key]);

        return $ranking;
    }
    
    public function loadOveralls($id, $type = 'day')
    {
        $ranking = $this->loadRanking($id, $type);
        $overalls = array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'max' => 0,
            'min' => -1,
            'avg' => 0
        );
        
        $i = 0;
        foreach($ranking as $rank)
        {
            if($overalls['max'] < $rank->getPoints())
                $overalls['max'] = $rank->getPoints();
            if($overalls['min'] == -1 || $overalls['min'] > $rank->getPoints())
                $overalls['min'] = $rank->getPoints();
             $overalls['avg'] += $rank->getPoints();
             $i++;
        }
        
        if($overalls['min'] == -1)
            $overalls['min'] = 0;
        
        if($i)
            $overalls['avg'] /= $i;
        
        $this->setMaxPoints($overalls['max']);
        $this->setMinPoints($overalls['min']);
        $this->setAvgPoints($overalls['avg']);
        return $this;
    }
}
