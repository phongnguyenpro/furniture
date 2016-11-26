<?php

class Module_model extends MY_Model {

    function index() {
        
    }

    function detail($page) {
        $result = $this->mydb->select("select * from module,module_detail "
                . "where module.module_id = module_detail.module_id and (module_detail_page=:module_detail_page or module_detail_page=-1)", array("module_detail_page" => $page));
        $data = array();
        foreach ($result as $k => $v) {
            $data[$v["module_type"]][] = $v;
        }
        return $data;
    }

    function insert($data) {
        $page = $data["page"];
        unset($data["page"]);
        if(isset($data["module_page"]))
        $list_page = $data["module_page"];
        else 
            $list_page =array(-1);
        unset($data["module_page"]);
        if (empty($list_page))
            $list_page = array("0" => -1);
        $result = $this->mydb->insert("module", $data);
        $id = $result["id"];
        foreach ($list_page as $k => $v) {
            $this->mydb->insert("module_detail", array("module_id" => $id, "module_detail_page" => $v));
        }
        debug($id);
    }
    
    function config($type,$module_id)
    {
        $data=array();
        $data["module"]=$this->mydb->select("select * from module where module_id=:module_id",array("module_id"=>$module_id));
        $result=$this->mydb->select("select module_detail_page  from module_detail where module_id=:module_id",array("module_id"=>$module_id));
        foreach ($result as $k=>$v)
        {
            $data["page"][]=$v["module_detail_page"];
        }
        
        return $data;
        
    }
    function delete($module_id)
    {
        $this->mydb->delete("module","module_id=:module_id",array("module_id"=>$module_id));
        $this->mydb->delete("module_detail","module_id=:module_id",array("module_id"=>$module_id));
        if($result["row"]==0 || $result["row"]>0)
        {
            $link = session_get("module_page")?"detail/".session_get("module_page"):"";
            session_set("notify",array("type"=>3,"messager"=>"Xóa module thành công"));
            Header("Location:".ADMIN_URL."module/".$link);
             
        }
    }

}
