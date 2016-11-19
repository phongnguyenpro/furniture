<?php

class User_model extends MY_Model {

    function obj_user() {
        return array(
            "user_id" => "",
            "user_email" => "",
            "user_password" => "",
            "user_name" => "",
            "user_sex" => "",
            "user_birthday" => "",
            "user_phone" => "",
            "user_address" => "",
            "user_note" => "",
            "user_id_social" => "",
            "user_role"=>"",
            "user_avatar"=>"",
            "user_status"=>"",
            "user_date_update"=>"",
        );
    }

    function insert($data)
    {
        if($this->check_exist_user($data["user_email"])["status"]==1)
        {
        $data["user_password"]=md5($data["user_password"]);
        $data["user_date_update"]=  today();
        $data["user_birthday"]=date_input($data["user_birthday"]); 
        $data["user_note"]=string_input($data["user_note"]); 
        $result=$this->mydb->insert("user",$data);
        if($result["row"]>0)
        {
            session_set("notify",array("type"=>3,"messager"=>"Tài khoản ".$data["user_email"]." đã được tạo thành công"));
        }
        }
        else
        {
                        session_set("notify",array("type"=>4,"messager"=>"Tài khoản ".$data["user_email"]." đã tồn tại"));
        }
        return true;
        
    }
    function check_exist_user($email)
    {
        $result = $this->mydb->select("select * from user where user_email=:user_email",array("user_email"=>$email));
        if(empty($result))
            return array("status"=>1,"message"=>"");
        else
            return array("status"=>0,"message"=>"email đã tồn tại");
    }
            function list_user() {

        return $result = $this->mydb->select("select * from user", array());
    }

}
