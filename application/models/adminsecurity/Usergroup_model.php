<?php

class Usergroup_model extends MY_Model {

    public $_index=0;
    function index() {
        
    }

    public function loadusergroup() {
        $menuData=array();
        $result = $this->mydb->select("select * from usergroup ORDER by usergroup_index ", array());
        foreach ($result as $value) {
            $menuData['items'][$value['usergroup_id']] = $value; //Lưu dữ liệu các biến có id khác nh
            $menuData['parent'][$value['usergroup_parent']][] = $value['usergroup_id'];
        }

        return $menu = $this->buiding_menu(0, $menuData);
    }

    function insert($data) {
        $count = $this->mydb->select("select max(usergroup_index) as max from usergroup", array());
        $index = $count[0]['max'] + 1;
        $data['usergroup_index'] = $index;
        $insert = $this->mydb->insert("usergroup", $data);
        return array('status' => 1, 'id' => $insert['id'], 'name' => $data['usergroup_name']);
    }
    function update($data)
    {
    $this->mydb->update("usergroup",$data,"usergroup_id=:usergroup_id",array('usergroup_id'=>$data['usergroup_id']));
    return array('status'=>1);
    }

    public function buiding_menu($parent, $menuData) {
        $html = "";
        if (isset($menuData['parent'][$parent])) {
            if ($parent != 0)
                $html.="<ul class='uk-nestable-list'>";
            foreach ($menuData['parent'][$parent] as $value) {
                $html.="<li data-id=" . $menuData['items'][$value]['usergroup_id'] . " class='uk-nestable-item'>";
                $html.="<div class='uk-nestable-panel'>"
                        . "<div class='uk-nestable-toggle' data-nestable-action='toggle'></div><span>" . $menuData['items'][$value]['usergroup_name'] . "</span> <a data-ten='" . $menuData['items'][$value]['usergroup_name'] . "'  class='itemedit uk-badge'><i class='uk-icon-pencil-square-o'></i> Chỉnh sửa</a>  ";
                $html.=" --- <a class='deletemenu uk-badge uk-badge-danger' ref='" . $menuData['items'][$value]['usergroup_id'] . "'><i class='uk-icon-times'></i>Xóa</a>";
                $html.="</div>";
                $html.=$this->buiding_menu($value, $menuData);
                $html.="</li>";
            }
            if ($parent != 0)
                $html.="</ul>";
        }
        return $html;
    }

    function usergroup_update_sort($data) {
        $obj = $data;
        $sort = json_decode($obj);
        $keys = 0;
        foreach ($sort as $key => $item) {

            if ($item->id != '') {
                $menu[$item->id]['usergroup_id'] = $item->id;
                $menu[$item->id]['usergroup_index'] = $this->_index;
                $menu[$item->id]['usergroup_parent'] = 0;
                $this->_index++;
                $keys++;
                $cha = $item->id;
                if (!empty($item->children)) {
                    $menu = $this->sort_menu($menu, $item->children, $cha, $keys, $this->_index);
                }
            }
        }
        if ($this->model->updatesort($menu))
            echo json_encode(array('status' => 1));
    }

    function sort_menu($menu, $obj, $cha, $stt) {
        foreach ($obj as $key => $item) {

            $menu[$item->id]['usergroup_id'] = $item->id;
            $menu[$item->id]['usergroup_index'] = $this->_index;
            $menu[$item->id]['usergroup_parent'] = $cha;
            $this->_index++;

            if (!empty($item->children)) {
                $menu = $this->sort_menu($menu, $item->children, $item->id, $this->_index);
            }
        }

        return $menu;
    }

    function updatesort($menu) {
   
        foreach ($menu as $value) {
            $data['usergroup_id'] = $value['usergroup_id'];
            $data['usergroup_index'] = $value['usergroup_index'];
            $data['usergroup_parent'] = $value['usergroup_parent'];

            $this->mydb->update("usergroup", $data, "usergroup_id=:usergroup_id", array('usergroup_id' => $value['usergroup_id']));
        }
        return true;
    }

    function load_usergroup_edit($menu_id) {
        $result = $this->mydb->select("select * from usergroup where usergroup_id=:usergroup_id", array('usergroup_id' => $menu_id));
        $this->load->helper("mydata");
        $result = $result[0];
        $name = $result['usergroup_name'];
        $id = $result['usergroup_id'];
        
        $html = <<<ABC
        <form class="form-horizontal" id="savemenu" style="text-align: center">
        <div class="uk-form-row">  
        <input hidden="" name="usergroup_id" type="text" value="{$id}" placeholder="">
        </div>
        
      <div class="form-group">  
          <label class="col-md-3" >Tên: </label>
       <div class="col-md-9">
    <input class="form-control" name="usergroup_name" type="text" value="{$name}" placeholder="">
        </div>
     </div>
     
        <div class="uk-form-row">  
        <button class="uk-button">LƯU</button>
        </div>
    
</form>
ABC;

        return array('html' => $html, 'tinhtrang' => 1);
    }
    function  buiding_deletemenu($dataxoa,$parent,$menuData){  
        if(isset($menuData['parent'][$parent])){
           
            foreach($menuData['parent'][$parent] as $value){
              $dataxoa[]=$value;
              $dataxoa=  $this->buiding_deletemenu($dataxoa,$value,$menuData);
            }
        
        }
    return $dataxoa;
    }
      
    function delete($id)
    {
                     
        $result= $this->mydb->select("select * from usergroup ORDER by usergroup_index ",array());
        
    
    foreach($result as $value){
        $menuData['items'][$value['usergroup_id']]=$value;
        $menuData['parent'][$value['usergroup_parent']][]=$value['usergroup_id'];
    }
   $dataxoa=$this->buiding_deletemenu(array(),$id,$menuData);
  
   if(!empty($dataxoa))
   {
      $strxoa="usergroup_id=".implode($dataxoa,' or usergroup_id=');
      $this->mydb->deleteall("usergroup",$strxoa,array());
     
   }
   $this->mydb->delete("usergroup","usergroup_id=:usergroup_id",array('usergroup_id'=>$id));     
            
          return array("id"=>$id,"status"=>1);
    }

}
