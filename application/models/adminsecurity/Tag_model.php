<?php

class Tag_model extends MY_Model {

    function index()
    {
        return $this->mydb->select("select * from tag order by tag_index");
    }
    
}