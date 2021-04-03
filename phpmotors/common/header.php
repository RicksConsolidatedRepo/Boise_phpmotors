<div id="logo">
    <img src="/phpmotors/images/site/logo.png" alt="PHP Motors Logo" />
</div>

<div id="my-account">
<?php 
                if(isset($cookieFirstname)) {
                        echo "<span>Welcome $cookieFirstname!</span>";
                } else if (isset($_SESSION['clientData'])) {
                        echo "<a href='/phpmotors/accounts/'>Welcome " . $_SESSION['clientData']['clientFirstname'] . "!</a>";
                }
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
                        echo "<span><a href='/phpmotors/accounts/index.php?action=logout' title='Logout of your PHP Motors account.'>Logout</a></span>";
                } else {
                        echo "<span><a href='/phpmotors/accounts/index.php?action=login' title='Access your PHP Motors account.'>My Account</a></span>";
                }
        ?>
</div>