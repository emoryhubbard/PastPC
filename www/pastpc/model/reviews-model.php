<?php
/*  The reviews model for PastPC. Used
    whenever database access to the reviews
    model is needed. It is the interface
    to the database for review operations.
*/
function addReview($reviewText, $deviceId, $clientId) {
    $sql = "INSERT INTO reviews (reviewText, deviceId, clientId) VALUES ('$reviewText', $deviceId, $clientId)";
    return rowsChanged($sql);
}
function getDeviceReviews($deviceId) {
    $sql = "SELECT reviews.reviewText, reviews.reviewDate, reviews.reviewId, clients.clientFirstname, clients.clientLastname FROM reviews JOIN devices ON devices.deviceId = reviews.deviceId JOIN clients ON clients.clientId = reviews.clientId WHERE reviews.deviceId = $deviceId ORDER BY reviews.reviewDate DESC";
    return query($sql);
}
function getClientReviews($clientId) {
    $sql = "SELECT reviews.reviewText, reviews.reviewDate, reviews.reviewId, clients.clientFirstname, clients.clientLastname FROM reviews JOIN clients ON clients.clientId = reviews.clientId WHERE reviews.clientId = $clientId";
    return query($sql);
}
function getReview($reviewId) {
    $sql = "SELECT reviews.reviewId, reviews.reviewDate, reviews.reviewText, clients.clientFirstname, clients.clientLastname FROM reviews JOIN clients ON clients.clientId = reviews.clientId WHERE reviews.reviewId = $reviewId";
    return query($sql);
}
function updateReview($reviewId, $reviewText) {
    $sql = "UPDATE reviews SET reviewText = '$reviewText' WHERE reviewId = $reviewId";
    return rowsChanged($sql);
}
function deleteReview($reviewId) {
    $sql = "DELETE FROM reviews WHERE reviewId = $reviewId";
    return rowsChanged($sql);
}



