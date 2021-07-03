<html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/style.css">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script src="./js/library.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8" />

<body>
    <div id="main" class="container-md">
        <div class="row">
            <?php
            include_once 'partials/header.php';
            ?>
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
            include_once 'partials/altoem.php';
            ?>
        </div>

    </div>
    <?php include_once 'partials/footer.php'; ?>
</body>

</html>