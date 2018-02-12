<!DOCTYPE html>
<html lang="en">
<head>
    <base href="http://localhost:8080/world_fit/blog">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>World Fit Company</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/slick.css"/>
    <link rel="stylesheet" href="https://npmcdn.com/js-offcanvas@1.0/dist/_css/minified/js-offcanvas.css">
    <link rel="stylesheet" href="./css/animate.css">
    <link rel="stylesheet" href="./css/lightbox.min.css" >
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <header class="header container-fluid">
        <div class="navbar navbar-expand-md navbar-dark">
            <h1 class="brand">World<span>Fit</span></h1>
            <a id="mobile-toggler" href="#" class="navbar-toggler">
                <i class="fightclub-icon-menu-1"></i>
            </a>
            <nav class="navigation collapse navbar-collapse ml-auto w-100 justify-content-end" id="navbarTogglerDemo02">
                <?php include("navigation.php") ?>
            </nav>
            <nav id="mobile-nav" class="" style="display:none;">
                <?php include("navigation.php") ?>
            </nav>
        </div>
    </header>