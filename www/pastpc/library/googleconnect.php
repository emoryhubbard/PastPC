<?php
require_once '../../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('../../../');
$dotenv->load();

function getGoogleClient() {
    $client = new Google\Client();
    $client->setClientId($_SERVER['CLIENT_ID']);
    $client->setClientSecret($_SERVER['CLIENT_SECRET']);
    $client->setRedirectUri($_SERVER['REDIRECT_URI']);
    $client->addScope("email");
    $client->addScope("profile");
    return $client;
}
