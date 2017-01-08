<?php

class Productcategory_model extends MY_Model
{

    public $productcategory_id;
    public $productcategory_name;
    public $productcategory_parent;
    public $productcategory_index;
    public $productcategory_slug;
    public $productcategory_icon;
    public $productcategory_panel;
    public $career_id;
    public $productcategory_show;
    public $productcategory_showmenu;
    public $productcategory_date_update;
    public $productcategory_user_update;
    public $index;

    function index()
    {
        $menuData = array();
        $result = $this->mydb->select("select * from productcategory ORDER by productcategory_index ");

        foreach ($result as $value) {
            $menuData['items'][$value['productcategory_id']] = $value;
            $menuData['parent'][$value['productcategory_parent']][] = $value['productcategory_id'];
        }

        return $this->buiding_category(0, $menuData);
    }

    function insert($data)
    {

        $count = $this->mydb->select("select max(productcategory_index) as max from productcategory", array());
        $index = $count[0]['max'] + 1;
        $data['productcategory_index'] = $index;
        $data['productcategory_show'] = 1;
        $data['productcategory_parent'] = 0;
        $data['productcategory_date_update'] = today();
        $insert = $this->mydb->insert("productcategory", $data);
        return array('status' => 1, 'id' => $insert['id'], 'name' => $data['productcategory_name']);
    }

    function update($data)
    {
        $kq = $this->mydb->select("select career_id from productcategory where productcategory_id=:productcategory_id", array("productcategory_id" => $data['productcategory_id']));
        $current_career = $kq[0]['career_id'];

        // Nganh nghe doi
        if ($current_career != $data['career_id']) {
            //  $this->deleteall("danhmucsanphamchitiet", "id_danhmuc=:id_danhmuc", array("id_danhmuc" => $data['id_danhmuc']));
        }
        $data["productcategory_date_update"] = today();
        $this->mydb->update("productcategory", $data, "productcategory_id=:productcategory_id", array('productcategory_id' => $data['productcategory_id']));
        return array('status' => 1);
    }

    function delete($id)
    {
        $this->load->model("adminsecurity/menu_model");
        $result = $this->mydb->select("select * from productcategory ORDER by productcategory_index ", array());


        foreach ($result as $value) {
            $menuData['items'][$value['productcategory_id']] = $value;
            $menuData['parent'][$value['productcategory_parent']][] = $value['productcategory_id'];
        }
        $datadelete = $this->menu_model->buiding_deletemenu(array(), $id, $menuData);

        if (!empty($datadelete)) {
            $strdelete = "productcategory_id=" . implode(' or productcategory_id=', $datadelete);
            $this->mydb->deleteall("productcategory", $strdelete, array());
            $this->mydb->deleteall("productcategory_detail", $strdelete, array());
        }


        $this->mydb->delete("productcategory", "productcategory_id=:productcategory_id", array('productcategory_id' => $id));
        $this->mydb->delete("productcategory_detail", "productcategory_id=:productcategory_id", array('productcategory_id' => $id));
        return array("id" => $id, "status" => 1);
    }

    function load_category_edit($id)
    {
        $this->load->model("adminsecurity/career_model");
        $nganhnghe = $this->career_model->index();
        $kq = $this->mydb->select("select * from productcategory where productcategory_id=:productcategory_id", array('productcategory_id' => $id));
        $kq = $kq[0];
        $ten = $kq['productcategory_name'];
        $slug = $kq['productcategory_slug'];
        $id = $kq['productcategory_id'];
        $slugview = BASE_URL . "danh-muc/" . $id . "/" . $slug;
        $icon = $kq['productcategory_icon'];
        $quangcao = $kq["productcategory_panel"];
        $id_nganhnhge = $kq['career_id'];


        if ($kq['productcategory_show'] == 1)
            $hienthi = '<input  value=1 type="checkbox" checked name="productcategory_show">';
        else
            $hienthi = '<input  value=2 type="checkbox"  name="productcategory_show">';
        if ($kq['productcategory_showmenu'] == 1)
            $hienThiMenu = '<input  value=1 type="checkbox" checked name="productcategory_showmenu">';
        else
            $hienThiMenu = '<input  value=2 type="checkbox"  name="productcategory_showmenu">';
        $select = "<select class='form-control'  id='career_id' name='career_id'>";

        foreach ($nganhnghe as $value) {
            $select .= "<option ";
            if ($value['career_id'] == $id_nganhnhge)
                $select .= "selected='selected' ";
            $select .= " value=" . $value['career_id'] . ">" . $value['career_name'] . "</option> ";
        }
        $select .= "<option " . ($id_nganhnhge == -1 ? "selected" : "") . " value=-1 >Tất cả</option>";
        $select .= "</select>";
        $html = <<<ABC
        <form class="form-horizontal" id="savecategory">
 
        <div class="form-group">
            <label class="control-label col-sm-3" for="email"> Tên danh mục </label>
    <div class="col-sm-8">
        <input class="form-control" name="productcategory_name" value='{$ten}' type="text" id="tenedit" placeholder="">
         <input hidden="" name="productcategory_id" type="text" value="{$id}" placeholder="">
    </div>
  </div>

    
      <div class="form-group ">
            <label class="control-label col-sm-3" for="email"> Slug danh mục </label>
    <div class="col-sm-8">
        <input class="form-control"  name="productcategory_slug"  value='{$slug}' type="text" placeholder="">
       
    </div>
  </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="email"> Icon danh mục </label>
    <div class="col-sm-8">
        <input class="form-control" id="linkIconEdit"  name="productcategory_icon"  value='{$icon}' type="text" placeholder="">
       
    </div>
    <div class="col-sm-1" style="line-height:34px;">
                            <a onclick="BrowseServer('linkIconEdit','Images');"><i style="color:blue; font-size:20px;"
                                                                               class="uk-icon-edit"></i></a>
                        </div>
  </div>
        
         <div class="form-group">
            <label class="control-label col-sm-3" for="email">Panner </label>
    <div class="col-sm-8">
        <input class="form-control" id="linkPannerEdit"  name="productcategory_panel"  value='{$quangcao}' type="text" placeholder="">
       
    </div>
    <div class="col-sm-1" style="line-height:34px;">
                            <a onclick="BrowseServer('linkPannerEdit','Images');"><i style="color:blue; font-size:20px;"
                                                                               class="uk-icon-edit"></i></a>
                        </div>
  </div>
       <div class="form-group ">
            <label class="control-label col-sm-3" for="email"> Đường dẫn trang </label>
          <div class="col-sm-8">
          <input class="form-control" id="slugview" type="text" value="{$slugview}" placeholder="">
         </div>
  </div>
      
              
   
          
         <div class="form-group">  
           <label class="control-label col-sm-3" for="email"> Ngành nghề </label>
     <div class="col-sm-8">
         $select
              </div>
        </div>
    
           <div class="form-group">  
           <label class="control-label col-sm-3" for="email"> Hiển thị </label>
     <div class="col-sm-8">
       $hienthi
              </div>
        </div>   
           <div class="form-group">  
           <label class="control-label col-sm-3" for="email"> Hiển thị menu</label>
     <div class="col-sm-8">
       $hienThiMenu
              </div>
        </div>  
                  
        <div class="form-group text-center">  
        <button class="uk-button">LƯU</button>
        </div>
</form>
ABC;

        return array('html' => $html, 'status' => 1);
    }

    public function buiding_category($parent, $menuData)
    {
        $html = "";
        if (isset($menuData['parent'][$parent])) {
            if ($parent != 0)
                $html .= "<ul class='uk-nestable-list'>";
            foreach ($menuData['parent'][$parent] as $value) {
                $html .= "<li data-id=" . $menuData['items'][$value]['productcategory_id'] . " class='uk-nestable-item '>";
                $html .= "<div class='uk-nestable-panel'>"
                    . "<div class='uk-nestable-toggle' data-nestable-action='toggle'></div><span>" . $menuData['items'][$value]['productcategory_name'] . "</span> <a class='itemedit uk-badge'><i class='uk-icon-pencil-square-o'></i> Chỉnh sửa</a> ";
                $html .= "--- <a class='deletemenu uk-badge uk-badge-danger' ref='" . $menuData['items'][$value]['productcategory_id'] . "'><i class='uk-icon-times'></i>Xóa</a> ";
                $html .= "</div>";
                $html .= $this->buiding_category($value, $menuData);
                $html .= "</li>";
            }
            if ($parent != 0)
                $html .= "</ul>";
        }
        return $html;
    }


    function sort_category()
    {
        $this->load->model("adminsecurity/menu_model");
        $obj = $_POST['productcategory'];
        $sort = json_decode($obj);
        $keys = 0;
        foreach ($sort as $key => $item) {

            if ($item->id != '') {
                $menu[$item->id]['menu_id'] = $item->id;
                $menu[$item->id]['menu_index'] = $this->index;
                $menu[$item->id]['menu_parent'] = 0;
                $this->index++;
                $keys++;
                $cha = $item->id;
                if (!empty($item->children)) {
                    $menu = $this->menu_model->sort_menu($menu, $item->children, $cha, $keys, $this->index);
                }
            }
        }

        if ($this->model->update_sort($menu))
            echo json_encode(array('status' => 1));
    }

    function update_sort($menu)
    {
        foreach ($menu as $value) {
            $data = array();
            $data['productcategory_id'] = $value['menu_id'];
            $data['productcategory_parent'] = $value['menu_parent'];
            $data['productcategory_index'] = $value['menu_index'];
            $data["productcategory_date_update"] = today();
            $this->mydb->update("productcategory", $data, "productcategory_id=:productcategory_id", array('productcategory_id' => $value['menu_id']));
        }
        return true;
    }

    function load_category_condition($career_id = "")
    {
        if ($career_id != "")
            $result = $this->mydb->select("select * from productcategory where career_id=:career_id or career_id=-1 ORDER by productcategory_index ", array("career_id" => $career_id));
        else
            $result = $this->mydb->select("select * from productcategory ORDER by productcategory_index ", array());
        $category = array();
        foreach ($result as $value) {
            $category['items'][$value['productcategory_id']] = $value;
            $category['parent'][$value['productcategory_parent']][] = $value['productcategory_id'];
        }
        return $category;
    }

}
