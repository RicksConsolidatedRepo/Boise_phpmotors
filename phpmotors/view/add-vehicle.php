<?php $currentPage = "Add Vehicle"; ?>
<?php

if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
   }

?><?php
//Build a dropdown menu
    $dropdown = '<select name="classificationId" id="classificationId">';
    $dropdown .= "<option value='' disabled hidden selected>Choose Car Classification</option>";
    foreach ($classifications as $classification) {
    $dropdown .= "<option value='".urlencode($classification['classificationId'])."'";
    if(isset($classificationId)){
        if($classification['classificationId'] === $classificationId){
                        $dropdown .= ' selected ';
        }

    }

    $dropdown .= ">$classification[classificationName]</option>";
    }
    $dropdown .= '</select>';

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
                <h1>Add Vehicle</h1>
                <div class="form-margin"><strong>*Note all fields are required</strong></div>
                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>

                <form action="/phpmotors/vehicles/" method="post">
                <?php
                    if (isset($dropdown)) {
                    echo $dropdown;
                    }
                ?>
                    <label for="invMake">Make</label>
                    <input type="text" name="invMake" id="invMake" placeholder="Enter Car Maker" autofocus autocomplete="off" <?php if(isset($invMake)){echo "value='$invMake'";} ?> required>
                    <label for="invModel">Model</label>
                    <input type="text" name="invModel" id="invModel" placeholder="Enter Car's Model" autocomplete="off" <?php if(isset($invModel)){echo "value='$invModel'";} ?> required>
                    <label for="invDescription">Description</label>
                    <textarea name="invDescription" id="invDescription" placeholder="Enter description" autocomplete="off" <?php if(isset($invDescription)){echo "$invDescription";} ?>required></textarea>
                    <label for="invImage">Image path</label>
                    <input type="text" name="invImage" id="invImage" placeholder="Enter image path" autocomplete="off" value="/phpmotors/images/no-image.png" required>
                    <label for="invThumbnail">Thumbnail path</label>
                    <input type="text" name="invThumbnail" id="invThumbnail" placeholder="Enter thumbnail path" autocomplete="off" value="/phpmotors/images/no-image.png" required>
                    <label for="invPrice">Price</label>
                    <input type="number" name="invPrice" id="invPrice" placeholder="Enter car's price" autocomplete="off"<?php if(isset($invPrice)){echo "value='$invPrice'";} ?> required>
                    <label for="invStock"># in stock</label>
                    <input type="number" name="invStock" id="invStock" placeholder="Enter inventory" autocomplete="off" <?php if(isset($invStock)){echo "value='$invStock'";} ?> required>
                    <label for="invColor">Color</label>
                    <input type="text" name="invColor" id="invColor" placeholder="Enter car's color" autocomplete="off" <?php if(isset($invColor)){echo "value='$invColor'";} ?> required>
                    <input type="submit" name="Submit" value="Add Vehicle">
                    <input type="hidden" name="action" value="addVehicle">
                </form>
            </section>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
    </div>
    </body>
</html>