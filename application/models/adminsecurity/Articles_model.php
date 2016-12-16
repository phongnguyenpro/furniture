<?php

class Articles_model extends MY_Model
{
    function __construct($type = null)
    {
        parent::__construct($type);
    }

    public $danhmucbaiviet;

    function articles_ajax($data)
    {
        $data['sqlwhere'] = '';
        if ($data['articlescategory_id'] != -1) {
            $id_danhmuc = $data['articlescategory_id'];
//            $this->load_category_edit();
            $danhsachcon = search_all_child($this->danhmucbaiviet, $id_danhmuc, array());
            if (empty($danhsachcon))
                $sqlwhere = " articlescategory_id=$id_danhmuc ";
            else
                $sqlwhere = " articlescategory_id=$id_danhmuc or articlescategory_id=" . implode(" or articlescategory_id=", $danhsachcon);

            $data['sqlwhere'] = $sqlwhere;

        }
        $table = 'articles';
        $tableJoin = 'articlescategory_detail';

// Table's primary key
        $primaryKey = 'articles_id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
        $columns = array(
            array('db' => 'articles_id', 'dt' => 0),
            array('db' => 'articles_index', 'dt' => 1),
            array('db' => 'articles_avatar', 'dt' => 2),
            array('db' => 'articles_name', 'dt' => 3),
            array('db' => 'articles_date_create', 'dt' => 4),
            array('db' => 'articles_feature', 'dt' => 5),
            array('db' => 'articles_show', 'dt' => 6),
        );

// SQL server connection information
        $this->load->database();
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname,
        );

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */
        $this->load->library("ssptable");
        echo json_encode(
            $this->ssptable->simple($data, $sql_details, $table, $tableJoin, $primaryKey, $columns, $data['sqlwhere'], 'quanly_baiviet')
        );

    }

    function load_articles_category()
    {
        $result = $this->mydb->select("select * from articlescategory ORDER by articlescategory_index ", array());
        $menuData = array();
        foreach ($result as $value) {
            $menuData['items'][$value['articlescategory_id']] = $value;//Lưu dữ liệu các biến có id khác nh
            $menuData['parent'][$value['articlescategory_parent']][] = $value['articlescategory_id'];
        }

        $this->danhmucbaiviet = $menuData;
        return $menuData;
    }

    function load_tag()
    {
        return $this->mydb->select("select * from tag order by tag_index ", array());
    }

    function insert($data)
    {
        $x = strpos($data['articles_content'], "{readmore}");
        if ($x > 0) {
            $data['articles_description'] = string_input(substr($data['articles_content'], 0, $x));
        }
        // end xu readmore

        $data['articles_date_create'] = date_input($data['articles_date_create']);

        // danh mục
        if (isset($data['articlescategory_id'])) {
            foreach ($data['articlescategory_id'] as $value) {
                $danhmuc[] = $value;
            }
            unset($data['articlescategory_id']);
        }
        // end danh mục
        // tag
        if (isset($data['tag'])) {
            $tagbaiviet = $data['tag'];
            unset($data['tag']);
        }
        // end tag

        // thong tin phu
        $data['articles_show'] = 1;
        $data['articles_feature'] = 0;
        $data['articles_view'] = 0;
        $data['articles_like'] = 0;
        // end thong tin phu
        if (isset($data['articles_avatar'])) {
            $file = $data['articles_avatar'];
            $this->load->library("image");
            if ($this->image->ktfileanh($file)) {
                $name = slug($data['articles_name']) . '-' . rand(0, 100) . time() . "." . $this->image->getExtension($file['name']);
                $url = "public/upload/images/thumb_articles/" . $name;
                $this->image->crop($file['tmp_name'], $url, WIDTHANHBAIVIET, HEIGHTANHBAIVIET, KIEUIMAGE);
                $data['articles_avatar'] = $name;
            } else
                unset ($data['articles_avatar']);
        }
        $kq = $this->mydb->select("select max(articles_index) as max from articles", array());
        $max = $kq[0]['max'] + 1;
        $data['articles_index'] = $max;
        $row = $this->mydb->insert("articles", $data);
        $id = $row['id'];
        if (isset($danhmuc)) {
            foreach ($danhmuc as $value) {
                $this->mydb->insert("articlescategory_detail", array("articles_id" => $id, "articlescategory_id" => $value));
            }
        }
        // them tag
        $kq = $this->mydb->select("select * from tag order by tag_index", array());
        foreach ($kq as $value) {
            $tag[$value['tag_id']] = $value['tag_name'];
        }
        if (isset($tagbaiviet)) {
            foreach ($tagbaiviet as $value) {
                if (in_array($value, $tag)) {
                    $this->mydb->insert("articles_tag", array("articles_id" => $id, "tag_id" => array_keys($tag, $value)[0]));
                } else {
                    $row = $this->mydb->insert("tag", array("tag_name" => $value, "tag_view" => 0, "tag_slug" => slug($value), "tag_search" => loaibodau($value)));
                    $id_tag = $row['id'];
                    $this->mydb->insert("articles_tag", array("articles_id" => $id, "tag_id" => $id_tag));
                }
            }
        }
        return TRUE;
    }

    function update_show($col, $id_baiviet, $giatri)
    {
        $this->mydb->update("articles", array($col => $giatri), "articles_id=:articles_id", array("articles_id" => $id_baiviet));
        return array("status" => 1);
    }

    function sort_articles($obj)
    {
        $sort = json_decode($obj);
        $stt = 1;
        $i = 0;
        $datastt = array();
        foreach ($sort as $key => $item) {
            $id = $item->id;
            $stt = $item->stt;
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
            $this->mydb->update("articles", array("articles_index" => $value), "articles_id=:articles_id", array("articles_id" => $key));
        }
        echo json_encode(array("status" => 1));
//     echo "<pre>";
//     print_r($datasapxep);
//     echo "</pre>";
    }

    function delete_articles($id_baiviet)
    {
        $kq = $this->mydb->select("select articles_avatar from articles where articles_id=:articles_id", array("articles_id" => $id_baiviet));
        $hinhdaidien = $kq[0]['articles_avatar'];
        if ($hinhdaidien != "") {
            $link = "public/upload/images/thumb_articles/" . $hinhdaidien;
            if (file_exists($link) && is_file($link))
                unlink($link);
        }
        $this->mydb->deleteall("articlescategory_detail", "articles_id=:articles_id", array("articles_id" => $id_baiviet));
        $this->mydb->delete("articles", "articles_id=:articles_id", array("articles_id" => $id_baiviet));
        return array("status" => 1);
    }

    function edit_articles($id_baiviet)
    {
        $kq = $this->mydb->select("select * from articles where articles_id=:articles_id", array("articles_id" => $id_baiviet));
        $data['baiviet'] = $kq[0];
        $data['baiviet']['danhmucbaivietchitiet'] = array();
        $kq = $this->mydb->select("select * from articlescategory_detail where articles_id=:articles_id", array("articles_id" => $id_baiviet));
        foreach ($kq as $value) {
            $data['baiviet']['danhmucbaivietchitiet'][] = $value['articlescategory_id'];
        }

        // tag baivet
        $data['baiviet']['tagbaiviet'] = array();
        $data['baiviet']['tag'] = array();
        $kq = $this->mydb->select("select * from tag order by tag_index", array());

        foreach ($kq as $value) {
            $data['baiviet']['tag'][$value['tag_id']] = $value['tag_name'];
        }
        $kq = $this->mydb->select("select * from articles_tag where articles_id=:articles_id", array("articles_id" => $id_baiviet));
        foreach ($kq as $value) {
            $data['baiviet']['tagbaiviet'][$value['tag_id']] = $data['baiviet']['tag'][$value['tag_id']];
        }
        // end tag

        $data['baiviet']['articles_date_create'] = date_out($data['baiviet']['articles_date_create']);
        return $data;
    }

    public function update_articles($data)
    {
        $id_baiviet = $data['articles_id'];
        unset($data['articles_id']);
//        if (isset($data['id_ngonngu'])) {
//            $id_ngonngu = $data['id_ngonngu'];
//            if ($id_ngonngu != -1) {
//                // xét xem có khác hiện tại không
//                $kq = $this->select("select id_ngonngu from baiviet where id_baiviet=:id_baiviet", array("id_baiviet" => $id_baiviet));
//                $id_ngonnguhientai = $kq[0]['id_ngonngu'];
//                if ($id_ngonnguhientai != $id_ngonngu) {
//                    $this->deleteall("danhmucbaivietchitiet", "id_baiviet=:id_baiviet", array("id_baiviet" => $id_baiviet));
//                    $this->update("baiviet", array("id_ngonngu" => $id_ngonngu), "id_baiviet=:id_baiviet", array("id_baiviet" => $id_baiviet));
//
//                    header("Location:" . URL . "administrator247/dashboard/editbaiviet/" . $id_baiviet);
//                    exit();
//                }
//
//
//            }
//        }

        // xu ly du lieu
        //
        //    // xu ly mieu ta va readmore
        $x = strpos($data['articles_content'], "{readmore}");
        if ($x > 0) {
            $data['articles_description'] = string_input(substr($data['articles_content'], 0, $x));
        }
        // end xu readmore

        $data['articles_date_create'] = date_input($data['articles_date_create']);

        // danh mục
        if (isset($data['articlescategory_id'])) {
            foreach ($data['articlescategory_id'] as $value) {
                $danhmuc[] = $value;
            }
            unset($data['articlescategory_id']);
        }
        // end danh mục
        // tag
        // tag san pham
        if (isset($data['tag'])) {
            $tagbaiviet = $data['tag'];
            unset($data['tag']);
        }
        // end tag
        // hien thi va noi bat
        if (isset($data['articles_show']))
            $data['articles_show'] = 1;
        else
            $data['articles_show'] = 0;

        if (isset($data['articles_feature']))
            $data['articles_feature'] = 1;
        else
            $data['articles_feature'] = 0;
        // end hien thi va noi bat
        // hinh dai dien
        $hinhdaidien = $data['articles_avatar'];
        $file = $data['filehinhdaidien'];
        unset($data['filehinhdaidien']);
        $this->load->library("image");
        if ($this->image->ktfileanh($file)) {

            $name = slug($data['articles_name']) . '-' . rand(0, 100) . time() . "." . $this->image->getExtension($file['name']);
            $url = "public/upload/images/thumb_articles/" . $name;

            $this->image->crop($file['tmp_name'], $url, WIDTHANHBAIVIET, HEIGHTANHBAIVIET, KIEUIMAGE);
            $data['articles_avatar'] = $name;
            $urlxoa = "public/upload/images/thumb_articles/" . $hinhdaidien;
            if (file_exists($urlxoa) && is_file($urlxoa))
                unlink($urlxoa);
        }
        // end hinh dai dien


        $this->mydb->update("articles", $data, "articles_id=:articles_id", array("articles_id" => $id_baiviet));

        // cap nhat danh muc
        $this->mydb->deleteall("articlescategory_detail", "articles_id=:articles_id", array("articles_id" => $id_baiviet));
        if (isset($danhmuc)) {
            foreach ($danhmuc as $value) {
                $this->mydb->insert("articlescategory_detail", array("articles_id" => $id_baiviet, "articlescategory_id" => $value));
            }
        }

        // cap nhat tag
        // select tat ca tag
        $kq = $this->mydb->select("select * from tag order by tag_index", array());
        foreach ($kq as $value) {
            $tag[$value['tag_id']] = $value['tag_name'];
        }
        $this->mydb->deleteall("articles_tag", "articles_id=:articles_id", array("articles_id" => $id_baiviet));
        if (isset($tagbaiviet)) {
            foreach ($tagbaiviet as $value) {
                if (in_array($value, $tag)) {
                    $this->mydb->insert("articles_tag", array("articles_id" => $id_baiviet, "tag_id" => array_keys($tag, $value)[0]));
                } else {
                    $row = $this->mydb->insert("tag", array("tag_name" => $value, "tag_view" => 0, "tag_slug" => slug($value), "tag_search" => loaibodau($value)));
                    $id_tag = $row['id'];
                    $this->mydb->insert("articles_tag", array("articles_id" => $id_baiviet, "tag_id" => $id_tag));
                }
            }
        }
        //end tag
        header("Location:" . ADMIN_URL . "articles/edit_articles/" . $id_baiviet);
    }
}
