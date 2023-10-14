<?php
/*
This is the model for the device image uploads application
*/

function storeImages($imgPath, $deviceId, $imgName, $imgPrimary) {
    $db = getPDO();
    $sql = 'INSERT INTO images (deviceId, imgPath, imgName, imgPrimary) VALUES (:deviceId, :imgPath, :imgName, :imgPrimary)';
    $stmt = $db->prepare($sql);
    $stmt-> bindValue(':deviceId', $deviceId, PDO::PARAM_INT);
    $stmt-> bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
    $stmt-> bindValue(':imgName', $imgName, PDO::PARAM_STR);
    $stmt-> bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
    $stmt->execute();

    $imgPath = makeThumbnailName($imgPath);
    $imgName = makeThumbnailName($imgName);
    $stmt-> bindValue(':deviceId', $deviceId, PDO::PARAM_INT);
    $stmt-> bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
    $stmt-> bindValue(':imgName', $imgName, PDO::PARAM_STR);
    $stmt-> bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
    $stmt->execute();

    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
function getImages() {
    $db = getPDO();
    $sql = 'SELECT imgId, imgPath, imgName, imgDate, devices.deviceId, deviceBrand, deviceModel FROM images JOIN devices ON images.deviceId = devices.deviceId';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $imageArray = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $imageArray;
}
function getThumbnails($deviceId) {
    $db = getPDO();
    $sql = "SELECT img.imgName, img.imgPath, device.deviceBrand, device.deviceModel FROM devices device JOIN images img ON img.deviceId = device.deviceId WHERE img.imgName LIKE '%-tn%' AND device.deviceId = :deviceId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':deviceId', $deviceId, PDO::PARAM_INT);
    $stmt->execute();
    $thumbnails = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $thumbnails;
}
function deleteImage($imgId) {
    $db = getPDO();
    $sql = 'DELETE FROM images WHERE imgId = :imgId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':imgId', $imgId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->rowCount();
    $stmt->closeCursor();
    return $result;
}
function checkExistingImage($imgName) {
    $db = getPDO();
    $sql = "SELECT imgName FROM images WHERE imgName = :name";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $imgName, PDO::PARAM_STR);
    $stmt->execute();
    $imageMatch = $stmt->fetch();
    $stmt->closeCursor();
    return $imageMatch;
}



