<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Motors</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:wght@500&display=swap" rel="stylesheet">

    <link rel="stylesheet" media="screen" href="/phpmotors/css/template.css">
    
</head>

<body>
    <div class="container">
        <header>
        <div id="logo">
            <img src="/phpmotors/images/site/logo.png" alt="PHP Motors Logo" />
        </div>
        <div id="my-account">
            <a href="#">My Account</a>
        </div>  
        </header>
       
        <div class="error-content">
            <main>
            <h1>Server Error</h1>
            <p>Sorry, our server seems to be experiencing some technical dificulties. Please check back later.</p>
            </main>
        </div>

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </div>
</body>

</html>