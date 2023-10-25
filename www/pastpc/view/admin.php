<?php
if (!$_SESSION['loggedin'])
    header('Location: /pastpc');
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>My Account</title>
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
        <div class="sticky-header">
            <header>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/pastpc/snippets/header.php"?>
            </header>
            <nav>
                <ul class='top-nav'><?php print $navList; ?></ul>
            </nav>
        </div>
        <main>
            <h1 class='account-h1'>Account Info</h1>
            <?php
            $cd = $_SESSION['clientData'];
            $dv .= "<ul class='account-info-table'>";
            $dv .= "<li class='account-info-table-item'><p class='account-info-table-item-field'>First name</p><p class='account-info-table-item-value'>$cd[clientFirstname]</p>";
            $dv .= "<li class='account-info-table-item'><p class='account-info-table-item-field'>Last name</p><p class='account-info-table-item-value'>$cd[clientLastname]</p>";
            $dv .= "<li class='account-info-table-item'><p class='account-info-table-item-field'>Email</p><p class='account-info-table-item-value'>$cd[clientEmail]</p>";
            $dv .= "</ul>";
            echo $dv;
            ?>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                $_SESSION['message'] = null;
            }
            ?>
            <div class='logout-button'>
                <a href='javascript:' class='logout-button-text p-link'>Log Out</a>
                <a href="javascript:"><img class='logout-button-arrow-icon' src='/pastpc/images/site/RightArrowIcon.svg' alt='right arrow icon'></a>
            </div>
            <div class='update-account-button'>
                <a href='javascript:' class='update-account-button-text p-link'>Update Account Info</a>
                <a href="javascript:"><img class='update-account-button-arrow-icon' src='/pastpc/images/site/RightArrowIcon.svg' alt='right arrow icon'></a>
            </div>
            <?php
            if ($cd['clientLevel'] > 1) {
                echo '<h2>Administrative Actions</h2>';
                echo '<p>Use the following link to administer device listings:</p>';
                echo '<p><a class="p-link" href="/pastpc/devices">Device Management</a></p>';
            }
            ?>
            <div class="reviews"></div>
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/pastpc/snippets/footer.php"?>
        </footer>
        <script src="../js/admin.js" type="module"></script>

    </div>
</body>
</html>