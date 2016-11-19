<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//$CI = &get_instance();
class Checksum extends MY_Controller {

    public function __construct() {
        parent::__construct("Checksum");
    }

    public function createchecksum() {
        if (isset($_SESSION['token']) && isset($_POST['token'])) {

            if ($_POST['token'] == $_SESSION['token']) {
                unset($_SESSION['token']);
                $_SESSION['token'] = generate_password();
                $data = $_POST;
                $key = hash_hmac("SHA1", implode("-", $data), HASH_KEY);
                echo json_encode(array("status" => 1, "token" => $_SESSION['token'], "checksum" => $key));
            } else
                echo json_encode(array("status" => 0));
        } else
            echo json_encode(array("status" => 0));
    }
}
