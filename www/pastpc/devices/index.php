<?php
/* The accounts controller for PastPC.
    Delivers account views like the login view
    and the register view.
*/
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../library/debug-print.php';
/* Need to get the devices model...*/
require_once '../model/devices-model.php';
require_once '../library/functions.php';
require_once '../model/uploads-model.php';

//Building a dynamic nav bar, replacing the static snippet
$classifications = getClassifications();
$navList = getNav($classifications);

/*$classificationList = "<select name='classificationId'>";
foreach ($classifications as $cl)
    $classificationList .= "<option value='$cl[classificationId]'>$cl[classificationName]</option>";
$classificationList .= '</select>';*/

//check to see if anything is in POST, if not check GET
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'add-classification':
        include '../view/add-classification.php';
        break;
    case 'add-device':
        include '../view/add-device.php';
        break;
    case 'submit-classification':
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        if (!valid($classificationName, $classificationNamePattern)) {
            $message = '<p>Please provide information for empty or invalid form fields.</p>';
            include '../view/add-classification.php';
            exit;
        }
        $outcome = insertClassification($classificationName);
        if ($outcome === 1) {
            header('Location: /pastpc/devices/index.php');
            exit;
        } else {
            $message = "<p>System failed to add new classification. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;
    case 'submit-device':
        $deviceBrand = trim(filter_input(INPUT_POST, 'deviceBrand', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $deviceModel = trim(filter_input(INPUT_POST, 'deviceModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $deviceDescription = trim(filter_input(INPUT_POST, 'deviceDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        //debugPrint($_POST["deviceDescription"]);
        $deviceImage = trim(filter_input(INPUT_POST, 'deviceImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $deviceThumbnail = trim(filter_input(INPUT_POST, 'deviceThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $deviceMonthlyRate = trim(filter_input(INPUT_POST, 'deviceMonthlyRate', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
        if (!valid($deviceBrand, $deviceBrandPattern) || !valid($deviceModel, $deviceModelPattern) || empty($deviceDescription) || empty($deviceImage) || empty($deviceThumbnail) || !valid($deviceMonthlyRate, $deviceMonthlyRatePattern) || empty($classificationId)) {
            $message = '<p>Please provide information for empty or invalid form fields.</p>';
            include '../view/add-device.php';
            exit;
        }
        $outcome = insertDevice($deviceBrand, $deviceModel, $deviceDescription, $deviceImage, $deviceThumbnail, $deviceMonthlyRate, $classificationId);
        if ($outcome === 1) {
            $message = "<p>Device successfully added!</p>";
            include '../view/add-device.php';
            exit;
        } else {
            $message = "<p>System failed to add new device. Please try again.</p>";
            include '../view/add-device.php';
            exit;
        }
        break;
    case 'getInventoryItems':
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $devicesArray = getInventoryByClassification($classificationId);
        echo json_encode($devicesArray);
        break;
    case 'mod':
        $deviceId = filter_input(INPUT_GET, 'deviceId', FILTER_VALIDATE_INT);
        $deviceInfo = getInvItemInfo($deviceId);
        if (count($deviceInfo)<1)
            $message = 'Sorry, no device information could be found.';
        include '../view/device-update.php';
        break;
    case 'submit-update-device':
        $deviceBrand = trim(filter_input(INPUT_POST, 'deviceBrand', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $deviceModel = trim(filter_input(INPUT_POST, 'deviceModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $deviceDescription = trim(filter_input(INPUT_POST, 'deviceDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $deviceImage = trim(filter_input(INPUT_POST, 'deviceImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $deviceThumbnail = trim(filter_input(INPUT_POST, 'deviceThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $deviceMonthlyRate = trim(filter_input(INPUT_POST, 'deviceMonthlyRate', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
        $deviceId = trim(filter_input(INPUT_POST, 'deviceId', FILTER_SANITIZE_NUMBER_INT)); //consider getting rid of this and determining id dynamically
        if (!valid($deviceBrand, $deviceBrandPattern) || !valid($deviceModel, $deviceModelPattern) || empty($deviceDescription) || empty($deviceImage) || empty($deviceThumbnail) || !valid($deviceMonthlyRate, $deviceMonthlyRatePattern) || empty($classificationId)) {
            $message = '<p>Please provide information for empty or invalid form fields.</p>';
            include '../view/device-update.php';
            exit;
        }
        $updateResult = updateDevice($deviceBrand, $deviceModel, $deviceDescription, $deviceImage, $deviceThumbnail, $deviceMonthlyRate, $classificationId, $deviceId);
        if ($updateResult === 1) {
            $message = "<p>Device successfully updated!</p>";
            $_SESSION['message'] = $message;
            header('location: /pastpc/devices/');
            exit;
        } else {
            $message = "<p>System failed to update device. Please try again.</p>";
            include '../view/device-update.php';
            exit;
        }        
        break;
    case 'del':
        $deviceId = filter_input(INPUT_GET, 'deviceId', FILTER_VALIDATE_INT);
        $deviceInfo = getInvItemInfo($deviceId);
        if (count($deviceInfo)<1)
            $message = 'Sorry, no device information could be found.';
        include '../view/device-delete.php';
        break;
    case 'submit-delete-device':
        $deviceBrand = trim(filter_input(INPUT_POST, 'deviceBrand', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $deviceModel = trim(filter_input(INPUT_POST, 'deviceModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $deviceId = trim(filter_input(INPUT_POST, 'deviceId', FILTER_SANITIZE_NUMBER_INT)); //consider getting rid of this and determining id dynamically
        $deleteResult = deleteDevice($deviceId);
        if ($deleteResult === 1) {
            $message = "<p>Device successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /pastpc/devices/');
            exit;
        } else {
            $message = "<p>System failed to delete device. Please try again.</p>";
            $_SESSION['message'] = $message;
            header('location: /pastpc/devices/');
            exit;
        }  
        break;
    case 'detail-view':
        $deviceId = filter_input(INPUT_GET, 'device-id', FILTER_VALIDATE_INT);
        $deviceInfo = getInvItemInfo($deviceId);
        if ($deviceInfo == null)
            $message = "<p class='notice'>Sorry, the indicated device could not be found in the devices.</p>";
        else
            $detailDisplay = buildDetailDisplay($deviceInfo);
        $thumbnails = getThumbnails($deviceId);
        $thumbnailDisplay = buildThumbnailDisplay($thumbnails);
        include '../view/device-detail.php';
        break;
    default:
        $classificationList = buildClassificationList($classifications);
        include '../view/device-management.php';
        break;
}

