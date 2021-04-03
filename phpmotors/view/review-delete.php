<?php $currentPage = "Delete Review"; ?>

<?php
if(!$_SESSION['loggedin']){
    header('Location: /phpmotors/');
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
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
        </header>
        <nav>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php'; ?>
        </nav>
        <main>
            <h1>Delete <?php echo $review['invMake'] . ' ' . $review['invModel'] ?> Review?</h1>
            <p class="form">Reviewed on <?php echo $review['reviewDate']; ?></p>
            <?php 
                if (isset($_SESSION['reviewMessage'])) {
                    echo $_SESSION['reviewMessage'];
                }
                unset($_SESSION['reviewMessage']);
            ?>
            <p id="warning">Delete cannot be undone. Are you sure you want to delete this review?</p>
            <form action="/phpmotors/reviews/index.php" method="post">
                    <div>
                        <label for="reviewText">Review Text</label>
                        <p id="reviewText" name="reviewText" readonly><?php echo $review['reviewText'] ?></p>
                    </div>
                    <div>
                        <input type="submit" name="submit" id="delete" value="Confirm Deletion">
                    </div>
                    <!-- Add the name - value pairs -->
                    <input type="hidden" name="action" value="review-deleted">
                    <input type="hidden" name="reviewId" value="<?php echo $reviewId ?>">
                </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
    </div>
</body>

</html>