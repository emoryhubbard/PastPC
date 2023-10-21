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
    <div class="search-bar">
        <form class='search-bar-form' action="/pastpc/devices/index.php" method="post">
            <input class="search-input" type="text" name="keywords" placeholder="Search...">
            <input type="hidden" name="action" value="submit-search">
            <a href="javascript:"><img class="submit-search-icon" src="/pastpc/images/site/Search2.svg" alt="search icon"></a>
        </form>
        <div class="has-search-close-icon">
            <a href="javascript:"><img class="search-close-icon" src="/pastpc/images/site/CloseIcon.svg" alt="close (as in the verb close) icon"></a>
        </div>
    </div>
    <div class="slideout-menu">
        <div class='has-menu-search-form'>
            <form class='menu-search-form' action="/pastpc/devices/index.php" method="post">
                <input class="menu-search-input" type="text" name="keywords" placeholder="Search...">
                <input type="hidden" name="action" value="submit-search">
                <a href="javascript:"><img class="menu-submit-search-icon" src="/pastpc/images/site/Search2.svg" alt="search icon"></a>
            </form>
            <div class='has-menu-close-icon'>
                <a href="javascript:"><img class="menu-close-icon" src="/pastpc/images/site/CloseIcon.svg" alt="close (as in the verb close) icon"></a>
            </div>
        </div>
        <ul class='menu-nav'>
            <?php
            $arrow = "<img class='menu-arrow-icon' src='/pastpc/images/site/RightArrowIcon.svg' alt='arrow icon'>"; 

            if ($_SESSION['loggedin']) {
                echo '<li><a href="/pastpc/accounts/index.php?client-id=' . $_SESSION['clientData']['clientId'] . '"><p>Welcome, ' . $_SESSION['clientData']['clientFirstname'] . '</p></a></li>';
                echo '<li><a href="/pastpc/accounts/index.php"><p>My Account</p>' . $arrow . '</a></li>';
                echo '<li><a href="/pastpc/accounts/index.php?action=submitLogout"><p>Log Out</p>' . $arrow . '</a></li>';
            }
            if (!$_SESSION['loggedin'])
                echo '<li><a href="/pastpc/accounts/index.php?action=login"><p>Sign In / Create Account</p>' . $arrow . '</a></li>';
            ?>
            <hr class='menu-hr'>
            <li><a class='find-device-option' href="javascript:"><p>Find Device</p><?php echo $arrow;?></a></li>
            <hr class='menu-hr'>
            <ul class='menu-nav-devices'>
                <?php print $menuNavList; ?>
            </ul>
        </ul>
    </div>
    <div class="dark-overlay"></div>
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