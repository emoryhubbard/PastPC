<?php
/*  Utility function that outputs the
    contents of a variable to the page for
    debugging. Terminates script immediately.
*/

function debugPrint($var, ...$vars) {
    print "<pre>";
    var_dump($var, $vars);
    print "</pre>";
    exit;
}