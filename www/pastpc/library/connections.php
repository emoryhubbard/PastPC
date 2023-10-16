<?php
    function getPDO() {
    $server = 'mysql';
    $dbname = 'pastpc';
    $username = 'iClient';
    $password = '_pPhn*mvJpt0vTrH';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

    try {
        $pdo = new PDO($dsn, $username, $password, $options);
        /*if (is_object($pdo)) {
            print 'Succeeded in connecting.';
        }*/
        return $pdo;
    } catch (PDOException $e) {
        //print "Failed to connect. Error: " . $e->getMessage();
        header('Location: /pastpc/view/500.php');
        exit;
    }
}
function getPDOFor($dbname) {
    $server = 'mysql';
    $username = 'iClient';
    $password = '_pPhn*mvJpt0vTrH';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

    try {
        $pdo = new PDO($dsn, $username, $password, $options);
        /*if (is_object($pdo)) {
            print 'Succeeded in connecting.';
        }*/
        return $pdo;
    } catch (PDOException $e) {
        //print "Failed to connect. Error: " . $e->getMessage();
        header('Location: /pastpc/view/500.php');
        exit;
    }
}
function query($sql) {
    $pdo = getPDO();
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();

    return $result;
}
function querydb($dbname, $sql) {
    $pdo = getPDOFor($dbname);
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();

    return $result;
}
function rowsChanged($sql) {
    $pdo = getPDO();
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $rowsChanged = $statement->rowCount();
    $statement->closeCursor();
    return $rowsChanged;
}
function executeGetRowsChanged($sql, $params) {
    $pdo = getPDO();
    $statement = $pdo->prepare($sql);

    // Bind the parameter based on its data type
    foreach ($params as $key => $value) {
        $dataType = getDataType($value);
        $statement->bindValue($key + 1, $value, $dataType);
    }

    $statement->execute();
    $rowsChanged = $statement->rowCount();
    $statement->closeCursor();
    return $rowsChanged;
}
function getDataType($value) {
    if (is_int($value))
        return PDO::PARAM_INT;
    if (is_float($value))
        return PDO::PARAM_STR; // Best practice. Convert back after retrieval
    if (is_string($value))
        return PDO::PARAM_STR;
    if (is_bool($value))
        return PDO::PARAM_BOOL;
    if (is_null($value))
        return PDO::PARAM_NULL;
    return PDO::PARAM_STR;
}
//getpastpcPDO();
?>