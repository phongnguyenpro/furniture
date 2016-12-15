<?php

class ArticlesCategory extends MY_Controller
{
    public $stt = 1;

    function __construct()
    {
        parent::__construct("ArticlesCategory", "admin");
    }

    function index()
    {
        $this->menu = $this->model->load_articles_category();
        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/articlescategory/index");
        $this->load->view("adminsecurity/footer");
    }

    function create_articles_category()
    {
        $data = array("articlescategory_parent" => 0);
        foreach ($_POST['data'] as $key => $value) {
            $data[$value['name']] = $value['value'];
        }
        echo json_encode($this->model->create_articles_category($data));
    }

    function delete_articles_category()
    {
        $id = $_POST['id'];
        echo json_encode($this->model->delete_articles_category($id));
    }

    public function sort()
    {
        $obj = $_POST['danhmucbaiviet'];
        $sort = json_decode($obj);

        $keys = 0;
        foreach ($sort as $key => $item) {
            if ($item->id != '') {
                $menu[$item->id]['id'] = $item->id;
                $menu[$item->id]['stt'] = $this->stt;
                $menu[$item->id]['cha'] = 0;
                $this->stt++;
                $keys++;
                $cha = $item->id;
                if (!empty($item->children)) {
                    $menu = $this->menu($menu, $item->children, $cha, $keys, $this->stt);
                }
            }
        }
        if ($this->model->updatesort($menu))
            echo json_encode(array('status' => 1));
    }

    function menu($menu, $obj, $cha, $stt)
    {
        $a = get_format_menu();
        foreach ($obj as $key => $item) {
            $menu[$item->id]['id'] = $item->id;
            $menu[$item->id]['stt'] = $this->stt;
            $menu[$item->id]['cha'] = $cha;
            $this->stt++;

            if (!empty($item->children)) {
                $menu = $this->menu($menu, $item->children, $item->id, $this->stt);
            }
        }

        return $menu;
    }

    function load_info_articles_category()
    {
        $id = $_POST['id'];
        echo json_encode($this->model->load_info_articles_category($id));
    }

    function update_info_articles_category()
    {
        $data = $_POST;
        echo json_encode($this->model->update_info_articles_category($data));
    }

}