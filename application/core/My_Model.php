<?php

class My_Model extends CI_Model {

    protected $primaryField = 'id';
    protected $table = "";
    protected $fields = array();
    protected $data = NULL;
    
    protected $collection = array();
    
    public function __construct()
    {
        if(get_class($this) != "My_Model")
        {
            if(!$this->table)
            $this->table = strtolower (get_class($this));

            $this->fields = $this->db->list_fields($this->table);
            $this->data = new stdClass();
            
            foreach($this->fields as $field)
                $this->data->{$field} = NULL;
        }
        
        parent::__construct();
    }
    
    public function __call($name, $args) {
        
        $matches = array();
        
        if(preg_match("#set(.*)#", $name, $matches))
        {
            $property = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $matches[1]));
            
            if($property == 'data' && is_array($args[0]))
                foreach($args[0] as $key => $val)
                    $this->data->{$key} = $val;
            
            if(isset($args[0]))
                $this->data->{$property} = $args[0];
            
            return $this->data->{$property};
        }
        
        if(preg_match("#get(.*)#", $name, $matches))
        {
            $property = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $matches[1]));
            
            if($property == 'data')
            {
                return $this->data;
            }
            
            if(isset($this->{$property}))
                return $this->{$property};
                
            return $this->data->{$property};
        }
    }
    
    public function load($id) {
       $result = $this->db->where($this->primaryField, $id)
                          ->get($this->table)
                          ->row(get_class($this));
       $this->_fill($result);
       return $this;
    }
    
    public function save()
    {
        $data = (array)$this->data;
            
        foreach($data as $key => $item)
            if($item == NULL)
                unset($data[$key]);
                
        if($this->_checkAvailable())
        {
            $this->db->where($this->primaryField, $this->data->{$this->primaryField});  
            $this->db->update($this->table, $data);
        }
        else
        {
            $this->db->insert($this->table, $data);
        }
    }
    
    public function delete()
    {
         if($this->_checkAvailable())
         {
             $this->db->where($this->primaryField, $this->data->{$this->primaryField});
             $this->db->delete($this->table);
         }
    }

    public function addFilters($data)
    {
        $this->db->where($this->_parseWhere($data));
    }
    
    public function addOrder($field, $dir = 'asc')
    {
        $this->db->order_by($field, $dir);
    }
    
    public function addLimit($count, $offset = NULL)
    {
        $this->db->limit($count, $offset);
    }
    
    public function loadCollection()
    {
        $collection = $this->db->get($this->table)->result();
        
        foreach($collection as $item)
        {
            $class = get_class($this);
            $this->_fill($item, $this->collection[] = new $class());
        }
        
        return $this->getCollection();
    }
    
    public function getCollection()
    {
        return $this->collection;
    }
    
    protected function _fill($result, $obj = NULL)
    {
        foreach($result as $key => $value)
        {
            $func = "set".ucfirst($key);
            
            if(!$obj)
                $this->$func($value);
            else
                $obj->$func($value);
        }
    }
    
    protected function _checkAvailable()
    {
        if(!$this->data->{$this->primaryField})
            return FALSE;
        
        $check = $this->db->where($this->primaryField, $this->data->{$this->primaryField})
                          ->get($this->table)->row();
        
        if(!$check)
            return FALSE;
        
        return TRUE;
    }
    
 /**
  * _parseWhere function
  *
  * This is a recursive array parser. It recognises the following keys:
  *
  * key => val        equals to (AND) key = val <br/>
  * key>|<|! => val   equals to (AND) key >|<|!= val <br/>
  * key% => val       equals tp (AND) key LIKE %val% <br/>
  * !key => val       equals to (OR)  key = val <br/>
  * key-in => array() equals to       key IN (array()) <br/>
  * key => array()    equals to (AND) (recusrsion on array()) <br/>
  * !key => array()   equals to (OR)  (recusrsion on array()) <br/>
  *
  * <b> example: </b> <br/>
  *
  * array(<br/>
  *      key1>  => val1<br/>
  *      !key2% => val2<br/>
  *      !sub1  => array(<br/>
  *          key3!  => val3<br/>
  *          key4< => val4<br/>
  *      )<br/>
  * )<br/>
  *
  * <b> equals to: </b> <br/>
  *
  * WHERE key1 > val1 OR key2 LIKE val2 OR (key3 != val3 AND key4 = val4)
  *
  * @param array the where data
  * @return string the parsed where string
  */
    protected function _parseWhere($data)
    {
         //This as the array that will contain all conditions
         $conds = array();

         //Cycling through the data
         foreach($data as $key => $val)
         {
             //The index of the current condition
             $index = count($conds);

             //If this is an array we have to process it recursively
             if(is_array($val))
             {
                 //We evaluate to see if it is an "IN" request
                 if(preg_match('#^([a-zA-Z0-9_\.]*)-(!)?in$#', $key, $matches))
                 {
                     //Escaping the values
                     foreach($val as &$v)
                         $v = mysql_real_escape_string(urldecode($v));
                     
                     $conds[$index] = $matches[1] . (isset($matches[2]) ? " NOT" : NULL) . " IN ('" . implode("','", $val) . "')";
                 }
                 else if($val)
                     //Recursion
                     $conds[$index] = "(" . $this->_parse_where ($val) . ')';

                 //Are there previous conditions ?
                 if($index > 0)
                     if(preg_match('#^!.*#', $key))
                         //If the key starts with a '!' then we need to add an OR
                         $conds[$index] = "OR " . $conds[$index];
                     else
                         //Otherwise - AND
                         $conds[$index] = "AND " . $conds[$index];    
             }
             else
             {
                 //The values are automatically sanitized, but let's check the
                 //key. The regex matches: table.val OR (!)table.val(<|>|!|%)
                 if(!preg_match('#^(([a-zA-Z0-9_\.]*)|((![a-zA-Z0-9_\.]*|[a-zA-Z0-9_\.]*)(>|<|!|%)))$#', $key))
                     continue;

                 $conds[$index] = '';

                 if(preg_match('#^!.*#', $key))
                 {    
                     //Are there previous conditions ?
                     if($index > 0)
                         //If the key starts with a '!' then we need to add an OR
                         $conds[$index] .= "OR ";

                     $key = substr($key,1);
                 }
                 else
                     if($index > 0)
                         //Otherwise - AND
                         $conds[$index] .= "AND ";  


                 //Next we check for an expression
                 if(preg_match('#^(![a-zA-Z0-9_\.]*|[a-zA-Z0-9_\.]*)(>|<|!|%)$#',$key,$matches))
                 {      
                      $key = str_replace($matches[2], '', $key);
                      if($matches[2] == "%")
                      {
                          $val = "%".mysql_real_escape_string($val)."%";
                          $conds[$index] .= $key. " LIKE '".$val."'";
                      }
                      elseif($matches[2] == "!")
                          $conds[$index] .= $key. " != '".mysql_real_escape_string(urldecode($val))."'";
                      else
                          $conds[$index] .= $key . " ".$matches[2]." '".mysql_real_escape_string(urldecode($val))."'";
                 }    
                 else
                     $conds[$index] .= $key . " = '".mysql_real_escape_string(urldecode($val))."'";
             }
         }
         
         return implode(" ",$conds);
    }
}