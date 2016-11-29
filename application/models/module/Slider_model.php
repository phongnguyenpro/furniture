<?php

class Slider_model extends MY_Model
{

 
    function update(&$data)
    {
     
        $module_image = isset( $data["module_image"])?$data["module_image"]:array();
        $module_link = isset($data["module_link"])?$data["module_link"]:array();
        unset($data["module_image"]);
        unset($data["module_link"]);
        $data_config =array();
        
        foreach ($module_image as $k=>$v)
        {
            $data_config[$k]["module_image"]=$v;
            $data_config[$k]["module_link"]=$module_link[$k];
        }
        $data["module_config"]=  serialize($data_config); 

    }

}