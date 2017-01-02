<?php

class Module_model extends MY_Model
{

    function __construct($type = null)
    {
        parent::__construct($type);
    }

    function run($page)
    {
        $data = array();
        $is_home = $page!="home"?"or module_detail_page=-1" : "";
        $result = $this->mydb->select("select module.module_id,module_name,module_location,module_index,module_type,module_config from module,module_detail "
            . "where module.module_id = module_detail.module_id and (module_detail_page=:module_detail_page $is_home )", array("module_detail_page" => $page));
        $data = array();
        foreach ($result as $k => $v) {
            $data[$v["module_type"]][$v["module_location"]][$v["module_index"]] = array();
            switch ($v["module_type"]) {
                case "slider":
                    $data[$v["module_type"]][$v["module_location"]][$v["module_index"]]["name"] = $v["module_name"];
                    $data[$v["module_type"]][$v["module_location"]][$v["module_index"]]["data"] = unserialize($v["module_config"]);
                    break;
                case "banner":
                    $data[$v["module_type"]][$v["module_location"]][$v["module_index"]]["name"] = $v["module_name"];
                    $data[$v["module_type"]][$v["module_location"]][$v["module_index"]]["data"] = unserialize($v["module_config"]);
                    break;
                case "product":
                    $data[$v["module_type"]][$v["module_location"]][$v["module_index"]]["name"] = $v["module_name"];
                    if (!isset($this->product_model))
                        $this->load->model("module/product_model");
                    $data[$v["module_type"]][$v["module_location"]][$v["module_index"]]["data"] = $this->product_model->load_product(unserialize($v["module_config"]));
                    break;
                case "articles":
                    //debug($result);
                    $data[$v["module_type"]][$v["module_location"]][$v["module_index"]]["name"] = $v["module_name"];
                    //if (!isset($this->articles_model))
                        $this->load->model("module/articlesmodule_model");
                    $data[$v["module_type"]][$v["module_location"]][$v["module_index"]]["data"] = $this->articlesmodule_model->load_articles(unserialize($v["module_config"]));
                    break;
            }
        }
        return $data;
        //module_type
        // location
//                index
//                      Name
//                      Data
        //return $data;
    }

    function category()
    {
        $category = array();
        if (!$category = $this->cache->get('sql/category')) {
            $this->load->model("module/header_model");
            $category = $this->header_model->category();
            // Save into the cache for 5 minutes
            CACHE == 1 ? $this->cache->save('sql/category', $category, 86400) : null;
        }

        return $category;
    }

    function articles_category()
    {
        $articles_category = array();
        if (!$category = $this->cache->get('sql/articles_category')) {
            $this->load->model("module/header_model");
            $articles_category = $this->header_model->articles_category();
            // Save into the cache for 5 minutes
            CACHE == 1 ? $this->cache->save('sql/articles_category', $articles_category, 86400) : null;
        }

        return $articles_category;
    }

    function menu()
    {
        $menu = array();

        if (!$menu = $this->cache->get('sql/menu')) {
            $this->load->model("module/header_model");
            $menu = $this->header_model->menu();
            // Save into the cache for 5 minutes
            CACHE == 1 ? $this->cache->save('sql/menu', $menu, 86400) : NULL;
        }
        return $menu;
    }

    function footer()
    {
        $footer = array();

        if (!$footer = $this->cache->get('sql/footer')) {
            $this->load->model("module/header_model");
            $footer = $this->header_model->footer();
            // Save into the cache for 5 minutes
            CACHE == 1 ? $this->cache->save('sql/footer', $footer, 86400) : NULL;
        }
        return $footer;
    }

}
