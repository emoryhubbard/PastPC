<?php
/* The accounts controller for PastPC.
    Delivers account views like the login view
    and the register view.
*/
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../library/debug-print.php';
/* Need to get the vehicles model...*/
require_once '../model/vehicles-model.php';
require_once '../library/functions.php';

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
    case 'add-vehicle':
        include '../view/add-vehicle.php';
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
            header('Location: /pastpc/vehicles/index.php');
            exit;
        } else {
            $message = "<p>System failed to add new classification. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;
        case 'submit-vehicle':
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
                include '../view/add-vehicle.php';
                exit;
            }
            $outcome = insertVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, 1, $invColor, $classificationId);
            if ($outcome === 1) {
                $message = "<p>Vehicle successfully added!</p>";
                include '../view/add-vehicle.php';
                exit;
            } else {
                $message = "<p>System failed to add new vehicle. Please try again.</p>";
                include '../view/add-vehicle.php';
                exit;
            }
            break;
    default:
        include '../view/vehicle-management.php';
        break;
}

