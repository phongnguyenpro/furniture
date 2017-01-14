<?php

class Articles_model extends MY_Model
{

    function __construct($type = null)
    {
        parent::__construct($type);
    }

    public $danhmucbaiviet;
    public $danhmucbaivietchitiet;

    function set_article_category($data)
    {
        $this->danhmucbaiviet = $data;
    }

    function load_data_category($id_danhmuc, $page = 1)
    {
        $listdanhmuc = search_all_child($this->danhmucbaiviet, $id_danhmuc, array());
        array_push($listdanhmuc, $id_danhmuc);
        $sqlwhere = " articlescategory_id=" . implode(" or articlescategory_id=", $listdanhmuc);
        $limit = LIMITBAIVIET;
        $kq = $this->mydb->select("select count( DISTINCT ( articles.articles_id)) as row from articles JOIN articlescategory_detail ON articles.articles_id=articlescategory_detail.articles_id and articles_show=1 and ($sqlwhere) ", array());
        $totalRow = $kq[0]['row'];
        $nowpage = 3;
        $total_page = $totalRow == 0 ? 1 : ceil($totalRow / $limit);
        $start = $page == 1 ? 0 : ($page - 1) * $limit;
        $data['phantrang']['totalpage'] = $total_page;
        $data['phantrang']['currentpage'] = $page;
        $sql = "select articles.articles_id,articles_name,articles_slug,articles_date_create,articles_description,articles_avatar from articles JOIN articlescategory_detail ON articles.articles_id=articlescategory_detail.articles_id and articles_show=1 and ($sqlwhere) GROUP by articles.articles_id order by articles_index desc limit $start,$limit";
        $data['data'] = $this->mydb->select($sql, array());
        if (!empty($data['data'])) {
            return $data;
        } else
            $this->error();
    }

    function load_bre($id_danhmuc)
    {
        $bre = $this->search_parent_all($this->danhmucbaiviet, $id_danhmuc, array());
        $bre['itemdanhmucbaiviet'] = array();
        return $bre;
    }

    public function search_parent_all($data, $id_danhmuc, $danhsach)
    {
        $temp = $data['item'][$id_danhmuc];
        $temp['ten'] = $temp['articlescategory_name'];
        $temp['slug'] = BASE_URL . "danh-muc-bai-viet/" . $data['item'][$id_danhmuc]['articlescategory_slug']."-".$data['item'][$id_danhmuc]['articlescategory_id'];
        $danhsach['info'][] = $temp;
        $danhsach['itemdanhmucbaiviet'][$data['item'][$id_danhmuc]['articlescategory_id']] = $data['item'][$id_danhmuc];
        $cha = $data['item'][$id_danhmuc]['articlescategory_parent'];
        if ($cha != 0) {
            $danhsach = $this->search_parent_all($this->danhmucbaiviet, $cha, $danhsach);

        }

        $danhsach['thongtindanhmucchinh'] = $this->danhmucbaiviet['item'][$id_danhmuc];
        return $danhsach;
    }

    function load_articles_details($id_baiviet)
    {
        $kq = $this->mydb->select("select * from articles where articles_id=:articles_id", array("articles_id" => $id_baiviet));
        if (!empty($kq)) {
            $data['baiviet'] = $kq[0];
            $x = strpos($data['baiviet']['articles_content'], "{readmore}");
            if ($x > 0) {
                $data['baiviet']['articles_description'] = substr($data['baiviet']['articles_content'], 0, $x);
                $data['baiviet']['articles_content'] = substr($data['baiviet']['articles_content'], $x + 10);
            } else {
                $data['baiviet']['articles_description'] = '';
            }

            // load tag
            // load tag
            $kq = $this->mydb->select("select * from tag JOIN articles_tag ON tag.tag_id=articles_tag.tag_id AND articles_id=:articles_id order by tag_index", array("articles_id" => $id_baiviet));
            $data['tag'] = $kq;
            // end load tag
            // load bre
            $data['baiviet']['danhmuc'] = $this->mydb->select("select * from articlescategory_detail JOIN articlescategory ON articlescategory_detail.articlescategory_id=articlescategory.articlescategory_id and articles_id=:articles_id order by articlescategory_index ", array("articles_id" => $id_baiviet));
            // end load tag
            $data['bre']['info'] = array();
            $data['bre']['itemdanhmucbaiviet'] = array();
            if (!empty($data['baiviet']['danhmuc'])) {
                $thongtin = array("ten" => $data['baiviet']['articles_name']);
                $bre['info'][] = $thongtin;
                $id_danhmuc = $data['baiviet']['danhmuc'][0]['articlescategory_id'];
                $bre = $this->search_parent_all($this->danhmucbaiviet, $id_danhmuc, $bre);
                $data['bre'] = $bre;
                $data['bre']['itemdanhmucbaiviet'] = array();

            } else {
                $thongtin = array("ten" => $data['baiviet']['articles_name']);
                array_push($data['bre']['info'], $thongtin);
            }

            // load bre
            // bai viet lien quan
            $data['baivietlienquan'] = array();
            if (!empty($data['baiviet']['danhmuc'])) {
                // Load bai viet lien quan

                $sql = " articles_id in ( SELECT * FROM ( select DISTINCT (articles.articles_id) from articles JOIN articlescategory_detail ON articles.articles_id=articlescategory_detail.articles_id and articles.articles_id!=$id_baiviet and articles_show=1  and";
                foreach ($data['baiviet']['danhmuc'] as $value) {
                    $listdanhmuc[] = $value['articlescategory_id'];
                }
                $limit = LIMITSANPHAMLIENQUAN;
                $sql .= "( articlescategory_id=" . implode(" or articlescategory_id=", $listdanhmuc) . ") order by articles_index desc limit $limit ) as t )";

                if (!empty($data['tag'])) {
                    $sql .= " or articles_id in ( SELECT * FROM ( select DISTINCT (articles.articles_id) from articles JOIN articles_tag ON articles.articles_id=articles_tag.articles_id and articles.articles_id!=$id_baiviet and articles_show=1 and articles_date_create < now() and";
                    foreach ($data['tag'] as $value) {
                        $listtag[] = $value['tag_id'];
                    }
                    $limit = LIMITSANPHAMLIENQUAN;
                    $sql .= "( tag_id=" . implode(" or tag_id=", $listtag) . ") order by articles_index desc limit $limit ) as t )";

                }
                $sql = "select articles_id,articles_description,articles_name,articles_slug,articles_avatar,articles_date_create from articles where " . $sql;
                $data['baivietlienquan'] = $this->mydb->select($sql, array());

                // End load bai viet lien quan
            }

            return $data;
        } else
            $this->error();
    }

    function tag($tag_id, $page)
    {
        // tinh phan trang
        $kq = $this->mydb->select("select count(*) as row from articles_tag where tag_id=:tag_id", array("tag_id" => $tag_id));
        $limit = LIMITBAIVIET;
        $totalRow = $kq[0]['row'];
        $total_page = $totalRow == 0 ? 1 : ceil($totalRow / $limit);
        $start = $page == 1 ? 0 : ($page - 1) * $limit;
        $data['phantrang']['totalpage'] = $total_page;
        $data['phantrang']['currentpage'] = $page;
        $kq = $this->mydb->select("select articles.articles_id,articles_description,articles_avatar,articles_name,articles_slug,articles_date_create from articles JOIN articles_tag ON articles.articles_id=articles_tag.articles_id and articles_show=1 and tag_id=:tag_id order by articles_index limit $start,$limit", array("tag_id" => $tag_id));
        $data['baiviet'] = $kq;

        $kq = $this->mydb->select("select tag_name,tag_id,tag_slug,tag_view from tag where tag_id=:tag_id", array("tag_id" => $tag_id));
        if (!empty($kq)) {
            $data['thongtintag'] = $kq[0];
            $this->mydb->update("tag", array("tag_view" => $data['thongtintag']['tag_view'] + 1), "tag_id=:tag_id", array("tag_id" => $tag_id));
        } else
            $this->error();
        $data['bre']['info'][] = array("ten" => $kq[0]['tag_name'], "slug" => "");
        $data['bre']['info'][] = array("ten" => "Tag", "slug" => "");
        return $data;
    }
}
