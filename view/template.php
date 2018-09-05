<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= $title ?></title>

        <!-- BOOTSTRAP -->
        <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <?= $other ?>

        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Monoton|Permanent+Marker" rel="stylesheet"> 
        <!-- <link href="https://fonts.googleapis.com/css?family=Lobster|Shadows+Into+Light" rel="stylesheet">  -->
    </head>

    <body>
        <!-- <div id="main-wrap" class="container"> -->
            <?= $header ?>

            <section>
                <?= $section ?>
            </section>

            <?= $footer ?>
        <!-- </div> -->
    </body>

</html>