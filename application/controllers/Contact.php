<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//$CI = &get_instance();
class Contact extends MY_Controller
{

    public function __construct()
    {
        parent::__construct("Contact");
    }

    function index()
    {
        $meta = array();
        $meta['title'] = "Liên hệ";
        $meta['description'] = MIEUTA;
        $meta['image'] = LOGO;
        $data['meta'] = $meta;

        $this->load->model(array("module_model"));
        $data['category'] = $this->module_model->category();
        $data['menu'] = $this->module_model->menu();

        $data['footer'] = $this->module_model->footer();


        $data['bre']['info'][0] = array("ten" => "Liên hệ");
        $data['bre']['itemdanhmucsanpham'] = array();

        $this->data = $data;

        $this->load->view(THEME . '/header');
        $this->load->view(THEME . '/lienhe/index');
        $this->load->view(THEME . '/footer');
    }
}
