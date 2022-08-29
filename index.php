<!DOCTYPE html>
<html lang="en">
<!-- Latest compiled and minified CSS -->
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<link rel="stylesheet" href="css/style.css">
<script src="./partials/library.js"></script>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="./images/favicon.svg" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8" />
    <meta name="description" content="This page has a toolset for Quality Control for use for packaging, such as Net content and text compare.">
    <title>
        Calculadoras de Produção
    </title>
</head>

<html>

<header>

    <div class="row" id="header">
        <?php
        include_once 'partials/header.php';
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        ?>
    </div>

</header>

<body>
    <main id="main" class="container-md p-3">
        <div class="row">
            <?php include_once 'partials/plano_escala.php'; ?>
            <?php include_once 'partials/distorcao.php';?>
            <?php include_once 'partials/netcontent.php';?>
        </div>
        <div class="row">
            <?php include_once 'partials/pt2mm.php';?>
            <?php include_once 'partials/px2mm.php';?>
            <?php include_once 'partials/ttransgenico.php';?>
        </div>
        <div class="row">
            
            <?php include_once 'partials/faroleq.php';?>
            <?php include_once 'partials/faroloctagono.php';?>
            <?php include_once 'partials/altoem.php';?>
        </div>

    </main>
</body>

<footer>

    <?php include_once 'partials/footer.php'; ?>
</footer>

</html>