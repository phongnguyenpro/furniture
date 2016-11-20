<?php

class Module {
    public function __construct() {
        
    }

    function run() {
        // load dữ liệu module ở đây
    }

    function category() {
    
      // load dữ liệu cho quá trình sử dụng lại. Ví dụ danh mục sản phẩm
        $this->load("header");
        $this->header->category();
        
    }

    function load($name) {
        $name_class = string_title($name).'_module';
        if (file_exists($file_path = APPPATH . "libraries/module/" .$name_class.".php")) {
            require $file_path;
            $this->$name = new $name_class();
            $this->$name->mydb = $this->mydb;
        } else {
            echo "Module not found";
            exit();
        }
    }

}
