<?php $currentPage = "Admin"; ?>

<?php
if(!$_SESSION['loggedin']){
    header('Location: /phpmotors/');
  } 

  if(isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
  }

  $clientFirstname = $_SESSION['clientData']['clientFirstname'];
  $clientLastname = $_SESSION['clientData']['clientLastname'];
  $clientEmail = $_SESSION['clientData']['clientEmail'];
  $clientLevel = $_SESSION['clientData']['clientLevel'];

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
                <h1><?php echo "$clientFirstname $clientLastname";?></h1>
                <?php if (isset($message)) {echo $message;} ?>
                <p>You are logged in.</p>
                <ul>
                    <li>First Name: <?php echo $clientFirstname; ?></li>
                    <li>Last Name: <?php echo $clientLastname; ?></li>
                    <li>Email: <?php echo $clientEmail; ?></li>
                </ul>
                <?php
                    if($_SESSION['loggedin']){
                        echo '<h2>Account Management</h2>';
                        echo '<p>Use this link to update account information</p>';
                        echo '<p><a href="/phpmotors/accounts/?action=updateaccount" title="Update your account information">Update Account Information</a></p>';
                    }
                    if($clientLevel > 1){
                        echo '<h2>Inventory Management</h2>';
                        echo '<p>Use this link to manage the inventory</p>';
                        echo '<p><a href="/phpmotors/vehicles/" title="Link to Vehicle Management">Vehicle Management</a></p>';
                    }
                ?>
                <?php
                    if (isset($_SESSION['message-rev'])) { ?>
                    <p class ="msg"> <?php  echo $_SESSION['message-rev']; ?> </p>
                <?php } ?>
                <?php 
                $clientReviews = getReviewsByClientId($_SESSION['clientData']['clientId']);
                if($clientReviews) {
                    echo "<h2>Manage Your Product Reviews</h2>";
                    $reviews = buildClientReviewsList($clientReviews);
                    echo $reviews;
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