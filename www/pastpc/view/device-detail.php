<!DOCTYPE html>
<html lang="en-US">
<head>
    <title><?php echo "$deviceInfo[deviceBrand] $deviceInfo[deviceModel]"; ?> | PastPC</title>
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
        <main class="device-detail-main">
            <?php
            if(isset($detailDisplay))
                echo $detailDisplay;
            ?>
            <?php
            if(isset($thumbnailDisplay))
                echo $thumbnailDisplay;
            ?>
            </main>
            <div class='has-reviews'>
            <h2 class='reviews-h2'>Customer Reviews</h2>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                $_SESSION['message'] = null;
            }
            ?>
            <?php
            if ($_SESSION['loggedin'])
                require_once $_SERVER['DOCUMENT_ROOT'] . "/pastpc/snippets/new-review-form.php";
            if (!$_SESSION['loggedin'])
                echo '<p>Add a review by <a class="p-link" href="/pastpc/accounts/index.php?action=login">logging in</a></p>';
            ?>
            <div class="reviews">

            </div>
            </div>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/pastpc/snippets/footer.php"?>
        </footer>
        <script src="../js/device-detail.js" type="module"></script>
    </div>
</body>
</html>


