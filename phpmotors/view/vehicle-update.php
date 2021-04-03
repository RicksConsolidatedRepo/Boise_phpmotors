<?php $currentPage = "Update Vehicle"; ?>

<?php

if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
   }

?><?php
// Build the classifications option list
$dropdown = '<select name="classificationId" id="classificationId">';
$dropdown .= "<option>Choose a Car Classification</option>";
foreach ($classifications as $classification) {
 $dropdown .= "<option value='$classification[classificationId]'";
 if(isset($classificationId)){
  if($classification['classificationId'] === $classificationId){
    $dropdown .= ' selected ';
  }
 } elseif(isset($invInfo['classificationId'])){
 if($classification['classificationId'] === $invInfo['classificationId']){
  $dropdown .= ' selected ';
 }
}
$dropdown .= ">$classification[classificationName]</option>";
}
$dropdown .= '</select>';

?><!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	        echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	        elseif(isset($invMake) && isset($invModel)){ 
            echo "Modify $invMake $invModel"; }?> | Boise PHP Motors<?php echo ($currentPage ? " - " . strtoupper($currentPage) : "") ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	            echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
                elseif(isset($invMake) && isset($invModel)) { 
                echo "Modify$invMake $invModel"; }?></h1>
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
                    <input type="text" name="invMake" id="invMake" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
                    <label for="invModel">Model</label>
                    <input type="text" name="invModel" id="invModel" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>
                    <label for="invDescription">Description</label>
                    <textarea type="text" name="invDescription" id="invDescription" required><?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
                    <label for="invImage">Image path</label>
                    <input type="text" name="invImage" id="invImage" required <?php if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?>>
                    <label for="invThumbnail">Thumbnail path</label>
                    <input type="text" name="invThumbnail" id="invThumbnail" required <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?>>
                    <label for="invPrice">Price</label>
                    <input type="number" step="0.01" name="invPrice" id="invPrice" required <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>>
                    <label for="invStock"># in stock</label>
                    <input type="number" name="invStock" id="invStock" required <?php if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?>>
                    <label for="invColor">Color</label>
                    <input type="text" name="invColor" id="invColor" required <?php if(isset($invColor)){ echo "value='$invColor'"; } elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>>
                    <input type="submit" name="Submit" value="Update Vehicle">
                    <input type="hidden" name="action" value="updateVehicle">
                    <input type="hidden" name="invId" value='<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];}elseif(isset($invId)){ echo $invId; } ?>'>
                </form>
            </section>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
    </div>
    </body>
</html>