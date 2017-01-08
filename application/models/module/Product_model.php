<?php

class Product_model extends MY_Model
{
    function update(&$data)
    {
        $module_product_type = isset($data["module_product_type"]) ? $data["module_product_type"] : "hot";
        unset($data["module_product_type"]);
        $module_product_limit = isset($data["module_product_limit"]) ? $data["module_product_limit"] : 1;
        unset($data["module_product_limit"]);

        $data["module_config"] = serialize(array("module_product_type" => $module_product_type,
            "module_product_limit" => $module_product_limit
        ));
    }

    function load_product($config)
    {
        $product_type = $config["module_product_type"];
        if ($config["module_product_limit"] != '' && $config["module_product_limit"] != 0)
            $limit = $config["module_product_limit"];
        else
            $limit = LIMITMODULE;
        $select = "product.product_id,product_price,product_sale,product_feature,product_date_create,product_new, "
                . "CAST((product_price-((product_sale/100)*product_price))  AS UNSIGNED ) as product_price_new,"
                . "SUBSTR(INSERT(product.product_name,27,3,'...'),1,29) as product_name,"
                . "product_slug,product_avatar,product_code,product_description";
        $data = array();

        switch ($product_type) {
            case "hot":
                $data = $this->mydb->select("select $select from product where product_date_create<=now() and product_feature=1 and product_show=1  order by product_index desc limit $limit ", array());
                break;
            case "selling":
                $data = $this->mydb->select("select $select from product where product_date_create<=now() and product_selling=1 and product_show=1 order by product_index desc limit $limit ", array());
                break;
            case "new":
                $data = $this->mydb->select("select $select from product where product_date_create<=now() and product_new=1 and product_show=1 order by product_index desc limit $limit ", array());
                break;
            case "sale":
                $data = $this->mydb->select("select $select from product where product_date_create<=now() and product_sale>0 and product_show=1  order by product_index desc limit $limit ", array());
                break;
            default :
                break;
        }
        return $data;
    }

}
