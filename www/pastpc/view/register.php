<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Create My Account</title>
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
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form class='blue-form' method="post" action="/pastpc/accounts/index.php">
                <fieldset class="password-fieldset">
                    <label>First name<span class="asterisk">*</span><input type="text" name="clientFirstname" title="Required field" required placeholder="" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?>></label>
                    <label>Last name<span class="asterisk">*</span><input type="text" name="clientLastname" title="Required field" required placeholder="" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?>></label>                    
                    <label>Email<span class="asterisk">*</span><input type="email" name="clientEmail" title="Required field" required placeholder="" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?>></label>
                    <label title="Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character">Password<span class="asterisk">*</span><input class="password-input" type="password" name="clientPassword" title="Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" placeholder=""><span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span></label>
                    <input class="submit-button" type="submit" value="Create Account">
                    <input type="hidden" name="action" value="submit-register">
                </fieldset>
            </form>
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/pastpc/snippets/footer.php"?>
        </footer>
    </div>
</body>
</html>


