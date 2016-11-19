<?php
class Config extends MY_Controller
{
    function __construct() {
        parent::__construct("Config","admin");
    }
      function index()
    {
          
          $this->data["config"]= $this->read_file_config();
          $this->load->view("adminsecurity/header");  
          $this->load->view("adminsecurity/config/index");  
          $this->load->view("adminsecurity/footer");          
    }
    function read_file_config()
    {
        $xml = simplexml_load_file("public/file/xml/config.xml") or die("Error: Cannot create object");
        foreach ($xml as $key => $value) {
            $data[$key] = $value;
        }
        return $data;
    }
    function save()
    {
         if (isset($_POST['cache']))
            $_POST['cache'] = 1;
        else
            $_POST['cache'] = 0;
             $xml = new SimpleXMLElement('<xml/>');
 
        foreach ($_POST as $key => $value) {
            $xml->addChild($key, $value);
        }
        Header('Content-type: text/xml');
        $xml->asXML("public/file/xml/config.xml");
        header("Location:" .ADMIN_URL. "config");
        
    }
        
    
}