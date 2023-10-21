<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /pastpc/');
    exit;
}
?><!DOCTYPE html>
<html lang="en-US">
<head>
    <title><?php
        if (isset($deviceInfo['deviceBrand']) && isset($deviceInfo['deviceModel']))
            echo "Delete $deviceINfo[deviceBrand] $deviceInfo[deviceModel]";
        elseif (isset($deviceBrand) && isset($deviceModel))
            echo "Delete $deviceBrand $deviceModel";
        ?> | PastPC</title>
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
            <ul class='top-nav'><?php print $navList; ?></ul>
        </nav>
        <main>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <h1><?php
                if (isset($deviceInfo['deviceBrand']) && isset($deviceInfo['deviceModel']))
                    echo "Delete $deviceInfo[deviceBrand] $deviceInfo[deviceModel]";
                elseif (isset($deviceBrand) && isset($deviceModel))
                    echo "Delete $deviceBrand $deviceModel";
                ?></h1>
            <p>Confirm deletion of the device. Note: deletion is permanent and cannot be undone.</p>
            <form class='blue-form' method="post" action="/pastpc/devices/index.php">
                <fieldset>
                    <label>Brand<span class="asterisk">*</span><input type="text" name="deviceBrand" title="Brand is limited to 30 characters" readonly placeholder="" <?php if(isset($deviceBrand)){echo "value='$deviceBrand'";} elseif(isset($deviceInfo['deviceBrand'])) echo "value='$deviceInfo[deviceBrand]'"; ?>><span>Brand is limited to 30 characters</span></label>
                    <label>Model<span class="asterisk">*</span><input type="text" name="deviceModel" title="Model is limited to 30 characters" readonly placeholder="" <?php if(isset($deviceModel)){echo "value='$deviceModel'";} elseif(isset($deviceInfo['deviceModel'])) echo "value='$deviceInfo[deviceModel]'"; ?>><span>Model is limited to 30 characters</span></label>
                    <label>Description<span class="asterisk">*</span><input type="text" name="deviceDescription" title="Required field" readonly placeholder="" <?php if(isset($deviceDescription)){echo "value='$deviceDescription'";} elseif(isset($deviceInfo['deviceDescription'])) echo "value='$deviceInfo[deviceDescription]'"; ?>></label>
                    <input class="submit-button" type="submit" value="Delete Device">
                    <input type="hidden" name="action" value="submit-delete-device">
                    <input type="hidden" name="deviceId" value="<?php
                    if (isset($deviceInfo['deviceId']))
                        echo $deviceInfo['deviceId'];
                    elseif (isset($deviceId))
                        echo $deviceId;
                    ?>">
                </fieldset>
            </form>
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/pastpc/snippets/footer.php"?>
        </footer>
    </div>
</body>
</html>