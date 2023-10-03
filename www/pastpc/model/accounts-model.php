<?php
/*
    This is the accounts model for the PastPC
    database.
*/

function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
    $db = getPDO();
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword)
        VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->execute();

    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
/* Function to check if an email address already exists in db */
function emailExists($clientEmail) {
    $db = getPDO();
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();

    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if (empty($matchEmail))
        return 0;
    return 1;
}
function getClient($clientEmail) {
    $db = getPDO();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}
function getClientFromId($clientId) {
    $db = getPDO();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}
function updateAccount($clientFirstname, $clientLastname, $clientEmail, $clientId) {
    $sql = "UPDATE clients SET clientFirstname = '$clientFirstname', clientLastname = '$clientLastname', clientEmail = '$clientEmail' WHERE clientId = '$clientId'";
    return rowsChanged($sql);
}
function changePassword($clientPassword, $clientId) {
    $sql = "UPDATE clients SET clientPassword = '$clientPassword' WHERE clientId = '$clientId'";
    return rowsChanged($sql);
}
