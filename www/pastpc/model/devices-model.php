<?php
/*  The devices model for PastPC. Used
    whenever database access to the devices
    model is needed. It is the interface
    to the database for device operations.
*/
$deviceBrandPattern = "^.{1,30}$";
$deviceModelPattern = "^.{1,30}$";
$deviceMonthlyRatePattern = "^[1-9]\d*(\.\d+)?$";
$classificationNamePattern = "^.{1,30}$";

function insertClassification($classification) {
    $sql = "INSERT INTO deviceclassification (classificationName) VALUES ('$classification')";
    return rowsChanged($sql);

}
function insertDevice($deviceBrand, $deviceModel, $deviceDescription, $deviceImage, $deviceThumbnail, $deviceMonthlyRate, $classificationId) {
    $sql = "INSERT INTO devices (deviceBrand, deviceModel, deviceDescription, deviceImage, deviceThumbnail, deviceMonthlyRate, classificationId) VALUES ('$deviceBrand','$deviceModel', '$deviceDescription', '$deviceImage', '$deviceThumbnail', '$deviceMonthlyRate', '$classificationId')";
    return rowsChanged($sql);
}
function getInventoryByClassification($classificationId) {
    $db = getPDO();
    $sql = 'SELECT * FROM devices WHERE classificationId = :classificationId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->execute();
    $devices = $stmt->fetchALL(PDO::FETCH_ASSOC); // "Line 8: Requests a multi-dimensional array of the devices as an associative array, stores the array in a variable."
    $stmt->closeCursor();
    return $devices;
}
function getInvItemInfo($deviceId) {
    $db = getPDO();
    $sql = "SELECT img.imgName, img.imgPath, device.deviceId, device.deviceBrand, device.deviceModel, device.deviceDescription, device.deviceMonthlyRate, device.classificationId, device.deviceImage, device.deviceThumbnail FROM devices device JOIN images img ON img.deviceId = device.deviceId WHERE img.imgPrimary = 1 AND img.imgName NOT LIKE '%-tn%' AND device.deviceId = :deviceId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':deviceId', $deviceId, PDO::PARAM_INT);
    $stmt->execute();
    $deviceInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $deviceInfo;
}
/*
function getInvItemInfo($deviceId) {
    $db = getPDO();
    $sql = 'SELECT * FROM devices WHERE deviceId = :deviceId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':deviceId', $deviceId, PDO::PARAM_INT);
    $stmt->execute();
    $deviceInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $deviceInfo;
}
*/
function updateDevice($deviceBrand, $deviceModel, $deviceDescription, $deviceImage, $deviceThumbnail, $deviceMonthlyRate, $classificationId, $deviceId) {
    $sql = "UPDATE devices SET deviceBrand = '$deviceBrand', deviceModel = '$deviceModel', deviceDescription = '$deviceDescription', deviceImage = '$deviceImage', deviceThumbnail = '$deviceThumbnail', deviceMonthlyRate = '$deviceMonthlyRate', classificationId = '$classificationId' WHERE deviceId = '$deviceId'";
    return rowsChanged($sql);
}
function deleteDevice($deviceId) {
    $sql = "DELETE FROM devices WHERE deviceId = '$deviceId'";
    return rowsChanged($sql);
}
function getDevicesByClassification($classificationName) {
    $db = getPDO();
    $sql = "SELECT img.imgName, img.imgPath, device.deviceId, device.deviceBrand, device.deviceModel, device.deviceDescription, device.deviceMonthlyRate, device.classificationId, device.deviceImage, device.deviceThumbnail FROM devices device JOIN images img ON img.deviceId = device.deviceId WHERE device.classificationId IN (SELECT classificationId FROM deviceclassification WHERE classificationName = :classificationName) AND img.imgPrimary = 1 AND img.imgName LIKE '%-tn%'";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $devices = $stmt->fetchALL(PDO::FETCH_ASSOC); // "Line 8: Requests a multi-dimensional array of the devices as an associative array, stores the array in a variable."
    $stmt->closeCursor();
    return $devices;
}
/*function getDevicesByClassification($classificationName) {
    $db = getPDO();
    $sql = 'SELECT * FROM devices WHERE classificationId IN (SELECT classificationId FROM deviceclassification WHERE classificationName = :classificationName)';
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
    $sql = 'SELECT deviceId, deviceBrand, deviceModel FROM devices';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $deviceInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $deviceInfo;
}
function getDevice($deviceBrand, $deviceModel) {
    $sql = "SELECT deviceId, deviceBrand, deviceModel FROM devices WHERE deviceBrand = $deviceBrand AND deviceModel = $deviceModel";
    return rowsChanged($sql);
}