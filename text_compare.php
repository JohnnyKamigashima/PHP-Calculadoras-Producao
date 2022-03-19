<link rel="icon" type="image/png" href="./images/favicon.svg" />
<div class="row">
    <?php
    include_once 'partials/header.php';
    ?>
</div>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sessionEDuplo = (isset($_POST['espacoDuplo'])) ? 'checked' : '';
    $sessionECaixa =  (isset($_POST['caixaAlta'])) ? 'checked' : '';
    $sessionDoc = (isset($_POST['textDoc'])) ? $_POST['textDoc'] : '';
    $sessionArte = (isset($_POST['textArte'])) ? $_POST['textArte'] : '';
} else {
    $sessionDoc =
    $sessionArte = '';
    $sessionEDuplo =
    $sessionECaixa =  'checked';
}

?>
<html>
<title>QC Text Compare</title>
<!-- Latest compiled and minified CSS -->
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<link rel="stylesheet" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8" />

<!--  List compare -->
<div id="main" class="container-md">
    <div class="container p-3">
        <div class="titulo p-3">
            Compara Textos
        </div>
        <form action="text_compare.php" method="post">
            <div class="input-group">
                <div class="col-md-6">
                    <span class="input-group-text textwrapper" id="inputGroup-sizing-default">
                        Textos do Documento:
                    </span>
                    <div class="textwrapper">
                        <textarea rows="30" cols="50" name="textDoc" style="width:100%"><?php echo $sessionDoc; ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <span class="input-group-text textwrapper" id="inputGroup-sizing-default">
                        Textos da Arte:
                    </span>
                    <div class="textwrapper">
                        <textarea rows="30" cols="50" name="textArte" style="width:100%"><?php echo $sessionArte; ?></textarea>
                    </div>
                </div>
                <div class="form-check m-3 p-1">
                    <input class="form-check-input" type="checkbox" id="espacoDuplo" name="espacoDuplo" value="<?php echo $sessionEDuplo; ?>" <?php echo $sessionEDuplo; ?>>
                    <label class="form-check-label" for="espacoDuplo">Ignorar espaços duplos</label>
                </div>
                <div class="form-check m-3 p-1">
                    <input class="form-check-input" type="checkbox" id="caixaAlta" name="caixaAlta" value="<?php echo $sessionECaixa; ?>" <?php echo $sessionECaixa; ?>>
                    <label class="form-check-label" for="caixaAlta">Ignorar Maiúsculas</label>
                </div>
                <!-- <div class="form-check ml-3">

            <input class="form-check-input" type="checkbox" id="espacoDuplo" name="espacoDuplo" value="" checked>
            <label class="form-check-label" for="espacoDuplo">Ignorar espaços duplos</label>
        </div>
        <div class="form-check ml-3">

            <input class="form-check-input" type="checkbox" id="espacoDuplo" name="espacoDuplo" value="" checked>
            <label class="form-check-label" for="espacoDuplo">Ignorar espaços duplos</label>
        </div>
        </div> -->

            </div>
            <div class="container p-3">

                <input type="submit" value="Comparar" class="btn btn-success" />
            </div>
        </form>
        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require('partials/functions.php');

            //Variables
            $textDoc = $_POST['textDoc'];
            $textArte = $_POST['textArte'];
            $textDoc = preg_replace("/\t/", " ", $textDoc);
            $textArte = preg_replace("/\t/", " ", $textArte);
            $textCompara =
            $textDocPalavras =
            $textArtePalavras =
            $textArteLinhasNovo =
            $textDocLinhasNovo = array();

            //Constants
            define('ENCODING', 'UTF-8');
            define("ATENCAO", 'color:#880000');
            define("ALERTA", 'color:#FF0000');
            define('UNIDADEMEDIDA', '/\d+(cm|m|km|mcg|mg|g|kg|ml|l|cal|kcal)/i');
            define('TERMOSINVALIDOS', '/(\d+ |\d+)(CM|cM|Cm|mt|M|Mt|mT|KM|kM|MCG|Mcg|McG|mcG|MGc|MG|Mg|mG|G|GR|Gr|KG|Kg|kG|ML|Ml|CAL|Cal|CaL|cAL|caL|KCAL|Kcal|kCAL|kcAL|kcaL|KcaL|KCal|KcAL) /');

            if (isset($_POST['espacoDuplo'])) $espacoDuplo = ($_POST['espacoDuplo'] == 'checked') ? true : false;
            else $espacoDuplo = false;
            if (isset($_POST['caixaAlta'])) $caixaAlta = ($_POST['caixaAlta'] == 'checked') ? true : false;
            else $caixaAlta = false;

            // Substitui espaços duplos por espaços simples
            if ($espacoDuplo) {
                $textDoc = preg_replace("/ +/", " ", $textDoc);
                $textArte = preg_replace("/ +/", " ", $textArte);
            }

            // troca quebras de linha, quebras de linha dupla e espaço no final da linha por pipes
            $replaceChars = array();
            $replaceChars[0] = [
                "/(\r+|\n+| \n+|\|+)/",
                "/\|+/",
                "/\//",
                "/\*/",
                "/\(/",
                "/\)/"
            ];
            $replaceChars[1] = [
                "|",
                "|",
                "\/",
                "\*",
                "\(",
                "\)"
            ];
            $replaceChars[2] = [
                "\n",
                "\n",
                "/",
                "*",
                "(",
                ")"
            ];
            $textDoc = preg_replace($replaceChars[0], $replaceChars[1], $textDoc);
            $textArte = preg_replace($replaceChars[0], $replaceChars[1], $textArte);

            // converte texto para array dividido por linhas
            $textDocLinhas = explode('|', $textDoc);
            $textArteLinhas = explode('|', $textArte);

            // Verifica possiveis erros
            $unidadeMedidaEspaco = preg_grep(UNIDADEMEDIDA, $textArteLinhas);
            $unidadeMedidaCaixa = preg_grep(TERMOSINVALIDOS, $textArteLinhas);

            // remove sapaço em branco antes e depois de cada linha
            $textDocLinhas = array_map('trim', $textDocLinhas);
            $textArteLinhas = array_map('trim', $textArteLinhas);

            // remove linhas vazias no array
            $textDocLinhas = array_filter($textDocLinhas);
            $textArteLinhas = array_filter($textArteLinhas);

            // remove linhas repetidas no array
            $textDocLinhas = array_unique($textDocLinhas);
            $textArteLinhas = array_unique($textArteLinhas);

            // Compara linha por linha
            foreach ($textDocLinhas as $indiceDoc => $docLinha) {
                foreach ($textArteLinhas as $indiceArte => $arteLinha) {
                    if (($caixaAlta) ? (mb_strtoupper($arteLinha, ENCODING) == mb_strtoupper($docLinha, ENCODING)) : ($arteLinha == $docLinha)) {
                        if ($docLinha != '') array_push($textCompara, $arteLinha);
                        unset($textDocLinhas[$indiceDoc]);
                        unset($textArteLinhas[$indiceArte]);
                        break;
                    }
                }
            }

            // compara palavra por palavra
            foreach ($textDocLinhas as $cadalinha)      array_push($textDocPalavras, explode(' ', $cadalinha));
            foreach ($textArteLinhas as $cadalinha)        array_push($textArtePalavras, explode(' ', $cadalinha));
            foreach ($textDocPalavras as $indicePalavraDoc => $palavrasDoc) {
                $palavrasIguais = array();

                // joga palavras iguais numa array para ver qual linha tem mais repeticoes
                foreach ($textArtePalavras as $indicePalavraArte => $palavrasArte) {
                    $difNumPalavras = 9999 - abs(count($palavrasDoc) - count($palavrasArte));
                    $correspond = true;
                    if (abs(count($palavrasDoc) - count($palavrasArte)) > (count($palavrasDoc) / 3)) $correspond = false;
                    if ($caixaAlta) array_push($palavrasIguais, [$difNumPalavras, count(descomparaArrays($palavrasDoc, $palavrasArte, $caixaAlta)), $indicePalavraDoc, $indicePalavraArte, $correspond]);
                    else array_push($palavrasIguais, [$difNumPalavras, count(descomparaArrays($palavrasDoc, $palavrasArte, $caixaAlta)), $indicePalavraDoc, $indicePalavraArte, $correspond]);
                }
                rsort($palavrasIguais); //coloca em ordem decrescente para que a linha com mais repeticoes seja a primeira

                if (isset($palavrasIguais[0][1]) && $palavrasIguais[0][1] > 1 && $palavrasIguais[0][4] == true) {
                    $difdeDoc = comparaArrays($textDocPalavras[$palavrasIguais[0][2]], $textArtePalavras[$palavrasIguais[0][3]], $caixaAlta);
                    $difdeArte = comparaArrays($textArtePalavras[$palavrasIguais[0][3]], $textDocPalavras[$palavrasIguais[0][2]], $caixaAlta);
                    // foreach ($difdeDoc as $palavra) {
                    //     foreach ($textDocPalavras[$palavrasIguais[0][2]] as $indexDocPalavra => $docPalavra) {
                    //         if ($palavra == $docPalavra) {
                    //             $textDocPalavras[$palavrasIguais[0][2]][$indexDocPalavra] = "<strong style="ALERTA">" . $textDocPalavras[$palavrasIguais[0][2]][$indexDocPalavra] . '</strong>';
                    //             break;
                    //         }
                    //     }
                    // }
                    // foreach ($difdeArte as $palavra) {
                    //     foreach ($textArtePalavras[$palavrasIguais[0][3]] as $indexDocArte => $docArte) {
                    //         if ($palavra == $docArte) {
                    //             $textArtePalavras[$palavrasIguais[0][3]][$indexDocArte] = "<strong style="ALERTA">" . $textArtePalavras[$palavrasIguais[0][3]][$indexDocArte] . '</strong>';
                    //             break;
                    //         }
                    //     }
                    // }
                    // array_push($textDocLinhasNovo, $textDocPalavras[$palavrasIguais[0][2]]);
                    // array_push($textArteLinhasNovo, $textArtePalavras[$palavrasIguais[0][3]]);
                    array_push($textDocLinhasNovo, frasesDiff($textDocPalavras[$palavrasIguais[0][2]], $textArtePalavras[$palavrasIguais[0][3]], $caixaAlta, ALERTA, ATENCAO));
                    array_push($textArteLinhasNovo, frasesDiff($textArtePalavras[$palavrasIguais[0][3]], $textDocPalavras[$palavrasIguais[0][2]], $caixaAlta, ALERTA, ATENCAO));
                    unset($textDocPalavras[$palavrasIguais[0][2]]);
                    unset($textArtePalavras[$palavrasIguais[0][3]]);
                }
            }
            while (count($textDocLinhasNovo) < count($textArteLinhasNovo)) {
                array_push($textDocLinhasNovo, array(''));
            }

            echo ' <div class="container p-6 m-0">';
            echo '<hr style="width:100%;text-align:center;margin-left:auto">';
            if (isset($unidadeMedidaEspaco) && count($unidadeMedidaEspaco) > 0) {
                echo "<h5>Unidades de medida sem espaço: </h5>";
                echo "<strong style=$atencao>";
                foreach ($unidadeMedidaEspaco as $erro) echo "<br><h7>" . str_replace($replaceChars[1], $replaceChars[2], $erro) . "</h7><br>";
                echo "</strong>";
            }
            if (isset($unidadeMedidaCaixa) && count($unidadeMedidaCaixa) > 0) {
                echo "<br><h6>Unidades de medida com escrita errada: </h6>";
                echo "<strong style=$atencao>";
                foreach ($unidadeMedidaCaixa as $erro) echo "<br><h7>" . str_replace($replaceChars[1], $replaceChars[2], $erro) . "</h7><br>";
                echo "</strong>";
            }
            echo '<hr style="width:100%;text-align:center;margin-left:auto">';
            if (isset($textCompara)) echo '<br><h5>' . count($textCompara) . ' parágrafos correspondem.</h5><br>';
            echo '</div>';
            if ((isset($textDocLinhasNovo) && count($textDocLinhasNovo) > 0) || (isset($textArteLinhasNovo) && count($textArteLinhasNovo) > 0) || max(count($textDocPalavras), count($textArtePalavras)) > 0) {
                echo '<div class="row p-3 m-0">';
                echo '<div class="col-md-6">';
                echo '<h5>Os ' . (count_valid($textDocLinhasNovo) + count_valid($textDocPalavras)) . '/' . (count_valid($textDocLinhasNovo) + count_valid($textCompara) + count_valid($textDocPalavras)) . ' parágrafos não correspondentes<br>no Documento são:</h5><br>';
                echo '</div>';
                echo '<div class="col-md-6">';
                echo '<h5>Os ' . (count_valid($textArteLinhasNovo) + count_valid($textArtePalavras))  . '/' . (count_valid($textArteLinhasNovo) + count_valid($textCompara) + count_valid($textArtePalavras)) .  ' parágrafos não correspondentes<br>na Arte são:</h5><br>';
                echo '</div>';
                echo '</div>';

                // sort($textDocLinhasNovo);
                // sort($textArteLinhasNovo);
                for ($item = 0; $item < max(count_valid($textDocLinhasNovo), count_valid($textArteLinhasNovo)); $item++) { {
                        echo '<div class="row p-3 m-0">';
                        echo '<div class="col-md-6">';
                        foreach ($textDocLinhasNovo[$item] as $textResult) echo str_replace($replaceChars[1], $replaceChars[2], $textResult) . ' ';
                        echo '</div>';
                        echo '<div class="col-md-6">';
                        foreach ($textArteLinhasNovo[$item] as $textResult) echo str_replace($replaceChars[1], $replaceChars[2], $textResult) . ' ';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            }
            while (count($textDocPalavras) > count($textArtePalavras)) array_push($textArtePalavras, array(''));
            while (count($textArtePalavras) > count($textDocPalavras)) array_push($textDocPalavras, array(''));
            for ($item = 0; $item < max(count_valid($textDocPalavras), count_valid($textArtePalavras)); $item++) {
                echo '<div class="row p-3 m-0">';
                echo '<div class="col-md-6">';
                $reind = array_values($textDocPalavras);
                echo "<strong style=$atencao>";
                if (isset($reind[$item])) foreach ($reind[$item] as $textResult) echo str_replace($replaceChars[1], $replaceChars[2], $textResult) . ' ';
                "</strong>";
                echo '</div>';
                echo '<div class="col-md-6">';
                $reind = array_values($textArtePalavras);
                echo "<strong style=$atencao>";
                if (isset($reind[$item])) foreach ($reind[$item] as $textResult) echo str_replace($replaceChars[1], $replaceChars[2], $textResult) . ' ';
                echo "</strong>";
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>

</div>
</div>
<?php include_once 'partials/footer.php'; ?>

</html>