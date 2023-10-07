<?php
$classificationList = "<select name='classificationId'>";
foreach ($classifications as $cl) {
    $classificationList .= "<option value='$cl[classificationId]'";

    if (isset($classificationId) && $cl['classificationId'] === $classificationId)
        $classificationList .= ' selected ';
    elseif (isset($invInfo['classificationId']) && $cl['classificationId'] === $invInfo['classificationId'])
        $classificationList .= ' selected ';
    $classificationList .= ">$cl[classificationName]</option>";
}
$classificationList .= '</select>';

if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /pastpc/');
    exit;
}
?><!DOCTYPE html>
<html lang="en-US">
<head>
    <title><?php
        if (isset($invInfo['invMake']) && isset($invInfo['invModel']))
            echo "Modify $invINfo[invMake] $invInfo[invModel]";
        elseif (isset($invMake) && isset($invModel))
            echo "Modify $invMake $invModel";
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
                if (isset($invInfo['invMake']) && isset($invInfo['invModel']))
                    echo "Modify $invInfo[invMake] $invInfo[invModel]";
                elseif (isset($invMake) && isset($invModel))
                    echo "Modify $invMake $invModel";
                ?></h1>
            <form method="post" action="/pastpc/devices/index.php">
                <fieldset>
                    <label>Make<span class="asterisk">*</span><input type="text" name="invMake" title="Make is limited to 30 characters" required pattern=<?php print $invMakePattern;?> placeholder="" <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) echo "value='$invInfo[invMake]'"; ?>><span>Make is limited to 30 characters</span></label>
                    <label>Model<span class="asterisk">*</span><input type="text" name="invModel" title="Model is limited to 30 characters" required pattern=<?php print $invModelPattern;?> placeholder="" <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) echo "value='$invInfo[invModel]'"; ?>><span>Model is limited to 30 characters</span></label>
                    <label>Description<span class="asterisk">*</span><input type="text" name="invDescription" title="Required field" required placeholder="" <?php if(isset($invDescription)){echo "value='$invDescription'";} elseif(isset($invInfo['invDescription'])) echo "value='$invInfo[invDescription]'"; ?>></label>
                    <label>Image<span class="asterisk">*</span><input type="text" name="invImage" value="/images/no-image.png" title="Required field"></label>
                    <label>Thumbnail<span class="asterisk">*</span><input type="text" name="invThumbnail" value="/images/no-image.png" title="Required field"></label>
                    <label>Price<span class="asterisk">*</span><input type="text" name="invPrice" title="Price must be a decimal number" required pattern=<?php print $invPricePattern;?> placeholder="" <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) echo "value='$invInfo[invPrice]'"; ?>><span>Price must be a decimal number</span></label>
                    <label>Color<span class="asterisk">*</span><input type="text" name="invColor" title="Color is limited to 20 characters" required pattern=<?php print $invColorPattern;?> placeholder="" <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) echo "value='$invInfo[invColor]'"; ?>><span>Color is limited to 20 characters</span></label>
                    <?php print $classificationList ?>
                    <input class="submit-button" type="submit" value="Update Device">
                    <input type="hidden" name="action" value="submit-update-device">
                    <input type="hidden" name="invId" value="<?php
                    if (isset($invInfo['invId']))
                        echo $invInfo['invId'];
                    elseif (isset($invId))
                        echo $invId;
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