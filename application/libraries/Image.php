<?php

class Image {

    function ktfileanh($file) {
        $errors = 1;
        $filename = stripslashes($file['name']);
        $extension = $this->getExtension($filename);
        $extension = strtolower($extension);
        if (($extension != "jpg") && ($extension != "jpeg") && ($extension !=
                "png") && ($extension != "gif")) {
            $errors = 0;
        }
        $size = filesize($file['tmp_name']);

        if ($size > FILESIZE)
            $errors = 0;


        return $errors;
    }

    function crop($sourceFile, $destFile, $width, $height, $type) {
        switch ($type) {
            case "resize":
                $this->resize($sourceFile, $destFile, $width, $height);
                break;
            case "fit":
                $this->fit($sourceFile, $destFile, $width, $height);
                break;
            case "fill":
                $this->fill($sourceFile, $destFile, $width, $height);
                break;
            default:
                $this->resizeImage($sourceFile, $destFile, $width, $height);
                break;
        }
    }

    function watermark_image($file, $destination, $overlay, $X = 30, $Y = 30) {

        $source = getimagesize($overlay);
        $source_mime = $source['mime'];
        if ($source_mime == "image/png") {
            $watermark = imagecreatefrompng($overlay);
        } else if ($source_mime == "image/jpeg") {
            $watermark = imagecreatefromjpeg($overlay);
        } else if ($source_mime == "image/gif") {
            $watermark = imagecreatefromgif($overlay);
        } else {
            $watermark = imagecreatefromjpeg($overlay);
        }

        $source = getimagesize($file);
        $source_mime = $source['mime'];

        if ($source_mime == "image/png") {
            $image = imagecreatefrompng($file);
        } else if ($source_mime == "image/jpeg") {
            $image = imagecreatefromjpeg($file);
        } else if ($source_mime == "image/gif") {
            $image = imagecreatefromgif($file);
        }
        imagecopy($image, $watermark, $X, $Y, 0, 0, imagesx($watermark), imagesy($watermark));
        imagepng($image, $destination);
        return $destination;
    }

    function chenlogo($destFile, $type = "center") {
       $config =  load_config(); 
       $filechen = substr($config["urlanhchen"], strpos($config["urlanhchen"], 'public'));
        $file = $destFile;
        if (!file_exists($filechen))
            return false;
        $info = getimagesize($filechen);
        switch ($info[2]) {
            case IMAGETYPE_GIF: $imagechen = imagecreatefromgif($filechen);
                break;
            case IMAGETYPE_JPEG: $imagechen = imagecreatefromjpeg($filechen);
                break;
            case IMAGETYPE_PNG: $imagechen = imagecreatefrompng($filechen);
                break;
            case IMAGETYPE_JPG: $imagechen = imagecreatefromjpeg($filechen);
                break;
            default: return false;
        }


        $info = getimagesize($file);
        switch ($info[2]) {
            case IMAGETYPE_GIF: $image = imagecreatefromgif($file);
                break;
            case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_PNG: $image = imagecreatefrompng($file);
                break;
            case IMAGETYPE_JPG: $image = imagecreatefromjpeg($file);
                break;
            default: return false;
        }

// Set the margins for the stamp and get the height/width of the stamp image
        $marge_right = 10;
        $marge_bottom = 10;
        $sx = imagesx($imagechen);
        $sy = imagesy($imagechen);
        $widthimage = imagesx($image);
        $heightimage = imagesy($image);

        $X = 0;
        $Y = 0;
        if ($type == "center") {
            $X = ($widthimage - $sx) / 2;
            $Y = ($heightimage - $sy) / 2;
        }
        if ($type == "topleft") {
            $X = 0;
            $Y = 0;
        }
        if ($type == "topright") {
            $X = $widthimage - $sx;
            $Y = 0;
        }
        if ($type == "botleft") {
            $X = 0;
            $Y = $heightimage - $sy;
        }
        if ($type == "botright") {
            $X = $widthimage - $sx;
            $Y = $heightimage - $sy;
        }
// Copy the stamp image onto our photo using the margin offsets and the photo 
// width to calculate positioning of the stamp. 
        imagecopy($image, $imagechen, $X, $Y, 0, 0, $sx, $sy);
// Output and free memory
        switch ($info[2]) {
            case IMAGETYPE_GIF: imagegif($image, $destFile);
                break;
            case IMAGETYPE_JPEG: imagejpeg($image, $destFile);
                break;
            case IMAGETYPE_PNG: imagepng($image, $destFile);
                break;
            default: return false;
        }
        imagedestroy($image);
        imagedestroy($imagechen);
        return true;
    }

    function fill($sourceFile, $destFile, $width, $height) {

        $file = $sourceFile;
        $info = getimagesize($file);
        switch ($info[2]) {
            case IMAGETYPE_GIF: $image = imagecreatefromgif($file);
                break;
            case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_PNG: $image = imagecreatefrompng($file);
                break;
            case IMAGETYPE_JPG: $image = imagecreatefromjpeg($file);
                break;
            default: return false;
        }

        $w = @imagesx($image); //current width
        $h = @imagesy($image); //current height

        if ((!$w) || (!$h)) {
            $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.';
            return false;
        }
        if (($w == $width) && ($h == $height)) {
            $image2 = $image;
        } else {
            //no resizing needed
            $image2 = imagecreatetruecolor($width, $height);
            imagecopyresampled($image2, $image, 0, 0, 0, 0, $width, $height, $w, $h);
        }


        switch ($info[2]) {
            case IMAGETYPE_GIF: imagegif($image2, $destFile);
                break;
            case IMAGETYPE_JPEG: imagejpeg($image2, $destFile);
                break;
            case IMAGETYPE_PNG: imagepng($image2, $destFile);
                break;
            default: return false;
        }
        imagedestroy($image2);
        return true;
    }

    function fit($sourceFile, $destFile, $width, $height) {
        $file = $sourceFile;
        $info = getimagesize($file);
        switch ($info[2]) {
            case IMAGETYPE_GIF: $image = imagecreatefromgif($file);
                break;
            case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_PNG: $image = imagecreatefrompng($file);
                break;
            case IMAGETYPE_JPG: $image = imagecreatefromjpeg($file);
                break;
            default: return false;
        }
        $w = @imagesx($image); //current width
        $h = @imagesy($image); //current height
        if ((!$w) || (!$h)) {
            $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.';
            return false;
        }
        if (($w == $width) && ($h == $height)) {

            switch ($info[2]) {
                case IMAGETYPE_GIF: imagegif($image, $destFile);
                    break;
                case IMAGETYPE_JPEG: imagejpeg($image, $destFile);
                    break;
                case IMAGETYPE_PNG: imagepng($image, $destFile);
                    break;
                default: return false;
            }
            imagedestroy($image);
            return true;
        } //no resizing needed
        //try max width first...
        $ratio = $width / $w;
        $new_w = $width;
        $new_h = $h * $ratio;

        //if that created an image smaller than what we wanted, try the other way
        if ($new_h < $height) {
            $ratio = $height / $h;
            $new_h = $height;
            $new_w = $w * $ratio;
        }



        $image2 = imagecreatetruecolor($new_w, $new_h);
        // png
        if ($info[2] == IMAGETYPE_PNG) {
            //    imagealphablending($image2, false);
            //    imagesavealpha($image2, true);
            // $transparent = imagecolorallocatealpha($image2, 225, 225, 225, 127);
            //    imagefilledrectangle($image2, 0, 0, $new_w, $new_h,$transparent);  
            $transparency = imagecolorallocate($image2, 255, 255, 255);
            imagefill($image2, 0, 0, $transparency);
        }
        imagecopyresampled($image2, $image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
        // end png


        imagedestroy($image);
        //check to see if cropping needs to happen
        if (($new_h != $height) || ($new_w != $width)) {
            $image3 = imagecreatetruecolor($width, $height);
            if ($info[2] == IMAGETYPE_PNG) {
                imagealphablending($image3, false);
                imagesavealpha($image3, true);
                // $transparent = imagecolorallocatealpha($image3, 225, 225, 225, 127);
                //  imagefilledrectangle($image3, 0, 0,$width,$height,$transparent);    
            }
            if ($new_h > $height) { //crop vertically
                $extra = $new_h - $height;
                $x = 0; //source x
                $y = round($extra / 2); //source y
                imagecopyresampled($image3, $image2, 0, 0, $x, $y, $width, $height, $width, $height);
            } else {
                $extra = $new_w - $width;
                $x = round($extra / 2); //source x
                $y = 0; //source y

                imagecopyresampled($image3, $image2, 0, 0, $x, $y, $width, $height, $width, $height);
            }
            imagedestroy($image2);
            switch ($info[2]) {
                case IMAGETYPE_GIF: imagegif($image3, $destFile);
                    break;
                case IMAGETYPE_JPEG: imagejpeg($image3, $destFile);
                    break;
                case IMAGETYPE_PNG: imagepng($image3, $destFile);
                    break;
                default: return false;
            }
            return true;
            imagedestroy($image3);
        } else {
            switch ($info[2]) {
                case IMAGETYPE_GIF: imagegif($image2, $destFile);
                    break;
                case IMAGETYPE_JPEG: imagejpeg($image2, $destFile);
                    break;
                case IMAGETYPE_PNG: imagepng($image2, $destFile);
                    break;
                default: return false;
            }
            imagedestroy($image2);
            return true;
        }
    }

    function resizeImage($sourceFile, $destFile, $width, $height, $thumb = false) {
        $proportional = true;
        $output = 'file';
        $file = $sourceFile;
        if ($height <= 0 && $width <= 0)
            return false;
# get image size
        $info = getimagesize($file);
        $image = '';
        list($width_old, $height_old) = $info;
        $final_width = 0;
        $final_height = 0;
        $dims = $this->resizeBoundary($width_old, $height_old, $width, $height);
        $final_height = $dims['height'];
        $final_width = $dims['width'];
# image loading
        switch ($info[2]) {
            case IMAGETYPE_GIF: $image = imagecreatefromgif($file);
                break;
            case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_PNG: $image = imagecreatefrompng($file);
                break;
            case IMAGETYPE_JPG: $image = imagecreatefromjpeg($file);
                break;
            default: return false;
        }
# This is the resizing/resampling/transparency-preserving magic
        $image_resized = imagecreatetruecolor($final_width, $final_height);
        if (($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG)) {
            $transparency = imagecolortransparent($image);
            if ($transparency >= 0) {
                $transparent_color = imagecolorsforindex($image, 1);
                $trnprt_color = array
                    (
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                );
                $transparency = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                imagefill($image_resized, 0, 0, $transparency);
                imagecolortransparent($image_resized, $transparency);
            } elseif ($info[2] == IMAGETYPE_PNG) {
                imagealphablending($image_resized, false);
                $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
                imagefill($image_resized, 0, 0, $color);
                imagesavealpha($image_resized, true);
            }
        }
        imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);
        $output = $destFile;

        if ($thumb && $info[2] != IMAGETYPE_PNG && $info[2] != IMAGETYPE_GIF) {
            $filehinhnho = URL . "//images/anhchen.png";
            $hinhnho = imagecreatefrompng($filehinhnho);

            $imagewidth = imagesx($image_resized);
            $imageheight = imagesy($image_resized);
            $watermarkwidth = imagesx($hinhnho);
            $watermarkheight = imagesy($hinhnho);
            $startwidth = ($imagewidth - ($watermarkwidth));
            $startheight = ($imageheight - ($watermarkheight));

            imagecopy($image_resized, $hinhnho, $startwidth, $startheight, 0, 0, $watermarkwidth, $watermarkheight);
            imagedestroy($hinhnho);
        }
# Writing image according to type to the output destination
        switch ($info[2]) {
            case IMAGETYPE_GIF: imagegif($image_resized, $output);
                break;
            case IMAGETYPE_JPEG: imagejpeg($image_resized, $output);
                break;
            case IMAGETYPE_PNG: imagepng($image_resized, $output);
                break;
            default: return false;
        }
        imagedestroy($image_resized);
        return true;
    }

    function resize($sourceFile, $destFile, $width, $height, $thumb = false) {
        $proportional = true;
        $output = 'file';
        $file = $sourceFile;
        if ($height <= 0 && $width <= 0)
            return false;
# get image size
        $info = getimagesize($file);
        $image = '';
        list($width_old, $height_old) = $info;
        $final_width = 0;
        $final_height = 0;
        $dims = $this->resizeBoundary($width_old, $height_old, $width, $height);
        $final_height = $dims['height'];
        $final_width = $dims['width'];
# image loading
        switch ($info[2]) {
            case IMAGETYPE_GIF: $image = imagecreatefromgif($file);
                break;
            case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_PNG: $image = imagecreatefrompng($file);
                break;
            case IMAGETYPE_JPG: $image = imagecreatefromjpeg($file);
                break;
            default: return false;
        }
# This is the resizing/resampling/transparency-preserving magic
        $trnprt_color = array
            (
            'red' => 255,
            'green' => 255,
            'blue' => 255,
        );
        
        $image_resized = imagecreatetruecolor($width, $height);
        $transparency = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
        imagefill($image_resized, 0, 0, $transparency);
// tÃ­nh Ä‘á»™ canh giá»¯
        if ($final_width >= $width)
            $left = 0;
        else {
            $left = ($width - $final_width) / 2;
        }
        if ($final_height >= $height)
            $top = 0;
        else {
            $top = ($height - $final_height) / 2;
        }
////imagecolortransparent($image_resized, $transparency);
        imagecopyresampled($image_resized, $image, $left, $top, 0, 0, $final_width, $final_height, $width_old, $height_old);
        $output = $destFile;


# Writing image according to type to the output destination
        switch ($info[2]) {
            case IMAGETYPE_GIF: imagegif($image_resized, $output);
                break;
            case IMAGETYPE_JPEG: imagejpeg($image_resized, $output);
                break;
            case IMAGETYPE_PNG: imagepng($image_resized, $output);
                break;
            default: return false;
        }
        imagedestroy($image);
        imagedestroy($image_resized);
        return true;
    }

    function resizeBoundary($w, $h, $max_width, $max_height) {
//if(!($oldW>0 && $oldH>0))
//return;
//$tempW = ( $oldW * $newH ) / ( $oldH );
//$tempH = ( $oldH * $newW ) / ( $oldW );
//if($newW =="" && $newH != "")
//{
//if($newH >$oldH)
//{
//$dims = $this->resizeBoundary($oldW, $oldH,'',$oldH);
//$finalH = $dims['height'];
//$finalW = $dims['width'];
//}
//else
//{
//$finalH = $newH;
//$finalW = $tempW;
//}
//}
//else if($newW !="" && $newH == "")
//{
//if($newW >$oldW)
//{
//$dims =$this->resizeBoundary($oldW, $oldH,$oldW,'');
//$finalH = $dims['height'];
//$finalW = $dims['width'];
//}
//else
//{
//$finalH = $tempH;
//$finalW = $newW;
//}
//}
//else if($newW !="" && $newH != "")
//{
//if($tempW > $newW)
//{
//if($newW >$oldW)
//{
//$dims =$this->resizeBoundary($oldW, $oldH,$oldW,'');
//$finalH = $dims['height'];
//$finalW = $dims['width'];
//}
//else
//{
//$finalH = $tempH;
//$finalW = $newW;
//}
//}
//else
//{
//if($newH >$oldH)
//{
//$dims = $this->resizeBoundary($oldW, $oldH,'',$oldH);
//$finalH = $dims['height'];
//$finalW = $dims['width'];
//}
//else
//{
//$finalH = $newH;
//$finalW = $tempW;
//}
//}
//}
//$dims['height'] = $finalH;
//$dims['width'] = $finalW;
//return $dims;
        if ((!$w) || (!$h)) {
            $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.';
            return false;
        }
        if (($w <= $max_width) && ($h <= $max_height)) {
            return array('width' => $w, 'height' => $h);
        } //no resizing needed

        $ratio = $max_width / $w;
        $new_w = $max_width;
        $new_h = $h * $ratio;

        if ($new_h > $max_height) {
            $ratio = $max_height / $h;
            $new_h = $max_height;
            $new_w = $w * $ratio;
        }
        $dims = array("width" => $new_w, 'height' => $new_h);
        return $dims;
    }

    function getExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }

    function loaianh($data) {
        $thongso = getimagesize($data);
        $rong = $thongso[0];
        $dai = $thongso[1];
        if ($rong <= $dai) {
            return "height";
        } else
            return "width";
    }

    function xoayanh($filename) {

        $exif = exif_read_data($filename);
        if (isset($exif['FileType']) && isset($exif['Orientation'])) {
            $type = $exif['FileType'];
            $ort = $exif['Orientation'];

            switch ($type) {
                case IMAGETYPE_GIF: $image = imagecreatefromgif($filename);
                    break;
                case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($filename);
                    break;
                case IMAGETYPE_PNG: $image = imagecreatefrompng($filename);
                    break;
                case IMAGETYPE_JPG: $image = imagecreatefromjpeg($filename);
                    break;
                default: return false;
            }
            $chuyen = FALSE;
            switch ($ort) {

                case 3:
                    $rotate = imagerotate($image, 180, 1, 0); //nguoc
                    $chuyen = true;
                    break;
                case 6:
                    $rotate = imagerotate($image, -90, 1, 0); //trai
                    $chuyen = true;
                    break;
            }
            if ($chuyen) {
                switch ($type) {
                    case IMAGETYPE_GIF: $image = imagegif($rotate, $filename);
                        break;
                    case IMAGETYPE_JPEG: $image = imagejpeg($rotate, $filename);
                        break;
                    case IMAGETYPE_PNG: $image = imagepng($rotate, $filename);
                        break;
                    case IMAGETYPE_JPG: $image = imagejpeg($rotate, $filename);
                        break;
                    default: return false;
                }

                imagedestroy($rotate);
            }
//     case 1:
//          $rotate = imagerotate($image,90,1,0);//phai
//        break;
//
//      case 3:
//          $rotate = imagerotate($image,180,1,0);//nguoc
//        break;
//
//      case 4:
//  $rotate = imagerotate($image,180,1,0);
//        break;
//
//      case 5:
//      $rotate = imagerotate($image,90,1,0);
//        break;
//
//      case 6:
//       $rotate = imagerotate($image,-90,1,0);//trai
//        break;
//
//      case 7:
//       $rotate = imagerotate($image,-90,1,0);
//        break;
//
//      case 8:
//      $rotate = imagerotate($image,-90,1,0);
//        break;
        }
    }

}

?>