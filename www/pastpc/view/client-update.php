<?php
if (!$_SESSION['loggedin'])
    header('Location: /pastpc');
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Update Account Information</title>
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
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                $_SESSION['message'] = null;
            }
            ?>
            <h2>Update Account Information</h2>
            <form method="post" action="/pastpc/accounts/index.php">
                <fieldset class="password-fieldset">
                    <label>First name<span class="asterisk">*</span><input type="text" name="clientFirstname" title="Required field" required placeholder="" <?php if(isset($_SESSION['clientData']['clientFirstname'])){$fname = $_SESSION['clientData']['clientFirstname']; echo "value='$fname'";} ?>></label>
                    <label>Last name<span class="asterisk">*</span><input type="text" name="clientLastname" title="Required field" required placeholder="" <?php if(isset($_SESSION['clientData']['clientLastname'])){$lname = $_SESSION['clientData']['clientLastname']; echo "value='$lname'";} ?>></label>                    
                    <label>Email<span class="asterisk">*</span><input type="email" name="clientEmail" title="Required field" required placeholder="" <?php if(isset($_SESSION['clientData']['clientEmail'])){$email = $_SESSION['clientData']['clientEmail']; echo "value='$email'";} ?>></label>
                    <input class="submit-button" type="submit" value="Update Account">
                    <input type="hidden" name="action" value="submit-update-account">
                    <input type="hidden" name="clientId" value="<?php
                    if (isset($_SESSION['clientData']['clientId']))
                    echo $_SESSION['clientData']['clientId'];
                    ?>">
                </fieldset>
            </form>
            <h2>Change Password</h2>
            <p>Enter a new password to change your existing password:</p>
            <form method="post" action="/pastpc/accounts/index.php">
                <fieldset class="password-fieldset">
                    <label title="Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character">Password<span class="asterisk">*</span><input class="password-input" type="password" name="clientPassword" title="Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" placeholder=""><span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span></label>
                    <input class="submit-button" type="submit" value="Change Password">
                    <input type="hidden" name="action" value="submit-change-password">
                    <input type="hidden" name="clientId" value="<?php
                    if (isset($_SESSION['clientData']['clientId']))
                        echo $_SESSION['clientData']['clientId'];
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


