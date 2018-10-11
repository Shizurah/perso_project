<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= $title ?></title>

        <!-- CSS/BOOTSTRAP -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/bootstrap-select-1.13.2/dist/css/bootstrap-select.css">
        <link href="assets/css/style.css" rel="stylesheet">
        
        <?= $other ?>

        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Monoton|Permanent+Marker|Anton" rel="stylesheet"> 
    </head>

    <body>
        <?= $header ?>

        <section>          
            <?= $section ?>
        </section>

        <?= $footer ?>
        
        <!-- SCRIPTS-->
        <!-- jquery : -->
        <script src="assets/js/jquery-3.3.1.js"></script>
        <!-- fichiers nécessaires au plugin 'BOOTSTRAP SELECT' : -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="assets/bootstrap/js/bootstrap.js"></script>
        <script src="assets/bootstrap-select-1.13.2/dist/js/bootstrap-select.min.js"></script>
        <script src="assets/bootstrap-select-1.13.2/dist/js/i18n/defaults-fr_FR.min.js"></script>
        
        <!-- autres scripts -->
        <?= $scripts ?>
    </body>

</html>