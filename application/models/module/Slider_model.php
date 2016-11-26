<?php

class Slider_model extends MY_Model
{

 
    function update($data)
    {
  
          if(isset($data["module_page"]))
        $module_page =$data["module_page"];
          else
             $module_page=array(-1); 
        $module_image = isset( $data["module_image"])?$data["module_image"]:array();
        $module_link = isset($data["module_link"])?$data["module_link"]:array();
        
        unset($data["module_page"]);
        unset($data["module_image"]);
        unset($data["module_link"]);
        $data_config =array();
        
        foreach ($module_image as $k=>$v)
        {
            $data_config[$k]["module_image"]=$v;
            $data_config[$k]["module_link"]=$module_link[$k];
        }
        $data["module_config"]=  serialize($data_config);
        $result=$this->mydb->update("module",$data,"module_id=:module_id",array("module_id"=>$data["module_id"]));
        $this->mydb->deleteall("module_detail","module_id=:module_id",array("module_id"=>$data["module_id"]));
        foreach ($module_page as $k=>$v )
        {
             $this->mydb->insert("module_detail", array("module_id" =>$data["module_id"], "module_detail_page" => $v));
        }
        if($result["row"]==0 || $result["row"]>0)
        {
           
            $link = session_get("module_page")?"detail/".session_get("module_page"):"";
            session_set("notify",array("type"=>3,"messager"=>"Cập nhật thành công"));
            Header("Location:".ADMIN_URL."module/".$link);
             
        }
    }

}