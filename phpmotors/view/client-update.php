<?php $currentPage = "Update Account"; ?>

<?php

if(!$_SESSION['loggedin']){
    header('Location: /phpmotors/');
  } 

  $clientId = $_SESSION['clientData']['clientId'];
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
            <section>
                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
                <form action="/phpmotors/accounts/" method="post">
                    <h1>Update Account Info</h1>
                    <label for="clientFirstname">First Name</label>
                    <input type="text" name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required>
                    <label for="clientLastname">Last Name</label>
                    <input type="text" name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> required>
                    <label for="clientEmail">Email</label>
                    <input type="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
                    <input type="submit" name="submit" id="updateInfo" value="Update Info">
                    <input type="hidden" name="action" value="updateAccount">
                    <input type="hidden" name="clientId" value='<?php if(isset($clientId)){echo $clientId;} ?>'>
                </form>  
                <form action="/phpmotors/accounts/" method="post">
                    <h1>Update Password</h1>
                    <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</p> 
                    <p><em>*note your original password will be changed</em></p>
                    <label for="clientPassword">Password</label>
                    <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    <input type="submit" name="submit" id="updatePassword" value="Update Password">
                    <input type="hidden" name="action" value="updatePassword">
                    <input type="hidden" name="clientId" value='<?php if(isset($clientId)){echo $clientId;} ?>'>
                </form>  
            </section>        
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
    </div>
    </body>
</html>