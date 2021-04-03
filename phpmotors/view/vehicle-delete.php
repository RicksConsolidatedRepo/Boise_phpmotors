<?php $currentPage = "Delete Vehicle"; ?>

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
            <h1><?php if(isset($invInfo['invMake'])){ 
	            echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</h1>
                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>

                <form action="/phpmotors/vehicles/" method="post">
                    <label for="invMake">Make</label>
                    <input type="text" name="invMake" id="invMake" readonly <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
                    <label for="invModel">Model</label>
                    <input type="text" name="invModel" id="invModel" readonly <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>
                    <label for="invDescription">Description</label>
                    <textarea type="text" name="invDescription" id="invDescription" readonly><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
                    <input type="submit" name="Submit" value="Delete Vehicle">
                    <input type="hidden" name="action" value="deleteVehicle">
                    <input type="hidden" name="invId" value='<?php if(isset($invInfo['invId'])){echo $invInfo['invId'];} ?>'>
                </form>
            </section>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
    </div>
    </body>
</html>