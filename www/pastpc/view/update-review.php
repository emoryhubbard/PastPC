<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Update Review</title>
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
            <?php print $navList; ?>
        </nav>
        <main>
            <h1>Edit Review</h1>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                $_SESSION['message'] = null;
            }
            ?>
            <form method="post" action="/pastpc/reviews/index.php">
                <fieldset>
                    <label>Review Date<span class="asterisk"></span><input type="text" name="review-date" title="(read-only)" readonly placeholder="" value="<?php echo $review['reviewDate']; ?>"><span>Make is limited to 30 characters</span></label>
                    <label>Screen Name<span class="asterisk"></span><input type="text" name="screen-name" title="(read-only)" readonly placeholder="" value="<?php echo substr($review['clientFirstname'], 0, 1) . $review['clientLastname']; ?>"><span>Model is limited to 30 characters</span></label>
                    <label>Review Text<span class="asterisk">*</span><input type="text" name="review-text" title="Required field" required placeholder="" value="<?php echo $review['reviewText']?>"></label>
                    <input class="submit-button" type="submit" value="Update Review">
                    <input type="hidden" name="action" value="submit-update-review">
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