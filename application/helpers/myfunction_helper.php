<?php

function load_admin_view($name)
{

    return BASE_URL . "application/views/adminsecurity/" . $name;
}

function load_admin_public($name)
{

    return BASE_URL . "application/views/adminsecurity/public/" . $name;
}

function load_frontend_view($name)
{
    return BASE_URL . "application/views/" . THEME . "/" . $name;
}

function load_public($name)
{

    return BASE_URL . "public/" . $name;
}

function generate_password($length = 8)
{
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}
function generate_key($str)
{
   return  hash_hmac("SHA1",$str, HASH_KEY);
}

//========================================== xử lý dữ liệu===========================
function check_post($post, $array = array())
{
    $check_isset = true;
    foreach ($array as $value) {
        if (!isset($post[$value])) {
            $check_isset = false;
            break;
        }
    }
    return $check_isset;
}
function checksum($data = "")
{
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

function string_input($str)
{
    //   \pL đại diện cho các kí tự chữ cái kể cả unicode
    //\pN đại diện cho các kí tự số
    //\x20-\x7F đại diện cho các kí tự chữ cái Latinh và các chữ số
    //   $str=preg_replace('/([^\pL\.\^\pN\@\,\-\%\#\&\$\ \\r\\n\/\:]+)/u', '',$str);
    //$str = str_replace("'", "", $str);
    $str = trim($str);
  //  $str = strip_tags($str); //bo php va html
    $str = htmlentities($str);
    $str = addslashes($str); //bo ky tu ',""
    $str = str_replace("\r\n", "<br>", $str);
    return $str;
}

function string_output($str)
{
    $str = str_replace("<br>", "\r\n", $str);
    return $str = stripslashes($str);
}

function slug($str)
{
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

function string_upper($str)
{
    $str = mb_convert_case($str, MB_CASE_UPPER, "UTF-8");
    return $str;
}

function string_title($str)
{
    $str = mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
    return $str;
}

function remove_empty($str)
{
    return $str = preg_replace('/\s\s+/', ' ', $str);
}

//======================Session============================

function session_init()
{
    if (session_status() == PHP_SESSION_NONE) {
        @session_start();
    }
}

function session_set($key, $value)
{
    session_init();
    if (is_array($value))
        $_SESSION[$key] = serialize($value);
    else
        $_SESSION[$key] = $value;
}

function session_get($key)
{
    session_init();
    if (isset($_SESSION[$key])) {
        if (@unserialize($_SESSION[$key]))
            return unserialize($_SESSION[$key]);
        return $_SESSION[$key];
    } else
        return false;
}

function session_delete($key)
{
    session_init();
    if (isset($_SESSION[$key]))
        unset($_SESSION[$key]);
}

//======================Cookie============================
function create_cook($key, $value)
{
    setcookie($key, $value, time() + (86400 * 10), "/");
}

function delete_cook($key, $value = FALSE)
{
    setcookie($key, $value, time() - (86400 * 10), '/');
}

function create_cook_time($key, $value, $time)
{
    setcookie($key, $value, time() + $time, "/");
}

function delete_cook_time($key, $time, $value = false)
{
    setcookie($key, $value, time() - $time, '/');
}
// =============== USER =============== //
 function SetUserLogin($data)
 {
     $data = serialize($data);
     create_cook_time("user",$data,864000);
     
 }
  function GetUserLogin()
 {
      if(isset($_COOKIE["user"]))
         return unserialize($_COOKIE["user"]);
      else
          return false;
 }
//========================= DATETIME ==============================
function today($format = "datetime")
{
    $format = $format == "date" ? "Y-m-d" : "Y-m-d H:i:s";
    return date($format);
}

function date_input($date, $format = "d/m/Y")
{
    if ($date!='') {
        $datetime = DateTime::createFromFormat($format, $date)->format("Y-m-d");
        return date('Y-m-d', strtotime($datetime));
    } else
        return today();
}

function date_out($date)
{
    return date('d/m/Y', strtotime($date));
}

function validate_date($date, $format)
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

//===== function for sortable and nestable =====

function sort_data($json)
{
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

function debug($parameter = "")
{
    echo "<pre>";
    print_r($parameter);
    echo "</pre>";
    echo"<br>";
    exit();
}

function delete_image($name, $type = "product")
{
    if (strlen($name) > 3) {
        $link_full = "public/upload/images/" . $type . "/" . $name;
        $link_thumb = "public/upload/images/thumb_" . $type . "/" . $name;
        if (file_exists($link_full))
            unlink($link_full);
        if (file_exists($link_thumb))
            unlink($link_thumb);
    }
}

function load_config($constans = array())
{
    $xml = simplexml_load_file("public/file/xml/config.xml") or die("Error: Cannot create object");
    if (empty($constans)) {
        foreach ($xml as $key => $value) {
            $data[$key] = $xml->$key;
        }
        return $data;
    } else {
        foreach ($constans as $k => $v) {
            $temp = string_lower($v);
            define($v, $xml->$temp);
        }
    }
}

//  =====  category, menu ====
function search_all_child($data, $id_danhmuc, $list_child)
{
    if (isset($data['parent'][$id_danhmuc])) {
        foreach ($data['parent'][$id_danhmuc] as $value) {
            $list_child[] = $value;
            $list_child = search_all_child($data, $value, $list_child);
        }
    }
    return $list_child;
}

function search_all_child_first_level($data, $id_danhmuc, $danhsach)
{
    if (isset($data['parent'][$id_danhmuc])) {
        return $data['parent'][$id_danhmuc];
    } else
        return false;
}

//  =========== cache view  ============ //


function cache_view_start($name = "", $time = 86400)
{
    $name = "application/cache/html/" . $name;
    //time() <= (fileatime($cacheFile) + $time_update_cache
    if (file_exists($name) &&
        (filemtime($name) > (time() - $time)) && CACHE
    ) {
        return unserialize(file_get_contents($name));
    } else {
        if (CACHE)
            ob_start();
        return false;
    }
}

function cache_view_end($name)
{
    $name = "application/cache/html/" . $name;
    if (CACHE) {
        $content = ob_get_contents();
        ob_end_clean();
        // Ghi cache file 
        file_put_contents($name, serialize($content));
        echo $content;
    }
}

// =============== check user login =======//
function check_login_user($arr)
{
    return false;
}

function check_url($arr, $id)
{
    if (!is_numeric($id))
        return false;
    foreach ($arr as $value) {
        if ($value == null || $value == '')
            return false;
    }
    return true;
}

function get_user_info($key)
{
    if (kiemtradangnhapuser(array(1, 2, 3, 4, 5))) {
        $taikhoan = unserialize($_COOKIE['taikhoan']);
        if (isset($taikhoan[$key]))
            return $taikhoan[$key];
        else
            return '';
    } else
        return '';
}

// ============== Google captcha ===========//

function check_captcha_google($recaptcha_response)
{
    $api_url = 'https://www.google.com/recaptcha/api/siteverify';
    $site_key = '6LeXfg4UAAAAAO0Ioz6bzRRrylr1la5aggjA1HBB';
    $secret_key = '6LeXfg4UAAAAABi5B-f5tAT40Px-qMRHsIPVp0BB';
    //lấy IP của khach
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $remoteip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $remoteip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $remoteip = $_SERVER['REMOTE_ADDR'];
    }
    //tạo link kết nối
    $api_url = $api_url . '?secret=' . $secret_key . '&response=' . $recaptcha_response . '&remoteip=' . $remoteip;
    //lấy kết quả trả về từ google
    $response = file_get_contents($api_url);
    //dữ liệu trả về dạng json
    $response = json_decode($response);
    if (!isset($response->success)) {
        return false;
    }
    if ($response->success == true) {
        return true;
    } else {
        return false;
    }
}

// ============== ******====================//
function phantrangajax($page_count, $cur_page, $link)
{
    $current_range = array(($cur_page - 2 < 1 ? 1 : $cur_page - 2), ($cur_page + 2 > $page_count ? $page_count : $cur_page + 2));

    // First and Last pages
    $first_page = $cur_page > 3 ? '<li  data-page="1" class="page" ><a  >1</a></li>' . ($cur_page < 5 ? ', ' : '<li> <a>...</a> <li>') : null;
    $last_page = $cur_page < $page_count - 2 ? ($cur_page > $page_count - 4 ? ', ' : ' <li> <a>...</a> <li> ') . '<li data-page="' . $page_count . '" class="page"><a>' . $page_count . '</a></li>' : null;

    // Previous and next page
    $previous_page = $cur_page > 1 ? '<li data-page="' . ($cur_page - 1) . '" class="page" ><a >Previous</a></li> ' : null;
    $next_page = $cur_page < $page_count ? ' <li data-page="' . ($cur_page + 1) . '" class="page"> <a >Next</a></li>' : null;

    // Display pages that are in range
    for ($x = $current_range[0]; $x <= $current_range[1]; ++$x)
        $pages[] = '<li data-page="' . $x . '" class="page ' . ($x == $cur_page ? "active" : NULL) . '"><a>' . $x . '</a></li>';

    if ($page_count > 1)
        return $previous_page . $first_page . implode(' ', $pages) . $last_page . $next_page;
}

function phantrang($page_count, $cur_page, $link)
{

    $current_range = array(($cur_page - 2 < 1 ? 1 : $cur_page - 2), ($cur_page + 2 > $page_count ? $page_count : $cur_page + 2));

    // First and Last pages
    $first_page = $cur_page > 3 ? '<li><a   href="' . sprintf($link, '1') . '">1</a></li>' . ($cur_page < 5 ? ', ' : '<li> <a>...</a> <li>') : null;
    $last_page = $cur_page < $page_count - 2 ? ($cur_page > $page_count - 4 ? ', ' : ' <li> <a>...</a> <li> ') . '<li><a href="' . sprintf($link, $page_count) . '">' . $page_count . '</a></li>' : null;

    // Previous and next page
    $previous_page = $cur_page > 1 ? '<li><a href="' . sprintf($link, ($cur_page - 1)) . '">Previous</a></li> ' : null;
    $next_page = $cur_page < $page_count ? ' <li > <a href="' . sprintf($link, ($cur_page + 1)) . '">Next</a></li>' : null;

    // Display pages that are in range
    for ($x = $current_range[0]; $x <= $current_range[1]; ++$x)
        $pages[] = '<li class="page ' . ($x == $cur_page ? "active" : NULL) . '"><a href="' . sprintf($link, $x) . '">' . ($x == $cur_page ? '<strong>' . $x . '</strong>' : $x) . '</a></li>';

    if ($page_count > 1)
        return $previous_page . $first_page . implode(' ', $pages) . $last_page . $next_page;
}

function kiemtranull($data)
{
    if (is_array($data) || $data === NULL) {
        if (!empty($data))
            return true;
        else
            return false;
    } else {
        if ($data == '' || $data == null)
            return FALSE;
        else
            return true;
    }
}
function neods($string, $len)
{
    $string = strip_tags($string); //bo php va html
    if ($len > strlen($string)) {
        $len = strlen($string);
    };
    $pos = strpos($string, ' ', $len);

    if ($pos) {
        $string = substr($string, 0, $pos) . "...";
    } else {
        mb_internal_encoding("UTF-8");
        $string = mb_substr($string, 0, $len);
    }

    // $string=  str_replace("\r\n", "<br>",$string);
    return $string;
}

function tien($str)
{
    if ($str != 0)
        return str_replace(',', '.', number_format($str));
    else
        return '0';
}
