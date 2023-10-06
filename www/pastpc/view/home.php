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
</head>
<body>
    <div class="body-div">
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/pastpc/snippets/header.php"?>
        </header>
        <nav>
            <ul class='top-nav'><li><a href='/pastpc/index.php' title='View the PHP Motors home page'>Used</a></li><li><a href='/pastpc/index.php?action=classification&classification-name=Classic' title='View our Classic product line'>Classic</a></li><li><a href='/pastpc/index.php?action=classification&classification-name=EV' title='View our EV product line'>EV</a></li><li><a href='/pastpc/index.php?action=classification&classification-name=Monster' title='View our Monster product line'>Monster</a></li><li><a href='/pastpc/index.php?action=classification&classification-name=Sports' title='View our Sports product line'>Sports</a></li><li><a href='/pastpc/index.php?action=classification&classification-name=SUV' title='View our SUV product line'>SUV</a></li><li><a href='/pastpc/index.php?action=classification&classification-name=Trucks' title='View our Trucks product line'>More</a></li></ul>
            <?php /*print $navList; */?>
        </nav>
        <main>
        <section class="w-section">
                <div class="has-lcp">
                    <img class="lcp" src="/pastpc/images/site/LCP34Left.webp" alt="image of various PCs and devices">
                    <div class="cover-lcp">
                        <p class="lcp-first-text">Rent a PC for Legacy Use, Hosting, and More.</p>
                        <p class="lcp-small">Get control <strong>instantly</strong> of a PC, tablet, or smartphone.</p>
                        <a href="/pastpc/vehicles/index.php?action=search">
                            <p class="find-a-pc">FIND A DEVICE</p>
                        </a>
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