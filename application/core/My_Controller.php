<?php

class My_Controller extends CI_Controller {
    
    protected $class;
    protected $method = "post";
    protected $view_data = array();
    
    public function __construct() {
        parent::__construct();
        $this->class = get_class($this);
        $this->api->setModel($this->_classToModel($this->class));
    }

    public function index()
    {
        $this->listing();
    }
    
    public function listing()
    {
        $filters = array();
        if($this->input->get('filter'))
            foreach($this->input->get('filter') as $key => $fr)
                $filters[$key."%"] = $fr;
        
        $order = array();
        if($this->input->get('ord'))
        {
            $dir = $this->input->get('dir') ? $this->input->get('dir') : 'asc';
            $order = array($this->input->get('ord'), $dir);
        }
        
        $p = $this->input->get('p') ? $this->input->get('p') : 1;
        $this->view_data['collection'] = $this->api->read($filters, $order, $p);

        $this->load->view('wrapper', array(
            'content' => $this->load->view($this->_classToModel($this->class)."_listing_view", $this->view_data, TRUE)
        ));
    }
    
    public function edit($id = NULL)
    {
        if($this->input->{$this->method}())
        {
            if(!$id)
                $this->api->create($this->input->{$this->method}());
            else
                $this->api->update($id, $this->input->{$this->method}());
                
            header('Location: '.  base_url() . 'index.php/' . $this->_classToModel($this->class) . '/listing');
        }
        
        $this->view_data['model'] = $this->api->readOne($id);
        
        $this->load->view('wrapper', array(
                'content' => $this->load->view($this->_classToModel($this->class)."_edit_view", $this->view_data, TRUE)
        ));
    }
    
    public function delete($id)
    {
        $this->api->delete($id);
        header('Location: '.  base_url() . 'index.php/' . $this->_classToModel($this->class) . '/listing');
    }
    
    protected function _classToModel($class)
    {
        return strtolower(str_replace('_Controller', '', $class));
    }
            
}

