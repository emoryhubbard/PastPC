<?php
if (isset($_SESSION['message']))
    $message = $_SESSION['message'];
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Image Management</title>
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
            <h1>Image Management</h1>
            <p>Welcome to the image management page. Please choose one of the options below.</p>
            <h2>Add New Device Image</h2>
            <?php
            if (isset($message))
                echo $message;
            ?>
            <form class='blue-form' action="/pastpc/uploads/" method="post" enctype="multipart/form-data">
                <label for="deviceItem">Device</label>
                <?php echo $prodSelect; ?>
                <fieldset>
                    <label>Is this the main image for the device?</label>
                    <label for="priYes" class="pImage">Yes</label>
                    <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                    <label for="priNo" class="pImage">No</label>
                    <input type="radio" name="imgPrimary" id="priNo" class="pIMage" checked value="0">
                </fieldset>
                <label>Upload Image:</label>
                <input type="file" name="file1">
                <input type="submit" class="regbtn" value="Upload">
                <input type="hidden" name="action" value="upload">
            </form>
            <hr>
            <h2>Exisiting Images</h2>
            <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay))
                echo $imageDisplay;
            ?>
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/pastpc/snippets/footer.php"?>
        </footer>
    </div>
</body>
</html>
<?php unset($_SESSION['message']); ?>


