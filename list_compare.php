<!DOCTYPE html>
<html lang="en">
<!-- Latest compiled and minified CSS -->
<!-- CSS only -->
<script src="
https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="
sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="
https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="
sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<link rel="stylesheet" href="css/style.css">
<script src="./partials/library.js"></script>

<?php
require('partials/functions.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sessionDoc  = isset($_POST['textDoc']) ? $_POST['textDoc'] : '';
    $sessionArte = isset($_POST['textArte']) ? $_POST['textArte'] : '';
    $sessionRef  = isset($_POST['textRef']) ? $_POST['textRef'] : '';
    $textDoc     =
        $textArte =
        $textRef = '';
} else {
    $sessionDoc =
        $sessionArte =
        $sessionRef = '';
} ?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="./images/favicon.svg" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8" />
    <meta name="description"
        content="This page has a toolset for Quality Control for use for packaging, such as Net content and text compare.">
    <title>QC Compare Lista de Arquivos-CT Docs</title>
</head>

<html lang="pt-BR">
<title>Compare de CT-List</title>

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

        <form action="list_compare.php" method="post">
            <div class="titulo p-2 m-2">
                <h2> Compara lista de Arquivos do CT-Files</h2>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    <label for="textDoc" class="input-group-text textwrapper text-center p-2 m-auto">
                        Arquivos no MySGS:
                    </label>
                    <div class="textwrapper">
                        <textarea
                        rows="15"
                        cols="50"
                        name="textDoc"
                        id="textDoc"
                        style="width:100%">
                      <?php echo $sessionDoc; ?></textarea>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <label for="textArte" class="input-group-text textwrapper text-center p-2 m-auto">
                        Arquivos da pasta finais:
                    </label>
                    <div class="textwrapper">
                        <textarea rows="15" cols="50" name="textArte" id="textArte"
                            style="width:100%"><?php echo $sessionArte; ?></textarea>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <label for="textRef" class="input-group-text textwrapper text-center p-2 m-auto">
                        Arquivos de REFERÊNCIA:
                    </label>
                    <div class="textwrapper">
                        <textarea rows="15" cols="50" name="textRef" id="textRef"
                            style="width:100%"><?php echo $sessionRef; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <input type="submit" value="Comparar" class="btn btn-success p-4" />
            </div>

            <?php

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $textDoc     = $_POST['textDoc'];
                $textArte    = $_POST['textArte'];
                $textRef     = $_POST['textRef'];
                $extensoes   = array('psd', 'tif', 'jpg', 'png', 'ai');
                $textCompara =
                    $textRefCompara = array();

                foreach ($extensoes as $ext) {
                    $textDoc  = str_replace("." . $ext, "", $textDoc);
                    $textArte = str_replace("." . $ext, "", $textArte);
                    $textRef  = str_replace("." . $ext, "", $textRef);
                }
                define('DOIS_ESPACOS', "/ {2}/");
                define('ESPACOS_E_QUEBRAS', "'/\r+/', '/\n+/', '/\t+/', '/\,+/'");
                $textDoc  = preg_replace(DOIS_ESPACOS, " ", $textDoc);
                $textArte = preg_replace(DOIS_ESPACOS, " ", $textArte);
                $textRef  = preg_replace(DOIS_ESPACOS, " ", $textRef);
                $textDoc  = preg_replace(array(ESPACOS_E_QUEBRAS), ",", $textDoc);
                $textArte = preg_replace(array(ESPACOS_E_QUEBRAS), ',', $textArte);
                $textRef  = preg_replace(array(ESPACOS_E_QUEBRAS), ',', $textRef);

                $textDocLinhas  = explode(',', $textDoc, 9999);
                $textArteLinhas = explode(',', $textArte, 9999);
                $textRefLinhas  = explode(',', $textRef, 9999);

                $totalArq = count($textDocLinhas);

                $textDocLinhas  = array_map('trim', $textDocLinhas);
                $textArteLinhas = array_map('trim', $textArteLinhas);
                $textRefLinhas  = array_map('trim', $textRefLinhas);

                $textDocLinhas  = array_filter(array_unique($textDocLinhas));
                $textArteLinhas = array_filter(array_unique($textArteLinhas));
                $textRefLinhas  = array_filter(array_unique($textRefLinhas));

                // Compara Mysgs com Finais
                foreach ($textDocLinhas as $docLinha) {
                    foreach ($textArteLinhas as $arteLinha) {
                        if (doublePreg(strtoupper($docLinha)) == doublePreg(strtoupper($arteLinha))) {
                            array_push($textCompara, $arteLinha);
                            array_splice($textDocLinhas, array_search($docLinha, $textDocLinhas, true), 1);
                            array_splice($textArteLinhas, array_search($arteLinha, $textArteLinhas, true), 1);
                        }
                    }
                }

                //compara Sobra do Mysgs com Refs
                $textDocLinhas = array_filter(array_unique($textDocLinhas));
                foreach ($textDocLinhas as $docLinha) {
                    foreach ($textRefLinhas as $refLinha) {
                        if (doublePreg(strtoupper($docLinha)) == doublePreg(strtoupper($refLinha))) {
                            array_push($textRefCompara, $docLinha);
                            array_splice($textDocLinhas, array_search($docLinha, $textDocLinhas, true), 1);
                            array_splice($textRefLinhas, array_search($refLinha, $textRefLinhas, true), 1);
                        }
                    }
                }
            }

            ?>
            <div class="row text-center">
                <?php if (isset($textCompara)) {
                    echo '<h5>'
                        . count($textCompara)
                        . '/'
                        . $totalArq
                        . ' arquivos Mysgs correspondem com FINAIS
                    .</h5><br>';
                    echo '<h5>'
                        . count($textRefCompara)
                        . '/'
                        . $totalArq
                        . ' arquivos Mysgs correspondem com Referências
                    .</h5><br>';
                }
                if (isset($textDocLinhas) && count($textDocLinhas) > 0) {
                    echo '<h5>Os '
                        . count($textDocLinhas)
                        . '/'
                        . $totalArq
                        . ' arquivos não correspondentes no MySGS são:</h5><br>';
                    foreach ($textDocLinhas as $textResult) {
                        echo $textResult
                            . '<br>';
                    }
                }
                if (isset($textArteLinhas) && count($textArteLinhas) > 0) {
                    echo '<h5>Os '
                        . count($textArteLinhas)
                        . '/'
                        . $totalArq
                        . ' arquivos não correspondentes na pasta Finais são:</h5><br>';
                    foreach ($textArteLinhas as $textResult) {
                        echo $textResult
                            . '<br>';
                    }
                }
                ?>
            </div>

    </main>
</body>

<footer>

    <?php include_once 'partials/footer.php'; ?>
</footer>

</html>