<?php
/*  Utility function that outputs the
    contents of a variable to the page for
    debugging. Terminates script immediately.
*/

function debugPrint($var) {
    print "<pre>";
    var_dump($var);
    print "</pre>";
    exit;
}