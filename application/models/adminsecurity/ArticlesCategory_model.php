<?php

class ArticlesCategory_model extends MY_Model {

    function __construct($type = null) {
        parent::__construct($type);
    }

    function load_articles_category() {
        $result = $this->mydb->select("select * from articlescategory ORDER by articlescategory_index ", array());
        foreach ($result as $value) {
            $menuData['items'][$value['articlescategory_id']] = $value; //Lưu dữ liệu các biến có id khác nh
            $menuData['parent'][$value['articlescategory_parent']][] = $value['articlescategory_id'];
        }
        if (isset($menuData))
            return $this->buiding_articles_category(0, $menuData);
        else
            return '';
    }

    function buiding_articles_category($parent, $menuData) {
        $html = "";
        if (isset($menuData['parent'][$parent])) {
            if ($parent != 0)
                $html .= "<ul class='uk-nestable-list'>";
            foreach ($menuData['parent'][$parent] as $value) {
                $html .= "<li data-id=" . $menuData['items'][$value]['articlescategory_id'] . " class='uk-nestable-item'>";
                $html .= "<div class='uk-nestable-panel'>"
                        . "<div class='uk-nestable-toggle' data-nestable-action='toggle'></div><span>" . $menuData['items'][$value]['articlescategory_name'] . "</span> <a class='itemedit uk-badge'><i class='uk-icon-pencil-square-o'></i> Chỉnh sửa</a>";
                if (check_login_user(array(1, 2)) || true) {
                    $html .= "--- <a class='deletemenu uk-badge uk-badge-danger' ref='" . $menuData['items'][$value]['articlescategory_id'] . "'><i class='uk-icon-times'></i>Xóa</a>";
                }
                $html .= "</div>";
                $html .= $this->buiding_articles_category($value, $menuData);
                $html .= "</li>";
            }
            if ($parent != 0)
                $html .= "</ul>";
        }
        return $html;
    }

    function create_articles_category($data) {
        $count = $this->mydb->select("select max(articlescategory_index) as max from articlescategory", array());
        $stt = $count[0]['max'] + 1;
        $data['articlescategory_index'] = $stt;
        $insert = $this->mydb->insert("articlescategory", $data);
        return array('status' => 1, 'id' => $insert['id'], 'name' => $data['articlescategory_name']);
    }

    function delete_articles_category($id) {
        $result = $this->mydb->select("select * from articlescategory ORDER by articlescategory_index ", array());

        foreach ($result as $value) {
            $menuData['items'][$value['articlescategory_id']] = $value;
            $menuData['parent'][$value['articlescategory_parent']][] = $value['articlescategory_id'];
        }
        $dataxoa = $this->buiding_delete_articles_category(array(), $id, $menuData);

        if (!empty($dataxoa)) {
            $strxoa = "articlescategory_id=" . implode($dataxoa, ' or articlescategory_id=');
            $this->mydb->deleteall("articlescategory", $strxoa, array());
            $this->mydb->deleteall("articlescategory_detail", $strxoa, array());
        }

        $this->mydb->delete("articlescategory", "articlescategory_id=:articlescategory_id", array('articlescategory_id' => $id));

        return array("id" => $id, "status" => 1);
    }

    function buiding_delete_articles_category($dataxoa, $parent, $menuData) {
        if (isset($menuData['parent'][$parent])) {
            foreach ($menuData['parent'][$parent] as $value) {
                $dataxoa[] = $value;
                $dataxoa = $this->buiding_delete_articles_category($dataxoa, $value, $menuData);
            }
        }
        return $dataxoa;
    }

    function updatesort($menu) {
        foreach ($menu as $value) {
            $data['articlescategory_id'] = $value['id'];
            $data['articlescategory_parent'] = $value['cha'];
            $data['articlescategory_index'] = $value['stt'];

            $this->mydb->update("articlescategory", $data, "articlescategory_id=:articlescategory_id", array('articlescategory_id' => $value['id']));
        }
        return true;
    }

    function load_info_articles_category($id) {
//        $objngongu = new \lib\table\NgonNgu();
//        $datangonngu = $objngongu->loadngonngu();
        $kq = $this->mydb->select("select * from articlescategory where articlescategory_id=:articlescategory_id", array('articlescategory_id' => $id));
        $kq = $kq[0];
        $ten = $kq['articlescategory_name'];
        $slug = $kq['articlescategory_slug'];
        $id = $kq['articlescategory_id'];
        $slugview = BASE_URL . "danh-muc-bai-viet/" . $slug . "-" . $id;
        $icon = $kq['articlescategory_icon'];
        $hide = '';
        $description = $kq["articlescategory_description"];
        $htmlngonngu = '';
//        $ngonngu = $kq['id_ngonngu'];
//        $hide = count($datangonngu) == 1 ? "hidden" : "";
//        $htmlngonngu = "<select class='form-control' name='id_ngonngu' style=' padding: 0px;'>";
//        foreach ($datangonngu as $key => $value) {
//            $htmlngonngu .= "<option " . ($ngonngu == $value['id_ngonngu'] ? "selected" : "") . " value=" . $value['id_ngonngu'] . " >" . $value['tenngonngu'] . "</option>";
//        }
//        $htmlngonngu .= "<option " . ($ngonngu == -1 ? "selected" : "") . " value=-1 >Tất cả</option>";
//
//        $htmlngonngu .= "</select>";
        $html = <<<ABC
        <form class="form-horizontal" id="savemenu">

    <fieldset data-uk-margin>
        
        <div class="form-group ">
            <label class="control-label col-sm-3" for="email"> Tên danh mục </label>
    <div class="col-sm-8">
        <input class="form-control" name="articlescategory_name" value='{$ten}' type="text" id="tenedit" placeholder="">
         <input hidden="" name="articlescategory_id" type="text" value="{$id}" placeholder="" id="idedit">
    </div>
  </div>

   
      <div class="form-group">
            <label class="control-label col-sm-3" for="email"> Slug danh mục </label>
    <div class="col-sm-8">
        <input class="form-control"  name="articlescategory_slug" id="slugedit" value='{$slug}' type="text" placeholder="">
       
    </div>
  </div>
 
      <div class="form-group">
            <label class="control-label col-sm-3" for="email">Miêu tả </label>
    <div class="col-sm-8">
        <input class="form-control"  name="articlescategory_description"  value='{$description}' type="text" placeholder="">
       
    </div>
  </div>     
       <div class="form-group ">
            <label class="control-label col-sm-3" for="email"> Đường dẫn trang </label>
          <div class="col-sm-8">
          <input class="form-control" id="slugview"  type="text" value="{$slugview}" placeholder="">
         </div>
  </div>
      
         <div class="form-group">
            <label class="control-label col-sm-3" for="email"> Icon </label>
          <div class="col-sm-8">
          <input class="form-control" name="articlescategory_icon" type="text" value="{$icon}" placeholder="">
         </div>
  </div>
           <!--<div class="form-group $hide">  
          <label class="control-label col-sm-3" >Ngôn ngữ: </label>
       <div class="col-sm-8">       
    {$htmlngonngu}
</div>
        </div>-->
        
        <div class="uk-form-row text-center">  
        <button class="uk-button">LƯU</button>
        </div>
     
    </fieldset>
</form>
ABC;

        return array('html' => $html, 'status' => 1);
    }

    function update_info_articles_category($data) {
        // đổi ngôn ngữ
        $id_danhmucbaiviet = $data['articlescategory_id'];
//        $ngonnguhientai = $this->mydb->select("select id_ngonngu from danhmucbaiviet where id_danhmucbaiviet=:id_danhmucbaiviet", array("id_danhmucbaiviet" => $id_danhmucbaiviet));
//        if ($ngonnguhientai != $data['id_ngonngu'] && $data['id_ngonngu'] != -1) {
//            // xoa danh muc bai viet chi tiet
//            $this->deleteall("danhmucbaivietchitiet", "id_danhmucbaiviet=:id_danhmucbaiviet", array("id_danhmucbaiviet" => $id_danhmucbaiviet));
//        }
        $this->mydb->update("articlescategory", $data, "articlescategory_id=:articlescategory_id", array('articlescategory_id' => $id_danhmucbaiviet));
        return array('status' => 1);
    }

}
