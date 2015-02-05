<?php

class Time {
    
    protected $now = NULL;
    
    public function init()
    {
        $this->now = time();
    }
    
    public function startOf($type = 'day')
    {
        $func = '_startOf'.ucfirst($type);
        return unix_to_human($this->{$func}(), TRUE, "eu");
    }
    
    public function getString($type = 'day')
    {
        $str = '';
        switch($type)
        {
            case 'hour': $str = 'За последния час';break;
            case 'day': $str = 'За последния ден';break;
            case 'week': $str = 'За последния седмица';break;
            case 'month': $str = 'За последния месец';break;
            case 'course': $str = 'За курса';break;
        }
        
        return $str;
    }
    
    protected function _startOfHour()
    {
        if(!$this->now)
            $this->init();

        return $this->now - 60*60;
    }
    
    protected function _startOfDay()
    {
        if(!$this->now)
            $this->init();
        
        return strtotime('midnight', $this->now);
    }
    
    protected function _startOfWeek()
    {
        if(!$this->now)
            $this->init();

        if(date('w', $this->now) == 1)
            return $this->_startOfDay();
        
        return strtotime('last monday', $this->now);
    }
    
    protected function _startOfMonth()
    {
        if(!$this->now)
            $this->init();

        return strtotime('midnight', strtotime('first day of this month', $this->now)); 
    }
}
