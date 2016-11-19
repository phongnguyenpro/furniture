<?php

class Career_model extends MY_Model {

    public $career_id;
    public $career_name;
    public $career_index;
    public $career_date_update;
    public $career_user_update;
    function __construct($type = null) {
        parent::__construct($type);
    }
       function index() {
        return $this->mydb->select("select * from career order by career_index");
    }

    function sort_career($data) {

        foreach ($data as $value) {
            $dataupdate['career_index'] = $value['career_index'];
            $dataupdate['career_date_update'] = today();
            $this->mydb->update("career", $dataupdate, "career_id=:career_id", array('career_id' => $value['career_id']));
        }
        echo json_encode(array("status" => 1));
    }
      public function insert($career_name)
    {
        $kq=$this->mydb->select("select max(career_index) as max from career",array());
        $max=$kq[0]['max']+1;
        
        $this->mydb->insert("career",array('career_name'=>$career_name,'career_index'=>$max,"career_date_update"=>  today()));
        header("Location:".ADMIN_URL."career");
    }
          public function update($career_name,$career_id)
    {
          $this->mydb->update("career",array('career_name'=>$career_name,"career_date_update"=>today()),"career_id=:career_id",array('career_id'=>$career_id));
          header("Location:".ADMIN_URL."career");
    }

}
