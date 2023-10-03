<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Vehicle Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" media="screen">
    <link rel="stylesheet" href="/pastpc/css/small.css" media="screen">
    <link rel="stylesheet" href="/pastpc/css/medium.css" media="screen">
    <link rel="stylesheet" href="/pastpc/css/large.css" media="screen">
</head>
<body>
    <div class="body-div">
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/pastpc/snippets/header.php"?>
        </header>
        <nav>
            <?php print $navList; ?>
        </nav>
        <main>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <h1 class="center">Vehicle Management</h1>
            <h2 class="center">New type of vehicle?</h2>
            <p class="center">Add a new <a class="p-link" href="/pastpc/vehicles/index.php?action=add-classification">classification.</a></p>
            <h2 class="center">New car to sell?</h2>
            <p class="center">Add a new <a class="p-link" href="/pastpc/vehicles/index.php?action=add-vehicle">vehicle.</a></p> 
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/pastpc/snippets/footer.php"?>
        </footer>
    </div>
</body>
</html>
<!--
            require_once '../library/connections.php';
            require_once '../model/main-model.php';
            $classifications = getClassifications();
            $navList = "<ul class='top-nav'>";
            $navList .= "<li><a href='/pastpc/index.php' title='View the PHP"
                . " Motors home page'>Home</a></li>";
            foreach ($classifications as $cl)
                $navList .= "<li><a href='/pastpc/index.php?action=" . urlencode($cl['classificationName']) . "' title='View our $cl[classificationName] product line'>$cl[classificationName]</a></li>";
            $navList .= '</ul>';-->