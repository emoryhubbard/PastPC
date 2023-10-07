<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /pastpc/');
    exit;
}
?><!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Add Classification</title>
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
            <form method="post" action="/pastpc/devices/index.php">
                <fieldset>
                    <label>Classification<span class="asterisk">*</span><input class="classification-input" type="text" name="classificationName" title="Classification is limited to 30 characters" required pattern=".{1,30}" placeholder="" <?php if(isset($classificationName)){echo "value='$classificationName'";} ?>><span>Classification is limited to 30 characters</span></label>
                    <input class="submit-button" type="submit" value="Add Classification">
                    <input type="hidden" name="action" value="submit-classification">
                </fieldset>
            </form>
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/pastpc/snippets/footer.php"?>
        </footer>
    </div>
</body>
</html>
