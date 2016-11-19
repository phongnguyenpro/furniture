<?php

function load_admin_view($name) {

    return BASE_URL . "application/views/adminsecurity/" . $name;
}

function load_admin_public($name) {

    return BASE_URL . "application/views/adminsecurity/public/" . $name;
}

function load_public($name) {

    return BASE_URL . "public/" . $name;
}

function generate_password($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}

//========================================== xử lý dữ liệu===========================
function check_post($post, $array = array()) {
    $check_isset = true;
    foreach ($array as $value) {
        if (!isset($post[$value])) {
            $check_isset = false;
            break;
        }
    }
    return $check_isset;
}

function checksum($data = "") {
    if (isset($data['checksum'])) {
        $checksum = $data['checksum'];
        unset($data['checksum']);

        $key = hash_hmac("SHA1", implode("-", $data), HASH_KEY);
        if ($checksum == $key) {
            return true;
        } else
            return FALSE;
    } else
        return false;
}

function string_input($str) {
    //   \pL đại diện cho các kí tự chữ cái kể cả unicode
    //\pN đại diện cho các kí tự số
    //\x20-\x7F đại diện cho các kí tự chữ cái Latinh và các chữ số
    //   $str=preg_replace('/([^\pL\.\^\pN\@\,\-\%\#\&\$\ \\r\\n\/\:]+)/u', '',$str);
    //$str = str_replace("'", "", $str);
    $str = trim($str);
    $str = strip_tags($str); //bo php va html
    $str = htmlentities($str);
    $str = addslashes($str); //bo ky tu ',""
    $str = str_replace("\r\n", "<br>", $str);
    return $str;
}

function string_output($str) {
    $str = str_replace("<br>", "\r\n", $str);
    return $str = stripslashes($str);
}

function slug($str) {
    $str = trim(mb_strtolower($str, "UTF-8"));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return string_lower($str);
}
   function price_input($str)
    {
        return str_replace('.', '', $str);
    }
     function loaibodau($str)
    {
        $str = string_input($str);

        $unicode = array('a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ', 'd' => 'đ', 'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ', 'i' => 'í|ì|ỉ|ĩ|ị', 'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ', 'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự', 'y' => 'ý|ỳ|ỷ|ỹ|ỵ',

            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ', 'D' => 'Đ', 'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ', 'I' => 'Í|Ì|Ỉ|Ĩ|Ị', 'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ', 'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự', 'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',);

        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return string_lower($str);

    }
       function string_lower($str)
    {
        $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
        return $str;
    }
//======================Session============================

function session_init() {
    @session_start();
}

function session_set($key, $value) {
    session_init();
    if (is_array($value))
        $_SESSION[$key] = serialize($value);
    else
        $_SESSION[$key] = $value;
}

function session_get($key) {
    session_init();
    if (isset($_SESSION[$key])) {
        if (@unserialize($_SESSION[$key]))
            return unserialize($_SESSION[$key]);
        return $_SESSION[$key];
    } else
        return false;
}

function session_delete($key) {
    session_init();
    if (isset($_SESSION[$key]))
        unset($_SESSION[$key]);
}

//========================= DATETIME ==============================
function today($format = "datetime") {
    $format = $format == "date" ? "Y-m-d" : "Y-m-d H:i:s";
    return date($format);
}

function date_input($date,$format="d/m/Y") {
  if($date)
  {
  $datetime = DateTime::createFromFormat($format, $date)->format("Y-m-d");
  return date('Y-m-d', strtotime($datetime));
  }
  else 
      return today();
}

function date_out($date) {
    return date('d/m/Y', strtotime($date));
}

function validate_date($date, $format) {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

//===== function for sortable and nestable =====

function sort_data($json) {
    $data = array();
    $sort = json_decode($json);
    $index = 1;
    foreach ($sort as $key => $item) {

        if ($item->id != -1) {
            $data[$item->id]['id'] = $item->id;
            $data[$item->id]['index'] = $index;
            $index++;
        }
    }
    return $data;
}

// ======= extention === 

function debug($parameter = "") {
    echo "<pre>";
    print_r($parameter);
    echo "</pre>";
    die();
}

function delete_image($name, $type = "product") {
    if (strlen($name) > 3) {
        $link_full = "public/upload/images/" . $type . "/" . $name;
        $link_thumb = "public/upload/images/thumb_" . $type . "/" . $name;
        if (file_exists($link_full))
            unlink($link_full);
        if (file_exists($link_thumb))
            unlink($link_thumb);
    }
}

function load_config() {
    $xml = simplexml_load_file("public/file/xml/config.xml") or die("Error: Cannot create object");
foreach ($xml as $key => $value) {

    $data[$key] = $xml->$key;
}
   return $data;
}

//  =====  category, menu ====
    function search_all_schild($data,$id_danhmuc,$list_child)
    {
        if(isset($data['parent'][$id_danhmuc])){
        foreach ($data['parent'][$id_danhmuc] as $value)
        {
            $list_child[]=$value;
            $list_child = search_all_schild($data,$value,$list_child);
        }
                }
          return $list_child;
    }