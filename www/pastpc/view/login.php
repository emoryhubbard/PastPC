<?php
require_once '../../../vendor/autoload.php';
require_once '../library/googleconnect.php';

$dotenv = Dotenv\Dotenv::createImmutable('../../../');
$dotenv->load();
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Log into my Account</title>
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
            <section class="w-section">
                <div class="has-lcp">
                    <!--<img class="lcp" src="/pastpc/images/site/LCP34Left.webp" alt="image of various PCs and devices">-->
                    <div class="cover-lcp login-cover-lcp">
                        <p class="lcp-small">
                        <?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            $_SESSION['message'] = null;
                        }?></p>
                        <form class='blue-form login-form' action="/pastpc/accounts/index.php" method="post">
                            <fieldset class='login-form-fieldset'>
                                <label>Email<span class="asterisk">*</span><input type="email" name="clientEmail" required placeholder="" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?>></label>
                                <label title="Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character">Password<span class="asterisk">*</span><input class="password-input" type="password" name="clientPassword" title="Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" placeholder=""><span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span></label>
                                <input class="submit-button" type="submit" value="Sign in">
                                <!--<div class="google-sign-in-button">
                                    <a href="
                                    <?php /*echo getGoogleClient()->createAuthUrl();*/
                                    ?>"> Login with Google</a>
                                </div>-->
                                <script src="https://accounts.google.com/gsi/client" async></script>
                                <div id="g_id_onload"
                                    data-client_id=<?php echo "'" . $_SERVER['CLIENT_ID'] . "'"; ?>
                                    data-login_uri=<?php echo "'" . $_SERVER['REDIRECT_URI'] . "'"; ?>
                                    data-context="signin"
                                    data-ux_mode="popup"
                                    data-auto_prompt="false"
                                    data-your_own_param_1_to_login="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                </div>
                                <div class="g_id_signin"
                                    data-type="standard"
                                    data-shape="pill"
                                    data-theme="outline"
                                    data-text="continue_with"
                                    data-size="large"
                                    data-logo_alignment="left">
                                </div>
                                <!--<script src="https://accounts.google.com/gsi/client" async></script>
                                <div id="g_id_onload"
                                    data-client_id=<?php /*echo "'" . $_SERVER['CLIENT_ID'] . "'";*/ ?>
                                    data-login_uri=<?php /*echo "'" . $_SERVER['REDIRECT_URI'] . "'";*/ ?>>
                                </div>-->
                                <label class="no-account">No account? <a href="/pastpc/accounts/index.php?action=register">Sign up</a></label>
                                <label class="forgot-password">Forgot password? <a href="/pastpc/accounts/index.php?action=forgot-password">Get reset link</a></label>
                                <input type="hidden" name="action" value="submit-login">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </section>
            <!--<?php
            /*if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                $_SESSION['message'] = null;
            }*/
            ?>
            <form class='blue-form' action="/pastpc/accounts/index.php" method="post">
                <fieldset>
                    <label>Email<span class="asterisk">*</span><input type="email" name="clientEmail" required placeholder="" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?>></label>
                    <label title="Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character">Password<span class="asterisk">*</span><input class="password-input" type="password" name="clientPassword" title="Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" placeholder=""><span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span></label>
                    <input class="submit-button" type="submit" value="Sign in">
                    <label class="no-account">No account? <a href="/pastpc/accounts/index.php?action=register">Sign up</a></label>
                    <label class="forgot-password">Forgot password? <a href="/pastpc/accounts/index.php?action=forgot-password">Get reset link</a></label>
                    <input type="hidden" name="action" value="submit-login">
                </fieldset>
            </form>-->
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/pastpc/snippets/footer.php"?>
        </footer>
    </div>
</body>
</html>


