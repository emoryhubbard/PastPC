<?php
function checkEmail($clientEmail) {
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}
function checkPassword($clientPassword) {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}
function valid($input, $pattern) {
    $phpPattern = '/' . $pattern . '/';
    return preg_match($phpPattern, $input);
}
function getNav($classifications) {
    $navList = "";
    foreach ($classifications as $cl)
        $navList .= "<li><a href='/pastpc/index.php?action=classification&classification-name=" . urlencode($cl['classificationName']) . "' title='View $cl[classificationName] devices'>$cl[classificationName]</a></li>";
    $navList .= '<li><a class="more-link" href="/pastpc/devices/index.php?action=submit-search" title="View All Devices">More</a></li>';
    return $navList;
}
function getMenuNav($classifications) {
    $navList = "";
    foreach ($classifications as $cl)
        $navList .= "<li><a href='/pastpc/index.php?action=classification&classification-name=" . urlencode($cl['classificationName']) . "' title='View $cl[classificationName] devices'><p>$cl[classificationName]</p><img class='menu-arrow-icon' src='/pastpc/images/site/RightArrowIcon.svg' alt='arrow icon'></a></li>";
    $navList .= '<li><a class="more-link" href="/pastpc/devices/index.php?action=submit-search" title="View All Devices">' . "<p>More</p><img class='menu-arrow-icon' src='/pastpc/images/site/RightArrowIcon.svg' alt='arrow icon'></a></li>"; 
    return $navList;
}
function buildClassificationList($classifications) {
    $classificationList = '<select name="classificationId" id="classificationList">';
    $classificationList .= "<option>Choose a Classification</option>";
    foreach ($classifications as $classification)
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    $classificationList .= '</select>';
    return $classificationList;
}
function buildDevicesDisplay($devices) {
    $dv = '<ul id="device-display">';
    foreach ($devices as $device) {
        $dv .= '<li>';
        $dv .= "<a href='/pastpc/devices/index.php?action=detail-view&device-id=$device[deviceId]'><img src='$device[imgPath]' alt='Image of $device[deviceBrand] $device[deviceModel] on pastpc.com'></a>";
        $dv .= '<hr>';
        $dv .= "<a href='/pastpc/devices/index.php?action=detail-view&device-id=$device[deviceId]'><h2>$device[deviceBrand] $device[deviceModel]</h2></a>";
        $dv .= "<span>$device[deviceMonthlyRate]</span>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}
/*function buildDevicesDisplay($devices) {
    $dv = '<ul id="device-display">';
    foreach ($devices as $device) {
        $dv .= '<li>';
        $dv .= "<a href='/pastpc/devices/index.php?action=detail-view&device-id=$device[deviceId]'><img src='$device[deviceThumbnail]' alt='Image of $device[deviceBrand] $device[deviceModel] on pastpc.com'></a>";
        $dv .= '<hr>';
        $dv .= "<a href='/pastpc/devices/index.php?action=detail-view&device-id=$device[deviceId]'><h2>$device[deviceBrand] $device[deviceModel]</h2></a>";
        $dv .= "<span>$device[deviceMonthlyRate]</span>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}*/
function buildDetailDisplay($deviceInfo) {
    $dv = '<div class="detail-display">';
    $dv .= "<img src='$deviceInfo[imgPath]' alt='Image of $deviceInfo[deviceBrand] $deviceInfo[deviceModel] on pastpc.com'>";
    $dv .= "<div class='detail-info'>";
    $montlyRate = number_format($deviceInfo["deviceMonthlyRate"]);
    $dv .= "<h2>$deviceInfo[deviceBrand] $deviceInfo[deviceModel]: $$montlyRate</h2>";
    $dv .= "<p>-- Reviews Below --</p>";
    $classification = getClassification($deviceInfo["classificationId"]);
    $dv .= "<p>Device type: $classification[classificationName]</p>";
    $dv .= "<p>" . htmlspecialchars($deviceInfo['deviceDescription'], ENT_QUOTES, 'UTF-8') . "</p>";
    //$dv .= "<p>" . $deviceInfo['deviceDescription'] . "</p>";
    //debugPrint($deviceInfo['deviceDescription']);
    $dv .= "</div>";
    $dv .= "</div>";
    return $dv;
}
function buildThumbnailDisplay($thumbnails) {
    $td = '<div class="thumbnail-display">'; // td is thumbnail display
    $td .= '<h2>Additional Images</h2>';
    foreach ($thumbnails as $thumbnail)
        $td .= "<img src='$thumbnail[imgPath]' alt='Thumbnail image of $thumbnail[deviceBrand] $thumbnail[deviceModel] on pastpc.com'>";
    $td .= "</div>";
    return $td;
}
/*
Functions for working with images
*/
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<img src='$image[imgPath]' title='$image[deviceBrand] $image[deviceModel] image on PastPC.com' alt='$image[deviceBrand] $image[deviceModel] image on PastPC.com'>";
        $id .= "<p><a href='/pastpc/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
        $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
}
function buildDevicesSelect($devices) {
    $prodList = '<select name="deviceId" id="deviceId">';
    $prodList .= "<option>Choose a Device</option>";
    foreach ($devices as $device) 
        $prodList .= "<option value='$device[deviceId]'>$device[deviceBrand] $device[deviceModel]</option>";
    $prodList .= '</select>';
    return $prodList;
}
function uploadFile($name) {
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name]))
        $filename = $_FILES[$name]['name'];
    if (isset($_FILES[$name]) && empty($filename))
        return;
    
    $source = $_FILES[$name]['tmp_name'];
    $target = $image_dir_path . '/' . $filename;
    move_uploaded_file($source, $target);
    processImage($image_dir_path, $filename);
    $filepath = $image_dir . '/' . $filename;

    return $filepath;
}
function processImage($dir, $filename) {
    $dir = $dir . '/';
    $image_path = $dir . $filename;
    $image_path_tn = $dir.makeThumbnailName($filename);
    resizeImage($image_path, $image_path_tn, 200, 200);
    resizeImage($image_path, $image_path, 500, 500);
}
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
            break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
            break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
            break;
        default:
            return;
    }

    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;

    if (!($width_ratio > 1 || $height_ratio > 1)) {
        $image_to_file($old_image, $new_image_path);
        imagedestroy($old_image);
        return;
    }

    $ratio = max($width_ratio, $height_ratio);
    $new_height = round($old_height / $ratio);
    $new_width = round($old_width / $ratio);
    
    $new_image = imagecreatetruecolor($new_width, $new_height);

    if ($image_type == IMAGETYPE_GIF) {
        $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
        imagecolortransparent($new_image, $alpha);
    }
    if (($image_type == IMAGETYPE_PNG || $image_type ==
        IMAGETYPE_GIF)) {
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);
    }

    $new_x = 0;
    $new_y = 0;
    $old_x = 0;
    $old_y = 0;
    imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
    $image_to_file($new_image, $new_image_path);
    imagedestroy($new_image);
    imagedestroy($old_image);

}






