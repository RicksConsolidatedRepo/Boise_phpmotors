<?php
/*
   Uploads Model
*/

// Add image information to the database table
function storeImages($imgPath, $invId, $imgName, $imgPrimary) {
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO images (invId, imgPath, imgName, imgPrimary) VALUES (:invId, :imgPath, :imgName, :imgPrimary)';
    $stmt = $db->prepare($sql);
    // Store the full size image information
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
    $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
    $stmt->bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
    $stmt->execute();
        
    // Make and store the thumbnail image information
    // Change name in path
    $imgPath = makeThumbnailName($imgPath);
    // Change name in file name
    $imgName = makeThumbnailName($imgName);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
    $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
    $stmt->bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
    $stmt->execute();
    
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
   }

   // Get Image Information from images table
   function getImages()
   {
     $db = phpmotorsConnect();
   
     $stmt = $db->prepare('SELECT i.imgId, i.imgPath, i.imgName, i.imgDate, ii.invId, ii.invMake, ii.invModel FROM images i JOIN inventory ii ON i.invId = ii.invId');
     $stmt->execute();
   
     $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
     $stmt->closeCursor();
   
     return $imageArray;
   }

// Delete image information from the images table
function deleteImage($imgId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM images WHERE imgId = :imgId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':imgId', $imgId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->rowCount();
    $stmt->closeCursor();
    return $result;
   }

// Check for an existing image
function checkExistingImage($imgName){
    $db = phpmotorsConnect();
    $sql = "SELECT imgName FROM images WHERE imgName = :name";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $imgName, PDO::PARAM_STR);
    $stmt->execute();
    $imageMatch = $stmt->fetch();
    $stmt->closeCursor();
    return $imageMatch;
   }

   // Get thumbnail Image Information from images table
   function getThumbnailsById($invId)
   {
     $db = phpmotorsConnect();
   
     $stmt = $db->prepare('SELECT i.imgId, i.imgPath, i.imgName, i.imgDate, ii.invId, ii.invMake, ii.invModel 
     FROM images i 
     JOIN inventory ii ON i.invId = ii.invId
     WHERE i.imgPath LIKE "%-tn%"
     AND ii.invId = :invId');
     $stmt->bindValue('invId', $invId, PDO::PARAM_INT);
     $stmt->execute();
   
     $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
     $stmt->closeCursor();
   
     return $imageArray;
   }
?>