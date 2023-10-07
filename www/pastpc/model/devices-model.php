<?php
/*  The devices model for PastPC. Used
    whenever database access to the devices
    model is needed. It is the interface
    to the database for device operations.
*/
$invMakePattern = "^.{1,30}$";
$invModelPattern = "^.{1,30}$";
$invPricePattern = "^[1-9]\d*(\.\d+)?$";
$invColorPattern = "^.{1,20}$";
$classificationNamePattern = "^.{1,30}$";

function insertClassification($classification) {
    $sql = "INSERT INTO deviceclassification (classificationName) VALUES ('$classification')";
    return rowsChanged($sql);

}
function insertDevice($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId) {
    $sql = "INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId) VALUES ('$invMake','$invModel', '$invDescription', '$invImage', '$invThumbnail', '$invPrice', '$invStock', '$invColor', '$classificationId')";
    return rowsChanged($sql);
}
function getInventoryByClassification($classificationId) {
    $db = getPDO();
    $sql = 'SELECT * FROM inventory WHERE classificationId = :classificationId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->execute();
    $inventory = $stmt->fetchALL(PDO::FETCH_ASSOC); // "Line 8: Requests a multi-dimensional array of the devices as an associative array, stores the array in a variable."
    $stmt->closeCursor();
    return $inventory;
}
function getInvItemInfo($invId) {
    $db = getPDO();
    $sql = "SELECT img.imgName, img.imgPath, inv.invId, inv.invMake, inv.invModel, inv.invDescription, inv.invPrice, inv.invStock, inv.classificationId, inv.invImage, inv.invThumbnail FROM inventory inv JOIN images img ON img.invId = inv.invId WHERE img.imgPrimary = 1 AND img.imgName NOT LIKE '%-tn%' AND inv.invId = :invId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}
/*
function getInvItemInfo($invId) {
    $db = getPDO();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}
*/
function updateDevice($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId) {
    $sql = "UPDATE inventory SET invMake = '$invMake', invModel = '$invModel', invDescription = '$invDescription', invImage = '$invImage', invThumbnail = '$invThumbnail', invPrice = '$invPrice', invStock = '$invStock', invColor = '$invColor', classificationId = '$classificationId' WHERE invId = '$invId'";
    return rowsChanged($sql);
}
function deleteDevice($invId) {
    $sql = "DELETE FROM inventory WHERE invId = '$invId'";
    return rowsChanged($sql);
}
function getDevicesByClassification($classificationName) {
    $db = getPDO();
    $sql = "SELECT img.imgName, img.imgPath, inv.invId, inv.invMake, inv.invModel, inv.invDescription, inv.invPrice, inv.invStock, inv.classificationId, inv.invImage, inv.invThumbnail FROM inventory inv JOIN images img ON img.invId = inv.invId WHERE inv.classificationId IN (SELECT classificationId FROM deviceclassification WHERE classificationName = :classificationName) AND img.imgPrimary = 1 AND img.imgName LIKE '%-tn%'";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $devices = $stmt->fetchALL(PDO::FETCH_ASSOC); // "Line 8: Requests a multi-dimensional array of the devices as an associative array, stores the array in a variable."
    $stmt->closeCursor();
    return $devices;
}
/*function getDevicesByClassification($classificationName) {
    $db = getPDO();
    $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM deviceclassification WHERE classificationName = :classificationName)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $devices = $stmt->fetchALL(PDO::FETCH_ASSOC); // "Line 8: Requests a multi-dimensional array of the devices as an associative array, stores the array in a variable."
    $stmt->closeCursor();
    return $devices;
}*/
function getClassification($classificationId) {
    $db = getPDO();
    $sql = 'SELECT * FROM deviceclassification WHERE classificationId = :classificationId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->execute();
    $classification = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $classification;
}
function getDevices() {
    $db = getPDO();
    $sql = 'SELECT invId, invMake, invModel FROM inventory';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}
function getDevice($invMake, $invModel) {
    $sql = "SELECT invId, invMake, invModel FROM inventory WHERE invMake = $invMake AND invModel = $invModel";
    return rowsChanged($sql);
}
