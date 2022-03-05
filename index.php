<html>

<link rel="icon" type="image/png" href="./images/favicon.svg"/>

<!-- Latest compiled and minified CSS -->
<!-- CSS only -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/style.css">
<script src="./js/library.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8" />

<body>
<title>
    Calculadoras
</title>
<div class="row">
            <?php
            include_once 'partials/header.php';
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