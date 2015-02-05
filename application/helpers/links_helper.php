<?php

function gen_query_string($data)
{
    $ci = & get_instance();
    $get = $ci->input->get();
    
    $arr = _rec_merge($get, $data);
    return "?".http_build_query($arr);
}

function gen_ord_array($ord)
{
    $ci = & get_instance();
    $arr = array('ord' => $ord, 'dir' => NULL);
    if($ci->input->get('ord') == $ord)
        if($ci->input->get('dir') == 'desc')
            $arr['dir'] = 'asc';
        else
            $arr['dir'] = 'desc';
    else
        $arr['dir'] = 'asc';
    
    return $arr;
}

function icon_order($ord)
{
    $ci = & get_instance();
    if($ci->input->get('ord') == $ord &&
       $ci->input->get('dir') == 'asc')
        return 'glyphicon-chevron-up';
    elseif($ci->input->get('ord') == $ord &&
           $ci->input->get('dir') == 'desc')
        return 'glyphicon-chevron-down';
}

function _rec_merge($arr1, $arr2)
{
    if($arr1)
        foreach($arr1 as $key => $val)
            if(!is_array($val) && isset($arr2[$key]))
                $arr1[$key] = $arr2[$key];
            elseif(is_array($val) && isset($arr2[$key]) && is_array($arr2[$key]))
                $arr1[$key] = _rec_merge ($arr1[$key], $arr2[$key]);
    
    foreach($arr2 as $key => $val)
        if(!isset($arr1[$key]))
           $arr1[$key] = $arr2[$key]; 
    return $arr1;
}

