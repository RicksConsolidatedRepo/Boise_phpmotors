<?php $currentPage = "Image Management"; ?>

<?php 
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boise PHP Motors <?php echo ($currentPage ? " - " . strtoupper($currentPage) : "") ?></title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&display=swap" rel="stylesheet"> 

    <link rel="stylesheet" media="screen" href="/phpmotors/css/template.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/home.css">

    <link rel="icon" href="/phpmotors/images/icon.png" type="image/gif" sizes="24x24">
</head>

<body>
    <div class="container">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
        </header>
        <nav>
            <?php // include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php'; ?>
            <?php echo $navList; ?>
        </nav>
        <main>
            <section class="form-padding">
                <h1>Image Management</h1>
                <p>Choose one of the options below:</p>
                <h2>Add New Vehicle Image</h2>
                <?php
                if (isset($message)) {
                    echo $message;
                } ?>
                <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
                <label for="invItem">Vehicle</label>
                    <?php echo $prodSelect; ?>
                <label>Upload Image:</label>
                <input type="file" name="file1">
                <fieldset>
                    <label>Is this the main image for the vehicle?</label>
                    <div class="flex">
                        <label for="priYes" class="pImage">Yes</label>
                        <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                        <label for="priNo" class="pImage">No</label>
                        <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                    </div>
                </fieldset><br>
                <input type="submit" class="regbtn" value="Upload">
                <input type="hidden" name="action" value="upload">
                </form>
                <hr>
                <h2>Existing Images</h2>
                <h3 id="warning">If deleting an image, delete the thumbnail too and vice versa.</h3>
                <?php
                if (isset($imageDisplay)) {
                    echo $imageDisplay;
                } ?>
            </section>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
    </div>
    </body>
</html><?php unset($_SESSION['message']); ?>