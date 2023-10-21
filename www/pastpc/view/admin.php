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
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/pastpc/snippets/header.php"?>
        </header>
        <nav>
            <ul class='top-nav'><?php print $navList; ?></ul>
        </nav>
        <main>
            <h1><?php echo $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname'];?></h1>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                $_SESSION['message'] = null;
            }
            ?>
            <?php
            $cd = $_SESSION['clientData'];
            $ul = '<ul>';
            $ul .= "<li>First name: $cd[clientFirstname]</li>";
            $ul .= "<li>Last name: $cd[clientLastname]</li>";
            $ul .= "<li>Email: $cd[clientEmail]</li>";
            $ul .= '</ul>';
            echo $ul;
            echo '<p><a class="p-link" href="/pastpc/accounts/index.php?action=submitLogout">Log Out</a></p>';
            echo '<p><a class="p-link" href="/pastpc/accounts/index.php?action=update-account">Update Account Information</a></p>';
            
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