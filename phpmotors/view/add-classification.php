<?php $currentPage = "Add Classification"; ?>
<?php

if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
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
            <?php //include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php'; ?>
            <?php echo $navList; ?>
        </nav>
        <main>
        <section class="form-padding">
                <h1>Add Car Classification</h1>
                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
                <form action="/phpmotors/vehicles/" method="post">
                    <label for="classificationName">Classification Name</label>
                    <input type="text" name="classificationName" id="classificationName" placeholder="Enter Name Here" autofocus autocomplete="off" required>
                    <input type="submit" name="Submit" value="Add Classification">
                    <input type="hidden" name="action" value="addClassification">
                </form>
        </section>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
    </div>
    </body>
</html>