<?php

class Tag_model extends MY_Model
{
    function __construct($type = null)
    {
        parent::__construct($type);
    }

    function index()
    {
        return $this->mydb->select("select * from tag order by tag_index");
    }

    function create_tag($data)
    {
        $data["tag_search"] = loaibodau($data['tag_name']);
        $this->mydb->insert("tag", $data);
        return true;
    }

    function update_tag($data)
    {
        $data["tag_search"] = loaibodau($data['tag_name']);
        $this->mydb->update("tag", $data, "tag_id=:tag_id", array("tag_id" => $data['tag_id']));
        return true;
    }

    function delete_tag($id_tag)
    {
        $this->mydb->delete("tag", "tag_id=:tag_id", array("tag_id" => $id_tag));
        $this->mydb->deleteall("product_tag", "tag_id=:tag_id", array("tag_id" => $id_tag));
        $this->mydb->deleteall("articles_tag", "tag_id=:tag_id", array("tag_id" => $id_tag));

        return TRUE;
    }

    function sort_tag($data)
    {
        foreach ($data as $value) {
            $dataupdate['tag_index'] = $value['tag_index'];
            $this->mydb->update("tag", $dataupdate, "tag_id=:tag_id", array('tag_id' => $value['tag_id']));
        }
        echo json_encode(array("status" => 1));
    }

}