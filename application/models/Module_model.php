<?php

class Module_model extends MY_Model {

    function __construct($type = null) {
        parent::__construct($type);
    }

    function category() {

        $category = array();
        if (!$category = $this->cache->get('sql/category')) {
            $this->load->model("module/header_model");
            $category = $this->header_model->category();
            // Save into the cache for 5 minutes
            $this->cache->save('sql/category',$category, 300);
        }
          return $category;
    }

}
