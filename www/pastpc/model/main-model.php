<?php
/*  The main model for PastPC. The code here is used to
    access general information about the database, like
    classifications. If code specific to the device model is
    needed, it would be found in the device model.
*/

function getClassifications() {
    $sql = 'SELECT classificationName, classificationId FROM deviceclassification ORDER BY classificationName ASC';
    return query($sql);
}


