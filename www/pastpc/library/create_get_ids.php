<?php
require_once '../library/connections.php';

function create_get_ids($dbname) {
    $max_params = 3; // Makes get_id1(), get_id2(), get_id3() if possible
    $tables = querydb($dbname, "SELECT table_name FROM information_schema.tables WHERE table_schema = '$dbname'");
    print "<pre>";
    foreach ($tables as $table) {
        $table_name = $table['TABLE_NAME'];
        create_table_get_ids($max_params, $table_name, $dbname);
    }
    print "</pre>";
    exit;
}
function create_table_get_ids($max_params, $table_name, $dbname) {
    for ($params = 1; $params <= $max_params; $params++)
        create_get_id($params, $table_name, $dbname);
}
function create_get_id($params, $table_name, $dbname) {
    $col_names = [];
    for ($param = 1; $param <= $params + 1; $param++)
        $col_names[$param] = get_column_name($param, $table_name, $dbname);
    if ($col_names[$params + 1] == NULL)
        return;
    
    $createFunctionLine = getCreateFunctionLine($params, $table_name);
    $returnLine = getReturnLine($params, $table_name, $col_names);
    print
"DROP FUNCTION IF EXISTS get_" . $table_name . "_id" . $params . ";\n";
    print
"DELIMITER $$\n";
    print
$createFunctionLine;
    print
"RETURNS INT
DETERMINISTIC
BEGIN
RETURN\n";
    print 
$returnLine;
    print
"END$$
DELIMITER ;\n\n";
}
function get_column_name($position, $table_name, $dbname) {
    $col1_result = querydb($dbname, "SELECT column_name FROM information_schema.columns WHERE table_schema = '$dbname' AND table_name = '$table_name' AND ordinal_position = $position");
    return $col1_result[0]['COLUMN_NAME'];
}
function getCreateFunctionLine($params, $table_name) {
    $parameters = "col2 VARCHAR(45)";
    for ($col_num = 3; $col_num <= $params + 1; $col_num++)
        $parameters .= ", col$col_num VARCHAR(45)";
    return "CREATE FUNCTION get_" . $table_name . "_id" . $params . " ($parameters)\n";
}
function getReturnLine($params, $table_name, $col_names) {
    $whereClause = "WHERE $col_names[2] = col2";
    for ($col_num = 3; $col_num <= $params + 1; $col_num++)
        $whereClause .= " AND $col_names[$col_num] = col$col_num";
    return "   (SELECT $col_names[1] FROM $table_name $whereClause);\n";
}
/*
function get_column_name($position, $table_name, $dbname) {
    $col1_result = querydb($dbname, "SELECT column_name FROM information_schema.columns WHERE table_schema = '$dbname' AND table_name = '$table_name' AND ordinal_position = $position");
    return $col1_result[0]['COLUMN_NAME'];
}
function getCreateFunctionLine($params, $table_name) {
    $parameters = "col2 VARCHAR(45)";
    if ($params == 2 || $params == 3)
        $parameters .= ", col3 VARCHAR(45)";
    if ($params == 3)
        $parameters .= ", col4 VARCHAR(45)";
    return "CREATE FUNCTION get_" . $table_name . "_id" . $params . " ($parameters)\n";
}
function getReturnLine($params, $table_name, $col1_name, $col2_name, $col3_name, $col4_name) {
    $whereClause = "WHERE $col2_name = col2";
    if ($params == 2 || $params == 3)
        $whereClause .= " AND $col3_name = col3";
    if ($params == 3)
        $whereClause .= " AND $col4_name = col4";
    return "   (SELECT $col1_name FROM $table_name $whereClause);\n";
}
*/

/*function create_get_ids($dbname) {
    $tables = querydb($dbname, "SELECT table_name FROM information_schema.tables WHERE table_schema = '$dbname'");
    print "<pre>";
    foreach ($tables as $table) {
        $table_name = $table['TABLE_NAME'];
        create_get_id(1, $table_name, $dbname);
        create_get_id(2, $table_name, $dbname);
        create_get_id(3, $table_name, $dbname);
    }
    print "</pre>";
    exit;
}
function create_get_id($params, $table_name, $dbname) {
    $col1_name = get_column_name(1, $table_name, $dbname);
    $col2_name = get_column_name(2, $table_name, $dbname);
    $col3_name = get_column_name(3, $table_name, $dbname);
    $col4_name = get_column_name(4, $table_name, $dbname);
    if ($col2_name == NULL || ($col3_name == NULL AND $params == 2) ||
        ($col4_name == NULL AND $params == 3))
        return;
    
    $createFunctionLine = getCreateFunctionLine($params, $table_name, $col2_name, $col3_name, $col4_name);
    $returnLine = getReturnLine($params, $table_name, $col1_name, $col2_name, $col3_name, $col4_name);
    print
"DROP FUNCTION IF EXISTS get_" . $table_name . "_id" . $params . ";\n";
    print
"DELIMITER $$\n";
    print
$createFunctionLine;
    print
"RETURNS INT
DETERMINISTIC
BEGIN
RETURN\n";
    print 
$returnLine;
    print
"END$$
DELIMITER ;\n\n";
}
function get_column_name($position, $table_name, $dbname) {
    $col1_result = querydb($dbname, "SELECT column_name FROM information_schema.columns WHERE table_schema = '$dbname' AND table_name = '$table_name' AND ordinal_position = $position");
    return $col1_result[0]['COLUMN_NAME'];
}
function getCreateFunctionLine($params, $table_name, $col2_name, $col3_name, $col4_name) {
    $parameters = "col2 VARCHAR(45)";
    if ($params == 2 || $params == 3)
        $parameters .= ", col3 VARCHAR(45)";
    if ($params == 3)
        $parameters .= ", col4 VARCHAR(45)";
    return "CREATE FUNCTION get_" . $table_name . "_id" . $params . " ($parameters)\n";
}
function getReturnLine($params, $table_name, $col1_name, $col2_name, $col3_name, $col4_name) {
    $whereClause = "WHERE $col2_name = col2";
    if ($params == 2 || $params == 3)
        $whereClause .= " AND $col3_name = col3";
    if ($params == 3)
        $whereClause .= " AND $col4_name = col4";
    return "   (SELECT $col1_name FROM $table_name $whereClause);\n";
}
*/

/*
function create_get_id1($table_name, $dbname) {
    $col1_name = get_column_name(1, $table_name, $dbname);
    $col2_name = get_column_name(2, $table_name, $dbname);
    if ($col2_name == NULL)
        return;
    
    print
"DROP FUNCTION IF EXISTS get_" . $table_name . "_id1;\n";
    print
"DELIMITER $$\n";
    print
"CREATE FUNCTION get_" . $table_name . "_id1 (col2 VARCHAR(45))\n";
    print
"RETURNS INT
DETERMINISTIC
BEGIN
RETURN\n";
    print 
"   (SELECT $col1_name FROM $table_name WHERE $col2_name = col2);\n";
    print
"END$$
DELIMITER ;\n\n";
}
function create_get_id2($table_name, $dbname) {
    $col1_name = get_column_name(1, $table_name, $dbname);
    $col2_name = get_column_name(2, $table_name, $dbname);
    $col3_name = get_column_name(3, $table_name, $dbname);
    if ($col3_name == NULL)
        return;

    print
"DROP FUNCTION IF EXISTS get_" . $table_name . "_id2;\n";
    print
"DELIMITER $$\n";
    print
"CREATE FUNCTION get_" . $table_name . "_id2 (col2 VARCHAR(45), col3 VARCHAR(45))\n";
    print
"RETURNS INT
DETERMINISTIC
BEGIN
RETURN\n";
    print 
"   (SELECT $col1_name FROM $table_name WHERE $col2_name = col2 AND $col3_name = col3);\n";
    print
"END$$
DELIMITER ;\n\n";
}
function create_get_id3($table_name, $dbname) {
    $col1_name = get_column_name(1, $table_name, $dbname);
    $col2_name = get_column_name(2, $table_name, $dbname);
    $col3_name = get_column_name(3, $table_name, $dbname);
    $col4_name = get_column_name(4, $table_name, $dbname);
    if ($col4_name == NULL)
        return;

    print
"DROP FUNCTION IF EXISTS get_" . $table_name . "_id3;\n";
    print
"DELIMITER $$\n";
    print
"CREATE FUNCTION get_" . $table_name . "_id3 (col2 VARCHAR(45), col3 VARCHAR(45), col4 VARCHAR(45))\n";
    print
"RETURNS INT
DETERMINISTIC
BEGIN
RETURN\n";
    print 
"   (SELECT $col1_name FROM $table_name WHERE $col2_name = col2 AND $col3_name = col3 AND $col4_name = col4);\n";
    print
"END$$
DELIMITER ;\n\n";
}
*/


/*
$result = querydb('university', 'SELECT college_name FROM college');
print "<pre>";
print $result[0]['college_name'];
print "<pre>";
exit;
*/