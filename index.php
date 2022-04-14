<html>

<link rel="icon" type="image/png" href="./images/favicon.svg" />

<!-- Latest compiled and minified CSS -->
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<link rel="stylesheet" href="css/style.css">
<script src="./partials/library.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8" />
<meta name="description" content="This page has a toolset for Quality Control for use for packaging, such as Net content and text compare.">
<body>
    <title>
        Calculadoras de Produção
    </title>
    <div class="row">
        <?php
        include_once 'partials/header.php';
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        ?>
    </div>
    <div id="main" class="container-md pb-3 pt-3">
        <div class="titulo p-3">

            <head>
                <link rel="icon" type="image/png" href="./images/favicon.png" />
                Calculadoras de produção
            </head>
        </div>

        <div class="row">
            <?php
            include_once 'partials/plano_escala.php';
            include_once 'partials/distorcao.php';
            include_once 'partials/netcontent.php';
            ?>
        </div>
        <div class="row">
            <?php
            include_once 'partials/pt2mm.php';
            include_once 'partials/px2mm.php';
            include_once 'partials/ttransgenico.php';
            ?>
        </div>
        <div class="row">
            <?php
            include_once 'partials/faroleq.php';
            include_once 'partials/faroloctagono.php';
            include_once 'partials/altoem.php';
            ?>
        </div>

    </div>
    <?php include_once 'partials/footer.php'; ?>
</body>

</html>