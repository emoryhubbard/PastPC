<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>PastPC Home Page</title>
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
        <section class="w-section">
                <div class="has-lcp">
                    <img class="lcp" src="/pastpc/images/site/LCP34Left.webp" alt="image of various PCs and devices">
                    <div class="cover-lcp">
                        <p class="lcp-first-text">Rent a PC for Legacy Use, Hosting, and More.</p>
                        <p class="lcp-small">Get control <strong>instantly</strong> of a PC, tablet, or smartphone.</p>
                        <div class="lcp-find-device">
                            <p class="find-a-pc">FIND A DEVICE</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/pastpc/snippets/footer.php"?>
        </footer>
    </div>
</body>
</html>