<div class="has-header">
    <a class="has-top-logo" href="/pastpc"><img class="top-logo" src="/pastpc/images/site/OuterBlueInnerWhiteBlackText.svg" alt="logo image"></a>
    <div class="has-my-account">
        <a href="javascript:"><img class="search-icon" src="/pastpc/images/site/Search2.svg" alt="search icon"></a>
        <?php
        if ($_SESSION['loggedin']) {
            //echo '<a href="../accounts/index.php?action=login"><img class="account-icon" src="../images/site/AccountCropped2.svg" alt="account icon"></a>';
            echo '<a href="/pastpc/accounts/index.php?client-id=' . $_SESSION['clientData']['clientId'] . '"><img class="account-icon" src="/pastpc/images/site/AccountCropped2.svg" alt="account icon">' . "</a>";
        }
        if (!$_SESSION['loggedin'])
            echo '<a href="/pastpc/accounts/index.php?action=login"><img class="account-icon" src="/pastpc/images/site/AccountCropped2.svg" alt="account icon"></a>';
        ?>
        <a href="javascript:"><img class="burger-icon" src="/pastpc/images/site/Burger2.svg" alt="burger icon"></a>
    </div>
    <div class="search-bar search-bar-close">
        <form action="/pastpc/devices/index.php" method="post">
            <fieldset>
                <input type="text" name="keywords" value="Find Device, eg. IBM PC...">
                <input class="submit-button" type="submit" value="Search">
                <input type="hidden" name="action" value="submit-search">
            </fieldset>
        </form>
        <a href="javascript:"><img class="search-close-icon" src="/pastpc/images/site/CloseIcon.svg" alt="close (as in the verb close) icon"></a>
    </div>
    <div class="slideout-menu slideout-menu-close">
        <a href="javascript:"><img class="menu-close-icon" src="/pastpc/images/site/CloseIcon.svg" alt="close (as in the verb close) icon"></a>
        <ul class='menu-nav'>
        <?php
        if ($_SESSION['loggedin']) {
            echo '<a href="/pastpc/accounts/index.php?client-id=' . $_SESSION['clientData']['clientId'] . '"><p>Welcome, ' . $_SESSION['clientData']['clientFirstname'] . "</p></a>";
            echo '<a href="/pastpc/accounts/index.php"><p>My Account</p></a>';
            echo '<a href="/pastpc/accounts/index.php?action=submitLogout"><p>Log Out</p></a>';
        }
        if (!$_SESSION['loggedin'])
            echo '<a href="/pastpc/accounts/index.php?action=login"><p>Sign In</p></a>';
        ?>
        <a class='find-device-option' href="javascript:"><p>Find Device</p></a>
        <?php print $navList; ?></ul>
    </div>
    <script src="/pastpc/js/header.js" type="module"></script>
    <!--<a href="/pastpc"><img src="/pastpc/images/site/logo.png" alt="logo image"></a>
    <div class="has-my-account">
        <?php
        /*if ($_SESSION['loggedin']) {
            echo '<a href="/pastpc/accounts/index.php?client-id=' . $_SESSION['clientData']['clientId'] . '"><p>Welcome, ' . $_SESSION['clientData']['clientFirstname'] . "</p></a>";
            echo '<a href="/pastpc/accounts/index.php?action=submitLogout"><p>Log Out</p></a>';
    
        }
        if (!$_SESSION['loggedin'])
            echo '<a href="/pastpc/accounts/index.php?action=login"><p>My Account</p></a>';
        */?>
    </div>-->
</div>