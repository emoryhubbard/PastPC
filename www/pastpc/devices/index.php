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
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
            if (!valid($invMake, $invMakePattern) || !valid($invModel, $invModelPattern) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || !valid($invPrice, $invPricePattern) || !valid($invColor, $invColorPattern) || empty($classificationId)) {
                $message = '<p>Please provide information for empty or invalid form fields.</p>';
                include '../view/add-device.php';
                exit;
            }
            $outcome = insertDevice($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, 1, $invColor, $classificationId);
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
        $inventoryArray = getInventoryByClassification($classificationId);
        echo json_encode($inventoryArray);
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo)<1)
            $message = 'Sorry, no device information could be found.';
        include '../view/device-update.php';
        break;
    case 'submit-update-device':
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT)); //consider getting rid of this and determining id dynamically
        if (!valid($invMake, $invMakePattern) || !valid($invModel, $invModelPattern) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || !valid($invPrice, $invPricePattern) || !valid($invColor, $invColorPattern) || empty($classificationId)) {
            $message = '<p>Please provide information for empty or invalid form fields.</p>';
            include '../view/device-update.php';
            exit;
        }
        $updateResult = updateDevice($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, 1, $invColor, $classificationId, $invId);
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
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo)<1)
            $message = 'Sorry, no device information could be found.';
        include '../view/device-delete.php';
        break;
    case 'submit-delete-device':
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT)); //consider getting rid of this and determining id dynamically
        $deleteResult = deleteDevice($invId);
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
        $invId = filter_input(INPUT_GET, 'inv-id', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if ($invInfo == null)
            $message = "<p class='notice'>Sorry, the indicated device could not be found in the inventory.</p>";
        else
            $detailDisplay = buildDetailDisplay($invInfo);
        $thumbnails = getThumbnails($invId);
        $thumbnailDisplay = buildThumbnailDisplay($thumbnails);
        include '../view/device-detail.php';
        break;
    default:
        $classificationList = buildClassificationList($classifications);
        include '../view/device-management.php';
        break;
}

