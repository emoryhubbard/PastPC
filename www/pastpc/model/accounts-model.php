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
    $sql = "UPDATE clients SET clientPassword = ? WHERE clientId = ?";
    $pdo = getPDO();
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$clientPassword, $clientId]);
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
function createToken() {
    $token = bin2hex(random_bytes(16));
    return $token;
}
function addToken($email, $token) {
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", time() + 60 * 30);
    $sql = "UPDATE clients
            SET resetTokenHash = ?,
                resetTokenExpiresAt = ?
            WHERE clientEmail = ?";
    /*
    $sql = "UPDATE user
            SET reset_token_hash = ?,
                reset_token_expires_at = ?
            WHERE email = ?";
    */
    $pdo = getPDO();
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$token_hash, $expiry, $email]);
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
function sendEmail($email, $token) {
        $mail = require __DIR__ . "/mailer.php";

        $mail->setFrom("noreply@example.com");
        $mail->addAddress($email);
        $mail->Subject = "Password Reset";
        $mail->Body = <<<END

        Click <a href="http://lvh.me/pastpc/accounts/index.php?action=reset-password&token=$token">here</a> 
        to reset your password.

        END;

        try {

            $mail->send();

        } catch (Exception $e) {

            return "Message could not be sent. Mailer error: {$mail->ErrorInfo}";

        }
        return "Message sent, please check your inbox.";
}
function getClientFromToken($token) {
    $token_hash = hash("sha256", $token);
    $db = getPDO();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE resetTokenHash = :resetTokenHash';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':resetTokenHash', $token_hash, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}
