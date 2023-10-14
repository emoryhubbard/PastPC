<?php
/* The accounts controller for PastPC.
    Delivers account views like the login view
    and the register view.
*/
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../library/debug-print.php';
/* Need to get the accounts model...*/
require_once '../model/accounts-model.php';
require_once '../model/reviews-model.php';
require_once '../library/functions.php';

//Building a dynamic nav bar, replacing the static snippet
$classifications = getClassifications();
$navList = getNav($classifications);
//debugPrint($navList);

//check to see if anything is in POST, if not check GET
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'submit-add-review':
        $deviceId = filter_input(INPUT_POST, 'device-id', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'client-id', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = filter_input(INPUT_POST, 'review-text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (empty($deviceId) | empty($clientId)) {
            $_SESSION['message'] = '<p>Please provide information for empty or invalid form fields or parameters.</p>';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        $outcome = addReview($reviewText, $deviceId, $clientId);
        if ($outcome === 1) {
            $_SESSION['message'] = "<p>Review successfully added!</p>";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            $_SESSION['message'] = "<p>System failed to add new review. Please try again.</p>";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        break;
    case 'update-review':
        $reviewId = filter_input(INPUT_GET, 'review-id', FILTER_SANITIZE_NUMBER_INT);
        $review = getReview($reviewId)[0];
        include '../view/update-review.php';
        break;
    case 'submit-update-review':
        $reviewId = filter_input(INPUT_POST, 'review-id', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = filter_input(INPUT_POST, 'review-text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        if (empty($reviewId) | empty($reviewText)) {
            $_SESSION['message'] = '<p>Please provide information for empty or invalid form fields or parameters.</p>';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        $outcome = updateReview($reviewId, $reviewText);
        if ($outcome === 1) {
            $_SESSION['message'] = "<p>Review successfully updated!</p>";
            header('Location: /pastpc/accounts/index.php?client-id=' . $_SESSION['clientData']['clientId']);
            exit;
        } else {
            $_SESSION['message'] = "<p>System failed to update review. Please try again.</p>";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        break;
    case 'delete-review':
        $reviewId = filter_input(INPUT_GET, 'review-id', FILTER_SANITIZE_NUMBER_INT);
        $review = getReview($reviewId)[0];
        include '../view/delete-review.php';
        break;
    case 'submit-delete-review':
        $reviewId = filter_input(INPUT_POST, 'review-id', FILTER_SANITIZE_NUMBER_INT);
        
        if (empty($reviewId)) {
            $_SESSION['message'] = '<p>Please provide information for empty or invalid parameters.</p>';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        $outcome = deleteReview($reviewId);
        if ($outcome === 1) {
            $_SESSION['message'] = "<p>Review successfully deleted.</p>";
            header('Location: /pastpc/accounts/index.php?client-id=' . $_SESSION['clientData']['clientId']);
            exit;
        } else {
            $_SESSION['message'] = "<p>System failed to delete review. Please try again.</p>";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        break;
    case 'get-reviews':
        $deviceId = filter_input(INPUT_GET, 'device-id', FILTER_SANITIZE_NUMBER_INT);
        $reviewsArray = getDeviceReviews($deviceId);
        echo json_encode($reviewsArray);
        break;
    case 'get-client-reviews':
        $clientId = filter_input(INPUT_GET, 'client-id', FILTER_SANITIZE_NUMBER_INT);
        $reviewsArray = getClientReviews($clientId);
        echo json_encode($reviewsArray);
        break;
    default:
        if ($_SESSION['loggedin'])
            include '../view/admin.php';
            exit;
        include '../view/home.php';
        exit;
}