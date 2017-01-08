<?php

class Product_model extends MY_Model
{

    function index()
    {
        return $this->mydb->select("select * from career order by career_index");
    }

    function product_info($product_id)
    {
        return $this->mydb->select("select product_id,product_name from product where product_id=:product_id order by product_index", array("product_id" => $product_id));
    }

    public function avatar($product_id, $name)
    {
        if ($product_id != "") {
            $kq = $this->mydb->select("select product_avatar from product where product_id=:product_id", array("product_id" => $product_id));
            if ($kq[0]['product_avatar'] != '') {
                $name_delete = $kq[0]['product_avatar'];
            }
            if (isset($name_delete)) {
                delete_image($name_delete);
            } else
                $name_delete = '';
            $this->mydb->update("product", array("product_avatar" => $name), "product_id=:product_id", array("product_id" => $product_id));
            return array("status" => 1, "tenanh" => $name, "tenanhxoa" => $name_delete);
        } else {
            return array("status" => 1, "tenanh" => $name, "tenanhxoa" => "");
        }
    }

    function delete_image($id_hinh, $tenhinh)
    {
        if ($id_hinh != -1) {
            $this->mydb->delete("product_images", "product_images_id=:product_images_id", array("product_images_id" => $id_hinh));
            delete_image($tenhinh, "product");
        } else
            delete_image($tenhinh, "product");
        return array('status' => 1);
    }

    function upload_image($product_id, $name_image)
    {
        if ($product_id != "") {
            $kq = $this->mydb->select("select max(product_images_index) as max from product_images where product_id=:product_id", array("product_id" => $product_id));
            $max = $kq[0]['max'] + 1;
            $row = $this->mydb->insert("product_images", array("product_id" => $product_id, "product_images_name" => $name_image, "product_images_index" => $max));
            return array("status" => 1, "tenhinh" => $name_image, "id_hinh" => $row['id']);
        } else {
            return array("status" => 1, "tenhinh" => $name_image, "id_hinh" => -1);
        }
    }

    function sort_images($data)
    {

        foreach ($data as $k => $value) {
            $dataupdate["product_images_index"] = $k;
            $this->mydb->update("product_images", $dataupdate, "product_images_id=:product_images_id", array('product_images_id' => $value['id']));
        }
        echo json_encode(array('status' => 1));
    }

    function insert($data)
    {

        // xu ly du lieu
        if (isset($data['product_feature']))
            $data['product_feature'] = 1;
        else
            $data['product_feature'] = 2;

        if (isset($data['product_show']))
            $data['product_show'] = 1;
        else
            $data['product_show'] = 2;

        if (isset($data['product_new']))
            $data['product_new'] = 1;
        else
            $data['product_new'] = 2;

        if (isset($data['product_selling']))
            $data['product_selling'] = 1;
        else
            $data['product_selling'] = 2;
        $data['product_view'] = 0;
        $data['product_like'] = 0;

        //xu ly anh tmp -> hinhsanpham
        if (isset($data["tmp_ava"])) {
            if (trim($data["tmp_ava"]) == "")
                unset($data["tmp_ava"]);
            else {
                if (file_exists("public/upload/images/temp/" . $data["tmp_ava"]) && file_exists("public/upload/images/thumb_temp/" . $data["tmp_ava"])) {
                    if (copy("public/upload/images/temp/" . $data["tmp_ava"], "public/upload/images/product/" . slug($data['product_name']) . "-" . $data["tmp_ava"])) {
                        if (copy("public/upload/images/thumb_temp/" . $data["tmp_ava"], "public/upload/images/thumb_product/" . slug($data['product_name']) . "-" . $data["tmp_ava"]))
                            $data["product_avatar"] = slug($data['product_name']) . "-" . $data["tmp_ava"];
                    }
                    delete_image($data["tmp_ava"], "temp");
                }
                unset($data["tmp_ava"]);
            }
        }
        //xu ly anh san pham
        if (isset($data["tmp_photo"])) {
            $tmp_photo = $data["tmp_photo"];
            unset($data["tmp_photo"]);
        }
        // xu ly mieu ta va readmore
        $data['product_description'] = substr($data['product_content'], 0, 220);
        // Xu lý thuoc tinh san pham
        $hienthichitiet = array();
        if (isset($data['hienthichitiet'])) {
            $hienthichitiet = $data['hienthichitiet'];
            unset($data['hienthichitiet']);
        }
        $result = $this->mydb->select("select productattr_id from productattr ", array());
        foreach ($result as $value) {
            if (isset($data[$value['productattr_id']])) {
                if (in_array($value['productattr_id'], $hienthichitiet)) {
                    $product_propchon[-2][$value['productattr_id']] = $data[$value['productattr_id']];
                } else {
                    $product_propchon[-1][$value['productattr_id']] = $data[$value['productattr_id']];
                }

                unset($data[$value['productattr_id']]);
            }
        }

        // xu ly danh muc
        if (isset($data['productcategory_id'])) {
            foreach ($data['productcategory_id'] as $value) {
                $category[] = $value;
            }
            unset($data['productcategory_id']);
        }
        // xy ly dac tinh
        if (isset($data['property'])) {
            $product_prop = array();
            $product_prop = $data['property'];
            unset($data['property']);
        }

        // xu ly tag
        if (isset($data['tag'])) {

            $product_tag = $data['tag'];
            unset($data['tag']);
        }

        $kq = $this->mydb->select("select max(product_index) as max from product", array());
        $max = $kq[0]['max'] + 1;
        $data['product_index'] = $max;
        $data['product_price'] = price_input($data['product_price']);
        $data['product_sale'] = 0;
        $data['product_search'] = loaibodau($data['product_name']) . " " . $data['product_price'];
        $data['product_date_update'] = today();
        $data['product_date_create'] = date_input($data['product_date_create']);
        $row = $this->mydb->insert("product", $data);
        $id = $row['id'];

        if (isset($tmp_photo)) {
            $linksPhotos = array();
            $linksPhotos = explode(";", $tmp_photo);
            foreach ($linksPhotos as $tmpPhotos) {
                if (file_exists("public/upload/images/temp/" . $tmpPhotos) && file_exists("public/upload/images/thumb_temp/" . $tmpPhotos) && $tmpPhotos != "") {
                    if (copy("public/upload/images/temp/" . $tmpPhotos, "public/upload/images/product/" . slug($data['product_name']) . "-" . $tmpPhotos)) {
                        if (copy("public/upload/images/thumb_temp/" . $tmpPhotos, "public/upload/images/thumb_product/" . slug($data['product_name']) . "-" . $tmpPhotos)) {
                            $tenanhP = slug($data['product_name']) . "-" . $tmpPhotos;
                            $kq2 = $this->mydb->select("select max(product_images_index) as max from product_images where product_id=:product_id", array("product_id" => $id));
                            $max2 = $kq2[0]['max'] + 1;
                            $this->mydb->insert("product_images", array("product_id" => $id, "product_images_name" => $tenanhP, "product_images_index" => $max2));
                        }
                    }
                    delete_image($tmpPhotos, "temp");
                }
            }
        }

        foreach ($product_prop as $key => $value) {
            if ($value != '')
                $this->mydb->insert("product_prop_detail", array("product_prop_id" => $key, "product_id" => $id, "product_prop_detail_value" => $value));
        }
        if (isset($product_propchon[-1])) {
            foreach ($product_propchon[-1] as $key => $value) {
                foreach ($value as $value2) {
                    $this->mydb->insert("productattr_detail", array("product_id" => $id, "productattr_id" => $key, "attr_val_id" => $value2, "product_detail_id" => -1));
                }
            }
        }

        if (isset($product_propchon[-2])) {
            foreach ($product_propchon[-2] as $key => $value) {
                foreach ($value as $value2) {
                    $this->insert("productattr_detail", array("product_id" => $id, "productattr_id" => $key, "attr_val_id" => $value2, "product_detail_id" => -2));
                }
            }
        }
        if (isset($category)) {
            foreach ($category as $value) {
                $this->mydb->insert("productcategory_detail", array("product_id" => $id, "productcategory_id" => $value));
            }
        }
        // them tag
        $tag = array();
        $kq = $this->mydb->select("select * from tag order by tag_index", array());
        foreach ($kq as $value) {
            $tag[$value['tag_id']] = $value['tag_name'];
        }
        if (isset($product_tag)) {
            foreach ($product_tag as $value) {
                if (in_array($value, $tag)) {
                    $this->mydb->insert("product_tag", array("product_id" => $id, "tag_id" => array_keys($tag, $value)[0]));
                } else {

                    $row = $this->mydb->insert("tag", array("tag_name" => $value, "tag_view" => 0, "tag_slug" => slug($value), "tag_search" => loaibodau($value)));
                    $tag_id = $row['id'];
                    $this->mydb->insert("product_tag", array("product_id" => $id, "tag_id" => $tag_id));
                }
            }
        }
        return array('status' => 1, 'product_id' => $id, 'nganh' => $data['career_id']);
    }

    function load_data_ssp($data)
    {
        $data['sqlwhere'] = '';
        if ($data['category_id'] != -1) {
            $this->load->model(array("adminsecurity/productcategory_model"));
            $category_id = $data['category_id'];
            $list_child = search_all_child($this->productcategory_model->load_category_condition(), $category_id, array());
            if (empty($list_child))
                $sqlwhere = " productcategory_id=$category_id";
            else
                $sqlwhere = " productcategory_id=$category_id or productcategory_id=" . implode(" or productcategory_id=", $list_child);

            $data['sqlwhere'] = $sqlwhere;
        }
        $table = 'product';

// Table's primary key
        $primaryKey = 'product_id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
        $columns = array(
            array('db' => 'product_id', 'dt' => 0),
            array('db' => 'product_index', 'dt' => 1),
            array('db' => 'product_avatar', 'dt' => 2),
            array('db' => 'product_code', 'dt' => 3),
            array('db' => 'product_name', 'dt' => 4),
            array('db' => 'product_price', 'dt' => 5),
            array('db' => 'product_date_create', 'dt' => 6),
            array('db' => 'product_feature', 'dt' => 7),
            array('db' => 'product_show', 'dt' => 8),
            array('db' => 'congcu', 'dt' => 9),
        );
        $this->load->database();
// SQL server connection information
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname,
        );
        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */
        $this->load->library("ssp_product");
        echo json_encode(
            $this->ssp_product->simple($data, $sql_details, $table, $primaryKey, $columns)
        );
    }

    function sort_product($data)
    {
//        $sort = json_decode($data);
        $stt = 1;
        $i = 0;

        $datastt = array();

        foreach ($data as $key => $item) {
            $id = $item['id'];
            $stt = $item['stt'];
            $datasapxep[$id] = $stt;
            $datatemp[$i] = $stt;
            $i++;
        }
        asort($datatemp);

        foreach ($datatemp as $value) {
            array_push($datastt, $value);
        }
        $i = count($datasapxep) - 1; // Đổi lớn bé tại đây
        foreach ($datasapxep as $key => $value) {
            $datasapxep[$key] = $datastt[$i];
            $i--;
        }
        foreach ($datasapxep as $key => $value) {
            $this->mydb->update("product", array("product_index" => $value), "product_id=:product_id", array("product_id" => $key));
        }
        echo json_encode(array("status" => 1));
    }

    function edit($product_id)
    {
        $result = $this->mydb->select("select * from product where product_id=:product_id", array("product_id" => $product_id));
        $data['product'] = $result[0];
        $result = $this->mydb->select("select * from product_images where product_id=:product_id order by product_images_index", array("product_id" => $product_id));
        $data['product_images'] = $result;

        // load thuoc tinh chon chi tiet
        $kq = $this->mydb->select("select productattr_id,attr_val_id,product_detail.product_detail_id,product_detail_total,"
            . "product_detail_price,product_detail_avatar from product_detail JOIN productattr_detail ON product_detail.product_detail_id=productattr_detail.product_detail_id   and  "
            . " product_detail.product_id=:product_id order by product_detail_date_create", array("product_id" => $product_id));
        if (!empty($kq)) {
            $data['product_detail'] = array();
            foreach ($kq as $value) {
                $data['product_detail'][$value['product_detail_id']]['attr_val_value'][$value['productattr_id']] = $value['attr_val_id'];
                $data['product_detail'][$value['product_detail_id']]['product_detail_price'] = $value['product_detail_price'];
                $data['product_detail'][$value['product_detail_id']]['product_detail_total'] = $value['product_detail_total'];
                $data['product_detail'][$value['product_detail_id']]['product_detail_avatar'] = $value['product_detail_avatar'];
            }
            $data['attr_val_id'] = array();

            $kq = $this->mydb->select("select attr_val_id,product_detail_id,productattr_id from productattr_detail where product_id=:product_id and (product_detail_id=-2 or product_detail_id=-1)", array("product_id" => $product_id));

            foreach ($kq as $value) {
                $data['attr_val_id'][] = $value['attr_val_id'];
                if ($value["product_detail_id"] == -1)
                    $data['hienthichitiet'][$value['productattr_id']] = -1;
                else
                    $data['hienthichitiet'][$value['productattr_id']] = -2;
            }
        } else {
            $data['attr_val_id'] = array();
            $kq = $this->mydb->select("select attr_val_id,product_detail_id,productattr_id from productattr_detail where product_id=:product_id", array("product_id" => $product_id));

            foreach ($kq as $value) {
                $data['attr_val_id'][] = $value['attr_val_id'];
                if ($value["product_detail_id"] == -1)
                    $data['hienthichitiet'][$value['productattr_id']] = -1;
                else
                    $data['hienthichitiet'][$value['productattr_id']] = -2;
            }

            $data['product_detail'] = array();
        }


        // load thuoc tinh chi tiet
        $kq = $this->mydb->select("select product_prop_id,product_prop_detail_value from product_prop_detail where product_id=:product_id", array("product_id" => $product_id));
        foreach ($kq as $value) {
            $data['product_prop_detail'][$value['product_prop_id']] = $value['product_prop_detail_value'];
        }
        $kq = $this->mydb->select("select product_prop_id,product_prop_name from product_prop", array());

        // danh muc san pham chi tiet

        $data['productcategory_detail'] = array();
        $kq = $this->mydb->select("select * from productcategory_detail where product_id=:product_id", array("product_id" => $product_id));
        foreach ($kq as $value) {
            $data['productcategory_detail'][] = $value['productcategory_id'];
        }
        // tag san pham
        $data['product_tag'] = array();
        $tag = array();
        $kq = $this->mydb->select("select * from tag order by tag_index", array());

        foreach ($kq as $value) {
            $tag[$value['tag_id']] = $value['tag_name'];
        }
        $kq = $this->mydb->select("select * from product_tag where product_id=:product_id", array("product_id" => $product_id));
        foreach ($kq as $value) {
            $data['product_tag'][$value['tag_id']] = $tag[$value['tag_id']];
        }


        // xu ly du lieu

        $data['product']['product_date_create'] = date_out($data['product']['product_date_create']);
        return $data;
    }

    function update($data)
    {
        $product_id = $_POST["product_id"];
        // xu ly du lieu
        if (isset($data['product_feature']))
            $data['product_feature'] = 1;
        else
            $data['product_feature'] = 2;

        if (isset($data['product_show']))
            $data['product_show'] = 1;
        else
            $data['product_show'] = 2;

        if (isset($data['product_new']))
            $data['product_new'] = 1;
        else
            $data['product_new'] = 2;

        if (isset($data['product_selling']))
            $data['product_selling'] = 1;
        else
            $data['product_selling'] = 2;
        $data["product_name"] = string_input($data["product_name"]);
        // xu ly mieu ta va readmore
        //$x = strpos($data['product_content'], "{readmore}");
        $data['product_description'] = substr($data['product_content'], 0, 220);
       // Xu lý thuoc tinh chon
        $hienthichitiet = array();
        if (isset($data['hienthichitiet'])) {
            $hienthichitiet = $data['hienthichitiet'];
            unset($data['hienthichitiet']);
        }
        $result = $this->mydb->select("select productattr_id from productattr ", array());
        foreach ($result as $value) {
            if (isset($data[$value['productattr_id']])) {
                if (in_array($value['productattr_id'], $hienthichitiet)) {
                    $productattr[-2][$value['productattr_id']] = $data[$value['productattr_id']];
                } else {
                    $productattr[-1][$value['productattr_id']] = $data[$value['productattr_id']];
                }

                unset($data[$value['productattr_id']]);
            }
        }

        // xu ly danh muc
        if (isset($data['productcategory_id'])) {
            foreach ($data['productcategory_id'] as $value) {
                $category[] = $value;
            }
            unset($data['productcategory_id']);
        }


        // xy ly dac tinh
        if (isset($data['property'])) {
            $product_prop = array();
            $product_prop = $data['property'];
            unset($data['property']);
        }

        // xu ly tag
        if (isset($data['tag'])) {

            $product_tag = $data['tag'];
            unset($data['tag']);
        }
        $data['product_price'] = price_input($data['product_price']);
        $data['product_search'] = loaibodau($data['product_name']) . " " . $data['product_price'];
        $data['product_date_update'] = today();
        $data['product_date_create'] = date_input($data['product_date_create']);

        $this->mydb->update("product", $data, "product_id=:product_id", array("product_id" => $product_id));


        // cap nhat danh muc
        $this->mydb->deleteall("productcategory_detail", "product_id=:product_id", array("product_id" => $product_id));
        if (isset($category)) {
            foreach ($category as $value) {
                $this->mydb->insert("productcategory_detail", array("product_id" => $product_id, "productcategory_id" => $value));
            }
        }

        // cap nhat product attribute
        // -1 là không liên quan đến giá, -2 là ẩn đi, còn lại là liên quan đến giá và số lượng
        $this->mydb->deleteall("productattr_detail", "product_id=:product_id and product_detail_id=-1", array("product_id" => $product_id));

        if (isset($productattr[-1])) {
            // kiem tra xem no co san pham chi tiet khong
            $id_productattr = array();
            $kq = $this->mydb->select("select DISTINCT  productattr_id from productattr_detail where  productattr_detail.product_detail_id!=-1 and productattr_detail.product_detail_id!=-2 and product_id=:product_id", array("product_id" => $product_id));
            foreach ($kq as $value) {
                $id_productattr[] = $value['productattr_id'];
            }
            foreach ($productattr[-1] as $key => $value) {
                if (!in_array($key, $id_productattr)) {
                    foreach ($value as $value2) {
                        $this->mydb->insert("productattr_detail", array("product_id" => $product_id, "productattr_id" => $key, "attr_val_id" => $value2, "product_detail_id" => -1));
                    }
                }
            }
        }

        $this->mydb->deleteall("productattr_detail", "product_id=:product_id and product_detail_id=-2", array("product_id" => $product_id));
        if (isset($productattr[-2])) {
            foreach ($productattr[-2] as $key => $value) {
                foreach ($value as $value2) {
                    $this->mydb->insert("productattr_detail", array("product_id" => $product_id, "productattr_id" => $key, "attr_val_id" => $value2, "product_detail_id" => -2));
                }
            }
        }
        // cập nhật đặc tính
        $this->mydb->deleteall("product_prop_detail", "product_id=:product_id", array("product_id" => $product_id));
        if (isset($product_prop)) {
            foreach ($product_prop as $key => $value) {
                if ($value != '')
                    $this->mydb->insert("product_prop_detail", array("product_id" => $product_id, "product_prop_id" => $key, "product_prop_detail_value" => $value));
            }
        }

        // cap nhat tag
        // select tat ca tag
        $kq = $this->mydb->select("select * from tag order by tag_index", array());
        foreach ($kq as $value) {
            $tag[$value['tag_id']] = $value['tag_name'];
        }
        $this->mydb->deleteall("product_tag", "product_id=:product_id", array("product_id" => $product_id));
        if (isset($product_tag)) {
            foreach ($product_tag as $value) {
                if (in_array($value, $tag)) {
                    $this->mydb->insert("product_tag", array("product_id" => $product_id, "tag_id" => array_keys($tag, $value)[0]));
                } else {
                    $row = $this->mydb->insert("tag", array("tag_name" => $value, "tag_view" => 0, "tag_slug" => slug($value), "tag_search" => loaibodau($value)));
                    $id_tag = $row['id'];
                    $this->mydb->insert("product_tag", array("product_id" => $product_id, "tag_id" => $id_tag));
                }
            }
        }


        return array("status" => 1);
    }

    function delete_product($product_id)
    {
        // delete images
        $kq = $this->mydb->select("select product_images_name from product_images where product_id=:product_id", array("product_id" => $product_id));
        foreach ($kq as $value) {
            $linkfile = "public/upload/images/product/" . $value['product_images_name'];
            $linkthumb = "public/upload/images/thumb_product/" . $value['product_images_name'];
            if (file_exists($linkfile))
                unlink($linkfile);
            if (file_exists($linkthumb))
                unlink($linkthumb);
        }
        $this->mydb->deleteall("product_images", "product_id=:product_id", array("product_id" => $product_id));
        // delete avatar
        $kq = $this->mydb->select("select product_avatar from product where product_id=:product_id", array("product_id" => $product_id));
        if ($kq[0]['product_avatar'] != '') {
            $linkfile = "public/upload/images/product/" . $kq[0]['product_avatar'];
            $linkthumb = "public/upload/images/thumb_product/" . $kq[0]['product_avatar'];
            if (file_exists($linkfile))
                unlink($linkfile);
            if (file_exists($linkthumb))
                unlink($linkthumb);
        }

        // delete prop detail
        $this->mydb->deleteall("product_prop_detail", "product_id=:product_id", array("product_id" => $product_id));
        // delete attr detail
        $this->mydb->deleteall("productattr_detail", "product_id=:product_id", array("product_id" => $product_id));
        // delete product detail
        $this->mydb->deleteall("product_detail", "product_id=:product_id", array("product_id" => $product_id));
        // delete product category detail
        $this->mydb->deleteall("productcategory_detail", "product_id=:product_id", array("product_id" => $product_id));
        // delete tag
        $this->mydb->deleteall("product_tag", "product_id=:product_id", array("product_id" => $product_id));
//        // delete mien
//        $this->mydb->deleteall("danhmucmienchitiet", "id_sanpham=:id_sanpham", array("id_sanpham" => $id_sanpham));
        // delete product
        $this->mydb->delete("product", "product_id=:product_id", array("product_id" => $product_id));

        // delete product temp
//        $kq = $this->mydb->select("select id_sanpham from hoadonchitiet where product_id=:product_id limit 2", array("product_id" => $product_id));
//        if (empty($kq)) {
//            $this->mydb->delete("sanphamtemp", "product_id=:product_id", array("product_id" => $product_id));
//        }

        return array("status" => 1);
    }

    function add_product_detail($data)
    {

        $list = array();
        foreach ($data['thuoctinh'] as $value) {
            if ($value != -1)
                $list[] = $value;
        }
        if (!empty($list)) {
            $chophepthem = true;
            $id_productattr = array();
            // kiem tra thuoc tinh chon
            $kq = $this->mydb->select("select DISTINCT productattr_id from productattr_detail where product_detail_id=-1 and product_id=:product_id ", array("product_id" => $data['id_sanpham']));
            foreach ($kq as $value) {
                $id_productattr[] = $value['productattr_id'];
            }
            // lay thuoc tinh chon sap them
            $sqlwhere = "attr_val_id=" . implode(" or attr_val_id=", $list);
            $kq = $this->mydb->select("select productattr_id from attr_val where $sqlwhere", array());
            foreach ($kq as $value) {
                if (in_array($value['productattr_id'], $id_productattr)) {
                    $chophepthem = false;
                }
            }
            if ($chophepthem) {

                $ar['product_detail_price'] = price_input($data['sotien']);
                $ar['product_detail_total'] = $data['soluong'];
                $ar['product_detail_avatar'] = $data['hinhsanpham'];
                $ar['product_id'] = $data['id_sanpham'];
                $ar['product_detail_date_create'] = today();
                if (!empty($list)) {

                    $sqlwhere = " 
select product_detail_id from productattr_detail where productattr_detail.attr_val_id=" . implode(" ) and  product_detail.product_detail_id IN
(
select product_detail_id from productattr_detail where productattr_detail.attr_val_id=", $list) . ")";
                    $sql = "select  DISTINCT( product_detail.product_detail_id) from product_detail JOIN productattr_detail ON product_detail.product_detail_id=productattr_detail.product_detail_id
and productattr_detail.product_id=:product_id and  product_detail.product_detail_id IN (" . $sqlwhere;


                    $kq = $this->mydb->select($sql, array("product_id" => $ar['product_id']));

                    if (empty($kq)) {
                        $sqlwhere = "attr_val.attr_val_id=" . implode(" or attr_val.attr_val_id= ", $data['thuoctinh']);
                        $kq = $this->mydb->select("select productattr.productattr_id,attr_val_id,attr_val_value,attr_val_label  from productattr JOIN attr_val ON productattr.productattr_id=attr_val.productattr_id and ( $sqlwhere )", array());
                        if (!empty($kq) && $data['soluong'] != '' && $data['sotien'] != '') {

                            $row = $this->mydb->insert("product_detail", $ar);

                            $product_detail_id = $row['id'];
                            $ar = null;
                            foreach ($kq as $value) {
                                $tenthuoctinh[$value['attr_val_id']] = $value['attr_val_label'];
                                $ar['product_id'] = $data['id_sanpham'];
                                $ar['product_detail_id'] = $product_detail_id;
                                $ar['attr_val_id'] = $value['attr_val_id'];
                                $ar['productattr_id'] = $value['productattr_id'];

                                $this->mydb->insert("productattr_detail", $ar);
                            }
                            $tenthuoctinh['-1'] = "Null";
                            $html = '<tr>';
                            foreach ($data['thuoctinh'] as $value) {
                                $html .= '<td class="giatrithuoctinhchon" data-giatri="' . $value . '">' . $tenthuoctinh[$value] . '</td>';
                            }
                            $html .= "<td>" . $data['sotien'] . "</td>";
                            $html .= "<td>" . $data['soluong'] . "</td>";
                            $html .= '<td> <a type="button" data-id_product_detail="' . $product_detail_id . '"  class="xoahinhproduct_detail uk-modal-close uk-close uk-close-alt uk-position-absolute"></a>';
                            $html .= ' <div  data-id_product_detail="' . $product_detail_id . '" data-type="2" class="boxanhdaidien showmodalhinhanh" style="width: 100%;height:50px">';
                            $html .= '<img  class="img-responsive " title="' . $data['hinhsanpham'] . '" id="hinhsanpham" src="' . BASE_URL . 'public/upload/images/product/' . $data['hinhsanpham'] . '" ></div></td>';
                            $sua = '<a data-hinhsanphamchitiet="' . $data['hinhsanpham'] . '" data-idsanphamchitiet="' . $product_detail_id . '" data-giasanpham="' . $data['sotien'] . '" data-soluongsanpham="' . $data['soluong'] . '" class=" label label-info suasanphamchitiet">Sửa</a>';
                            $html .= '<td> ' . $sua . ' <a  data-id_product_detail="' . $product_detail_id . '" class="label label-danger xoaproduct_detail">Xóa</a></td>';

                            $html .= '</tr>';


                            return array("status" => 1, "html" => $html);
                        } else
                            return array("status" => 0, "tinnhan" => "Điền đầy đủ thông tin"); // thuộc tính, số lượng....
                    } else
                        return array("status" => 0, "tinnhan" => "Thuộc tính sản phẩm này đã tồn tại"); // đã tồn tại
                } else
                    return array("status" => 0, "tinnhan" => "Điền đầy đủ thông tin"); // thuoc tinh rỗng
            } else
                return array("status" => 0, "tinnhan" => "Thuộc tính sản phẩm đã tồn tại"); // không được thêm
        } else
            return array("status" => 0, "tinnhan" => "Điền đầy đủ thông tin"); // thuoc tinh rỗng
    }

    function update_product_detail($data)
    {
        $list = array();
        foreach ($data['thuoctinh'] as $value) {
            if ($value != -1)
                $list[] = $value;
        }
        if (!empty($list)) {
            $chophepthem = true;
            $id_productattr = array();
            // kiem tra thuoc tinh chon
            $kq = $this->mydb->select("select DISTINCT productattr_id from productattr_detail where product_detail_id=-1 and product_id=:product_id ", array("product_id" => $data['id_sanpham']));
            foreach ($kq as $value) {
                $id_productattr[] = $value['productattr_id'];
            }
            // lay thuoc tinh chon sap them
            $sqlwhere = "attr_val_id=" . implode(" or attr_val_id=", $list);
            $kq = $this->mydb->select("select productattr_id from attr_val where $sqlwhere", array());
            foreach ($kq as $value) {
                if (in_array($value['productattr_id'], $id_productattr)) {
                    $chophepthem = false;
                }
            }
            if ($chophepthem) {

                $ar['product_detail_price'] = price_input($data['sotien']);
                $ar['product_detail_total'] = $data['soluong'];
                $ar['product_id'] = $data['id_sanpham'];

                $id_sanphamchitiet = $data['id_sanphamchitiet'];
                if (!empty($list)) {

                    $sqlwhere = " 
select product_detail_id from productattr_detail where productattr_detail.attr_val_id=" . implode(" ) and  product_detail.product_detail_id IN
(
select product_detail_id from productattr_detail where productattr_detail.attr_val_id=", $list) . ")";
                    $sql = "select  DISTINCT( product_detail.product_detail_id) from product_detail JOIN productattr_detail ON product_detail.product_detail_id=productattr_detail.product_detail_id
and productattr_detail.product_id=:product_id and  product_detail.product_detail_id IN (" . $sqlwhere;

                    $kq = $this->mydb->select($sql, array("product_id" => $ar['product_id']));

                    if (!empty($kq))
                        $lastid = $kq[0]['product_detail_id'];
                    else
                        $lastid = $id_sanphamchitiet;
                    if ($lastid == $id_sanphamchitiet) {
                        $sqlwhere = "attr_val.attr_val_id=" . implode(" or attr_val.attr_val_id= ", $data['thuoctinh']);
                        $kq = $this->mydb->select("select productattr.productattr_id,attr_val_id,attr_val_value,attr_val_label  from productattr JOIN attr_val ON productattr.productattr_id=attr_val.productattr_id and ( $sqlwhere )", array());
                        if (!empty($kq) && $data['soluong'] != '' && $data['sotien'] != '') {

                            $row = $this->mydb->update("product_detail", $ar, "product_detail_id=:product_detail_id", array("product_detail_id" => $id_sanphamchitiet));
                            $this->mydb->deleteall("productattr_detail", "product_detail_id=:product_detail_id", array("product_detail_id" => $id_sanphamchitiet));
                            $ar = null;
                            foreach ($kq as $value) {
                                $tenthuoctinh[$value['attr_val_id']] = $value['attr_val_label'];
                                $ar['product_id'] = $data['id_sanpham'];
                                $ar['product_detail_id'] = $id_sanphamchitiet;
                                $ar['attr_val_id'] = $value['attr_val_id'];
                                $ar['productattr_id'] = $value['productattr_id'];

                                $this->mydb->insert("productattr_detail", $ar);
                            }

                            $tenthuoctinh[-1] = "Null";

                            $html = '';
                            foreach ($data['thuoctinh'] as $value) {
                                $html .= '<td class="giatrithuoctinhchon" data-giatri="' . $value . '">' . $tenthuoctinh[$value] . '</td>';
                            }
                            $html .= "<td>" . $data['sotien'] . "</td>";
                            $html .= "<td>" . $data['soluong'] . "</td>";
                            $html .= '<td> <a type="button" data-id_sanphamchitiet="' . $id_sanphamchitiet . '"  class="xoahinhsanphamchitiet uk-modal-close uk-close uk-close-alt uk-position-absolute"></a>';
                            $html .= ' <div  data-id_sanphamchitiet="' . $id_sanphamchitiet . '" data-type="2" class="boxanhdaidien showmodalhinhanh" style="width: 100%;height:50px">';
                            $html .= '<img  class="img-responsive " title="' . $data['hinhsanpham'] . '" id="hinhsanpham" src="' . BASE_URL . 'public/upload/images/product/' . $data['hinhsanpham'] . '" ></div></td>';
                            $sua = '<a data-hinhsanphamchitiet="' . $data['hinhsanpham'] . '" data-idsanphamchitiet="' . $id_sanphamchitiet . '" data-giasanpham="' . $data['sotien'] . '" data-soluongsanpham="' . $data['soluong'] . '" class=" label label-info suasanphamchitiet">Sửa</a>';
                            $html .= '<td>' . $sua . ' <a data-id_sanphamchitiet="' . $id_sanphamchitiet . '" class="label label-danger xoasanphamchitiet">Xóa</a> </td>';

                            return array("status" => 1, "tinnhan" => "Thành công", "html" => $html);
                        }// Nếu thuộc tính không rỗng, tiền và số lượng không rỗng
                        else
                            return array("status" => 0, "tinnhan" => "Lỗi! Tiền và số lượng không rỗng");
                    }// 2 id_sanpham chi tiet bang nhau, nghĩa là chưa tồn tại cái giống vậy
                    else {
                        return array("status" => 0, "tinnhan" => "Lỗi! Thuộc tính sản phẩm tồn tại");
                    }
                }// thuoc tinh khong rong
                else
                    return array("status" => 0, "tinnhan" => "Lỗi! Chọn một thuộc tính cần thiết");
            } else
                return array("status" => 0, "tinnhan" => "Lỗi! Thuộc tính đã tồn tại");
        }
        return array("status" => 0, "tinnhan" => "Điền đầy đủ thông tin"); // thuoc tinh rỗng 
    }

    function delete_product_detail($data)
    {
        $id_sanphamchitiet = $data['id_sanphamchitiet'];
        $this->mydb->delete("product_detail", "product_detail_id=:product_detail_id", array("product_detail_id" => $id_sanphamchitiet));
        $this->mydb->deleteall("productattr_detail", "product_detail_id=:product_detail_id", array("product_detail_id" => $id_sanphamchitiet));
        return array("status" => 1);
    }

    function update_image_product_detail($data)
    {
        $id_sanphamchitiet = $data['id_sanphamchitiet'];
        $name = $_POST['name'];
        $this->mydb->update("product_detail", array("product_detail_avatar" => $name), "product_detail_id=:product_detail_id", array("product_detail_id" => $id_sanphamchitiet));
        return array("status" => 1);
    }

    function delete_image_product_detail($data)
    {
        $id_sanphamchitiet = $data['id_sanphamchitiet'];
        $this->mydb->update("product_detail", array("product_detail_avatar" => ''), "product_detail_id=:product_detail_id", array("product_detail_id" => $id_sanphamchitiet));
        return array("status" => 1);
    }

    function update_show_feature($col, $product_id, $giatri)
    {
        $this->mydb->update("product", array($col => $giatri), "product_id=:product_id", array("product_id" => $product_id));
        return array("status" => 1);
    }
}
