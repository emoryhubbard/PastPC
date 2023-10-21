<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Delete Review</title>
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
            <h1>Delete Review</h1>
            <p>Deleting a review is permanent. Are you sure?</p>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                $_SESSION['message'] = null;
            }
            ?>
            <form class='blue-form' method="post" action="/pastpc/reviews/index.php">
                <fieldset>
                    <label>Review Date<span class="asterisk"></span><input type="text" name="review-date" title="(read-only)" readonly placeholder="" value="<?php echo $review['reviewDate']; ?>"><span>Brand is limited to 30 characters</span></label>
                    <label>Screen Name<span class="asterisk"></span><input type="text" name="screen-name" title="(read-only)" readonly placeholder="" value="<?php echo substr($review['clientFirstname'], 0, 1) . $review['clientLastname']; ?>"><span>Model is limited to 30 characters</span></label>
                    <label>Review Text<span class="asterisk"></span><input type="text" name="review-text" title="(read-only)" readonly placeholder="" value="<?php echo $review['reviewText']?>"></label>
                    <input class="submit-button" type="submit" value="Delete Review">
                    <input type="hidden" name="action" value="submit-delete-review">
                    <input type="hidden" name="review-id" value="<?php echo $review['reviewId']?>">
                </fieldset>
            </form>
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/pastpc/snippets/footer.php"?>
        </footer>
    </div>
</body>
</html>