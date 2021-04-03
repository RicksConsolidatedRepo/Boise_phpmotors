<?php $currentPage = "Vehicle Details"; ?>

<!DOCTYPE html>
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
            <section class="thumbs">
              <h6 hidden>img</h6>
                <?php 
                    if (isset($_SESSION['message'])) {
                        $message = $_SESSION['message'];
                    }
                    if (isset($message)) {
                        echo $message;
                    }
                    unset($_SESSION['message']);
                    
                    if(isset($vehicleThumbs)){
                        echo $vehicleThumbs;
                    } 
                ?>
            </section>
            <section class="details">
            <h6 hidden>Details</h6>
            <?php 
                if (isset($_SESSION['message'])) {
                    $message = $_SESSION['message'];
                }
                if (isset($message)) {
                    echo $message;
                }
                unset($_SESSION['message']);
                
                if(isset($vehicleDetails)){
                    echo $vehicleDetails;
                } 
                ?>
            </section>
            <section class="reviews-container">
                <h2>Customer Reviews</h2>
                <?php
                    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                        $screenName = screenName($_SESSION['clientData']['clientFirstname'], $_SESSION['clientData']['clientLastname']);
                ?>
                <h3>Review the <?php echo $vehicleInfo['invMake'] . " " . $vehicleInfo['invModel'] ?></h3>
                <?php 
                    if (isset($_SESSION['reviewMessage'])) {
                        echo $_SESSION['reviewMessage'];
                    }
                    unset($_SESSION['reviewMessage']);
                ?>
                <form action="/phpmotors/reviews/index.php" method="post">
                    <div>
                        <label for="screenName">Screen Name</label>
                        <input type="text" <?php echo "value='$screenName'"  ?> id="screenName" name="screenName" readonly>
                    </div>
                    <div>
                        <label for="reviewText">Review Text</label>
                        <textarea rows=5 id="reviewText" name="reviewText" required></textarea>
                    </div>
                    <div>
                        <input type="submit" name="submit" id="revbtn" value="Submit Review">
                    </div>
                    <!-- Add the name - value pairs -->
                    <input type="hidden" name="action" value="add-review">
                    <input type="hidden" name="invId" value="<?php echo $invId ?>">
                    <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId'] ?>">
                </form>
                <?php
                    } else {
                        echo "<p>You must <a href='/phpmotors/accounts/?action=login'>login</a> to write a review.</p>";
                    }
                    $invReviews = getReviewsByInvId($invId);
                    if($invReviews) {
                        $reviews = buildInventoryReviewsList($invReviews);
                        echo $reviews;
                    } else {
                        echo "<h3 class='review-prompt'>Be the first to write a review.</h3>";
                    }
                ?>
            </section>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
</div>
    </body>
</html>