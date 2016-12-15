<?php

class Invoice extends MY_Controller
{
    function __construct()
    {
        parent::__construct("Invoice", "admin");
    }

    function index()
    {
        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/invoice/index");
    }

    function load_data_ssp()
    {
        $this->model->load_data_ssp($_POST);
    }

    function view($invoice_id)
    {
        $this->data_invoice = $this->model->load_invoice($invoice_id);
        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/invoice/view");
    }

    function delete_invoice()
    {
        $id_hoadon = string_input($_POST['id_hoadon']);
        echo json_encode($this->model->xoahoadon($id_hoadon));
    }

    function update_quantity()
    {
        $data = $_POST['data'];
        echo json_encode($this->model->update_quantity($data));
    }

    public function delete_invoice_detail()
    {
        echo json_encode($this->model->delete_invoice_detail($_POST));
    }

    public function update_invoice()
    {
        $data = $_POST;
        echo json_encode($this->model->update_invoice($data));
    }

    public function invoice_payment()
    {
        echo json_encode($this->model->invoice_payment($_POST['id_hoadon']));
    }
}