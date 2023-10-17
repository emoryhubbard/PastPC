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
    case 'login':
        include '../view/login.php';
        break;
    case 'register':
        include '../view/register.php';
        break;
    case 'submitRegister':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        if (emailExists($clientEmail)) {
            $_SESSION['message'] = '<p>Email address already exists. Register with a new email, or log in to your existing account.';
            include '../view/login.php';
            exit;
        }
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $_SESSION['message'] = '<p>Please provide information for empty or invalid form fields.</p>';
            include '../view/register.php';
            exit;
        }

        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
        if ($regOutcome === 1) {
            setcookie('clientFirstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "<p>Thanks for registering, $clientFirstname. Please use your email and password to log in.</p>";
            header('Location: /pastpc/accounts/?action=login');
            exit;
        } else {
            $_SESSION['message'] = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    case 'submitLogin':
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        
        $checkEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        if (empty($checkEmail) || empty($checkPassword)) {
            $_SESSION['message'] = '<p>Please provide information for empty or invalid form fields.</p>';
            include '../view/login.php';
            exit;
        }
        $clientData = getClient($clientEmail);
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        if (!$hashCheck) {
            $_SESSION['message'] = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['message'] = "<p class='notice'>Currently logged-in using $clientEmail.</p>";
        // Remove the password from the array with array pop,
        // now that we are finished with it
        array_pop($clientData);
        $_SESSION['clientData'] = $clientData;
        include '../view/admin.php';
        exit;
        //$regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);
        /*$outcome = 1;
        if ($outcome === 1) {
            $message = "<p>Thanks for logging in.</p>";
            include '../view/login.php';
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the log-in failed. Please try again.</p>";
            include '../view/login.php';
            exit;
        }*/
    case 'submitLogout':
        session_unset();
        session_destroy();
        header('Location: /pastpc');
        exit;
    case 'update-account':
        include '../view/client-update.php';
        break;
    case 'submit-update-account':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));        
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));        

        $clientEmail = checkEmail($clientEmail);
        if ($_SESSION['clientData']['clientFirstname'] == $clientFirstname && $_SESSION['clientData']['clientLastname'] == $clientLastname && $_SESSION['clientData']['clientEmail'] == $clientEmail) {
            $_SESSION['message'] = '<p>Change at least one field in order to update your account info.';
            include '../view/client-update.php';
            exit;
        }
        if ($_SESSION['clientData']['clientEmail'] != $clientEmail && emailExists($clientEmail)) {
            $_SESSION['message'] = '<p>Email address already exists in another account. Update your account with a new email, or log in to your existing account.</p>';
            include '../view/login.php';
            exit;
        }
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $_SESSION['message'] = '<p>Please provide information for empty or invalid form fields.</p>';
            include '../view/client-update.php';
            exit;
        }

        $updateOutcome = updateAccount($clientFirstname, $clientLastname, $clientEmail, $clientId);
        if ($updateOutcome === 1) {
            $clientData = getClientFromId($clientId);
            array_pop($clientData);
            $_SESSION['clientData'] = $clientData;
            $_SESSION['message'] = "<p>Account info successfully changed, $clientFirstname.</p>";
            include '../view/admin.php';
            exit;
        } else {
            $_SESSION['message'] = "<p>Sorry $clientFirstname, but your account information was unable to be updated. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }
        break;
    case 'submit-change-password':
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));        
        
        $checkPassword = checkPassword($clientPassword);
        if ($_SESSION['clientData']['clientPassword'] == $clientPassword) {
            $_SESSION['message'] = '<p>A new password is required for a password change.';
            include '../view/client-update.php';
            exit;
        }
        if (empty($checkPassword)) {
            $_SESSION['message'] = '<p>Please provide information for empty or invalid form fields.</p>';
            include '../view/client-update.php';
            exit;
        }

        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        $changePasswordOutcome = changePassword($hashedPassword, $clientId);
        if ($changePasswordOutcome === 1) {
            $clientData = getClientFromId($clientId);
            array_pop($clientData);
            $_SESSION['clientData'] = $clientData;
            $_SESSION['message'] = "<p>Password successfully changed, $clientData[clientFirstname].</p>";
            include '../view/admin.php';
            exit;
        } else {
            $_SESSION['message'] = "<p>Sorry $clientFirstname, but your password was unable to be changed. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }
        break;
    case 'forgot-password':
        include '../view/forgot-password.php';
        break;
    case 'submit-forgot-password':
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));   
        if (!emailExists($clientEmail)) {
            $_SESSION['message'] = '<p>Email address already exists in another account. Update your account with a new email, or log in to your existing account.</p>';
            include '../view/forgot-password.php';
            exit;
        }
        $token = createToken($clientEmail);
        $addTokenResult = addToken($clientEmail, $token);
        if (!($addTokenResult === 1)) {
            $_SESSION['message'] = "<p>The reset password link was unable to be sent to your email. Please try again later.</p>";
            include '../view/forgot-password.php';
            exit;
        }

        $sendEmailOutcome = sendEmail($clientEmail, $token);
        if ($sendEmailOutcome === 1) {
            $_SESSION['message'] = "<p>Reset password link has been sent to your email.</p>";
            include '../view/admin.php';
            exit;
        } else {
            $_SESSION['message'] = "<p>The reset password link was unable to be sent to your email. Please try again later.</p>";
            include '../view/forgot-password.php';
            exit;
        }
        break;
    case 'reset-password':
        $token = filter_input(INPUT_GET, 'token');
        $clientData = getClientFromToken($token);
        if (empty($clientData)) {
            $_SESSION['message'] = '<p class="notice">Link not verifiable. Please request another password reset link.</p>';
            include '../view/forgot-password.php';
            exit;
        }
        if (strtotime($clientData["resetTokenExpiresAt"]) <= time()) {
            $_SESSION['message'] = '<p class="notice">Link has expired. Please request another password reset link.</p>';
            include '../view/forgot-password.php';
            exit;
        }
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['message'] = "<p class='notice'>Currently logged-in using $clientEmail.</p>";
        // Remove the password from the array with array pop,
        // now that we are finished with it
        array_pop($clientData);
        $_SESSION['clientData'] = $clientData;
        include '../view/client-update.php';
        exit;
    default:
        include '../view/admin.php';
        break;
}

