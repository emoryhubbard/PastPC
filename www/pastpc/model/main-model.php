<?php
/*  The main model for PastPC. The code here is used to
    access general information about the database, like
    classifications. If code specific to the vehicle model is
    needed, it would be found in the vehicle model.
*/

function getClassifications() {
    $sql = 'SELECT classificationName, classificationId FROM carclassification ORDER BY classificationName ASC';
    return query($sql);
}


