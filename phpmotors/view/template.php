<?php $currentPage = "Template"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Motors<?php echo ($currentPage ? " - " . strtoupper($currentPage) : "") ?></title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:wght@500&display=swap" rel="stylesheet">

    <link rel="stylesheet" media="screen" href="/phpmotors/css/template.css">
    
</head>

<body>
    <div class="container">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
        </header>
        
        <?php //include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php'; ?>
        <?php echo $navList; ?>
        <div class="content">
            <h1>PHP Motors Template</h1>
            <main>

            </main>
        </div>

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </div>
</body>

</html>