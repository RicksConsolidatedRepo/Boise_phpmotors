<?php
// Vehicles controller
// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/vehicles-model.php';
// Get the uploads model
require_once '../model/uploads-model.php';
// Get the reviews model
require_once '../model/reviews-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);

// var_dump($classifications);
// 	exit;
// Build a navigation bar using the $classifications array
// $navList = '<ul>';
// $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
// foreach ($classifications as $classification) {
//  $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
// }
// $navList .= '</ul>';


//Build a dropdown menu
// $dropdown = '<select name="classificationId" id="classificationId">';
// $dropdown .= "<option value='' disabled hidden selected>Choose Car Classification</option>";
// foreach ($classifications as $classification) {
// $dropdown .= "<option value='".urlencode($classification['classificationId'])."'>$classification[classificationName]</option>";
// }
// $dropdown .= '</select>';
// echo $navList;
// exit;
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

// Switch case to control vehicle management
switch ($action){
  case 'addclassification':
    include '../view/add-classification.php';
  break;

  case 'addvehicle':
    include '../view/add-vehicle.php';
  break;

  case 'addClassification':
    // Filter and store the data
    $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING);


    // Check for missing data
    if(empty($classificationName)){
      $message = '<p id="warning">Please enter a classification name.</p>';
      include '../view/add-classification.php';
      exit; 
    }
    // Send the data to the model
    $checkClass = checkClassification($classificationName);

    // Check and report the result
    if($checkClass == 1){
      $message = "<p id=\"warning\">Sorry! '$classificationName' classification already exists. Please enter another classification name.</p>";
      include '../view/add-classification.php';
      exit;
    }else{
      $addClass = addClassification($classificationName);
      $checkClass = 0;
      if($addClass == 1){
        header ('Location: /phpmotors/vehicles/');
        exit;
      }else{
        $message = "<p id=\"warning\">Sorry the registration failed. Please try again.</p>";
        include '../view/add-classification.php';
        exit;
      }

    }
  break;

  case 'addVehicle':

      // Filter and store the data
      // $classificationId = 3;
      $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
      $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
      $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
      $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
      $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
      $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
      $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
      $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);

      // Check for missing data
      if(empty($invMake) || empty($invModel) || empty($invDescription)  || empty($invImage) || empty($invThumbnail) || empty($invStock) || empty($invPrice) || empty($invColor) || empty($classificationId)){
        $message = '<p id="warning">Please provide information for all empty form fields.</p>';
        include '../view/add-vehicle.php';
        exit; 
      }
      // Send the data to the model
      $addCar = addCar($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

      // Check and report the result
      if($addCar === 1){
        $message = "<p id='success'>The $invMake $invModel was added successfully!</p>";
        // header ('Location: /phpmotors/vehicles/?action=addvehicle');
        include '../view/add-vehicle.php';
        exit;
      } else {
        $message = '<p id="warning">Sorry the insertion is failed. Please try again.</p>';
        include '../view/add-vehicle.php';
        exit;
      }  
  break;

/* * ********************************** 
* Get vehicles by classificationId 
* Used for starting Update & Delete process 
* ********************************** */ 
  case 'getInventoryItems': 
    // Get the classificationId 
    $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
    // Fetch the vehicles by classificationId from the DB 
    $inventoryArray = getInventoryByClassification($classificationId); 
    // Convert the array to a JSON object and send it back 
    echo json_encode($inventoryArray); 
    break;
  case 'mod':
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    if(count($invInfo)<1){
     $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-update.php';
    exit;
  break;

  case 'updateVehicle':
    $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
    $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

    if (empty($classificationId) || empty($invMake) || empty($invModel) 
      || empty($invDescription) || empty($invImage) || empty($invThumbnail)
      || empty($invPrice) || empty($invStock) || empty($invColor)) {
    $message = '<p>Please complete all information for the item! Double check the classification of the item.</p>';
    include '../view/vehicle-update.php';
  exit;
  }

  $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage,  $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
  if ($updateResult) {
    $message = "<p id='success'>Congratulations, the $invMake $invModel was successfully updated.</p>";
    $_SESSION['message'] = $message;
    header('location: /phpmotors/vehicles/');
    exit;
  } else {
    $message = "<p id='warning'>Error. the $invMake $invModel was not updated.</p>";
    include '../view/vehicle-update.php';
    exit;
    }
  break;

  case 'del':
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    if (count($invInfo) < 1) {
        $message = 'Sorry, no vehicle information could be found.';
      }
      include '../view/vehicle-delete.php';
      exit;
  break;

  case 'deleteVehicle':
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

    $deleteResult = deleteVehicle($invId);
    if ($deleteResult) {
      $message = "<p id='warning'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
    } else {
      $message = "<p class='notice'>Error: $invMake $invModel was not
    deleted.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
    }
  break;

  case 'showVehicle':
    $invId = filter_input(INPUT_GET, 'Id', FILTER_SANITIZE_NUMBER_INT);

    $vehicleInfo = getVehicleDetailsById($invId);
    $vehicleThumbs = getThumbnailsById($invId);
    $vehicleThumbs = showThumbnails($vehicleThumbs);
    $vehicleDetails = showVehicleDetails($vehicleInfo);

    include '../view/vehicle-detail.php';
    break;

  case 'classification':
    $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
    $vehicles = getVehiclesByClassification($classificationName, 1);
    if(!count($vehicles)){
     $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
    } else {
     $vehicleDisplay = buildVehiclesDisplay($vehicles);
    }
    include '../view/classification.php';
    // echo $vehicleDisplay;
    // exit;
  break; 

  default:
    $classificationList = buildClassificationList($classifications);
    include '../view/vehicle-management.php';
  break;
 }
?>