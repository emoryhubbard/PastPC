<?php
$classificationList = "<select name='classificationId'>";
foreach ($classifications as $cl) {
    $classificationList .= "<option value='$cl[classificationId]'";

    if (isset($classificationId) && $cl['classificationId'] === $classificationId)
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
    <title>Add Device</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" media="screen">
    <link rel="stylesheet" href="/pastpc/css/small.css" media="screen">
    <link rel="stylesheet" href="/pastpc/css/medium.css" media="screen">
    <link rel="stylesheet" href="/pastpc/css/large.css" media="screen">
    <link rel="icon" type="image/svg" href="/pastpc/images/site/OuterBlueInnerWhite.svg">
</head>
<body><script>0</script>
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
            <form class='blue-form' method="post" action="/pastpc/devices/index.php">
                <fieldset>
                    <label>Brand<span class="asterisk">*</span><input type="text" name="deviceBrand" title="Brand is limited to 30 characters" required pattern=<?php print $deviceBrandPattern;?> placeholder="" <?php if(isset($deviceBrand)){echo "value='$deviceBrand'";} ?>><span>Brand is limited to 30 characters</span></label>
                    <label>Model<span class="asterisk">*</span><input type="text" name="deviceModel" title="Model is limited to 30 characters" required pattern=<?php print $deviceModelPattern;?> placeholder="" <?php if(isset($deviceModel)){echo "value='$deviceModel'";} ?>><span>Model is limited to 30 characters</span></label>
                    <label>Description<span class="asterisk">*</span></label>
                    <textarea name="deviceDescription" title="Required field" required placeholder=""><?php if(isset($deviceDescription)) { echo $deviceDescription; } ?></textarea>
                    <!--<label>Description<span class="asterisk">*</span><input type="text" name="deviceDescription" title="Required field" required placeholder="" <?php //if(isset($deviceDescription)){echo "value='$deviceDescription'";} ?>></label>-->
                    <label>Image<span class="asterisk">*</span><input type="text" name="deviceImage" value="/images/no-image.png" title="Required field"></label>
                    <label>Thumbnail<span class="asterisk">*</span><input type="text" name="deviceThumbnail" value="/images/no-image.png" title="Required field"></label>
                    <label>Monthly Rate<span class="asterisk">*</span><input type="text" name="deviceMonthlyRate" title="Monthly rate must be a decimal number" required pattern=<?php print $deviceMonthlyRatePattern;?> placeholder="" <?php if(isset($deviceMonthlyRate)){echo "value='$deviceMonthlyRate'";} ?>><span>Monthly rate must be a decimal number</span></label>
                    <?php print $classificationList ?>
                    <input class="submit-button" type="submit" value="Add Device">
                    <input type="hidden" name="action" value="submit-device">
                </fieldset>
            </form>
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/pastpc/snippets/footer.php"?>
        </footer>
    </div>
</body>
</html>