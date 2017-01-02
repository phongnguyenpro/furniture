<?php

class User_model extends MY_Model {

    function obj_user($id_user = "") {
        if ($id_user == "")
            return array(
                "user_id" => "",
                "user_email" => "",
                "user_password" => "",
                "user_name" => "",
                "user_sex" => "",
                "user_birthday" => today(),
                "user_phone" => "",
                "user_address" => "",
                "user_note" => "",
                "user_id_social" => "",
                "user_role" => "",
                "user_avatar" => "",
                "user_status" => "",
                "user_date_update" => "",
            );
        else
            return $this->mydb->select("select * from user where user_id=:user_id", array("user_id" => $id_user))[0];
    }

    function insert($data) {
        if ($this->check_exist_user($data["user_email"])["status"] == 1) {
            if (isset($_FILES['user_avatar']))
                $data['user_avatar'] = $_FILES['user_avatar'];
            if (isset($data['user_avatar'])) {
                $file = $data['user_avatar'];
                $this->load->library("image");
                if ($this->image->ktfileanh($file)) {
                    $name = slug($data['user_name']) . '-' . rand(0, 100) . time() . "." . $this->image->getExtension($file['name']);
                    $url = "public/upload/images/user_profile/" . $name;
                    $this->image->crop($file['tmp_name'], $url, WIDTHANHBAIVIET, HEIGHTANHBAIVIET, KIEUIMAGE);
                    $data['user_avatar'] = $name;
                } else
                    unset($data['user_avatar']);
            }
            $data["user_role_name"] = $data["user_role"] == "administrator" ? "Administrator" :
                    ( $data["user_role"] == "user" ? "User" :
                            $this->mydb->select("select usergroup_name from usergroup where usergroup_id=:usergroup_id", array("usergroup_id" => $data["user_role"]))[0]["usergroup_name"]
                    );
            $data["user_password"] = md5($data["user_password"]);
            $data["user_date_update"] = today();
            $data["user_status"] = isset($data["user_status"]) ? 1 : -1;
            $data["user_birthday"] = date_input($data["user_birthday"]);
            $data["user_note"] = string_input($data["user_note"]);
            $result = $this->mydb->insert("user", $data);
            if ($result["row"] > 0) {
                session_set("notify", array("type" => 3, "messager" => "Tài khoản " . $data["user_email"] . " đã được tạo thành công"));
            }
        } else {
            session_set("notify", array("type" => 4, "messager" => "Tài khoản " . $data["user_email"] . " đã tồn tại"));
        }
        return true;
    }

    function update($data) {
        $info_old = $this->mydb->select("select * from user where user_id=:user_id", array("user_id" => $data["user_id"]))[0];
        if (isset($_FILES['user_avatar']))
            $data['user_avatar'] = $_FILES['user_avatar'];
        if (isset($data['user_avatar'])) {
            $file = $data['user_avatar'];
            $this->load->library("image");
            if ($this->image->ktfileanh($file)) {
                $name = slug($data['user_name']) . '-' . rand(0, 100) . time() . "." . $this->image->getExtension($file['name']);
                $url = "public/upload/images/user_profile/" . $name;
                $this->image->crop($file['tmp_name'], $url, WIDTHANHBAIVIET, HEIGHTANHBAIVIET, KIEUIMAGE);
                $data['user_avatar'] = $name;
                delete_image($info_old["user_avatar"], "user_profile");
            } else
                unset($data['user_avatar']);
        }
        if (isset($data["user_password"]) && $data["user_password"] != $info_old["user_password"])
            $data["user_password"] = md5($data["user_password"]);
        $data["user_role_name"] = $data["user_role"] == "administrator" ? "Administrator" :
                ( $data["user_role"] == "user" ? "User" :
                        $this->mydb->select("select usergroup_name from usergroup where usergroup_id=:usergroup_id", array("usergroup_id" => $data["user_role"]))[0]["usergroup_name"]
                );
        $data["user_status"] = isset($data["user_status"]) ? 1 : -1;
        $data["user_date_update"] = today();
        $data["user_birthday"] = date_input($data["user_birthday"]);
        $data["user_note"] = string_input($data["user_note"]);

        $result = $this->mydb->update("user", $data, "user_id=:user_id", array("user_id" => $data["user_id"]));
        if ($result["row"] > 0) {
            session_set("notify", array("type" => 3, "messager" => "Tài khoản " . $data["user_email"] . " đã cập nhật thông tin thành công"));
        }
        return true;
    }

    function check_exist_user($email) {
        $result = $this->mydb->select("select * from user where user_email=:user_email", array("user_email" => $email));
        if (empty($result))
            return array("status" => 1, "message" => "");
        else
            return array("status" => 0, "message" => "email đã tồn tại");
    }

    function check_login_user($email, $pass) {
       
        $result = $this->mydb->select("select * from user where user_email=:user_email and user_password=:user_password", array("user_email" => $email,"user_password"=>md5($pass)));
        if (!empty($result))
            return $result[0];
        else
            return false;  
    }

    function list_user() {

        return $result = $this->mydb->select("select * from user", array());
    }

    function list_role($current = "") {
        $result = $this->mydb->select("select * from usergroup order by usergroup_index", array());
        $roleData = array();
        foreach ($result as $value) {
            $roleData['items'][$value['usergroup_id']] = $value; //Lưu dữ liệu các biến có id khác nh
            $roleData['parent'][$value['usergroup_parent']][] = $value['usergroup_id'];
        }
        $list_role = "";
        $list_role .="<option value='administrator'>Administrator</option>";
        $list_role .= $this->buiding_role(0, $roleData, "", $current);
        return $list_role;
    }

    public function buiding_role($parent, $roleData, $level = "", $current) {
        $html = "";
        if (isset($roleData["parent"][$parent])) {
            foreach ($roleData['parent'][$parent] as $value) {
                $html .= "<option value='" . $roleData["items"][$value]["usergroup_id"] . "' " . ($current == $roleData["items"][$value]["usergroup_id"] ? "selected" : "") . ">";
                $html .= $level . $roleData["items"][$value]["usergroup_name"];
                $html .= "</option>";
                $html .= $this->buiding_role($value, $roleData, $level . " - ", $current);
            }
        }
        return $html;
    }

    function delete($user_id) {
        $info_old = $this->mydb->select("select * from user where user_id=:user_id", array("user_id" => $user_id))[0];
        $this->mydb->delete("user", "user_id=:user_id", array("user_id" => $user_id));
        delete_image($info_old["user_avatar"], "user_profile");
        return array("status" => 1);
    }

    function load_data_ssp() {
        $table = 'user';

// Table's primary key
        $primaryKey = 'user_id';

        $columns = array(
            array('db' => 'user_id', 'dt' => 0),
            array('db' => 'user_email', 'dt' => 1),
            array('db' => 'user_role_name', 'dt' => 2),
            array('db' => 'user_avatar', 'dt' => 3),
            array('db' => 'user_status', 'dt' => 4),
            array('db' => 'user_id', 'dt' => 5),
        );
        $this->load->database();
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname,
        );
        $this->load->library("ssptable");
        echo json_encode(
                $this->ssptable->simple($_POST, $sql_details, $table, '', $primaryKey, $columns, '', 'user')
        );
    }

}
