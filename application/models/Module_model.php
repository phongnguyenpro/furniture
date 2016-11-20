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
            CACHE==1?$this->cache->save('sql/category', $category, 300):null;
        }

        return $category;
    }

    function menu() {
        $menu = array();
        
       if (!$menu = $this->cache->get('sql/menu')) {
            $this->load->model("module/header_model");
            $menu = $this->header_model->menu();
            // Save into the cache for 5 minutes
          CACHE==1? $this->cache->save('sql/menu', $menu, 300):NULL;
        }
        return $menu;
    }


}
