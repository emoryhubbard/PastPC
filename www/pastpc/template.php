<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>PastPC Page Template</title>
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
            <h1>Content Title Here</h1>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                $_SESSION['message'] = null;
            }
            ?>
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/pastpc/snippets/footer.php"?>
        </footer>
    </div>
</body>
</html>


