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
function getClassificationResults($devices) {
    $firstDevice = $devices[0];
    $dv = "<p class='classification-results-p'>" . count($devices) . " Results for $firstDevice[classificationName]</p>";
    return $dv;
}
function getSearchResults($devices, $keywords) {
    $dv = "<p class='keywords-p'><p class='keywords-value-p'>" . '"' . $keywords . '":' . "</p>" . "<p class='search-results-p'>" . count($devices) . " Search Results</p>";
    return $dv;
}

function buildDevicesDisplay($devices) {
    $dv = '<ul id="device-display" class="device-display">';
    foreach ($devices as $device) {
        $dv .= '<li>';
        $dv .= "<a href='/pastpc/devices/index.php?action=detail-view&device-id=$device[deviceId]'><img loading='lazy' src='$device[thumbnail_imgPath]' data-src='$device[original_imgPath]' alt='Image of $device[deviceBrand] $device[deviceModel] on pastpc.com'></a>";
        $dv .= "<div class='device-info'>";
        $dv .= "<a href='/pastpc/devices/index.php?action=detail-view&device-id=$device[deviceId]'><p class='listing-title'>$device[deviceDescription]</p></a>";
        $dv .= "<p class='classification-name'>$device[classificationName]</p>";
        $dv .= "<p class='device-monthly-rate'>$" . number_format($device['deviceMonthlyRate'], 2, '.', '') . "/month</p>";
        $dv .= "<p class='device-brand'>$device[deviceBrand]</p>";
        $dv .= "<p class='device-model'>$device[deviceModel]</p>";
        $dv .= "<p class='device-access'>24/7 access";
        $dv .= "<p class='device-free-trial'>Free trial</p>";
        $dv .= "</div>";
        $dv .= '</li>';
    }
    /*for ($i = 0; $i < 100; $i++) {
        foreach ($devices as $device) {
            $dv .= '<li>';
            $dv .= "<a href='/pastpc/devices/index.php?action=detail-view&device-id=$device[deviceId]'><img loading='lazy' src='$device[thumbnail_imgPath]' data-src='$device[original_imgPath]' alt='Image of $device[deviceBrand] $device[deviceModel] on pastpc.com'></a>";
            $dv .= "<div class='device-info'>";
            $dv .= "<a href='/pastpc/devices/index.php?action=detail-view&device-id=$device[deviceId]'><p class='listing-title'>$device[deviceDescription]</p></a>";
            $dv .= "<p class='classification-name'>$device[classificationName]</p>";
            $dv .= "<p class='device-monthly-rate'>$" . number_format($device['deviceMonthlyRate'], 2, '.', '') . "/month</p>";
            $dv .= "<p class='device-brand'>$device[deviceBrand]</p>";
            $dv .= "<p class='device-model'>$device[deviceModel]</p>";
            $dv .= "<p class='device-access'>24/7 access";
            $dv .= "<p class='device-free-trial'>Free trial</p>";
            $dv .= "</div>";
            $dv .= '</li>';
        }
    }*/
    $dv .= '</ul>';
    return $dv;
}
/* Before refactoring to use both thumbnail images and non-thumbnail images
function buildDevicesDisplay($devices) {
    $dv = '<ul id="device-display" class="device-display">';
    foreach ($devices as $device) {
        $dv .= '<li>';
        $dv .= "<a href='/pastpc/devices/index.php?action=detail-view&device-id=$device[deviceId]'><img src='$device[imgPath]' alt='Image of $device[deviceBrand] $device[deviceModel] on pastpc.com'></a>";
        $dv .= "<div class='device-info'>";
        $dv .= "<a href='/pastpc/devices/index.php?action=detail-view&device-id=$device[deviceId]'><p class='listing-title'>$device[deviceDescription]</p></a>";
        $dv .= "<p class='classification-name'>$device[classificationName]</p>";
        $dv .= "<p class='device-monthly-rate'>$" . number_format($device['deviceMonthlyRate'], 2, '.', '') . "/month</p>";
        $dv .= "<p class='device-brand'>$device[deviceBrand]</p>";
        $dv .= "<p class='device-model'>$device[deviceModel]</p>";
        $dv .= "<p class='device-access'>24/7 access";
        $dv .= "<p class='device-free-trial'>Free trial</p>";
        $dv .= "</div>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}
*/
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
function buildDetailDisplay($deviceInfo, $thumbnails) {
    $classification = getClassification($deviceInfo["classificationId"]);
    $dv = "<p class='detail-listing-title'>" . htmlspecialchars($deviceInfo['deviceDescription'], ENT_QUOTES, 'UTF-8') . "</p>";
    $dv .= "<p class='detail-listing-subtitle'>$classification[classificationName] category | <span class='access-available'>Access available 24/7</span></p>";
    $dv .= "<div class='detail-grid'>";
    $dv .= "<div class='detail-images'>";
    $dv .= "<div class='has-detail-main-img'><img class='detail-main-img' src='$deviceInfo[imgPath]' alt='Image of $deviceInfo[deviceBrand] $deviceInfo[deviceModel] on pastpc.com'></div>";
    $dv .= buildThumbnailDisplay($thumbnails);
    $dv .= "</div>";
    $dv .= "<div class='detail-text'>";
    $monthlyRate = number_format($deviceInfo["deviceMonthlyRate"], 2, '.', '');
    $dv .= "<div class='main-img-subtitle'><p class='main-img-monthly-rate'>$$monthlyRate<span class='main-img-month'>/mo</span><span class='main-img-free-trial'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;Free trial available</span></div>";
    $dv .= "<ul class='detail-info-table'>";
    $dv .= "<li class='detail-info-table-item'><p class='detail-info-table-item-field'>Brand</p><p class='detail-info-table-item-value'>$deviceInfo[deviceBrand]</p>";
    $dv .= "<li class='detail-info-table-item'><p class='detail-info-table-item-field'>Model</p><p class='detail-info-table-item-value'>$deviceInfo[deviceModel]</p>";
    $dv .= "<li class='detail-info-table-item'><p class='detail-info-table-item-field'>Description</p><p class='detail-info-table-item-value'></p>";
    $dv .= "</ul>";
    $dv .= "<p class='detail-description'>" . htmlspecialchars($deviceInfo['deviceDescription'], ENT_QUOTES, 'UTF-8') . "</p>";
    //$dv .= "<p class='show-more-button'>Show more</p>";
    $dv .= "<a class='show-more-button p-link' href='javascript:'>
                <img class='show-more-button-arrow-icon' src='/pastpc/images/site/DownArrow.svg' alt='more button down arrow icon'>
                <p class='show-more-button-text p-link'>Show more</p>
            </a>";
    $dv .= "</div>";
    $dv .= "</div>";
    //$dv .= "<p>" . $deviceInfo['deviceDescription'] . "</p>";
    //debugPrint($deviceInfo['deviceDescription']);
    return $dv;
}
function buildThumbnailDisplay($thumbnails) {
    $dv = '<div class="thumbnail-display">';
    foreach ($thumbnails as $thumbnail)
        $dv .= "<img src='$thumbnail[imgPath]' alt='Thumbnail image of $thumbnail[deviceBrand] $thumbnail[deviceModel] on pastpc.com'>";
    $dv .= "</div>";
    return $dv;
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






