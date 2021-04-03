<?php
/*
*Vehicles Model
*/
// Check if class already exist
function checkClassification($classificationName){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'SELECT * FROM carclassification WHERE classificationName = (:classificationName);';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $exist = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $exist;
}

// Insert a new classification
function addClassification($classificationName){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO carclassification (classificationName) VALUES (:classificationName)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Insert a new car
function addCar($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId) 
    VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);

    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;   
}

// Get vehicles by classificationId 
function getInventoryByClassification($classificationId){ 
    $db = phpmotorsConnect(); 
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
   }
// Get vehicle information by invId
function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
   }
// Update a vehicle
function updateVehicle($invMake, $invModel, $invDescription, $invImage,  $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId) {
    $db = phpmotorsConnect();
    $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
  }

function deleteVehicle($invId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function getVehiclesByClassification($classificationName, $isPrimary = 0){
    $db = phpmotorsConnect();
    $stmt = $db->prepare('
    SELECT i.invId, i.invMake, i.invModel, i.invDescription, i.invPrice, i.invStock, i.invColor, i.classificationId, ii.imgPath
    FROM inventory i
    JOIN images ii ON ii.invId = i.invId
    WHERE i.classificationId 
    IN (
      SELECT classificationId 
      FROM carclassification 
      WHERE classificationName = :classificationName
    ) 
    AND ii.imgPath LIKE "%-tn%"
    AND ii.imgPrimary = :isPrimary;
    ');
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->bindValue(':isPrimary', $isPrimary, PDO::PARAM_INT);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
   }

  function getVehicleById($invId)  
  {
    $db = phpmotorsConnect();

    $stmt = $db->prepare('SELECT * FROM inventory WHERE invId = :invId');

    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();

    $vehicleInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $vehicleInfo;
  }

  function getVehicleDetailsById($invId)  
  {
    $db = phpmotorsConnect();

    $stmt = $db->prepare('SELECT i.invId, i.invMake, i.invModel, i.invDescription, i.invPrice, i.invStock, i.invColor, ii.imgPath 
    FROM inventory i
    JOIN images ii ON ii.invId = i.invId 
    WHERE i.invId = :invId
    AND ii.imgPath NOT LIKE "%-tn%"');

    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();

    $vehicleInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $vehicleInfo;
  }

  function getVehicles()
  {
    $db = phpmotorsConnect();

    $stmt = $db->prepare('SELECT invId, invMake, invModel FROM inventory');
    $stmt->execute();

    $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $invInfo;
  }

  function getVehicleThumbnails($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT imgPath 
            FROM images 
            WHERE invId = :invId 
            AND imgPath LIKE "%-tn%"
            ORDER BY imgPrimary DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $thumbnails = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $thumbnails;
}

function getVehicleInfo($invId){
  $db = phpmotorsConnect();
  $sql = 'SELECT i.invId, i.invMake, i.invModel, i.invDescription, im.imgPath, i.invPrice, i.invStock, i.invColor, i.classificationId
          FROM inventory i 
          INNER JOIN images im
              ON i.invId = im.invId 
          WHERE i.invId = :invId
          AND im.imgPath NOT LIKE "%-tn%"
          AND im.imgPrimary = 1';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $invInfo;
}
?>