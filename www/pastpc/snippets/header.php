<a href="/pastpc"><img src="/pastpc/images/site/logo.png" alt="logo image"></a>
<div class="has-my-account">
    <?php
    if ($_SESSION['loggedin']) {
        echo '<a href="/pastpc/accounts/index.php?client-id=' . $_SESSION['clientData']['clientId'] . '"><p>Welcome, ' . $_SESSION['clientData']['clientFirstname'] . "</p></a>";
        echo '<a href="/pastpc/accounts/index.php?action=submitLogout"><p>Log Out</p></a>';

    }
    if (!$_SESSION['loggedin'])
        echo '<a href="/pastpc/accounts/index.php?action=login"><p>My Account</p></a>';
    ?>
</div>