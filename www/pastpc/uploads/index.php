<?php
/*
This is the controller for the image uploads application
*/
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/uploads-model.php';
require_once '../library/functions.php';
require_once '../library/debug-print.php';

$classifications = getClassifications();
$navList = getNav($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == null)
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

/*
Important global variables for image uploads application
*/
$image_dir = '/pastpc/images/vehicles';
$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . $image_dir;

switch ($action) {
    case 'upload':
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT));
        $imgPrimary = trim(filter_input(INPUT_POST, 'imgPrimary', FILTER_VALIDATE_INT));

        $imgName = $_FILES['file1']['name'];
        $imageCheck = checkExistingImage($imgName);

        if ($imageCheck)
            $message = '<p class="notice">An image by that name already exists.</p>';
        elseif (empty($invId) || empty($imgName))
            $message = '<p class="notice">You must select a vehicle and image file for the vehicle.</p>';
        else {
            $imgPath = uploadFile('file1');
            $result = storeImages($imgPath, $invId, $imgName, $imgPrimary);
        
        if ($result)
            $message = '<p class="notice">The upload succeeded.</p>';
        else
            $message = '<p class="notice">Sorry, the upload failed.</p>';
        }
        $_SESSION['message'] = $message;
        header('location: .');
        break;
    case 'delete':
        $filename = trim(filter_input(INPUT_GET, 'filename', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $imgId = trim(filter_input(INPUT_GET, 'imgId', FILTER_VALIDATE_INT));

        $target = $image_dir_path . '/' . $filename;

        if (file_exists($target))
            $result = unlink($target);
        if ($result)
            $remove = deleteImage($imgId);
        if ($remove)
            $message = "<p class='notice'>$filename was successfully deleted.</p>";
        else
            $message = "<p class='notice'>$filename was NOT deleted.</p>";
        
        $_SESSION['message'] = $message;
        header('location: .');
        break;
    default:
        $imageArray = getImages();
        if (count($imageArray))
            $imageDisplay = buildImageDisplay($imageArray);
        else
            $imageDisplay = '<p class="notice">Sorry, no images could be found.</p>';
        $vehicles = getVehicles();
        $prodSelect = buildVehiclesSelect($vehicles);
        include '../view/image-admin.php';
        exit;
}