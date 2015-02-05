<?php

class Api {
    
    protected $model = NULL;
    protected $rpp = 10;
    
    public function ci()
    {
        $ci = & get_instance();
        return $ci;
    }
    
    public function getRpp()
    {
        return $this->rpp;
    }
    
    public function setModel($model)
    {
        $this->model = $model;
        $this->ci()->load->model($model);
    }
    
    public function create($data)
    {
        $obj = new $this->model;
        
        foreach($data as $key => $value)
        {
            $func = 'set'.$key;
            $obj->{$func}($value);
        }
        $obj->save();
    }
    
    public function update($id, $data)
    {
        $obj = new $this->model();
        $obj->load($id);
        
        foreach($data as $key => $value)
        {
            $func = 'set'.$key;
            $obj->{$func}($value);
        }
        $obj->save();
    }
    
    public function delete($id)
    {
        $obj = new $this->model();
        $obj->load($id);
        
        $obj->delete();
    }
    
    public function read( $filter = NULL, $order = NULL, $page = 1)
    {
        $obj = new $this->model();
        
        if($filter)
            $obj->addFilters($filter);
        
        if($order)
            $obj->addOrder($order[0],$order[1]);
        
        $offset = ($page - 1) * $this->rpp;
        
        $obj->addLimit($this->rpp, $offset);
        return $obj->loadCollection();
    }
    
    public function readOne($id = NULL)
    {
        if(!$id)
            return NULL;
        
        $obj = new $this->model;
        return $obj->load($id);
    }
}

