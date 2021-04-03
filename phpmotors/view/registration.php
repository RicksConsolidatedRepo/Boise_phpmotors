<?php $currentPage = "Register"; ?>

<!DOCTYPE html>
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
            <section>
                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
                <form action="/phpmotors/accounts/index.php" method="post">
                        <h1>Register</h1>
                        <div>
                            <label for="clientFirstname">First Name</label>
                            <input type="text" name="clientFirstname" id="clientFirstname" placeholder="Your First Name" autofocus autocomplete="off" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required> 
                        </div>
                        <div>
                            <label for="clientLastname">Last Name</label>
                            <input type="text" name="clientLastname" id="clientLastname" placeholder="Your Last Name" autocomplete="off" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> required>
                        </div>
                        <div>
                            <label for="clientEmail">Email</label>
                            <input type="email" name="clientEmail" id="clientEmail" placeholder="Your Email" autocomplete="off" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
                        </div>
                        <div>
                            <label for="clientPassword">Password</label>
                            <input type="password" name="clientPassword" id="clientPassword" placeholder="Your Password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" autocomplete="off" required>
                            <span>*Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> 
                        </div>
                        <div>
                            <input type="submit" name="submit" id="regbtn" value="Register">
                            <input type="hidden" name="action" value="register">
                        </div>
                </form>   
            </section>        
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
    </div>
    </body>
</html>