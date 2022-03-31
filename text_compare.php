<!DOCTYPE html>
<link rel="icon" type="image/png" href="./images/favicon.svg" />
<div class="row">
    <?php include_once 'partials/header.php'; ?>
</div>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sessionEDuplo = (isset($_POST['espacoDuplo'])) ? 'checked' : '';
    $sessionECaixa =  (isset($_POST['caixaAlta'])) ? 'checked' : '';
    $sessionEbold =  (isset($_POST['bold'])) ? 'checked' : '';
    $sessionEitalico =  (isset($_POST['italico'])) ? 'checked' : '';
    $sessionDoc = (isset($_POST['textDoc'])) ? $_POST['textDoc'] : '';
    $sessionArte = (isset($_POST['textArte'])) ? $_POST['textArte'] : '';
    $sessionRascunho = (isset($_POST['rascunho'])) ? $_POST['rascunho'] : '';
} else {
    $sessionDoc = $sessionArte = $sessionRascunho = $sessionEbold = $sessionEitalico = '';
    $sessionEDuplo = $sessionECaixa =  'checked';
}

?>

<head>

</head>

<html>

<body>
    <title>QC Text Compare</title>
    <!-- Latest compiled and minified CSS -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/1hwzefvhux0zaed3wgjhtj8xrid32be83jl71noha1gb803t/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type='text/javascript' src='partials/functions.js'></script>

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
                    <!-- <div class="col-md-12">
                        <span class="input-group-text textwrapper" id="inputGroup-sizing-default">
                        Rascunho (texto Simples):
                        </span>
                        <div class="textwrapper">
                            <textarea rows="8" cols="50" id='rascunho' name='rascunho' style="width:100%"><?php echo $sessionRascunho; ?></textarea>
                        </div>
                    </div> -->
                    <div class="col-md-6">
                        <span class="input-group-text textwrapper" id="inputGroup-sizing-default">
                            Textos do Documento:
                        </span>
                        <div class="textwrapper">
                            <textarea id='textDoc' name='textDoc' style="width:100%"><?php echo $sessionDoc; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span class="input-group-text textwrapper" id="inputGroup-sizing-default">
                            Textos da Arte:
                        </span>
                        <div class="textwrapper">
                            <textarea id="textArte" name='textArte' style="width:100%"><?php echo $sessionArte; ?></textarea>
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
                    <div class="form-check m-3 p-1">
                        <input class="form-check-input" type="checkbox" id="bold" name="bold" value="<?php echo $sessionEbold; ?>" <?php echo $sessionEbold; ?>>
                        <label class="form-check-label" for="bold">Ignorar Bold</label>
                    </div>
                    <div class="form-check m-3 p-1">
                        <input class="form-check-input" type="checkbox" id="italico" name="italico" value="<?php echo $sessionEitalico; ?>" <?php echo $sessionEitalico; ?>>
                        <label class="form-check-label" for="italico">Ignorar Itálico</label>
                    </div>
                </div>
                <div class="container p-3">

                    <input type="submit" id="submit" value="Comparar" class="btn btn-success" />
                </div>
            </form>

            <script>
                document.addEventListener("keydown", e => {
                    console.log(e)
                })
                document.addEventListener("keydown", e => {
                    if ((e.key.toLowerCase() === "enter" &&
                            e.ctrlKey) || e.key.toLowerCase() === "f12") {
                        document.getElementById("submit").click();
                    }
                })

                tinymce.init({
                    selector: 'textarea#textDoc',
                    plugins: ' casechange searchreplace fullscreen wordcount visualchars  tinymcespellchecker  powerpaste',
                    menubar: false,
                    toolbar: 'bold italic paste pastetext searchreplace visualchars spellchecker fullscreen',
                    toolbar_mode: 'floating',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name',
                    height: 300,
                    init_instance_callback: function(editor) {
                        editor.on('paste', function(e) {
                            tinymce.get("textDoc").setContent(removeTags(tinymce.get("textDoc").getContent()));;
                        });
                    }
                });
                tinymce.init({
                    selector: 'textarea#textArte',
                    plugins: ' casechange searchreplace fullscreen wordcount visualchars  tinymcespellchecker  powerpaste',
                    menubar: false,
                    toolbar: 'bold italic paste pastetext searchreplace visualchars spellchecker fullscreen',
                    toolbar_mode: 'floating',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name',
                    height: 300,
                    init_instance_callback: function(editor) {
                        editor.on('paste', function(e) {
                            tinymce.get("textArte").setContent(removeTags(tinymce.get("textArte").getContent()));;
                        });
                    }
                });

                function updateValues() {
                    <?php
                    $sessionDoc = "<script>master.html.get()</script>";
                    $sessionArte = "<script>copy.html.get()</script>";
                    ?>
                }
            </script>

            <?php

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                require('partials/functions.php');

                //Variables
                $textDoc = removeTags($_POST['textDoc']);
                $textArte = removeTags($_POST['textArte']);
                $faltaBOLD = $faltaItalic = $faltaCAIXA = array();
                $textCompara =
                    $textDocPalavras =
                    $textArtePalavras =
                    $textArteLinhasNovo =
                    $textDocLinhasNovo = array();

                //Constants
                define('ENCODING', 'UTF-8');
                define("ATENCAO", '880000');
                define("ALERTA", 'FF0000');
                define('UNIDADEMEDIDA', '/\d+(cm|m|km|mcg|mg|g|kg|ml|l|cal|kcal)/i');
                define('TERMOSINVALIDOS', '/(\d+ |\d+)(CM|cM|Cm|mt|M|Mt|mT|KM|kM|MCG|Mcg|McG|mcG|MGc|MG|Mg|mG|G|GR|Gr|KG|Kg|kG|ML|Ml|CAL|Cal|CaL|cAL|caL|KCAL|Kcal|kCAL|kcAL|kcaL|KcaL|KCal|KcAL) /');

                //Checa opçoes selecionadas
                if (isset($sessionEDuplo)) $espacoDuplo = ($sessionEDuplo == 'checked') ? true : false;
                else $espacoDuplo = false;
                if (isset($sessionECaixa)) $caixaAlta = ($sessionECaixa == 'checked') ? true : false;
                else $caixaAlta = false;
                if (isset($sessionEbold)) $bold = ($sessionEbold == 'checked') ? true : false;
                else $bold = false;
                if (isset($sessionEitalico)) $italico = ($sessionEitalico == 'checked') ? true : false;
                else $italico = false;

                //converte para Decodifica HTML
                $textDoc = html_entity_decode($textDoc);
                $textArte = html_entity_decode($textArte);

                // Limpeza inicial de Tags HTML
                $textDoc = preg_replace("/\t/", " ", $textDoc);
                $textArte = preg_replace("/\t/", " ", $textArte);
                $textDoc = preg_replace("/(<(\/?(p|br).*?)>)/i", "\n", $textDoc);
                $textArte = preg_replace("/(<(\/?(p|br).*?)>)/i", "\n", $textArte);

                //Verifica textos obrigatorios BOLD/Italic/Caixa alta
                if (!$bold) foreach (isBold('fabricado', 'ltda', $textArte) as $result) array_push($faltaBOLD, $result);
                if (!$bold) foreach (isBold('fabricado', 's.a.', $textArte) as $result) array_push($faltaBOLD, $result);
                if (!$bold) foreach (isBold('importado', 'ltda', $textArte) as $result) array_push($faltaBOLD, $result);
                if (!$bold) foreach (isBold('importado', 's.a.', $textArte) as $result) array_push($faltaBOLD, $result);
                if (!$bold) foreach (isBold('(contém lactose|contém glúten|ingredientes|ingred|ingr)', '', $textArte) as $result) array_push($faltaBOLD, $result);
                if (!$italico) foreach (isItalic('trans', '', $textArte) as $result) array_push($faltaItalic, $result);
                foreach (isCaixa('contém', '(glúten|lactose)', $textArte) as $result) array_push($faltaCAIXA, $result);

                // Remove Bolds antes de checar
                if ($bold) {
                    $textDoc = preg_replace("/(<(\/?(strong).*?)>)/i", "", $textDoc);
                    $textArte = preg_replace("/(<(\/?(strong).*?)>)/i", "", $textArte);
                }
                // Remove Italico antes de checar
                if ($italico) {
                    $textDoc = preg_replace("/(<(\/?(em).*?)>)/i", "", $textDoc);
                    $textArte = preg_replace("/(<(\/?(em).*?)>)/i", "", $textArte);
                }
                // Substitui espaços duplos por espaços simples
                if ($espacoDuplo) {
                    $textDoc = preg_replace("/ +/", " ", $textDoc);
                    $textArte = preg_replace("/ +/", " ", $textArte);
                }

                // troca quebras de linha, e limpeza de tags com espaços antes ou depois ou bolds italicos de espaços vazios
                $replaceChars = array();
                $replaceChars[0] = [
                    "/(\r+|<br>|\n+| \n+|\|+)/",
                    // "/\|+ ?\|+/",
                    // "/\*/",
                    // "/\(/",
                    // "/\)/",
                    "/ ?<em> ?/",
                    "/ ?<\/em> ?/",
                    "/( ?|\s?)<strong> ?/",
                    "/( ?|\s?)<\/strong> ?/",
                    "/(<strong>(\s?)+<\/strong>|<em>(\s?)+<\/em>|<\/strong>(\s?)+<strong>|<\/em>(\s?)+<em>)/"
                ];
                $replaceChars[1] = [
                    "|",
                    // "|",
                    // "*",
                    // "(",
                    // ")",
                    " <em>",
                    "</em> ",
                    " <strong>",
                    "</strong> ",
                    " "
                ];
                $replaceChars[2] = [
                    "\n",
                    // "\n",
                    // "*",
                    // "(",
                    // ")",
                    " <em>",
                    "</em> ",
                    " <strong>",
                    "</strong> ",
                    " "

                ];
                $textDoc = preg_replace($replaceChars[0], $replaceChars[1], $textDoc);
                $textArte = preg_replace($replaceChars[0], $replaceChars[1], $textArte);
                $textDoc = preg_replace("/<em>([[:punct:]])+<\/em>/", "$1", $textDoc);
                $textArte = preg_replace("/<em>([[:punct:]])+<\/em>/", "$1", $textArte);
                $textDoc = preg_replace("/<strong>([[:punct:]])+<\/strong>/", "$1", $textDoc);
                $textArte = preg_replace("/<strong>([[:punct:]])+<\/strong>/", "$1", $textArte);
                $textDoc = preg_replace("/\|\<\/strong>/", "</strong>", $textDoc);
                $textArte = preg_replace("/\|\<\/strong>/", "</strong>", $textArte);
                $textDoc = preg_replace("/\|+ ?\|+/", "|", $textDoc);
                $textArte = preg_replace("/\|+ ?\|+/", "|", $textArte);
                $textDoc = preg_replace("/\<strong\>(.*)\|/", "<strong>$1</strong>|<strong>", $textDoc);
                $textArte = preg_replace("/\<strong\>(.*)\|/", "<strong>$1</strong>|<strong>", $textArte);

                var_dump(preg_replace("/\</", "&lt;", $textDoc));
                echo "<br><br>";
                var_dump(preg_replace("/\</", "&lt;", $textArte));

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
                        if ($caixaAlta) {
                            $caixaArte = mb_strtoupper($arteLinha, ENCODING);
                            $caixaDoc = mb_strtoupper($docLinha, ENCODING);
                        } else {
                            $caixaArte = $arteLinha;
                            $caixaDoc = $docLinha;
                        }
                        if ($caixaArte == $caixaDoc) {
                            if ($caixaDoc != '') array_push($textCompara, $caixaArte);
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
                        array_push($textDocLinhasNovo, frasesDiff($textDocPalavras[$palavrasIguais[0][2]], $textArtePalavras[$palavrasIguais[0][3]], $caixaAlta, ALERTA, ATENCAO));
                        array_push($textArteLinhasNovo, frasesDiff($textArtePalavras[$palavrasIguais[0][3]], $textDocPalavras[$palavrasIguais[0][2]], $caixaAlta, ALERTA, ATENCAO));
                        unset($textDocPalavras[$palavrasIguais[0][2]]);
                        unset($textArtePalavras[$palavrasIguais[0][3]]);
                    }
                }
                while (count($textDocLinhasNovo) < count($textArteLinhasNovo)) {
                    array_push($textDocLinhasNovo, array(''));
                }

                // Mostra Resultados de textos legais
                echo ' <div class="container p-6 m-0">';
                if (isset($unidadeMedidaEspaco) && count($unidadeMedidaEspaco) > 0) {
                    echo '<hr style="width:100%;text-align:center;margin-left:auto">';
                    echo "<h5>Unidades de medida sem espaço: </h5>";
                    echo "<strong style='color:#" . ATENCAO . "'>";
                    foreach ($unidadeMedidaEspaco as $erro) echo "<br><h7>" . str_replace($replaceChars[1], $replaceChars[2], $erro) . "</h7><br>";
                    echo "</strong>";
                }
                if (isset($unidadeMedidaCaixa) && count($unidadeMedidaCaixa) > 0) {
                    echo "<br><h6>Unidades de medida com escrita errada: </h6>";
                    echo "<strong style='color:#" . ATENCAO . "'>";
                    foreach ($unidadeMedidaCaixa as $erro) echo "<br><h7>" . str_replace($replaceChars[1], $replaceChars[2], $erro) . "</h7><br>";
                    echo "</strong>";
                }
                if (count($faltaBOLD) > 0) {
                    echo '<hr style="width:100%;text-align:center;margin-left:auto">';
                    echo '<h5>Atenção a estas frases que não estão em BOLD:</h5><br>';
                    foreach ($faltaBOLD as $lin) echo "<br><h7>$lin</h7>";
                }
                if (count($faltaItalic) > 0) {
                    echo '<hr style="width:100%;text-align:center;margin-left:auto">';
                    echo '<h5>Atenção a estas palavras que não estão em Itálico:</h5><br>';
                    foreach ($faltaItalic as $lin) echo "<br><h7>$lin</h7>";
                }
                if (count($faltaCAIXA) > 0) {
                    echo '<hr style="width:100%;text-align:center;margin-left:auto">';
                    echo '<h5>Atenção a estas palavras que não estão em CAIXA ALTA:</h5><br>';
                    foreach ($faltaCAIXA as $lin) echo "<br><h7>$lin</h7>";
                }

                // Mostra resultados da comparação de paragrafos
                echo '<hr style="width:100%;text-align:center;margin-left:auto">';
                if (isset($textCompara)) echo '<br><h5>' . count($textCompara) . ' parágrafos correspondem.</h5><br>';
                echo '</div>';

                //Mostra resultados que parecem que estão errados
                if ((isset($textDocLinhasNovo) && count($textDocLinhasNovo) > 0) || (isset($textArteLinhasNovo) && count($textArteLinhasNovo) > 0) || max(count($textDocPalavras), count($textArtePalavras)) > 0) {
                    echo '<div class="row p-3 m-0">';
                    echo '<div class="col-md-6">';
                    echo '<h5>Os ' . (count_valid($textDocLinhasNovo) + count_valid($textDocPalavras)) . '/' . (count_valid($textDocLinhasNovo) + count_valid($textCompara) + count_valid($textDocPalavras)) . ' parágrafos não correspondentes<br>no Documento são:</h5><br>';
                    echo '</div>';
                    echo '<div class="col-md-6">';
                    echo '<h5>Os ' . (count_valid($textArteLinhasNovo) + count_valid($textArtePalavras))  . '/' . (count_valid($textArteLinhasNovo) + count_valid($textCompara) + count_valid($textArtePalavras)) .  ' parágrafos não correspondentes<br>na Arte são:</h5><br>';
                    echo '</div>';
                    echo '</div>';
                    echo '<br>';

                    for ($item = 0; $item < max(count_valid($textDocLinhasNovo), count_valid($textArteLinhasNovo)); $item++) { {
                            echo '<div class="row p-3 m-0">';
                            echo '<div class="col-md-6">';
                            foreach ($textDocLinhasNovo[$item] as $textResult) echo str_replace($replaceChars[1], $replaceChars[2], $textResult) . ' ';
                            echo '</div>';
                            echo '<div class="col-md-6">';
                            foreach ($textArteLinhasNovo[$item] as $textResult) echo str_replace($replaceChars[1], $replaceChars[2], $textResult) . ' ';
                            echo '</div></div>';
                        }
                    }
                }

                // Mostra resultados não encontrados
                while (count($textDocPalavras) > count($textArtePalavras)) array_push($textArtePalavras, array(''));
                while (count($textArtePalavras) > count($textDocPalavras)) array_push($textDocPalavras, array(''));
                for ($item = 0; $item < max(count_valid($textDocPalavras), count_valid($textArtePalavras)); $item++) {
                    echo '<div class="row p-3 m-0">';
                    echo '<div class="col-md-6">';
                    $reind = array_values($textDocPalavras);
                    echo "<text style='color:#" . ALERTA . "'>";
                    if (isset($reind[$item])) foreach ($reind[$item] as $textResult) echo str_replace($replaceChars[1], $replaceChars[2], $textResult) . ' ';
                    "</text>";
                    echo '</div>';
                    echo '<div class="col-md-6">';
                    $reind = array_values($textArtePalavras);
                    echo "<text style='color:#" . ALERTA . "'>";
                    if (isset($reind[$item])) foreach ($reind[$item] as $textResult) echo str_replace($replaceChars[1], $replaceChars[2], $textResult) . ' ';
                    echo "</text>";
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>

    </div>
    </div>
</body>
<?php include_once 'partials/footer.php'; ?>

</html>