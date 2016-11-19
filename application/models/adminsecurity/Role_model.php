<?php

class Role_model extends MY_Model {

    public $role_id;
    public $role_role;
    public $role_controller;
    public $role_action;
    public $role_date_update;
    public $role_user_update;

    function update($data) {
        $this->mydb->deleteall("role","role_role=:role_role",array("role_role"=>$data["role_current"]));
        $this->load->helper('date');
        $data_update["role_role"] = $data["role_current"];
        $data_update["role_date_update"] =mdate('%Y-%m-%d %H:%i:%s', time());
        unset($data["role_current"]);
        foreach ($data as $k => $v) {
            $data_update["role_controller"] = $k;
            foreach ($v as $k_action => $v_action) {
                $data_update["role_action"] = $v_action;
                $this->mydb->insert("role",$data_update);
            }
        }
    }

}
