<?php
/* The main controller for PastPC.
    It handles all web traffic to the site
    and gives it the appropriate data in
    response.
*/
// Create or access a Session
session_start();

require_once 'library/connections.php';
require_once 'model/main-model.php';
require_once 'model/devices-model.php';
require_once 'library/debug-print.php';
require_once 'library/functions.php';

//Building a dynamic nav bar, replacing the static snippet
$classifications = getClassifications();
$navList = getNav($classifications);

//check to see if anything is in POST, if not check GET
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}
if (isset($_COOKIE['clientFirstname']))
    $cookieFirstname = filter_input(INPUT_COOKIE, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

switch ($action) {
    case 'classification':
        $classificationName = trim(filter_input(INPUT_GET, 'classification-name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $devices = getDevicesByClassification($classificationName);
        if (!count($devices))
            $message = "<p class='notice'>Sorry, no $classificationName devices could be found.</p>";
        else
            $deviceDisplay = buildDevicesDisplay($devices);
        include 'view/classification.php';
        break;
    default:
        include 'view/home.php';
}

