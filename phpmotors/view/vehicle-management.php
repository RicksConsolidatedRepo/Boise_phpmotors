<?php $currentPage = "Manage Vehicle"; ?>

<?php

if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
   }

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
                <h1>Vehicle Management</h1>
                <ul>
                    <li><a class="block" href="/phpmotors/vehicles/?action=addclassification">Add Classification</a></li>
                    <li><a class="block" href="/phpmotors/vehicles/?action=addvehicle">Add Vehicle</a></li>
                </ul>             
            </section>
            <?php
                if (isset($message)) { 
                    echo $message; 
                } 
                if (isset($classificationList)) { 
                    echo '<h2 class="form-padding">Vehicles By Classification</h2>'; 
                    echo '<p class="form-padding">Choose a classification to see those vehicles</p>'; 
                    echo $classificationList; 
                }
            ?>
            <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>
            <table id="inventoryDisplay"></table>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
        <script src="../js/inventory.js"></script>
    </div>
    </body>
</html><?php unset($_SESSION['message']); ?>