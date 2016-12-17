<?php

class Articles_model extends MY_Model
{
    function update(&$data)
    {
        $module_articles_type = isset($data["module_articles_type"]) ? $data["module_articles_type"] : "hot";
        unset($data["module_articles_type"]);
        $module_articles_limit = isset($data["module_articles_limit"]) ? $data["module_articles_limit"] : 1;
        unset($data["module_articles_limit"]);

        $data["module_config"] = serialize(array("module_articles_type" => $module_articles_type,
            "module_articles_limit" => $module_articles_limit
        ));
    }

    function load_articles($config)
    {
        $articles_type = $config["module_articles_type"];
        if ($config["module_articles_limit"] != '' && $config["module_articles_limit"] != 0)
            $limit = $config["module_articles_limit"];
        else
            $limit = LIMITMODULE;
        $select = "articles.articles_id,articles_feature,articles_date_create,articles_name,articles_slug,articles_avatar,articles_description";
        $data = array();

        switch ($articles_type) {
            case "hot":
                $data = $this->mydb->select("select $select from articles where articles_feature=1 and articles_show=1 order by articles_index desc limit $limit ", array());
                break;
            case "view":
                $data = $this->mydb->select("select $select from articles where articles_show=1 order by articles_view desc limit $limit ", array());
                break;
            default :
                break;
        }
        return $data;
    }

}
