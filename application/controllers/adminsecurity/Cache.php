<?php

class Cache extends MY_Controller {

    public function __construct() {
        parent::__construct("Cache", "admin");
    }

    function list_files($directory = '.') {
        $data = array();
        if ($directory != '.') {
            $directory = rtrim($directory, '/') . '/';
        }
        if ($handle = opendir($directory)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != '.' && $file != '..') {
                    $data[] = $file;
                }
            }

            closedir($handle);
        }
        return $data;
    }

    function index() {
        $data['total'] = 0;
        $filesize = 0;
        $filecache = $this->list_files("application/cache/sql/");
        $data['total'] += count($filecache);
        foreach ($filecache as $value) {
            $filesize+=filesize("application/cache/sql/" . $value);
        }
        $filecache = $this->list_files("application/cache/html/");
        $data['total'] += count($filecache);
        foreach ($filecache as $value) {
            $filesize+=filesize("application/cache/sql/" . $value);
        }
        $data["totalsize"] = $filesize;

        $this->data["data"] = $data;
        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/extension/cache");
        $this->load->view("adminsecurity/footer");
    }

    function clearcache() {
        $filecache = $this->list_files("application/cache/sql/");
        foreach ($filecache as $value) {
            unlink("application/cache/sql/" . $value);
        }
        $filecache = $this->list_files("application/cache/html/");
        foreach ($filecache as $value) {
            unlink("application/cache/html/" . $value);
        }
        echo json_encode(array("status" => 1));
    }

}
