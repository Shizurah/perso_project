<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= $title ?></title>

        <!-- CSS/BOOTSTRAP -->
        <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <?= $other ?>
        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Monoton|Permanent+Marker" rel="stylesheet"> 
        <!-- JQUERY -->
        <script src="assets/js/jquery-3.3.1.js"></script>
    </head>

    <body>
        <!-- <div id="main-wrap" class="container"> -->
            <?= $header ?>

            <section>
                <?= $section ?>
            </section>

            <?= $footer ?>

            <?= $scripts ?>
        <!-- </div> -->
    </body>

</html>