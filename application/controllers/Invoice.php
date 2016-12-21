<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//$CI = &get_instance();
class Invoice extends MY_Controller
{

    public function __construct()
    {
        parent::__construct("Invoice");
    }

    function index()
    {
        $this->load->helper(array("mydata_helper"));
        $mabaove = string_input($_GET['token']);
        $mahoadon = string_input($_GET['mahoadon']);
        $data = $this->model->load_invoice_detail($mahoadon, $mabaove);
        $data['hinhthucthanhtoan'] = get_checkout_type();
        $data['tinhtrang'] = get_invoice_state();

        $meta['title'] = $data['thongtin']['invoice_code'];
        $meta['image'] = LOGO;
        $data['meta'] = $meta;

        $this->data = $data;

        $this->load->view(THEME . '/hoadon/index');
    }
}
